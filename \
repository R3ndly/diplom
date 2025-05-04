<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Order;

class ApiCartController extends Controller
{
    public function index(): JsonResponse
    {
        if (!Auth::guard('sanctum')->user()) {
            return response()->json(['message' => 'неавторизован!'], 401);
        }

        $userId = Auth::guard('sanctum')->id();

        $cartItems = DB::select("
            SELECT
                (carts.quantity * products.price) AS total_price,
                products.product_image,
                products.title,
                products.warranty,
                products.brand,
                products.material,
                products.power_supply,
                carts.quantity,
                carts.id AS cart_id
            FROM Smart_home.carts
            JOIN Smart_home.products ON carts.product_id = products.product_id
            WHERE carts.user_id = ?;
        ", [$userId]);

        return response()->json([
            'success' => true,
            'data' => $cartItems
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $cart = Cart::find($id);

        if (!$cart) {
            return response()->json([
                'message' => 'Запись в таблице Cart не найдена',
            ], 404);
        }

        $cart->delete();

        return response()->json([
            'message' => 'Запись в таблице Cart успешно удалена',
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $user = Auth::user();

        $cartItems = Cart::where('user_id', $user->user_id)->with('product')->get();


        $shippingCosts = [100, 150];

        foreach ($cartItems as $item) {

            $product = $item->product;

            Order::create([
                'user_id' => $user->user_id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'order_status' => 'в обработке',
                'shipping_address' => $request->input('shipping_address'),
                'shipping_cost' => $shippingCosts[array_rand($shippingCosts)],
                'order_date' => now(),
                'delivery' => $product->delivery,
                'payment_method' => $request->input('payment_method'),
            ]);
        }

        Cart::where('user_id', $user->user_id)->delete();

         return response()->json([
            'success' => true,
            'message' => 'Доставка успешно оформлена!',
        ], 201);
    }

}
