<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
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

    public function view_order()
    {


        $orders = Order::all();

        return view('admin.view_order', compact('orders'));
    }

    public function on_the_way(int $id)
    {

        $order = Order::find($id);

        $order->status = "On the way";

        $order->save();

        return redirect()->back();
    }

    public function delivered(int $id)
    {

        $order = Order::find($id);

        $order->status = "Delivered";

        $order->save();

        return redirect()->back();
    }

    public function print_pdf(int $id)
    {
        $order = Order::find($id);

        $pdf = Pdf::loadView('admin.invoice', compact('order'));

        return $pdf->download('invoice.pdf');
    }
}
