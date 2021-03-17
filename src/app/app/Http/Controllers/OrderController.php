<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index($slug)
    {
        $order = Order::withoutGlobalScope('ref')->with(['driver'])->where('slug', $slug)->firstOrFail();
        $rest = User::withoutGlobalScope('ref')->findOrFail($order->user_id);
        return view('order', compact(['order', 'rest']));
    }
}
