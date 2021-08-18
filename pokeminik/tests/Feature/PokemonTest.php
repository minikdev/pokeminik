<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PokemonTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_pokemon()
    {
        $limit = "10";
        $offset = "0";
        $response = $this->get('/api/pokemon?limit='.$limit.'&offset'.$offset);
        $response->assertStatus(200);
    }
    public function test_index_pokemon_limit()
    {
        $limit = "10";
        $offset = "0";
        $response = $this->get('/api/pokemon?limit='.$limit.'&offset'.$offset);
        $this->assertEquals(count($response->original) ,$limit);
    }
    public function test_show_pokemon(){
        $id = "1";
        $response = $this->get('/api/pokemon/'.$id);
        $response->assertStatus(200);
    }
    public function test_show_correct_pokemon(){
        $id = "1";
        $response = $this->get('/api/pokemon/'.$id);
        $this->assertEquals($response->original->id,$id);
    }

    public function test_search_pokemon(){
        $nameOrId = "bulbasa";
        $response = $this->get('/api/pokemon/search/'.$nameOrId);
        $countResult = count($response->original);
        $this->assertEquals(1,$countResult);
    }
}
