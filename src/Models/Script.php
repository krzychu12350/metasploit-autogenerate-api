<?php

namespace Krzychu12350\MetasploitApi\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Krzychu12350\MetasploitApi\Enums\ScriptTypeEnum;

class Script extends Model
{
    use HasFactory;

    // Disable Laravel's mass assignment protection
    //protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        "file_name",
        "file_abs_path",
        "type",
        "contents",

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'type' => ScriptTypeEnum::class,
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'scripts';

}
