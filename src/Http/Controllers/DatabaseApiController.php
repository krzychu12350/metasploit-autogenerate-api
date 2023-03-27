<?php

namespace Krzychu12350\MetasploitApi\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\DB;
use Spatie\RouteAttributes\Attributes\Get;

class DatabaseApiController extends Controller
{
    #[Get('database/workspaces/{id}/hosts')]
    public function hosts($id)
    {
        try {
            $data = DB::table('hosts')->where('workspace_id', $id)->get();
            return response()->json([
                "status" => true,
                "data" => $data],
                200);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
            ],
                $e->getCode());
        }

    }

    #[Get('database/services/{id}')]
    public function hostServices($id)
    {
        try {
            $data = DB::table('services')->where('host_id', $id)->get();
            return response()->json([
                "status" => true,
                "services" => $data],
                200);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
            ],
                $e->getCode());
        }
    }

    #[Get('database/hosts/{id}')]
    public function hostDetails($id)
    {
        try {
            $data = DB::table('hosts')->where('id', $id)->get()->first();
            return response()->json([
                "status" => true,
                "host_details" => $data],
                200);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
            ],
                $e->getCode());
        }

    }

    #[Get('database/workspaces')]
    public function workspaces()
    {
        try {
            $data = DB::table('workspaces')->get();
            return response()->json([
                "status" => true,
                "workspaces" => $data],
                200);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
            ],
                $e->getCode());
        }

    }
}
