<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiProductsController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Products::paginate(21);

        return response()->json([
            'success' => true,
            'products' => $products
        ]);
    }

    public function filter(Request $request): JsonResponse
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
            $query->whereBetween('price', [
                (int)$request->min_price,
                (int)$request->max_price
            ]);
        }

        $products = $query->simplePaginate(21);

        return response()->json([
            'success' => true,
            'products' => $products,
            'filters' => [
                'brands' => Products::distinct()->pluck('brand')->toArray(),
                'categories' => Products::distinct()->pluck('category')->toArray(),
                'warranties' => Products::distinct()->pluck('warranty')->toArray(),
                'materials' => Products::distinct()->pluck('material')->toArray(),
                'powerSupplies' => Products::distinct()->pluck('power_supply')->toArray()
            ]
        ]);
    }

    public function getFilters(): JsonResponse
    {
        return response()->json([
            'brands' => Products::distinct()->pluck('brand')->toArray(),
            'categories' => Products::distinct()->pluck('category')->toArray(),
            'warranties' => Products::distinct()->pluck('warranty')->toArray(),
            'materials' => Products::distinct()->pluck('material')->toArray(),
            'powerSupplies' => Products::distinct()->pluck('power_supply')->toArray()
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
