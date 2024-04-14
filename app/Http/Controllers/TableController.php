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

    public function all(Request $request){
        $status = $request->get('status') ? $request->get('status') : 1;
        $tables = Table::where('status', $status)->latest()->get();
        return response()->json($tables, 200);
    }

    public function delete(Table $table){
        if(!$table){
            return response('', 404);
        }
        if($table->status != -1){
            $table->status = -1;
            $table->save();
            return response('', 200);
        }
        if($table->status == -1){
            $table->delete();
            return response('', 200);
        }
    }

    public function get(Table $table){
        if(!$table){
            return response('', 404);
        }
        return response()->json($table, 200);
    }

    public function update(Request $request, Table $table){
        $v = Validator::make($request->all(), [
            'table_code' => 'required|min:1|max:160',
            'seats' => 'numeric|min:1',
        ]);

        if($v->fails()){
            return response()->json($v->errors(), 400);
        }

        $table->table_code = $request->table_code;
        $table->seats = $request->seats;
        $result = $table->save();

        if(!$result){
            return response('', 500);
        }
        return response()->json($table, 201);
    }

    public function restore(Table $table){
        if(!$table){
            return response('', 404);
        }
        $table->status = 1;
        $table->save();
        return response('', 200);
    }
}
