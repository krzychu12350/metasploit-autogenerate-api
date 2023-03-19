<?php

namespace Krzychu12350\MetasploitApi\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Krzychu12350\MetasploitApi\Http\Requests\ConnectToMsfRpcServerRequest;
use Krzychu12350\MetasploitApi\Http\Requests\StoreMsfRpcServerConnectionRequest;
use Krzychu12350\MetasploitApi\Http\Requests\UpdateMsfRpcServerConnectionRequest;
use Krzychu12350\MetasploitApi\Http\Resources\MsfRpcServerConnectionResource;
use Krzychu12350\MetasploitApi\Models\MsfRpcServerConnection;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Put;

class MsfRpcServerConnectionApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    #[Get('connections')]
    public function index()
    {
        try {
            return response()->json([
                'status' => true,
                'connections' => MsfRpcServerConnectionResource::collection(MsfRpcServerConnection::all())
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
            ],
                400);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMsfRpcServerConnectionRequest $request
     * @return JsonResponse
     */
    #[Post('connections')]
    public function store(StoreMsfRpcServerConnectionRequest $request)
    {
        try {
            $newConnection = MsfRpcServerConnection::create($request->validated());

            return response()->json([
                'status' => true,
                'message' => "Connection was created successfully",
                'new_connection' => new MsfRpcServerConnectionResource($newConnection)
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
            ],
                400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    #[Get('connections/{id}')]
    public function show($id)
    {
        try {
            $msfRpcServerConnection = MsfRpcServerConnection::findOrFail($id);

            return response()->json([
                'status' => true,
                'connection' => new MsfRpcServerConnectionResource($msfRpcServerConnection)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => 'Connection not found',
            ],
                404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMsfRpcServerConnectionRequest $request
     * @param $id
     * @return JsonResponse
     */
    #[Put('connections/{id}')]
    public function update(UpdateMsfRpcServerConnectionRequest $request, $id)
    {
        try {
            $msfRpcServerConnection = MsfRpcServerConnection::findOrFail($id);
            $msfRpcServerConnection?->update($request->validated());

            return response()->json([
                'status' => true,
                'message' => "Connection was updated successfully",
                'updated_connection' => $msfRpcServerConnection
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => 'Connection not found',
            ],
                404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    #[Delete('connections/{id}')]
    public function destroy($id)
    {
        try {
            $msfRpcServerConnection = MsfRpcServerConnection::findOrFail($id);
            $msfRpcServerConnection?->delete();

            return response()->json([], 204);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => 'Connection not found',
            ],
                404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    #[Post('connections/set-connection')]
    public function setConnection(ConnectToMsfRpcServerRequest $request)
    {
        try {
            $connection = MsfRpcServerConnection::firstOrCreate($request->validated(), $request->validated());
            settings()->set('current_connection', $connection->id)->save();

            return response()->json([
                "status" => true,
                "message" => 'Connection was set successfully',
                "connection_details" => new MsfRpcServerConnectionResource($connection)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => 'Connection was not set successfully',
            ],
                500);
        }
    }
}
