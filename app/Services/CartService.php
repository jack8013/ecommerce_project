<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function show()
    {
        $user_id = Auth::user()?->id;

        // Each user has only one cart, so fetch cart through User's eloquent relationship
        $cart = Auth::user()?->cart;

        return $cart;
    }

    public function store($id, Request $request)
    {
        $product = Product::find($id);
        $user = Auth::user();

        if (!$user) {
            return redirect();
        }

        //If user has no cart, create one
        $cart = $user->cart ?: $cart = Cart::create(['user_id' => $user->id,]);

        $productExist = $cart->products()->where('product_id', $id)->first();

        if ($productExist) {
            $quantity = $productExist->pivot->quantity + ($request->quantity ?: 1);
            $cart->products()->updateExistingPivot(
                $id,
                [
                    'quantity' => $quantity,
                    'price' => $product->price * $quantity
                ]
            );
        } else {
            $cart->products()->attach($id, ['quantity' => ($request->quantity ?: 1), 'price' => $product->price]);
        }

        return $cart;
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $cart = $user->cart;

        if ($cart) {
            $cart->products()->detach($id);
        }

        return $cart;
    }
}
