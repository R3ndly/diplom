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


    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0|max:999999',
            'brand' => 'required|string|max:100',
            'delivery' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'warranty' => 'required|string|max:100',
            'material' => 'required|string|max:100',
            'power_supply' => 'required|string|max:100',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,webm',
        ]);

        $filename = time() . '.' . $request->product_image->getClientOriginalExtension();
        $request->product_image->move(public_path('img/products'), $filename);
        $file_path = 'img/products/' . $filename;

        Products::create([
            'title' => $validated['title'],
            'price' => $validated['price'],
            'brand' => $validated['brand'],
            'delivery' => $validated['delivery'],
            'category' => $validated['category'],
            'warranty' => $validated['warranty'],
            'material' => $validated['material'],
            'power_supply' => $validated['power_supply'],
            'product_image' => $file_path,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Товар успешно добавлен',
        ], 201);
    }

    public function show(int $product_id): JsonResponse
    {
        $product = Products::findOrFail($product_id);

        return response()->json([
            'success' => true,
            'product' => $product
        ]);
    }

    public function update(Request $request, Products $product, int $product_id): JsonResponse
    {
        $validated = $request->validate([
            "title" => "required|string|max:255",
            "price" => "required|numeric|min:0|max:9999999.99",
            "brand" => "required|string|max:255",
            "delivery" => "required|string|max:10",
            "category" => "required|string|max:255",
            "warranty" => "required|string|max:255",
            "material" => "required|string|max:255",
            "power_supply" => "required|string|max:255",
            "product_image" => "nullable|image|mimes:jpg,jpeg,png,webp",
        ]);

        $product = Products::findOrFail($product_id);

        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $filename = 'product_'.time().'.'.$file->extension();
            $file->move(public_path('img/products'), $filename);
            $validated['product_image'] = 'img/products/'.$filename;
        }

        $product->update($validated);

        return response()->json([
            'message' => 'Товар успешно обновлён',
            'data' => $product->fresh()
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
         $products = Products::find($id);

        if (!$products) {
            return response()->json([
                'message' => 'Запись в таблице Products не найдена',
            ], 404);
        }

        $products->delete();

        return response()->json([
            'message' => 'Запись в таблице Products успешно удалена',
        ]);
    }
}
