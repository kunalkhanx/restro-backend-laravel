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
        $result = $order->save();
        if(!$result){
            return response('', 400);
        }
        $order->items()->attach($request->items);
        $order->payments()->createMany($request->payments);

        return response('', 201);
    }


    public function get(Order $order){
        return response()->json($order->with('items')->with('payments')->get());
    }

    public function browse(){
        $orders = Order::latest()->with('items')->with('payments')->paginate(15);
        return response()->json($orders);
    }
}
