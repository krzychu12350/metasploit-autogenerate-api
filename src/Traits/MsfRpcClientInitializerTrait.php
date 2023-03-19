<?php

namespace Krzychu12350\MetasploitApi\Traits;

use Exception;
use Krzychu12350\MetasploitApi\Models\MsfRpcServerConnection;
use Krzychu12350\Phpmetasploit\MsfRpcClient;

trait MsfRpcClientInitializerTrait
{
    public function initializeMsfRpcClient()
    {
        try {
            $currentConnectionId = settings()->get('current_connection');
            $msfRpcServerConnection = MsfRpcServerConnection::findOrFail($currentConnectionId);
            new MsfRpcClient($msfRpcServerConnection['user_password'],
                boolval($msfRpcServerConnection['ssl']) ? 'true' : 'false', $msfRpcServerConnection['user_name'],
                $msfRpcServerConnection['ip'], $msfRpcServerConnection['port'],
                $msfRpcServerConnection['web_server_uri']);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ],
                500);
        }
    }
}
