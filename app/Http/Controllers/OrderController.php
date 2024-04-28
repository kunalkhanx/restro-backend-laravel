<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function create(Request $request){

        $order = new Order;
        $order->date = date('Y-m-d');
        $order->total = $request->totalAmount;
        $order->final = $request->totalAmount;
        $order->status = $request->status;
        $order->waiter_id = $request->waiter;
        $order->table_id = $request->table;
        $result = $order->save();
        if(!$result){
            return response('', 400);
        }
        $order->items()->attach($request->items);
        if($request->payments){
            $order->payments()->createMany($request->payments);
        }       

        return response('', 201);
    }

    public function get($id){
        $order = Order::where('id', $id)->with('items')->with('payments')->with('table')->first();
        if(!$order){
            return response('', 404);
        }
        return response()->json($order);
    }

    public function browse(Request $request){
        // return response()->json(['status' => $request->get('status')]);
        $query = Order::select();
        // if($request->get('status') !== 'null'){
        //     $query->where('status', $request->get('status'));
        // }
        if($request->get('dateFrom') && $request->get('dateFrom') != '' && $request->get('dateTo') && $request->get('dateTo') != ''){
            $query->whereBetween('date', [date($request->get('dateFrom')), date($request->get('dateTo'))]);
        }
        $orders = $query->latest()->with('items')->with('payments')->paginate(15);
        return response()->json($orders);
    }

    public function addItems(Request $request, Order $order){
        if(!$order){
            return response('', 404);
        }
        $order->total = $order->total + $request->totalAmount;
        $order->final = $order->final + $request->totalAmount;
        $result = $order->save();
        if(!$result){
            return response('', 400);
        }
        $order->items()->attach($request->items);
        return response('', 201);
    }
}
