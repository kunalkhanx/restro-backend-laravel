<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Request $request){

        $order = new Order;
        $order->date = date('Y-m-d');
        $order->status = $request->status;
        $order->waiter_id = $request->waiter;
        $order->table_id = $request->table;

        $totalAmount = 0;
        foreach($request->items as $item){
            $totalAmount += ((int) $item['price']) * ((int) $item['quantity']);
        }
        $order->total = $totalAmount;
        $settings = Setting::whereIn('setting_key', ['SGST', 'CGST'])->get();
        $tax = [];
        $final = 0;
        foreach($settings as $setting){
            $tax[$setting->setting_key] = [(int) $setting->setting_value, round(($totalAmount * $setting->setting_value) / 100)];
            $final += (int) $tax[$setting->setting_key][1];
        }
        $order->tax = json_encode($tax);
        $order->final = round($totalAmount + $final);

        $result = $order->save();
        if(!$result){
            return response('', 400);
        }
        $order->items()->attach($request->items);
        if($request->payments){
            $order->payments()->createMany($request->payments);
        }       

        return response()->json($order, 201);
    }

    public function update(Request $request, Order $order){
        $order->status = $request->status;
        $result = $order->save();
        if(!$result){
            return response('', 400);
        }
        if($request->payments){
            $order->payments()->createMany($request->payments);
        }       

        return response()->json($order, 201);
    }

    public function get($id){
        $order = Order::where('id', $id)->with('items')->with('payments')->with('table')->first();
        if(!$order){
            return response('', 404);
        }
        return response()->json($order);
    }

    public function browse(Request $request){
        $query = Order::select();
        if($request->get('dateFrom') && $request->get('dateFrom') != '' && $request->get('dateTo') && $request->get('dateTo') != ''){
            $query->whereBetween('date', [date($request->get('dateFrom')), date($request->get('dateTo'))]);
        }
        $orders = $query->latest()->with('items')->with('payments')->with('waiter')->with('table')->paginate(15);
        return response()->json($orders);
    }

    public function addItems(Request $request, Order $order){
        if(!$order){
            return response('', 404);
        }
        $totalAmount = 0;
        foreach($request->items as $item){
            $totalAmount += ((int) $item['price']) * ((int) $item['quantity']);
        }
        $order->total = $totalAmount;
        $order->final = $totalAmount;
        $result = $order->save();
        if(!$result){
            return response('', 400);
        }
        $order->items()->sync($request->items);
        return response('', 201);
    }
}
