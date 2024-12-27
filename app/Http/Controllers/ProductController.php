<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function add_product()
    {

        $category = Category::all();

        return view('admin.add_product', compact('category'));
    }

    public function upload_product(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'string|required',
                'description' => 'required',
                'price' => 'required|deci:2',
                'quantity' => 'nullable',
                'category' => 'required',
                'image' => 'nullable',
            ]
        );
        $image = $request->image;
        if ($request->image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();

            $request->image->move('products', $imagename);
        }

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagename,
            'price' => $request->price,
            'category' => $request->category,
            'quantity' => $request->quantity,
        ]);

        // $data = $request->validate([
        //     'name' => 'string|required',
        //     'description' => 'required',
        //     'price' => 'required|decimal:2',
        //     'quantity' => 'numeric',
        //     'category' => 'required',
        //     'image' => 'nullable',
        // ]);




        return redirect()->back();
    }

    public function view_product()
    {
        $products = Product::all();

        return view('admin.view_product', compact('products'));
    }
}
