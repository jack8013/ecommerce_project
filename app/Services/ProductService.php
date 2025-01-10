<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function store(Request $request)
    {
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

        return $product;
    }

    public function update(Request $request, Product $product)
    {
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
            'category_id' => $request->category_id,
            'quantity' => $request->quantity,
        ]);
    }

    public function destroy(Product $product)
    {
        $product->delete();
    }
}
