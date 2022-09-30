<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(){
        $items = Item::latest()->get();

        return response()->json([
            'status' => true,
            'items' => $items
        ],200);
    }

    public function show($id){
        $item = Item::find($id);

        if($item){
            return $item;
        }

        return "item not found!";
    }

    public function store(StoreItemRequest $request){
        $item = Item::create($request->all());

        return response()->json([
            'status' => true,
            'message'=> 'created Successfully!',
            'item' => $item
        ],200);
    }

    public function update($id,StoreItemRequest $request){
        $item = Item::find($id);

        if($item){
            $item->update($request->all());

            return response()->json([
                'status' => true,
                'message'=> 'updated Successfully!',
                'item' => $item
            ],200);
        }

        return "item not found!";
    }

    public function destroy($id){
        $item = Item::find($id);

        if($item){
            $item->delete();

            return response()->json([
                'status' => true,
                'message'=> 'destroyed Successfully!',
            ],200);
        }

        return "item not found!";
    }
}
