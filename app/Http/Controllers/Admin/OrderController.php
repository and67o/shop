<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()->active()->paginate();
        return view('auth.panel.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('auth.panel.show', compact('order'));
    }
}
