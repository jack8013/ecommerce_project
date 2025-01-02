<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function home()
    {
        $products = Product::all();

        $user_id = Auth::user()?->id;

        $count = Cart::where('user_id', $user_id)->count();
        return view('home.index', compact('products', 'count'));
    }

    public function login_home()
    {
        $products = Product::all();

        $user_id = Auth::user()?->id;

        $count = Cart::where('user_id', $user_id)->count();

        return view('home.index', compact('products', 'count'));
    }

    public function add_cart(int $id)
    {
        $product = Product::find($id);

        $user = Auth::user();

        $user_id = $user->id;

        $cart = Cart::create([
            'user_id' => $user_id,
            'product_id' => $product->id,
        ]);

        toastr()
            ->closeButton()
            ->success('Product added to cart successfully');

        return redirect()->back();
    }

    public function user_cart()
    {
        $products = Product::all();

        $user_id = Auth::user()?->id;

        $count = Cart::where('user_id', $user_id)->count();

        $cart = Cart::where('user_id', $user_id)->get();

        return view('home.user_cart', compact('cart', 'count'));
    }

    public function remove_cart_item(int $id)
    {
        $cart_item = Cart::find($id);

        $cart_item->delete();

        return redirect()->back();
    }

    public function place_order(Request $request)
    {

        $userid = Auth::user()?->id;

        $carts = Cart::where('user_id', $userid)->get();


        foreach ($carts as $cart) {
            $order = Order::create(
                [
                    'name' => $request->name,
                    'rec_address' => $request->address,
                    'phone' => $request->phone,
                    'user_id' => $userid,
                    'product_id' => $cart->product_id

                ]
            );
        }

        Cart::where('user_id', $userid)->delete();

        return redirect()->back();
    }
}
