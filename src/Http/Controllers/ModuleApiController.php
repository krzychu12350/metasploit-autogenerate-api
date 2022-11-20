<?php

namespace Krzychu12350\MetasploitApi\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Krzychu12350\Phpmetasploit\ModuleApiMethods;
use Krzychu12350\Phpmetasploit\MsfRpcClient;

class ModuleApiController extends Controller
{
	private ModuleApiMethods $moduleApiMethods;


	public function __construct()
	{
		$this->moduleApiMethods = new ModuleApiMethods();
	}


	#[\Spatie\RouteDiscovery\Attributes\Route(fullUri: '\exploits')]
	public function exploits(): JsonResponse
	{
		$data = $this->moduleApiMethods->exploits();
		                    return response()->json(["status" => true,
		                    "message" => "exploits" . "Works!!!",
		                    "data" => $data ], 200);
	}


	#[\Spatie\RouteDiscovery\Attributes\Route(fullUri: '\auxiliary')]
	public function auxiliary(): JsonResponse
	{
		$data = $this->moduleApiMethods->auxiliary();
		                    return response()->json(["status" => true,
		                    "message" => "auxiliary" . "Works!!!",
		                    "data" => $data ], 200);
	}


	#[\Spatie\RouteDiscovery\Attributes\Route(fullUri: '\post')]
	public function post(): JsonResponse
	{
		$data = $this->moduleApiMethods->post();
		                    return response()->json(["status" => true,
		                    "message" => "post" . "Works!!!",
		                    "data" => $data ], 200);
	}


	#[\Spatie\RouteDiscovery\Attributes\Route(fullUri: '\payloads')]
	public function payloads(): JsonResponse
	{
		$data = $this->moduleApiMethods->payloads();
		                    return response()->json(["status" => true,
		                    "message" => "payloads" . "Works!!!",
		                    "data" => $data ], 200);
	}


	#[\Spatie\RouteDiscovery\Attributes\Route(fullUri: '\encoders')]
	public function encoders(): JsonResponse
	{
		$data = $this->moduleApiMethods->encoders();
		                    return response()->json(["status" => true,
		                    "message" => "encoders" . "Works!!!",
		                    "data" => $data ], 200);
	}


	#[\Spatie\RouteDiscovery\Attributes\Route(fullUri: '\noInputCommand')]
	public function noInputCommand(): JsonResponse
	{
		$data = $this->moduleApiMethods->noInputCommand();
		                    return response()->json(["status" => true,
		                    "message" => "noInputCommand" . "Works!!!",
		                    "data" => $data ], 200);
	}


	#[\Spatie\RouteDiscovery\Attributes\Route(fullUri: '\info')]
	public function info($moduleType, $moduleName): JsonResponse
	{
		$data = $this->moduleApiMethods->info($moduleType, $moduleName);
		                    return response()->json(["status" => true,
		                    "message" => "info" . "Works!!!",
		                    "data" => $data ], 200);
	}


	#[\Spatie\RouteDiscovery\Attributes\Route(fullUri: '\options')]
	public function options(): JsonResponse
	{
        $moduleType = "payloads";
        $moduleName = "windows/shell/reverse_tcp";

        $data = $this->moduleApiMethods->options($moduleType, $moduleName);
        return response()->json(["status" => true,
            "message" => "options" . "Works!!!",
            "data" => $data ], 200);
	}


	#[\Spatie\RouteDiscovery\Attributes\Route(fullUri: '\compatiblePayloads')]
	public function compatiblePayloads($moduleName): JsonResponse
	{
		$data = $this->moduleApiMethods->compatiblePayloads($moduleName);
		                    return response()->json(["status" => true,
		                    "message" => "compatiblePayloads" . "Works!!!",
		                    "data" => $data ], 200);
	}


	#[\Spatie\RouteDiscovery\Attributes\Route(fullUri: '\targetCompatible')]
	public function targetCompatible($moduleName): JsonResponse
	{
		$data = $this->moduleApiMethods->targetCompatible($moduleName);
		                    return response()->json(["status" => true,
		                    "message" => "targetCompatible" . "Works!!!",
		                    "data" => $data ], 200);
	}


	#[\Spatie\RouteDiscovery\Attributes\Route(fullUri: '\compatibleSessions')]
	public function compatibleSessions($moduleName): JsonResponse
	{
		$data = $this->moduleApiMethods->compatibleSessions($moduleName);
		                    return response()->json(["status" => true,
		                    "message" => "compatibleSessions" . "Works!!!",
		                    "data" => $data ], 200);
	}


	#[\Spatie\RouteDiscovery\Attributes\Route(fullUri: '\encode')]
	public function encode($data, $encoderModule): JsonResponse
	{
		$data = $this->moduleApiMethods->encode($data, $encoderModule);
		                    return response()->json(["status" => true,
		                    "message" => "encode" . "Works!!!",
		                    "data" => $data ], 200);
	}


	#[\Spatie\RouteDiscovery\Attributes\Route(fullUri: '\execute')]
	public function execute($moduleType, $moduleName): JsonResponse
	{
		$data = $this->moduleApiMethods->execute($moduleType, $moduleName);
		                    return response()->json(["status" => true,
		                    "message" => "execute" . "Works!!!",
		                    "data" => $data ], 200);
	}
}
