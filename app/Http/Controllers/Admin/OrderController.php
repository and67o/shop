<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::query()->where('status', 1)->get();
        return view('auth.panel.index', compact('orders'));
    }
}
