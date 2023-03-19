<?php

namespace Krzychu12350\MetasploitApi\Tests\Feature;

use Illuminate\Support\Facades\Storage;
use Krzychu12350\MetasploitApi\Models\Script;
use Tests\TestCase;

class ScriptTest extends TestCase
{
    /**
     * A feature test to all scripts data
     *
     * @return void
     */
    public function test_get_all_scripts()
    {
        $response = $this->get('/api/scripts')
            ->assertStatus(200)
            ->assertJsonStructure(['status', 'scripts' =>
                ['*' => ["id", "name", "file_abs_path", "type", "contents", "created_at", "updated_at",],],]);
    }

    /**
     * A feature test to get script by id
     *
     * @return void
     */
    public function test_get_script_by_id()
    {
        $latestScript = Script::get()->first();
        $response = $this->get('/api/scripts/' . $latestScript->id)->assertStatus(200)
            ->assertJsonStructure(['status', 'script' =>
                ["id", "name", "file_abs_path", "type", "contents", "created_at", "updated_at",],]);
    }

    /**
     * A feature test to add a new script
     *
     * @return void
     */
    public function test_for_add_script()
    {
        $randomString = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            ceil(10/strlen($x)) )),1,10);
        $payload = [
            "name" => $randomString,
            "file_name" => $randomString,
            "type" => "meterpreter",
            "contents" => "pwd\nhelp"
        ];
        $fileLocalPath = 'msf_scripts\\' . $payload['file_name'] . '.rc';
        $fileAbsPath = str_replace('\\', '/', Storage::disk('local')->path($fileLocalPath));
        $this->json('POST', 'api/scripts', array_merge($payload, ['file_abs_path' => $fileAbsPath]))
            ->assertStatus(201)
            ->assertJson(["status" => true, "message" => "Script was created successfully",
            ]);
    }

    /**
     * A feature test to update existing script
     *
     * @return void
     */
    public function test_for_update_script()
    {
        $latestScript = Script::latest()->first();
        $payload = [
            "name" => "testMeter2",
            "file_name" => "testMeter2",
            "type" => "meterpreter",
            "contents" => "pwd\nhelp",
        ];
        $this->json('PUT', 'api/scripts/' . $latestScript->id, $payload)
            ->assertStatus(200)
            ->assertJson(["status" => true, "message" => "Script was updated successfully",
            ]);
    }

    /**
     * A feature test to update a script that does not exist
     *
     * @return void
     */
    public function test_for_update_script_that_not_exist()
    {
        $payload = [
            "name" => "testMeter2",
            "file_name" => "testMeter2",
            "type" => "meterpreter",
            "contents" => "pwd\nhelp",
            "file_abs_path" => "C:\\testMeter2.rc"
        ];

        //script id that not exist in database
        $scriptId = random_int(100000, 999999);

        $this->json('PUT', 'api/scripts/' . $scriptId, $payload)
            ->assertStatus(404)->assertJson(['status' => false, 'message' => 'Script not found',]);
    }

    /**
     * A feature test to delete a script that does not exist
     *
     * @return void
     */
    public function test_for_delete_script_that_not_exist()
    {
        //script id that not exist in database
        $scriptId = random_int(100000, 999999);

        $this->json('DELETE', 'api/scripts/' . $scriptId)
            ->assertStatus(404)->assertJson(['status' => false, 'message' => 'Script not found',]);
    }
}
