<?php

namespace Krzychu12350\MetasploitApi\Http\Controllers;


use Illuminate\Support\Facades\Redis;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Get;

class MsfRpcServerConnectionApiController2 extends Controller
{


    public function __construct()
    {
        $this->redis = Redis::connection();
    }

    //#[Get('connections/all-connections')]
    public function allConnections()
    {
        /*
        $this->redis->set('connections', json_encode(array(
                "connection:1" => [
                    "user_password" => "pass123",
                    "ssl" => "true",
                    "user_name" => "user",
                    "ip" => "127.0.0.1",
                    "port" => 55553,
                    "web_server_uri" => "/api/1.0"
                ],
                "connection:2" => [
                    "user_password" => "pass1234",
                    "ssl" => "true",
                    "user_name" => "user123",
                    "ip" => "127.0.0.1",
                    "port" => 55554,
                    "web_server_uri" => "/api/1.0"
                ]
            ))
        );
        */

		try {
            $response = $this->redis->get('connections');

            return response()->json([
                "status" => true,
                "connections" => json_decode($response)
            ],
                200);
		} catch (\Exception $e) {
			return response()->json([
				"status" => false,
				"message" => $e->getMessage(),
			],
				$e->getCode());
		}

    }

    //#[Delete('connections/delete-connection')]
    public function deleteConnection()
    {

    }
}
