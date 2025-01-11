<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function __construct(private OrderService $service) {}

    public function view_order()
    {
        $orders = $this->service->index();

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
