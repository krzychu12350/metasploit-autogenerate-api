<?php

namespace Krzychu12350\MetasploitApi\Http\Requests;

class UpdateMsfRpcServerConnectionRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            "user_name" => "required|string",
            "user_password" => "required|string",
            "ip" => "required|string",
            "port" => "required|integer",
            "web_server_uri" => "required|string",
            "ssl" => "required|boolean",
        ];
    }

    public function authorize()
    {
        return true;
    }
}
