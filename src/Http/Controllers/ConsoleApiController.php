<?php

namespace Krzychu12350\MetasploitApi\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Krzychu12350\Phpmetasploit\ConsoleApiMethods;
use Krzychu12350\Phpmetasploit\MsfRpcClient;

class ConsoleApiController extends Controller
{
	private ConsoleApiMethods $consoleApiMethods;


	public function __construct()
	{
		$this->consoleApiMethods = new ConsoleApiMethods();
	}


	public function create(): JsonResponse
	{
		$data = $this->consoleApiMethods->create();
		                    return response()->json(["status" => true,
		                    "message" => "create" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function destroy(): JsonResponse
	{
		$data = $this->consoleApiMethods->destroy(0);
		                    return response()->json(["status" => true,
		                    "message" => "destroy" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function list(): JsonResponse
	{
		$data = $this->consoleApiMethods->list();
		                    return response()->json(["status" => true,
		                    "message" => "list" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function write($consoleID, $command): JsonResponse
	{
		$data = $this->consoleApiMethods->write($consoleID, $command);
		                    return response()->json(["status" => true,
		                    "message" => "write" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function read($consoleID): JsonResponse
	{
		$data = $this->consoleApiMethods->read($consoleID);
		                    return response()->json(["status" => true,
		                    "message" => "read" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function sessionDetach($consoleID): JsonResponse
	{
		$data = $this->consoleApiMethods->sessionDetach($consoleID);
		                    return response()->json(["status" => true,
		                    "message" => "sessionDetach" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function sessionKill($consoleID): JsonResponse
	{
		$data = $this->consoleApiMethods->sessionKill($consoleID);
		                    return response()->json(["status" => true,
		                    "message" => "sessionKill" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function tabs($consoleID, $inputLine): JsonResponse
	{
		$data = $this->consoleApiMethods->tabs($consoleID, $inputLine);
		                    return response()->json(["status" => true,
		                    "message" => "tabs" . "Works!!!",
		                    "data" => $data ], 200);
	}
}
