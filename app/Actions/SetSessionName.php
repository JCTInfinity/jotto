<?php


namespace App\Actions;


use Lorisleiva\Actions\Concerns\AsAction;

class SetSessionName
{
    use AsAction;

    public function handle($name)
    {
        session(['name'=>$name]);
    }
}
