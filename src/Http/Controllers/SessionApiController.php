<?php

namespace Krzychu12350\MetasploitApi\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Krzychu12350\Phpmetasploit\MsfRpcClient;
use Krzychu12350\Phpmetasploit\SessionApiMethods;

class SessionApiController extends Controller
{
	private SessionApiMethods $sessionApiMethods;


	public function __construct()
	{
		$this->sessionApiMethods = new SessionApiMethods();
	}


	public function list(): JsonResponse
	{
		$data = $this->sessionApiMethods->list();
		                    return response()->json(["status" => true,
		                    "message" => "list" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function stop($sessionID): JsonResponse
	{
		$data = $this->sessionApiMethods->stop($sessionID);
		                    return response()->json(["status" => true,
		                    "message" => "stop" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function shellRead($sessionID, $inputCommand): JsonResponse
	{
		$data = $this->sessionApiMethods->shellRead($sessionID, $inputCommand);
		                    return response()->json(["status" => true,
		                    "message" => "shellRead" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function shellWrite($sessionID, $inputCommand): JsonResponse
	{
		$data = $this->sessionApiMethods->shellWrite($sessionID, $inputCommand);
		                    return response()->json(["status" => true,
		                    "message" => "shellWrite" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function meterpreterWrite($sessionID, $inputCommand): JsonResponse
	{
		$data = $this->sessionApiMethods->meterpreterWrite($sessionID, $inputCommand);
		                    return response()->json(["status" => true,
		                    "message" => "meterpreterWrite" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function meterpreterRead($sessionID): JsonResponse
	{
		$data = $this->sessionApiMethods->meterpreterRead($sessionID);
		                    return response()->json(["status" => true,
		                    "message" => "meterpreterRead" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function meterpreterRun($sessionID, $inputCommand): JsonResponse
	{
		$data = $this->sessionApiMethods->meterpreterRun($sessionID, $inputCommand);
		                    return response()->json(["status" => true,
		                    "message" => "meterpreterRun" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function meterpreterScript($sessionID, $scriptname): JsonResponse
	{
		$data = $this->sessionApiMethods->meterpreterScript($sessionID, $scriptname);
		                    return response()->json(["status" => true,
		                    "message" => "meterpreterScript" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function meterpreterSession($sessionID): JsonResponse
	{
		$data = $this->sessionApiMethods->meterpreterSession($sessionID);
		                    return response()->json(["status" => true,
		                    "message" => "meterpreterSession" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function meterpreterTabs($sessionID, $inputLine): JsonResponse
	{
		$data = $this->sessionApiMethods->meterpreterTabs($sessionID, $inputLine);
		                    return response()->json(["status" => true,
		                    "message" => "meterpreterTabs" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function compatibleModules($sessionID): JsonResponse
	{
		$data = $this->sessionApiMethods->compatibleModules($sessionID);
		                    return response()->json(["status" => true,
		                    "message" => "compatibleModules" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function shellUpgrade($sessionID, $ipAddress): JsonResponse
	{
		$data = $this->sessionApiMethods->shellUpgrade($sessionID, $ipAddress);
		                    return response()->json(["status" => true,
		                    "message" => "shellUpgrade" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function ringClear($sessionID): JsonResponse
	{
		$data = $this->sessionApiMethods->ringClear($sessionID);
		                    return response()->json(["status" => true,
		                    "message" => "ringClear" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function ringLast($sessionID): JsonResponse
	{
		$data = $this->sessionApiMethods->ringLast($sessionID);
		                    return response()->json(["status" => true,
		                    "message" => "ringLast" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function ringPut($sessionID, $inputCommand): JsonResponse
	{
		$data = $this->sessionApiMethods->ringPut($sessionID, $inputCommand);
		                    return response()->json(["status" => true,
		                    "message" => "ringPut" . "Works!!!",
		                    "data" => $data ], 200);
	}
}
