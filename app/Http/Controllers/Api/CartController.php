<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct(private CartService $service) {}

    public function show()
    {
        $cart = $this->service->show();

        return response()->json([
            'data' => $cart
        ]);
    }

    public function store($id, Request $request)
    {
        $cart = $this->service->store($id, $request);

        return response()->json([
            'data' => $cart
        ]);
    }

    public function destroy($id)
    {
        $cart = $this->service->destroy($id);

        return response()->json([
            'data' => $cart
        ]);
    }
}
