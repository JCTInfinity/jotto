<?php

namespace App\Actions;

use Illuminate\Support\Str;
use Lorisleiva\Actions\Concerns\AsAction;

class GetCode
{
    use AsAction;

    public function handle(string $type): string
    {
        return strtolower(Str::random(config("jotto.codes.$type.length")));
    }
}
