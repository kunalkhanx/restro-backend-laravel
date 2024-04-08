<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TableController extends Controller
{
    public function create(Request $request){
        $v = Validator::make($request->all(), [
            'table_code' => 'required|min:1|max:160',
            'seats' => 'numeric|min:1',
        ]);

        if($v->fails()){
            return response()->json($v->errors(), 400);
        }

        $table = new Table;
        $table->table_code = $request->table_code;
        $table->seats = $request->seats;
        $result = $table->save();

        if(!$result){
            return response('', 500);
        }
        return response()->json($table, 201);
    }

    public function all(){
        $tables = Table::latest()->get();
        return response()->json($tables, 200);
    }
}
