<?php

namespace App\Actions;

use Lorisleiva\Actions\Concerns\AsAction;

class GetSessionName
{
    use AsAction;
    public function handle()
    {
        return session('name');
    }
}
