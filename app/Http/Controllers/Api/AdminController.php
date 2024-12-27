<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminCategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Flasher\Toastr\Prime\ToastrInterface;

class AdminController extends Controller
{

    public function index()
    {
        $categories = Category::get();

        if ($categories->count() > 0) {
            return AdminCategoryResource::collection($categories);
        } else {
            return response()->json(['message' => 'No record available', 200]);
        }
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->messages(),
            ]);
        }


        $category = Category::create([
            'category_name' => $request->category_name,
        ]);


        return response()->json([
            'messsage' => 'Category Created Succesfully',
            'data' => new AdminCategoryResource($category),
        ]);
    }
}
