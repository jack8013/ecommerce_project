<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Flasher\Toastr\Prime\ToastrInterface;

class AdminController extends Controller
{
    public function view_category()
    {
        $data = Category::all();

        return view('admin.category', compact('data'));
    }

    public function add_category(Request $request)
    {
        $category = new Category;

        $category->category_name = $request->category_name;

        $category->save();

        toastr()
            ->closeButton()
            ->success('Category added successfully');

        return redirect()->back();
    }

    public function edit_category(Request $request, int $id)
    {

        $data = Category::find($id);

        return view('admin.edit_category', compact('data'));
    }

    public function update_category(Request $request, int $id)
    {
        $data = Category::find($id);

        $data->category_name = $request->category_name;

        $data->save();

        toastr()
            ->closeButton()
            ->success('Category edited successfully');

        return redirect('admin/view_category');
    }

    public function delete_category(int $id)
    {
        $data = Category::find($id);

        $data->delete();

        toastr()
            ->closeButton()
            ->success('Category deleted successfully');

        return response()->json([
            'messsage' => 'Category Deleted Succesfully',
        ]);
    }
}
