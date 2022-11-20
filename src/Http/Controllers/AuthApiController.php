<?php

namespace Krzychu12350\MetasploitApi\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Krzychu12350\Phpmetasploit\AuthApiMethods;
use Krzychu12350\Phpmetasploit\MsfRpcClient;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;

class AuthApiController extends Controller
{
	private AuthApiMethods $authApiMethods;


	public function __construct()
	{
		$this->authApiMethods = new AuthApiMethods();
	}


    #[Get('my-route')]
	public function login($myUserName, $myPassword): JsonResponse
	{
		$data = $this->authApiMethods->login($myUserName, $myPassword);
		                    return response()->json(["status" => true,
		                    "message" => "login" . "Works!!!",
		                    "data" => $data ], 200);
	}


    #[Post('logout')]
	public function logout($logoutToken): JsonResponse
	{
		$data = $this->authApiMethods->logout($logoutToken);
		                    return response()->json(["status" => true,
		                    "message" => "logout" . "Works!!!",
		                    "data" => $data ], 200);
	}


	#[\Spatie\RouteDiscovery\Attributes\Route(fullUri: '\tokenAdd')]
	public function tokenAdd($newToken): JsonResponse
	{
		$data = $this->authApiMethods->tokenAdd($newToken);
		                    return response()->json(["status" => true,
		                    "message" => "tokenAdd" . "Works!!!",
		                    "data" => $data ], 200);
	}


	#[\Spatie\RouteDiscovery\Attributes\Route(fullUri: '\tokenGenerate')]
	public function tokenGenerate(): JsonResponse
	{
		$data = $this->authApiMethods->tokenGenerate();
		                    return response()->json(["status" => true,
		                    "message" => "tokenGenerate" . "Works!!!",
		                    "data" => $data ], 200);
	}


	#[\Spatie\RouteDiscovery\Attributes\Route(fullUri: '\tokenList')]
	public function tokenList(): JsonResponse
	{
		$data = $this->authApiMethods->tokenList();
		                    return response()->json(["status" => true,
		                    "message" => "tokenList" . "Works!!!",
		                    "data" => $data ], 200);
	}


	#[\Spatie\RouteDiscovery\Attributes\Route(fullUri: '\tokenRemove')]
	public function tokenRemove($tokenToBeRemoved): JsonResponse
	{
		$data = $this->authApiMethods->tokenRemove($tokenToBeRemoved);
		                    return response()->json(["status" => true,
		                    "message" => "tokenRemove" . "Works!!!",
		                    "data" => $data ], 200);
	}
}
