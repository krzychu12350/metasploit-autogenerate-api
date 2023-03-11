<?php

namespace Krzychu12350\MetasploitApi\Http\Requests;

use Illuminate\Validation\Rules\Enum;
use Krzychu12350\MetasploitApi\Enums\ScriptTypeEnum;

class UpdateScriptRequest extends ApiFormRequest
{
    public function rules()
    {
        /*
         *       "name",
        "file_name",
        "file_abs_path",
        "type",
        "contents",
         */
        return [
            "name" => "required|string",
            "file_name" => "required|string",
            "type" => [
                "required",
                new Enum(ScriptTypeEnum::class)
            ],
            "contents" => "required|string",
        ];
    }


    public function authorize()
    {
        return true;
    }
}
