<?php

namespace Krzychu12350\MetasploitApi\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Krzychu12350\Phpmetasploit\ConsoleApiMethods;
use Krzychu12350\Phpmetasploit\MsfRpcClient;
use Spatie\RouteAttributes\Attributes\Post;

class DatabaseApiController extends Controller
{


	#[Post('database/hosts')]
	public function hosts()
	{
        $data = DB::table('hosts')->get();
        return response()->json([
            "status" => true,
            "data" => $data],
            200);
        /*
		try {
			$this->consoleApiMethods->setToken($request->header("Authorization"));
			$data = $this->consoleApiMethods->create();
			return response()->json([
				"status" => true,
				"data" => $data],
				200);
		} catch (\Exception $e) {
			return response()->json([
				"status" => false,
				"message" => $e->getMessage(),
			],
				$e->getCode());
		}
        */
	}

    #[Post('database/services/{id}')]
    public function services($id)
    {
        $data = DB::table('services')->where('host_id', $id)->first();
        return response()->json([
            "status" => true,
            "services" => $data],
            200);
        /*
		try {
			$this->consoleApiMethods->setToken($request->header("Authorization"));
			$data = $this->consoleApiMethods->create();
			return response()->json([
				"status" => true,
				"data" => $data],
				200);
		} catch (\Exception $e) {
			return response()->json([
				"status" => false,
				"message" => $e->getMessage(),
			],
				$e->getCode());
		}
        */
    }

    #[Post('database/hosts/{id}')]
    public function hostDetails($id)
    {
        $data = DB::table('hosts')->where('id', $id)->get()->first();
        return response()->json([
            "status" => true,
            "host_details" => $data],
            200);
        /*
		try {
			$this->consoleApiMethods->setToken($request->header("Authorization"));
			$data = $this->consoleApiMethods->create();
			return response()->json([
				"status" => true,
				"data" => $data],
				200);
		} catch (\Exception $e) {
			return response()->json([
				"status" => false,
				"message" => $e->getMessage(),
			],
				$e->getCode());
		}
        */
    }
}
