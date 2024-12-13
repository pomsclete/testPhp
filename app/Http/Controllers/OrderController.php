<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //public function store(Request $request)
    public function store(OrderStoreRequest $request)
    {
        Order::create([
            'label' =>  $request->label,
            'sends_at'  =>  $request->sends_at
        ]);

        return redirect()->route('welcome');
    }

    public function update(OrderStoreRequest $request, Order $order)
    {
        $order->update([
            'label' =>  $request->label,
            'sends_at'  =>  $request->sends_at
        ]);

        return redirect()->route('orders.show', $order);

    }

    public function delete(Order $order)
    {
        $order->delete();

        return redirect()->route('welcome');

    }


}
