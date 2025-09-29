<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }
    
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }
    
    public function store(Request $request)
    {
        // Simple order creation for demo
        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }
    
    public function checkout()
    {
        return view('checkout');
    }
}