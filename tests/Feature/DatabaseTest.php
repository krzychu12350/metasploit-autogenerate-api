<?php

namespace Krzychu12350\MetasploitApi\Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    /**
     * A feature test to get all hosts belongs to specific workspace
     *
     * @return void
     */
    public function test_get_all_hosts_belongs_to_specific_workspace()
    {
        $workspace = DB::table('workspaces')->orderBy('id', 'asc')->first();

        $this->get('/api/database/workspaces/' . $workspace->id . '/hosts')
            ->assertStatus(200)
            ->assertJsonStructure(['status',
                'data' =>
                ['*' => [
                    "id",
                    "created_at",
                    "address",
                    "mac",
                    "comm",
                    "name",
                    "state",
                    "os_name",
                    "os_flavor",
                    "os_sp",
                    "os_lang",
                    "arch",
                    "workspace_id",
                    "updated_at",
                    "purpose",
                    "info",
                    "comments",
                    "scope",
                    "virtual_host",
                    "note_count",
                    "vuln_count",
                    "service_count",
                    "host_detail_count",
                    "exploit_attempt_count",
                    "cred_count",
                    "detected_arch",
                    "os_family",
            ],
            ],
        ]);
    }

    /**
     * A feature test to get all services of specific host
     *
     * @return void
     */
    public function test_get_all_services_of_specific_host()
    {
        $host = DB::table('hosts')->orderBy('id', 'asc')->first();

        $this->get('/api/database/hosts/' . $host->id . '/services')
            ->assertStatus(200)
            ->assertJsonStructure(['status',
                'services' =>
                    ['*' => [
                        "id",
                        "host_id",
                        "created_at",
                        "port",
                        "proto",
                        "state",
                        "name",
                        "updated_at",
                        "info",],
                    ],
            ]);
    }

    /**
     * A feature test to get all workspaces
     *
     * @return void
     */
    public function test_get_all_workspaces()
    {
        $this->get('/api/database/workspaces')
            ->assertStatus(200)
            ->assertJsonStructure(['status',
                'workspaces' =>
                    ['*' => [
                        "id",
                        "name",
                        "created_at",
                        "updated_at",
                        "boundary",
                        "description",
                        "owner_id",
                        "limit_to_network",
                        "import_fingerprint",
                        ],
                    ],
            ]);
    }
}
