<?php

namespace Krzychu12350\MetasploitApi\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MsfRpcServerConnectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            "user_name" => $this->user_name,
            "user_password" => $this->user_password,
            "ip" => $this->ip,
            "port" => $this->port,
            "web_server_uri" => $this->web_server_uri,
            "ssl" => $this->ssl,
        ];
    }
}
