<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class AdTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Auth::attempt(["email" => "test@gmail.com", "password" => "123456"]);
    }
    public function testCreateAd()
    {
        $data = [
            "title"=> "test ad",
            "content"=> "this is test"
        ];

        $createResponse = $this->post('api/campaigns/620e2f084d637c1eb76933b2/ads', $data);

        $createResponse->assertStatus(200);
    }

    public function testGetAds()
    {
        $createResponse = $this->get('api/campaigns/620e2f084d637c1eb76933b2/ads');

        $createResponse->assertStatus(200);
    }
}
