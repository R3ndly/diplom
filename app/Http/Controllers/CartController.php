<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    public function add(Products $product){

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

    public function index(): View
    {
        return view('cart.index');
    }
}
