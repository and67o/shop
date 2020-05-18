<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class CartController
 * @package App\Http\Controllers
 */
class BasketController extends Controller
{
    /**
     *
     */
    public function index(): View
    {
        $orderId = session('orderId');

        $order = [];
        if (!is_null($orderId)) {
            $order = Order::query()->findOrFail($orderId);
        }

        return view(
            'basket.index',
            compact('order')
        );
    }

    public function basketAdd(int $productId)
    {
        $orderId = session('orderId');
        /* @var $order Order */
        if (is_null($orderId)) {
            $order = Order::query()->create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::query()->find($orderId);
        }

        if ($order->getProducts() && $order->getProducts()->contains($productId)) {
            $pivotRow = $order
                ->products()
                ->where('product_id', $productId)
                ->first();
            if (!is_null($pivotRow)) {
                $pivotRow = $pivotRow->pivot;
            }
            $pivotRow->count++;
            $pivotRow->update();
        } else {
            $order->products()->attach($productId);
        }

        if (Auth::check()) {
            $order->setUserId(Auth::id());
            $order->save();
        }

        /* @var $product Product */
        $product = Product::query()->find($productId);


        Order::changeFullSum($product->getPrice());
        session()->flash('success', 'Товар добавлен' . $product->getName());

        return redirect()->route('basket');
    }

    public function basketRemove(int $productId)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('basket');
        }
        /* @var $order Order */
        $order = Order::query()->find($orderId);

        if ($order->getProducts() && $order->getProducts()->contains($productId)) {
            $pivotRow = $order
                ->products()
                ->where('product_id', $productId)
                ->first();
            if (!is_null($pivotRow)) {
                $pivotRow = $pivotRow->pivot;
            }
            if ($pivotRow->count < 2) {
                $order->products()->detach();
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }
        /* @var $product Product */
        $product = Product::query()->find($productId);
        Order::changeFullSum(-$product->getPrice());
        session()->flash('warning', 'Товар удален' . $product->getName());

        return redirect()->route('basket');
    }

    public function basketPlace()
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('home');
        }

        $order = Order::query()->find($orderId);

        return view('basket.place', compact('order'));
    }

    public function basketConfirm(Request $request)
    {
        $name = (string)$request->input('name');
        $phone = (string)$request->input('phone');
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('home');
        }
        /* @var $order Order */
        $order = Order::query()->find($orderId);
        if (is_null($order)) {
            return redirect()->route('home');
        }

        $success = $order->saveOrder($name, $phone);
        if ($success) {
            session()->flash('success', 'заказ в обработке');
        } else {
            session()->flash('warning', 'случилось ошибка');
        }

Order::eraseOrderSum();

        return redirect()->route('home');
    }
}
