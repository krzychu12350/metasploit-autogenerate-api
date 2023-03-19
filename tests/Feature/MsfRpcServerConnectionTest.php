<?php

namespace Krzychu12350\MetasploitApi\Tests\Feature;

use Krzychu12350\MetasploitApi\Models\MsfRpcServerConnection;
use Tests\TestCase;

class MsfRpcServerConnectionTest extends TestCase
{
    /**
     * A feature test to all RPC connection data
     *
     * @return void
     */
    public function test_get_all_rpc_connections()
    {
        $response = $this->get('/api/connections')->assertStatus(200)->assertJsonStructure(['status', 'connections' => ['*' => ["id", "user_name", "user_password", "ip", "port", "web_server_uri", "ssl",],],]);
    }

    /**
     * A feature test to get RPC connection by id
     *
     * @return void
     */
    public function test_get_rpc_connection_by_id()
    {
        $response = $this->get('/api/connections/25')->assertStatus(200)->assertJsonStructure(['status', 'connection' => ["id", "user_name", "user_password", "ip", "port", "web_server_uri", "ssl",],]);
    }

    /**
     * A feature test to add a new rpc connection
     *
     * @return void
     */
    public function test_for_add_rpc_connection()
    {
        $payload = [
            "user_password" => "testpass123",
            "ssl" => true,
            "user_name" => "testuser",
            "ip" => "4.4.4.4",
            "port" => 55553,
            "web_server_uri" => "/api/1.0"
        ];
        MsfRpcServerConnection::create($payload);
        $this->json('POST', 'api/connections', $payload)
            ->assertStatus(201)
            ->assertJson(["status" => true, "message" => "Connection was created successfully",
            ]);
    }

    /**
     * A feature test to set current rpc connection
     *
     * @return void
     */
    public function test_for_set_current_rpc_connection()
    {
        $payload = [
            "user_password" => "testpass123",
            "ssl" => true,
            "user_name" => "testuser",
            "ip" => "4.4.4.4",
            "port" => 55553,
            "web_server_uri" => "/api/1.0"
        ];
        $this->json('POST', 'api/connections/set-connection', $payload)
            ->assertStatus(200)
            ->assertJson(["status" => true, "message" => "Connection was set successfully",
            ]);
    }

    /**
     * A feature test to update existing rpc connection
     *
     * @return void
     */
    public function test_for_update_rpc_connection()
    {
        $latestConnection = MsfRpcServerConnection::latest()->first();
        $payload = [
            "user_password" => "testpass123updated",
            "ssl" => true,
            "user_name" => "testuserupdated",
            "ip" => "5.5.5.5",
            "port" => 55553,
            "web_server_uri" => "/api/1.0"
        ];
        $this->json('PUT', 'api/connections/' . $latestConnection->id, $payload)
            ->assertStatus(200)
            ->assertJson(["status" => true, "message" => "Connection was updated successfully",
            ]);
    }

    /**
     * A feature test to update a RPC connection that does not exist
     *
     * @return void
     */
    public function test_for_update_rpc_connection_that_not_exist()
    {
        //connection id that not exist in database
        $connectionId = random_int(100000, 999999);

        $this->json('DELETE', 'api/connections/' . $connectionId)
            ->assertStatus(404)->assertJson(['status' => false, 'message' => 'Connection not found',]);
    }

    /**
     * A feature test to delete a RPC connection that does not exist
     *
     * @return void
     */
    public function test_for_delete_rpc_connection_that_not_exist()
    {
        //connection id that not exist in database
        $connectionId = random_int(100000, 999999);

        $this->json('DELETE', 'api/connections/' . $connectionId)->assertStatus(404)->assertJson(['status' => false, 'message' => 'Connection not found',]);
    }
}
