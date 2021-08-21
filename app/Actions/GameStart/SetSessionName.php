<?php


namespace App\Actions\GameStart;


use Lorisleiva\Actions\Concerns\AsAction;
use function session;

class SetSessionName
{
    use AsAction;

    public function handle($name)
    {
        session(['name'=>$name]);
    }
}
