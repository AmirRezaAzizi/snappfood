<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderCollection;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('vendor', 'trip')->paginate(\request('paginate'));

        return new OrderCollection($orders);
    }
}
