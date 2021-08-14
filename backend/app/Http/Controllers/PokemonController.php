<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    //
    public function index(Request $request)
    {
        $limit = $request->input("limit");
        $offset = $request->input("offset");
        $pokemons = Pokemon::query()->offset($offset)->limit($limit)->get();
        return $pokemons;
    }

    public function show(){

        $id = request("id");
        $pokemon = Pokemon::query()->where('id',$id)->first();
        return $pokemon;
    }


}
