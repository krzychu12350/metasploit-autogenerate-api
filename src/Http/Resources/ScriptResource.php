<?php

namespace Krzychu12350\MetasploitApi\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScriptResource extends JsonResource
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
            "name" => $this->name,
            "file_name" => $this->file_name,
            "file_abs_path" => $this->file_abs_path,
            "type" => $this->type,
            "contents" => $this->contents,
        ];
    }
}
