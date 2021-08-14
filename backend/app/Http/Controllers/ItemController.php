<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    //
    public function index(Request $request)
    {
        $limit = $request->input("limit");
        $offset = $request->input("offset");
        $items = Item::query()->offset($offset)->limit($limit)->get();
        return $items;
    }

    public function show(){

        $id = request("id");
        $item = Item::query()->where('id',$id)->first();
        return $item;
    }
}
