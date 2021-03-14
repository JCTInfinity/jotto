<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $word
 * @property bool $valid
 * @property array $api_response
 *
 * @mixin Builder
 */
class Word extends Model
{
//    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    protected $casts = [
        'valid'=>'bool',
        'api_response'=>'array',
    ];
}
