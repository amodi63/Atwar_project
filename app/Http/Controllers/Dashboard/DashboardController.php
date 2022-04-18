<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->latest()->take(5)->get();

        $total = 0;
        foreach ($orders as $order){
            $total += $order->total_price;
        }
        return view('admin.dashboard', compact('total', 'orders'));
    }
}
