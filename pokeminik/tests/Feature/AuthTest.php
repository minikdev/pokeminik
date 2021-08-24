<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_register(){

        $username = "trainer1";
        $password = "1";
        $gender = "male";
        $response = $this->post(('/auth/register'),[
            "username"=>$username,
            "password"=>$password,
            "gender"=> $gender
        ]);

       $response->assertStatus(200) ;
    }
}
