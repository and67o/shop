<?php

namespace App\Http\Middleware;

use App\Order;
use Closure;
use Illuminate\Http\Request;

class BasketIsNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $orderId = session('orderId');
        /* @var $order Order */
        if (is_null($orderId)) {
            $order = Order::findOrFail($orderId);
            if ($order->products()->count()) {
                session()->flash('warning', 'Ваша корзина пуста');
                return redirect()->route('home');
            }
        }

        return $next($request);
    }
}
