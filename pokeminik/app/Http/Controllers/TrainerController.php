<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    //

    public function show(){

        $id = request("id");
        $trainer = Trainer::query()->where('id',$id)->first();
        return $trainer;
    }
}
