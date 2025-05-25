<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

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
        $minPrice = $request->query('min_price', 0);
        $maxPrice = $request->query('max_price', 10000);

        $minPrice = (int)$minPrice;
        $maxPrice = (int)$maxPrice;

        if ($minPrice > $maxPrice) {
            [$minPrice, $maxPrice] = [$maxPrice, $minPrice];
        }

        $query = Products::query();

        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('warranty')) {
            $query->where('warranty', $request->warranty);
        }

        if ($request->filled('material')) {
            $query->where('material', $request->material);
        }

        if ($request->filled('power_supply')) {
            $query->where('power_supply', $request->power_supply);
        }

        $query->whereBetween('price', [$minPrice, $maxPrice]);

        $products = $query->paginate(21);

        return response()->json([
            'success' => true,
            'products' => $products
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


    public function show(int $product_id): JsonResponse
    {
        $product = Products::find($product_id);

        if(!$product)   {
            return response()->json([
                'success' => false,
                'message' => 'товар по id не найден.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'product' => $product
        ]);
    }


    public function store(ProductRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $filename = time() . '.' . $validated['product_image']->getClientOriginalExtension();
        $validated['product_image']->move(public_path('img/products'), $filename);

        Products::create([
            'title' => $validated['title'],
            'price' => $validated['price'],
            'brand' => $validated['brand'],
            'delivery' => $validated['delivery'],
            'category' => $validated['category'],
            'warranty' => $validated['warranty'],
            'material' => $validated['material'],
            'power_supply' => $validated['power_supply'],
            'product_image' => 'img/products/' . $filename,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Товар успешно добавлен',
        ], 201);
    }


    public function update(ProductRequest $request, int $product_id): JsonResponse
    {
        $validated = $request->validated();

        $product = Products::find($product_id);

        if(!$product)   {
            return response()->json([
                'message' => 'товар по id не найден.'
            ], 404);
        }

        $product->update($validated);

        return response()->json([
            'message' => 'Товар успешно обновлён',
            'data' => $product->fresh()
        ]);
    }


    public function destroy(int $id): JsonResponse
    {
         $product = Products::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Запись в таблице Products не найдена',
            ], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Запись в таблице Products успешно удалена',
        ]);
    }
}
