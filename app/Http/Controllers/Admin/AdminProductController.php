<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class AdminProductController extends Controller
{
    public function index(): View
    {
        $products = Products::simplePaginate(21);

        $brands = Products::distinct()->pluck('brand')->toArray();
        $categories = Products::distinct()->pluck('category')->toArray();
        $warranties = Products::distinct()->pluck('warranty')->toArray();
        $materials = Products::distinct()->pluck('material')->toArray();
        $powerSupplies = Products::distinct()->pluck('power_supply')->toArray();

        $minPrice = request()->input('min_price', 0);
        $maxPrice = request()->input('max_price', 10000);

        return view('admin.products.index', compact('products', 'brands', 'categories', 'warranties', 'materials', 'powerSupplies', 'minPrice', 'maxPrice'));
    }

    
    public function create(): View
    {
        return view('admin.products.create');
    }
        
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required',
            'brand' => 'required',
            'delivery' => 'required',
            'category' => 'required',
            'warranty' => 'required',
            'material' => 'required',
            'power_supply' => 'required',
        ]);
        $file_name = "";
        if ($request->hasFile('product_image')) {
            $file_name = '/img/products/' . time() . '.' . $request->product_image->getClientOriginalExtension();
            $request->product_image->move(public_path('img/products'), $file_name);
        } else {
            echo "Фото не загружено";
        }
        
        $products = new Products;
        $products->title = $request->title;
        $products->price = $request->price;
        $products->brand = $request->brand;
        $products->delivery = $request->delivery;
        $products->category = $request->category;
        $products->warranty = $request->warranty;
        $products->material = $request->material;
        $products->power_supply = $request->power_supply;
        $products->product_image = $file_name;
        $products->save();

        return redirect()->route('admin.products.index');
    }
    
    public function update(Request $request, Products $product): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required',
            'brand' => 'required',
            'delivery' => 'required',
            'category' => 'required',
            'warranty' => 'required',
            'material' => 'required',
            'power_supply' => 'required',
        ]);

        $file_name = $product->product_image;
        if($request->hasFile('product_image')) {
            $file_name = '/img/products/'.time().'.'.$request->product_image->getClientOriginalExtension();
            $request->product_image->move(public_path('img/products'),$file_name);
        }

        $product->title = $request->title;
        $product->price = $request->price;
        $product->brand = $request->brand;
        $product->delivery = $request->delivery;
        $product->category = $request->category;
        $product->warranty = $request->warranty;
        $product->material = $request->material;
        $product->power_supply = $request->power_supply;
        $product->product_image = $file_name;
        $product->save();

        return redirect()->route('admin.products.index');
    }

    public function edit(Products $product): View
    {
        return view('admin.products.edit', compact('product'));
    }
    
    
    public function destroy(Products $product): RedirectResponse
    {
        $product->delete(); 
        return redirect()->route('admin.products.index');
    }

    public function filter(Request $request): View
    {
        $query = Products::query();

        $filters = ['brand', 'category', 'warranty', 'material', 'power_supply'];
        foreach($filters as $filter) {
            if ($request->has($filter) && $request->$filter != '') {
                $query->where($filter, $request->$filter);
            }
        }

        if ($request->has('min_price') && $request->has('max_price')) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);

            $minPrice = $request->min_price;
            $maxPrice = $request->max_price;
        } else {
            $minPrice = 0;
            $maxPrice = 10000;
        }

        $products = $query->simplePaginate(21)->appends($request->all());

        $brands = Products::distinct()->pluck('brand')->toArray();
        $categories = Products::distinct()->pluck('category')->toArray();
        $warranties = Products::distinct()->pluck('warranty')->toArray();
        $materials = Products::distinct()->pluck('material')->toArray();
        $powerSupplies = Products::distinct()->pluck('power_supply')->toArray();

        return view('admin.products.index', compact('products', 'brands', 'categories', 'warranties', 'materials', 'powerSupplies', 'minPrice', 'maxPrice'));
    }   
}
