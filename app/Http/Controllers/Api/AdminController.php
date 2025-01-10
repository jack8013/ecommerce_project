<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminCategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Flasher\Toastr\Prime\ToastrInterface;

class AdminController extends Controller
{
    public function __construct(private CategoryService $service) {}

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

        $category = $this->service->store($request);

        return response()->json([
            'messsage' => 'Category Created Successfully',
            'data' => new AdminCategoryResource($category),
        ]);
    }

    public function update(Request $request, int $id){
        $data = Category::find($id);
        $category = $this->service->update($request, $data);

        return response()->json([
            'message' => 'Category Updated Successfully',
            'data' => new AdminCategoryResource($category),
        ]);
    }
}
