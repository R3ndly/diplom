<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request, Products $product){

        $cart = Cart::firstOrCreate(
         [
            'user_id' => Auth::id(),
            'product_id' => $product->product_id,
        ],
            ['quantity' => 0]
    );
        $cart->increment('quantity');

        return redirect()->back();

    }

    public function remove(Cart $cart){
        $cart->decrement('quantity');
        if ($cart->quantity == 0) {
            $cart->delete();
        }
        return redirect()->back()->with('success', 'удалено.');
    }

    public function main()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        // Логирование для отладки
        foreach ($cartItems as $item) {
            if (!$item->product) {
                Log::warning("Продукт не найден для cart item ID: " . $item->id);
            }
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product ? $item->quantity * $item->product->price : 0;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }


 
}
