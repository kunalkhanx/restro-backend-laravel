<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function create(Request $request){
        // return response()->json($request->all(), 400);
        $rules = [
            'title' => 'required|min:2|max:160',
            'description' => 'nullable|max:5000',
            // 'image' => 'nullable|max:2048|mimes:png,jpg',
            'use_quantity' => 'string|in:true,false',
            'non_veg' => 'string|in:true,false',
            'price' => 'required|numeric'
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
        
        $item = new Item;
        $item->title = $request->title;
        $item->description = $request->description;
        $item->image = $file_name;
        $item->use_quantity = $request->use_quantity == "true";
        $item->non_veg = $request->non_veg == "true";
        $item->price = $request->price;
        // return response()->json($item, 400);
        $result = $item->save();
        if(!$result){
            return response('', 500);
        }
        return response()->json($item, 201);
    }


    public function all(){
        $items = Item::latest()->get();
        return response()->json($items, 200);
    }

    public function image(Item $item){
        if(!$item){
            return response('', 404);
        }
        return Storage::response($item->image);
    }

}
