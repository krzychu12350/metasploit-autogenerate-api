<?php

namespace Krzychu12350\MetasploitApi\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MsfRpcServerConnection extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "user_name",
        "user_password",
        "ip",
        "port",
        "web_server_uri",
        "ssl",
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'msf_rpc_client_connections';
}
