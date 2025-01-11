<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct(private CartService $service) {}

    public function add_cart(int $id, Request $request)
    {
        // $product = Product::find($id);
        // $user = Auth::user();

        // if (!$user) {
        //     return redirect();
        // }

        // //If user has no cart, create one
        // $cart = $user->cart ?: $cart = Cart::create(['user_id' => $user->id,]);

        // $productExist = $cart->products()->where('product_id', $id)->first();

        // if ($productExist) {
        //     $quantity = $productExist->pivot->quantity + ($request->quantity ?: 1);
        //     $cart->products()->updateExistingPivot(
        //         $id,
        //         [
        //             'quantity' => $quantity,
        //             'price' => $product->price * $quantity
        //         ]
        //     );
        // } else {
        //     $cart->products()->attach($id, ['quantity' => ($request->quantity ?: 1), 'price' => $product->price]);
        // }

        $cart = $this->service->store($id, $request);

        toastr()
            ->closeButton()
            ->success('Product added to cart successfully');

        return redirect()->back();
    }

    public function user_cart()
    {
        $this->service->show();
        // $user_id = Auth::user()?->id;

        // $count = Cart::where('user_id', $user_id)->count();

        // // Each user has only one cart, so fetch cart through User's eloquent relationship
        // $cart = Auth::user()?->cart;

        //$products = Product::all();
        //$cart = Cart::with('products')->where('user_id', $user_id)->get();

        return view('home.user_cart', compact('cart', 'count'));
    }

    public function remove_cart_item(int $id)
    {
        // $user = Auth::user();
        // $cart = $user->cart;

        // if ($cart) {
        //     $cart->products()->detach($id);
        // }

        $this->service->destroy($id);

        return redirect()->back();
    }
}
