<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @mixin Builder
 */
class Admin extends Authenticatable
{
    use Notifiable;

    public function routeNotificationForDiscord(): string
    {
        return config('services.discord.admin_webhook_url');
    }
}
