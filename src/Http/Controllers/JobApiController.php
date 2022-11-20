<?php

namespace Krzychu12350\MetasploitApi\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Krzychu12350\Phpmetasploit\JobApiMethods;
use Krzychu12350\Phpmetasploit\MsfRpcClient;

class JobApiController extends Controller
{
	private JobApiMethods $jobApiMethods;


	public function __construct()
	{
		$this->jobApiMethods = new JobApiMethods();
	}


	#[\Spatie\RouteAttributes\Attributes\Get('list')]
	public function list(): JsonResponse
	{
		$data = $this->jobApiMethods->list();
		                    return response()->json(["status" => true,
		                    "message" => "list" . "Works!!!",
		                    "data" => $data ], 200);
	}


	#[\Spatie\RouteAttributes\Attributes\Get('info')]
	public function info($jobID): JsonResponse
	{
		$data = $this->jobApiMethods->info($jobID);
		                    return response()->json(["status" => true,
		                    "message" => "info" . "Works!!!",
		                    "data" => $data ], 200);
	}


	#[\Spatie\RouteAttributes\Attributes\Get('stop')]
	public function stop($jobID): JsonResponse
	{
		$data = $this->jobApiMethods->stop($jobID);
		                    return response()->json(["status" => true,
		                    "message" => "stop" . "Works!!!",
		                    "data" => $data ], 200);
	}
}
