<?php

namespace Krzychu12350\MetasploitApi\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Krzychu12350\MetasploitApi\Http\Requests\StoreScriptRequest;
use Krzychu12350\MetasploitApi\Http\Requests\UpdateScriptRequest;
use Krzychu12350\MetasploitApi\Http\Resources\ScriptResource;
use Krzychu12350\MetasploitApi\Models\Script;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Put;

class ScriptApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    #[Get('scripts')]
    public function index()
    {
        try {
            return response()->json([
                'status' => true,
                'scripts' => ScriptResource::collection(Script::all())
            ], 200);
        } catch (\Exception $e) {
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
     * @param StoreScriptRequest $request
     * @return JsonResponse
     */
    #[Post('scripts')]
    public function store(StoreScriptRequest $request)
    {
        try {
            //$request->request->add(['variable' => 'value']);
            //dd(array_merge($request->validated(), ['file_abs_path' => 'value']));
            if (Script::where('name', $request->file_name)->exists()) {
                throw ValidationException::withMessages(
                    [
                        'The script file named ' . $request->file_name . ' already exists'
                    ]);
            }

            $fileLocalPath = 'msf_scripts\\' . $request->file_name . '.rc';
            Storage::disk('local')->put($fileLocalPath, $request->contents);

            $fileAbsPath = str_replace('\\', '/', Storage::disk('local')->path($fileLocalPath));


            $newScript = Script::create(array_merge($request->validated(), ['file_abs_path' => $fileAbsPath]));

            //dd($newScript);
            return response()->json([
                'status' => true,
                'message' => "Script was created successfully",
                'new_script' => new ScriptResource($newScript)
            ], 201);
        } catch (\Exception $e) {
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
    #[Get('scripts/{id}')]
    public function show($id)
    {
        try {
            $script = Script::findOrFail($id);

            return response()->json([
                'status' => true,
                'script' => new ScriptResource($script)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => 'Script not found',
            ],
                404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateScriptRequest $request
     * @param $id
     * @return JsonResponse
     */
    #[Put('scripts/{id}')]
    public function update(UpdateScriptRequest $request, $id)
    {
        try {

            /*
            if (Script::where('name', $request->file_name)->exists()) {
                throw ValidationException::withMessages(
                    [
                        'The script file named ' . $request->file_name . ' already exists'
                    ]);
            }
            */
            $script = Script::findOrFail($id);
            $fileOldLocalPath = 'msf_scripts\\' . $script->file_name . '.rc';
            $fileNewLocalPath = 'msf_scripts\\' . $request->file_name . '.rc';
            //dd($fileOldLocalPath, $fileNewLocalPath);
            //Storage::disk('local')->put($fileLocalPath, $request->contents);
            //Storage::disk('local')->move($fileOldLocalPath, $fileNewLocalPath);

            Storage::disk('local')->delete($fileOldLocalPath);
            Storage::disk('local')->put($fileNewLocalPath, $request->contents);
            $fileAbsPath = str_replace('\\', '/', Storage::disk('local')->path($fileNewLocalPath));

            $script?->update(array_merge($request->validated(), ['file_abs_path' => $fileAbsPath]));

            return response()->json([
                'status' => true,
                'message' => "Script was updated successfully",
                'updated_script' => $script
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => 'Script not found',
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
    #[Delete('scripts/{id}')]
    public function destroy($id)
    {
        try {
            $script = Script::findOrFail($id);
            $script?->delete();

            return response()->json([], 204);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => 'Script not found',
            ],
                404);
        }
    }
}
