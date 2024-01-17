<?php

namespace Modules\SupportTicket\Providers;
use App\Events\DefaultData;
use App\Events\GivePermissionToRole;
use Modules\SupportTicket\Listeners\DataDefault;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\SupportTicket\Listeners\GiveRoleToPermission;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    protected $listen = [
        GivePermissionToRole::class =>[
            GiveRoleToPermission::class
        ],
        DefaultData::class =>[
            DataDefault::class
        ]
    ];
}
