<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Exceptions\GrpcNotFoundException;
use Illuminate\Support\Facades\Auth;
class CampaignTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

        Auth::attempt(["email" => "test@gmail.com", "password" => "123456"]);
    }
    public function testCreateCampaign()
    {
        $data = [
            "title"=> "test campaign",
            "content"=> "this is test"
        ];

        $createResponse = $this->post('api/campaigns/', $data);

        $createResponse->assertStatus(200);
    }
    public function testActivateCampaign()
    {
        $createResponse = $this->post('api/campaigns/620e2f084d637c1eb76933b2/activate');

        $createResponse->assertStatus(200);
    }
    public function testGetCampaigns()
    {
        $createResponse = $this->get('api/campaigns/');

        $createResponse->assertStatus(200);
    }
}
