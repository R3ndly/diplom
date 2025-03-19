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
        $products = Products::simplePaginate(21);

        $brands = Products::distinct()->pluck('brand')->toArray();
        $categories = Products::distinct()->pluck('category')->toArray();
        $warranties = Products::distinct()->pluck('warranty')->toArray();
        $materials = Products::distinct()->pluck('material')->toArray();
        $powerSupplies = Products::distinct()->pluck('power_supply')->toArray();

        return view('products.index', compact('products', 'brands', 'categories', 'warranties', 'materials', 'powerSupplies'));
    }


    public function filter(Request $request): View
    {
        $query = Products::query();

        if ($request->has('brand') && $request->brand != '') {
            $query->where('brand', $request->brand);
        }

        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        if ($request->has('warranty') && $request->warranty != '') {
            $query->where('warranty', $request->warranty);
        }

        if ($request->has('material') && $request->material != '') {
            $query->where('material', $request->material);
        }

        if ($request->has('power_supply') && $request->power_supply != '') {
            $query->where('power_supply', $request->power_supply);
        }

        if ($request->has('min_price') && $request->has('max_price')) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);

            $minPrice = $request->min_price;
            $maxPrice = $request->max_price;
        } else {
            $minPrice = 0;
            $maxPrice = 10000;
        }

        $products = $query->simplePaginate(21);

        $brands = Products::distinct()->pluck('brand')->toArray();
        $categories = Products::distinct()->pluck('category')->toArray();
        $warranties = Products::distinct()->pluck('warranty')->toArray();
        $materials = Products::distinct()->pluck('material')->toArray();
        $powerSupplies = Products::distinct()->pluck('power_supply')->toArray();

        return view('products.index', compact('products', 'brands', 'categories', 'warranties', 'materials', 'powerSupplies', 'minPrice', 'maxPrice'));
    }
}
