<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Table;
use App\Models\Waiter;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(){
        $date = date('Y-m-d');

        $orders = Order::where('date', $date)->withSum('items', 'order_items.quantity')->with(['table' => function($query){
            $query->select('id', 'table_code');
        }])->latest()->get();

        $waiters = Waiter::where('last_login', $date)->withCount(['orders' => function($query) use($date) {
            return $query->where('orders.date', $date);
        }])->orderBy('orders_count', 'DESC')->get();

        $payments = Payment::whereDate('created_at', Carbon::today())->latest()->limit(15)->get();
        return response()->json([
            'orders' => $orders,
            'waiters' => $waiters,
            'payments' => $payments
        ]);
    }


    public function expo(Waiter $waiter){
        if(!$waiter){
            return response('', 404);
        }
        $date = date('Y-m-d');
        $tables = Table::where('status', 1)->get();
        $completedOrders = Order::where('status', 1)->where('date', $date)->count();
        $pendingOrders = Order::where('status', 0)->where('date', $date)->count();
        return response()->json([
            'tables' => $tables,
            'completedOrders' => $completedOrders,
            'pendingOrders' => $pendingOrders
        ]);
    }

    public function search(Request $request){
        $term = $request->term;
        if(!$term){
            return response('', 400);
        }
        
        $items = Item::where('title', 'like', "%{$term}%")->orWhere('description', 'like', "%{$term}%")->get();
        $waiters = Waiter::where('name', 'like', "%{$term}%")->get();
        $tables = Table::where('table_code', 'like', "%{$term}%")->get();

        return response()->json([
            'items' => $items,
            'waiters' => $waiters,
            'tables' => $tables
        ]);

    }

    
}
