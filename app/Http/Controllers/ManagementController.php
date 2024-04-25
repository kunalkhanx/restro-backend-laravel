<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Table;
use App\Models\Waiter;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function index(){

        $items = Item::latest()->take(10)->get();
        $waiters = Waiter::latest()->take(10)->get();
        $tables = Table::latest()->take(10)->get();

        return response()->json(['items' => $items, 'waiters' => $waiters, 'tables' => $tables]);
    }
}
