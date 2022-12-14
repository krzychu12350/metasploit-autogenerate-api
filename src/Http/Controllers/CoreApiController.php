<?php

namespace Krzychu12350\MetasploitApi\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Krzychu12350\Phpmetasploit\CoreApiMethods;
use Krzychu12350\Phpmetasploit\MsfRpcClient;

class CoreApiController extends Controller
{
	private CoreApiMethods $coreApiMethods;


	public function __construct()
	{
		$this->coreApiMethods = new CoreApiMethods();
	}


	public function addModule($path): JsonResponse
	{
		$data = $this->coreApiMethods->addModule($path);
		                    return response()->json(["status" => true,
		                    "message" => "addModule" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function moduleStats(): JsonResponse
	{
		$data = $this->coreApiMethods->moduleStats();
		                    return response()->json(["status" => true,
		                    "message" => "moduleStats" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function reloadModules(): JsonResponse
	{
		$data = $this->coreApiMethods->reloadModules();
		                    return response()->json(["status" => true,
		                    "message" => "reloadModules" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function save(): JsonResponse
	{
		$data = $this->coreApiMethods->save();
		                    return response()->json(["status" => true,
		                    "message" => "save" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function setg($optionName, $optionValue): JsonResponse
	{
		$data = $this->coreApiMethods->setg($optionName, $optionValue);
		                    return response()->json(["status" => true,
		                    "message" => "setg" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function unsetg($optionName): JsonResponse
	{
		$data = $this->coreApiMethods->unsetg($optionName);
		                    return response()->json(["status" => true,
		                    "message" => "unsetg" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function threadList(): JsonResponse
	{
		$data = $this->coreApiMethods->threadList();
		                    return response()->json(["status" => true,
		                    "message" => "threadList" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function threadKill($threadID): JsonResponse
	{
		$data = $this->coreApiMethods->threadKill($threadID);
		                    return response()->json(["status" => true,
		                    "message" => "threadKill" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function version(): JsonResponse
	{
		$data = $this->coreApiMethods->version();
		                    return response()->json(["status" => true,
		                    "message" => "version" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function stop(): JsonResponse
	{
		$data = $this->coreApiMethods->stop();
		                    return response()->json(["status" => true,
		                    "message" => "stop" . "Works!!!",
		                    "data" => $data ], 200);
	}
}
