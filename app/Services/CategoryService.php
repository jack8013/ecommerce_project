<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryService
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
        $category = Category::create([
            'category_name' => $request->category_name,
        ]);

        return $category;
    }

    public function update(Request $request, Category $category)
    {
        $category->update([
            'category_name' => $request->category_name,
        ]);

        return $category;
    }

    public function destroy(Category $category)
    {
        $category->delete();
    }
}
