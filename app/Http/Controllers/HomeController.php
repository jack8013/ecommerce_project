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
        $user = User::where('usertype', 'user')->count();

        $products = Product::all()->count();

        $orders = Order::all()->count();

        $delivered = Order::where('status', 'Delivered')->count();

        return view('admin.index', compact('user', 'products', 'orders', 'delivered'));
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

        //If user has no cart, create one
        $cart = $user->cart ?: $cart = Cart::create(['user_id' => $user->id,]);

        $productExist = $cart->products()->where('product_id', $id)->first();

        if ($productExist) {
            $quantity = $productExist->pivot->quantity + 1;
            $cart->products()->updateExistingPivot(
                $id,
                [
                    'quantity' => $quantity,
                    'price' => $product->price * $quantity
                ]
            );
        } else {
            $cart->products()->attach($id, ['quantity' => 1, 'price' => $product->price]);
        }

        toastr()
            ->closeButton()
            ->success('Product added to cart successfully');

        return redirect()->back();
    }

    public function user_cart()
    {

        $user_id = Auth::user()?->id;

        $count = Cart::where('user_id', $user_id)->count();

        // Each user has only one cart, so fetch cart through User's eloquent relationship
        $cart = Auth::user()?->cart;

        //$products = Product::all();
        //$cart = Cart::with('products')->where('user_id', $user_id)->get();

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

    public function get_order()
    {
        $userid = Auth::user()?->id;

        $orders = Order::where('user_id', $userid)->get();

        $count = Cart::where('user_id', $userid)->count();

        return view('home.order', compact('count', 'orders'));
    }
}
