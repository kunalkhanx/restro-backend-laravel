<?php

namespace App\Http\Controllers;

use App\Models\Waiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WaiterController extends Controller
{

    public function create(Request $request){

        $rules = [
            'name' => 'required|min:3|max:160',
            'sex' => 'required|in:male,female,others',
        ];

        if($request->file('image')){
            $rules['image'] = 'max:2048|mimes:png,jpg';
        }

        $v = Validator::make($request->all(), $rules);

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

    public function all(Request $request){
        $status = ['status', '>=', 0];
        if($request->get('status') && $request->get('status') == -1){
            $status = ['status', '=', -1];
        }
        $waiters = Waiter::where(...$status)->latest()->get();
        return response()->json($waiters, 200);
    }

    public function image(Waiter $waiter){
        if(!$waiter){
            return response('', 404);
        }
        return Storage::response($waiter->image);
    }

    public function delete(Waiter $waiter){
        if(!$waiter){
            return response('', 404);
        }
        if($waiter->status != -1){
            $waiter->status = -1;
            $waiter->save();
            return response('', 200);
        }
        if($waiter->status == -1){
            $waiter->delete();
            return response('', 200);
        }
    }

    public function get(Waiter $waiter){
        if(!$waiter){
            return response('', 404);
        }
        return response()->json($waiter);
    }


    public function update(Request $request, Waiter $waiter){
        $rules = [
            'name' => 'required|min:3|max:160',
            'sex' => 'required|in:male,female,others',
        ];

        if($request->file('image')){
            $rules['image'] = 'max:2048|mimes:png,jpg';
        }

        $v = Validator::make($request->all(), $rules);
        if($v->fails()){
            return response()->json($v->errors(), 400);
        }
        // return response()->json($request->all(), 400);
        $file = $request->file('image');
        $file_name = null;
        if($file){
            $date = date('d-m-Y');
            $file_name = $file->store('uploads/' . $date .'/');
        }
        
        $waiter->name = $request->name;
        $waiter->sex = $request->sex;
        if($file_name){
            $waiter->image = $file_name;
        }elseif($request->post('image') == 'null'){
            $waiter->image = null;
        }
        $result = $waiter->save();
        if(!$result){
            return response('', 500);
        }
        return response()->json($waiter, 201);

    }
}
