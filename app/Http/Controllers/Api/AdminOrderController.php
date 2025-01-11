<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrderController extends Controller
{
    public function __construct(private OrderService $service) {}

    public function index()
    {
        $orders = $this->service->index();

        return response()->json([
            'data' => $orders,
        ]);
    }

    public function show($id)
    {
        $order = $this->service->show($id);

        return response()->json([
            'data' => $order,
        ]);
    }

    public function store($request)
    {
        $order = $this->service->store($request);

        return response()->json([
            'data' => $order
        ]);
        // $user = Auth::user();
        // $cart = $user->cart;

        // if (!$cart || $cart->products->isEmpty()) {
        //     return redirect()->back()->with('error', 'Your cart is empty.');
        // }
        // $order_total = 0;
        // $order = Order::create([
        //     'name' => $request->name,
        //     'rec_address' => $request->address,
        //     'phone' => $request->phone,
        //     'order_total' => 0,
        //     'user_id' => $user->id,
        // ]);

        // foreach ($cart->products as $product) {
        //     OrderDetails::create([
        //         'product_quantity' => $product->pivot->quantity,
        //         'price' => $product->price,
        //         'price_total' => $product->pivot->price,
        //         'order_id' => $order->id,
        //         'product_id' => $product->id
        //     ]);

        //     $product->update([
        //         'quantity' => $product->quantity - $product->pivot->quantity,
        //     ]);

        //     $order_total += $product->pivot->price;
        // }

        // $order->update([
        //     'order_total' => $order_total,
        // ]);


    }
}
