<?php

namespace App\Actions\GameStart;

use App\Models\Word;
use Lorisleiva\Actions\Concerns\AsAction;

class GetRandomWord
{
    use AsAction;

    public function handle()
    {
        return Word::where('valid',true)->inRandomOrder()->first()->word ?? 'shant';
    }
}
