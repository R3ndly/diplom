<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class AdminOrdersController extends Controller
{
    public function index(): View
    {
        $orders = Orders::all();

        return view('admin.orders.index',compact('orders'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    
     public function create(): View
        {
         return view('admin.orders.create');
        }
        

   
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'order_number' => 'required',
            'order_date' => 'required',
            'order_status' => 'required',
            'customer_name' => 'required',
            'delivery_address' => 'required',
            'customer_phone_number' => 'required',
            'payment_method' => 'required',
            'shipping_cost' => 'required'
        ]);

        $file_name = "";
        if($request->hasFile('image')){
            $file_name = '/img/orders/'.time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('img/orders'),$file_name);
        } else {
            echo "Фото не загружено";
        }

        $order = new Orders;
        $order->order_number = $request->order_number;
        $order->order_date = $request->order_date;
        $order->order_status = $request->order_status;
        $order->customer_name = $request->customer_name;
        $order->delivery_address = $request->delivery_address;
        $order->customer_phone_number = $request->customer_phone_number;
        $order->payment_method = $request->payment_method;
        $order->shipping_cost = $request->shipping_cost;
        $order->image = $file_name;
        $order->save();

        return redirect()->route('admin.orders.index')->with('Выполнено','изделия добавлены');
    }
    public function show(Orders $order): View
    {
        return view('admin.orders.show', compact('order'));
    }
    
    
    public function edit(Orders $order): View
    {
        return view('admin.orders.edit', compact('order'));
    }
    


     
    public function update(Request $request, Orders $order): RedirectResponse
    {
        $request->validate([
           'order_number' => 'required',
            'order_date' => 'required',
            'order_status' => 'required',
            'customer_name' => 'required',
            'delivery_address' => 'required',
            'customer_phone_number' => 'required',
            'payment_method' => 'required',
            'shipping_cost' => 'required'
        ]);

        $file_name = $order->image;
        if($request->hasFile('image')) {
            $file_name = '/img/orders/'.time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('img/orders'),$file_name);
        } else {
            echo "Фото не загружено";
        }
       $order->order_number = $request->order_number;
        $order->order_date = $request->order_date;
        $order->order_status = $request->order_status;
        $order->customer_name = $request->customer_name;
        $order->delivery_address = $request->delivery_address;
        $order->customer_phone_number = $request->customer_phone_number;
        $order->payment_method = $request->payment_method;
        $order->shipping_cost = $request->shipping_cost;
        $order->image = $file_name;
        $order->save();

        return redirect()->route('admin.orders.index')->with('выполнено','изделия добавлены');
    }


    
     public function destroy(Orders $order): RedirectResponse
     {
         $order->delete();
         
         
         return redirect()->route('admin.orders.index')
         
         ->with('выполнено','изделие удалёно.');
        }
        
}
