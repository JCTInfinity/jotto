<?php

namespace App\Actions\Admin;

use App\Models\Admin;
use App\Notifications\AdminLoginLink;
use Lorisleiva\Actions\Concerns\AsAction;

class SendAdminLoginLink
{
    use AsAction;

    public function handle()
    {
        Admin::first()->notify(new AdminLoginLink());
    }
}
