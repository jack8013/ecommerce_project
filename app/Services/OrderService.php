<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    /**
     * Create a new class instance.
     */
    public function index()
    {
        $orders = Order::all();

        return $orders;
    }

    public function show($id)
    {
        $order = Order::find($id);

        return $order;
    }

    public function store($request)
    {
        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart || $cart->products->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }
        $order_total = 0;
        $order = Order::create([
            'name' => $request->name,
            'rec_address' => $request->address,
            'phone' => $request->phone,
            'order_total' => 0,
            'user_id' => $user->id,
        ]);

        foreach ($cart->products as $product) {
            OrderDetails::create([
                'product_quantity' => $product->pivot->quantity,
                'price' => $product->price,
                'price_total' => $product->pivot->price,
                'order_id' => $order->id,
                'product_id' => $product->id
            ]);

            $product->update([
                'quantity' => $product->quantity - $product->pivot->quantity,
            ]);

            $order_total += $product->pivot->price;
        }

        $order->update([
            'order_total' => $order_total,
        ]);

        $cart->products()->detach();

        return $order;
    }
}
