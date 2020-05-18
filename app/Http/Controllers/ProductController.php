<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsFilterRequest;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    const COUNT_OF_PAGE = 4;

    /**
     * Display a listing of the resource.
     *
     * @param ProductsFilterRequest $request
     * @param int $categoryId
     * @return Factory|Application|View
     */
    public function index(ProductsFilterRequest $request, $categoryId = 0)
    {
        $query = Product::with('category');
        if ($request->filled('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }

        if ($request->filled('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }

        foreach (['hit', 'new', 'recommend',] as $field) {
            if ($request->has($field)) {
                $query->$field();
            }
        }

        $products = $query
            ->paginate(
                self::COUNT_OF_PAGE,
                ['*'],
                'page',
                (int)$request->input('page')
            )->withPath('?' . $request->getQueryString());

        return view(
            'products.index',
            ['products' => $products]
        );
    }
}
