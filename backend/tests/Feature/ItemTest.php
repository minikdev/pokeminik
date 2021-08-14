<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ItemTest extends TestCase
{
    public function test_index_item()
    {
        $limit = "10";
        $offset = "0";
        $response = $this->get('/api/item?limit='.$limit.'&offset'.$offset);
        $response->assertStatus(200);
    }
    public function test_index_item_limit()
    {
        $limit = "10";
        $offset = "0";
        $response = $this->get('/api/item?limit='.$limit.'&offset'.$offset);
        $this->assertEquals(count($response->original) ,$limit);
    }
    public function test_show_item(){
        $id = "1";
        $response = $this->get('/api/item/'.$id);
        $response->assertStatus(200);
    }
    public function test_show_correct_item(){
        $id = "1";
        $response = $this->get('/api/item/'.$id);
        $this->assertEquals($response->original->id,$id);
    }
}
