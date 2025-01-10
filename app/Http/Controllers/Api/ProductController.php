<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct(private ProductService $service) {}

    public function index()
    {
        $products = Product::get();

        if ($products->count() > 0) {
            return ProductResource::collection($products);
        } else {
            return response()->json(['message' => 'No record available'], 200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required',
            'description' => 'required',
            'price' => 'required|deci:2',
            'quantity' => 'nullable',
            'category_id' => 'required',
            'image' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->messages(),
            ]);
        }
        $product = $this->service->store($request);

        return response()->json([
            'messsage' => 'Product Created Succesfully',
            'data' => new ProductResource($product),
        ]);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required',
            'description' => 'required',
            'price' => 'required|deci:2',
            'quantity' => 'nullable',
            'category_id' => 'required',
            'image' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->messages(),
            ]);
        }

        $this->service->update($request, $product);

        return response()->json([
            'messsage' => 'Product Updated Succesfully',
            'data' => new ProductResource($product),
        ]);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'messsage' => 'Product Deleted Succesfully',
        ]);
    }
}
