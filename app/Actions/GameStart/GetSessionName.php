<?php

namespace App\Actions\GameStart;

use Lorisleiva\Actions\Concerns\AsAction;
use function session;

class GetSessionName
{
    use AsAction;
    public function handle()
    {
        return session('name','');
    }
}
