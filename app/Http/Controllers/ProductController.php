<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function add_product()
    {

        // For category label options
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
                'category_id' => 'required',
                'image' => 'nullable',
            ]
        );
        $image = $request->image;
        if ($request->image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();

            $request->image->move('products', $imagename);
        } else {
            $imagename = null;
        }

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagename,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'quantity' => $request->quantity,
        ]);




        return redirect()->back();
    }

    public function view_product()
    {
        $products = Product::paginate(3);

        return view('admin.view_product', compact('products'));
    }

    public function delete_product(int $id)
    {
        $product = Product::find($id);

        $product->delete();

        toastr()
            ->closeButton()
            ->success('Category deleted successfully');
    }

    public function edit_product(int $id)
    {
        $data = Product::find($id);

        $category = Category::all();

        return view('admin.edit_product', compact('data', 'category'));
    }

    public function update_product(Request $request, int $id)
    {
        $product = Product::find($id);

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
        } else {
            $imagename = null;
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagename,
            'price' => $request->price,
            'category' => $request->category,
            'quantity' => $request->quantity,
        ]);

        toastr()
            ->closeButton()
            ->success('Product updated successfully');

        return redirect('admin/view_product');
    }

    public function search_product(Request $request)
    {
        $search = $request->search;

        $products = Product::where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('category', 'like', '%' . $search . '%')
            ->paginate();

        return view('admin.view_product', compact('products'));
    }

    public function product_details(int $id){
        $product = Product::find($id);
        $user_id = Auth::user()?->id;

        $count = Cart::where('user_id', $user_id)->count();
        return view('home.product_details',compact('product','count'));
    }
}
