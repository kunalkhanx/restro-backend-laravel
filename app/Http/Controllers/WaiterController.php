<?php

namespace App\Http\Controllers;

use App\Models\Waiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WaiterController extends Controller
{

    public function create(Request $request){
        $v = Validator::make($request->all(), [
            'name' => 'required|min:3|max:160',
            'sex' => 'required|in:male,female,others',
            'image' => 'nullable|file|image|max:2048'
        ]);

        if($v->fails()){
            return response()->json($v->errors(), 400);
        }

        $file = $request->file('image');
        $file_name = null;
        if($file){
            $date = date('d-m-Y');
            $file_name = $file->store('uploads/' . $date .'/');
        }

        $waiter = new Waiter;
        $waiter->name = $request->name;
        $waiter->sex = $request->sex;
        $waiter->image = $file_name;
        $result = $waiter->save();

        if(!$result){
            return response('', 500);
        }
        return response()->json($waiter, 201);
    }

    public function all(){
        $waiters = Waiter::latest()->get();
        return response()->json($waiters, 200);
    }

    public function image(Waiter $waiter){
        if(!$waiter){
            return response('', 404);
        }
        return Storage::response($waiter->image);
    }
}
