<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $cartItems = Cart::where('user_id', $user->user_id)->with('product')->get();

        
        $shippingCosts = [200, 400, 500, 600, 1200];
        
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

        return redirect()->route('cart.index')->with('success', 'Заказ успешно оформлен!');
    }
}
