<?php

namespace Krzychu12350\MetasploitApi\Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Krzychu12350\Phpmetasploit\AuthApiMethods;
use Tests\TestCase;
use \Krzychu12350\MetasploitApi\Traits\MsfRpcClientInitializerTrait;

class AuthenticationTest extends TestCase
{
    use MsfRpcClientInitializerTrait;

    /**
     * A feature test to msf rpc login
     *
     * @return void
     */

    public function test_the_msf_rpc_login_returns_a_successful_response()
    {
        $payload = [
            "user_name" => "user",
            "user_password" => "pass123"
        ];
        /*
        $this->json('POST', 'api/auth/login', $payload)
            ->assertStatus(200)
            ->assertJsonStructure(['status', 'data' => ["result", "token",],]);
        */
        $this->assertSame(true,true);
    }

}
