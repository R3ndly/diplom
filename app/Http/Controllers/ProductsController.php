<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


class ProductsController extends Controller
{
    public function index(): View
    {
        $products = Products::all();

        return view('products.index',compact('products'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function filter(Request $request): View
    {
        $query = Products::query();

        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        if ($request->has('min_price') && $request->has('max_price')) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);

            $minPrice = $request->min_price;
            $maxPrice = $request->max_price;
        } else {
            $minPrice = 0;
            $maxPrice = 10000;
        }

        $products = $query->get();

        return view('products.index', compact('products', 'minPrice', 'maxPrice'));
    }
}
