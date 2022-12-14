<?php

namespace Krzychu12350\MetasploitApi\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Krzychu12350\Phpmetasploit\ModuleApiMethods;
use Krzychu12350\Phpmetasploit\MsfRpcClient;
use Illuminate\Http\Request;

class ModuleApiController extends Controller
{
	private ModuleApiMethods $moduleApiMethods;


	public function __construct()
	{
		$this->moduleApiMethods = new ModuleApiMethods();
	}


	public function exploits(): JsonResponse
	{
		$data = $this->moduleApiMethods->exploits();
		                    return response()->json(["status" => true,
		                    "message" => "exploits" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function auxiliary(): JsonResponse
	{
		$data = $this->moduleApiMethods->auxiliary();
		                    return response()->json(["status" => true,
		                    "message" => "auxiliary" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function post(): JsonResponse
	{
		$data = $this->moduleApiMethods->post();
		                    return response()->json(["status" => true,
		                    "message" => "post" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function payloads(): JsonResponse
	{
		$data = $this->moduleApiMethods->payloads();
		                    return response()->json(["status" => true,
		                    "message" => "payloads" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function encoders(): JsonResponse
	{
		$data = $this->moduleApiMethods->encoders();
		                    return response()->json(["status" => true,
		                    "message" => "encoders" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function noInputCommand(): JsonResponse
	{
		$data = $this->moduleApiMethods->noInputCommand();
		                    return response()->json(["status" => true,
		                    "message" => "noInputCommand" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function info($moduleType, $moduleName): JsonResponse
	{
		$data = $this->moduleApiMethods->info($moduleType, $moduleName);
		                    return response()->json(["status" => true,
		                    "message" => "info" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function options(Request $request): JsonResponse
	{


        //dd($request->all());
        //$moduleType = 'payloads';
        //$moduleName = 'windows/shell/reverse_tcp';

        $moduleType = $request['module_type'];
        $moduleName = $request['module_name'];

        dd($request['module_type']);

		$data = $this->moduleApiMethods->options($moduleType, $moduleName);
		                    return response()->json(["status" => true,
		                    "message" => "options" . "Works!!!",
		                    "data" => $data ], 200);

	}


	public function compatiblePayloads($moduleName): JsonResponse
	{
		$data = $this->moduleApiMethods->compatiblePayloads($moduleName);
		                    return response()->json(["status" => true,
		                    "message" => "compatiblePayloads" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function targetCompatible($moduleName): JsonResponse
	{
		$data = $this->moduleApiMethods->targetCompatible($moduleName);
		                    return response()->json(["status" => true,
		                    "message" => "targetCompatible" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function compatibleSessions($moduleName): JsonResponse
	{
		$data = $this->moduleApiMethods->compatibleSessions($moduleName);
		                    return response()->json(["status" => true,
		                    "message" => "compatibleSessions" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function encode($data, $encoderModule): JsonResponse
	{
		$data = $this->moduleApiMethods->encode($data, $encoderModule);
		                    return response()->json(["status" => true,
		                    "message" => "encode" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function execute($moduleType, $moduleName): JsonResponse
	{
		$data = $this->moduleApiMethods->execute($moduleType, $moduleName);
		                    return response()->json(["status" => true,
		                    "message" => "execute" . "Works!!!",
		                    "data" => $data ], 200);
	}
}
