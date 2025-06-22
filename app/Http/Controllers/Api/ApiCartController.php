<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\Order;

class ApiCartController extends Controller
{
    public function index(): JsonResponse
    {
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

        foreach($cartItems as $item) {
            $item->total_price = (float)$item->total_price;
        }

        return response()->json([
            'success' => true,
            'data' => $cartItems
        ]);
    }

    public function destroy(int $cart_id): JsonResponse
    {
        $cart = Cart::find($cart_id);

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
        $findUserFromCart = Cart::where('user_id', $user->user_id);

        if($findUserFromCart->get()->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Товар в корзине не найден',
            ], 404);
        }

        $cartItems = $findUserFromCart->with('product')->get();

        $shippingCosts = [100, 150];

        $orders = $cartItems->map(function ($item) use ($user, $request, $shippingCosts) {
            return [
                'user_id' => $user->user_id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'order_status' => 'в обработке',
                'shipping_address' => $request->input('shipping_address'),
                'shipping_cost' => $shippingCosts[array_rand($shippingCosts)],
                'order_date' => now(),
                'delivery' => $item->product->delivery,
                'payment_method' => $request->input('payment_method')
            ];
        });

        Order::insert($orders->toArray());

        $findUserFromCart->delete();

         return response()->json([
            'success' => true,
            'message' => 'Доставка успешно оформлена!'
        ], 201);
    }

    public function add(int $product_id): JsonResponse
    {
        $findProduct = Products::find($product_id);

        if(!$findProduct) {
            return response()->json([
                'success' => false,
                'message' => "Товар не найден."
            ], 404);
        }

        $cart = Cart::firstOrCreate(
        [
            'user_id' => Auth::id(),
            'product_id' => $product_id,
        ],
            ['quantity' => 0]
        );
        $cart->increment('quantity');

        return response()->json([
            'success' => true,
            'message' => "Добавлено в корзину"
        ]);
    }
}
