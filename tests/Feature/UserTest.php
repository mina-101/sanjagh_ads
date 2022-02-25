<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testRegisterUser()
    {
        $data = [
            "first_name"=> "test",
            "last_name"=> "test",
            "email"=> "test@gmail.com",
            "password"=> "123456"
        ];

        $createResponse = $this->post('api/register/', $data);

        $createResponse->assertStatus(200);
    }
    public function testLoginUser()
    {
        $data = [
            "email"=> "test@gmail.com",
            "password"=> "123456"
        ];

        $createResponse = $this->post('api/login/', $data);

        $createResponse->assertStatus(200);
    }
}
