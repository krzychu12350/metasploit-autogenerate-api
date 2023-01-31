<?php

namespace Krzychu12350\MetasploitApi\Traits;

use Doctrine\DBAL\Exception;
use Krzychu12350\MetasploitApi\Models\MsfRpcServerConnection;
use Krzychu12350\Phpmetasploit\MsfRpcClient;
use Illuminate\Support\Facades\Redis;

trait MsfRpcClientInitializerTrait
{

    public function initializeMsfRpcClient(): void
    {
        /*
        Redis::hmset("connection:1", "user_name", "user", 'user_password', 'pass123', "ssl", 'true',
            'ip', '127.0.0.1', 'port', 55553, 'web_server_uri', '/api/1.0');

        Redis::hmset("connection:2", "user_name", "user2", 'user_password', 'pass1234', "ssl", 'true',
            'ip', '127.0.0.1', 'port', 55554, 'web_server_uri', '/api/1.0');
        */

        //Redis::hSet('connection:1', 'port', 55553);

        //Redis::hdel('connection:1', 'port');

        $connectionNo = 1;
        //settings()->set('current_connection', 1)->save();


        //$value = Redis::hGetAll('connection:' . $connectionNo);
        //$connectionSettings = Redis::hgetall("connection:" . $connectionNo);
        //dd($connectionSettings);
        //settings()->set(['user_name' => 'user'])
        //
        //dd(settings()->all());
        /*
             "user_password": "pass123",
    "ssl":"true",
    "user_name": "user",
    "ip": "127.0.0.1",
    "port": 55553,
    "web_server_uri": "/api/1.0"
         */
        $userPassword = "pass123";
        $ssl = "true";
        $userName = "user";
        $ip = "127.0.0.1";
        $port = 55553;
        $webServerURI = "/api/1.0";
        //settings()->set('port', 522223);
        //settings()->save();
        //dd(settings()->all());
        $connData = settings()->all();
        //dd($connectionSettings);

        try {
            $currentConnectionId = settings()->get('current_connection');
            $msfRpcServerConnection = MsfRpcServerConnection::findOrFail($currentConnectionId);
            new MsfRpcClient($msfRpcServerConnection['user_password'],
                boolval($msfRpcServerConnection['ssl']) ? 'true' : 'false', $msfRpcServerConnection['user_name'],
                $msfRpcServerConnection['ip'], $msfRpcServerConnection['port'],
                $msfRpcServerConnection['web_server_uri']);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
