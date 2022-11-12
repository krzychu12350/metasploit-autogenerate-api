<?php

namespace Krzychu12350\MetasploitApi\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Krzychu12350\Phpmetasploit\MsfRpcClient;
use Krzychu12350\Phpmetasploit\PluginApiMethods;

class PluginApiController extends Controller
{
	private PluginApiMethods $pluginApiMethods;


	public function __construct()
	{
		$this->pluginApiMethods = new PluginApiMethods();
	}


	public function load($pluginName, $options): JsonResponse
	{
		$data = $this->pluginApiMethods->load($pluginName, $options);
		                    return response()->json(["status" => true,
		                    "message" => "load" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function unload($pluginName): JsonResponse
	{
		$data = $this->pluginApiMethods->unload($pluginName);
		                    return response()->json(["status" => true,
		                    "message" => "unload" . "Works!!!",
		                    "data" => $data ], 200);
	}


	public function loaded(): JsonResponse
	{
		$data = $this->pluginApiMethods->loaded();
		                    return response()->json(["status" => true,
		                    "message" => "loaded" . "Works!!!",
		                    "data" => $data ], 200);
	}
}
