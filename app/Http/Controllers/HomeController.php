<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
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
}
