<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()->where('status', 1)->paginate();
        return view('auth.panel.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('auth.panel.show', compact('order'));
    }
}
