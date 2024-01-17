<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class CreateUserLis
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if (module_is_active('ActivityLog')) {
            $user = $event->user;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'User Management';
            $activity['sub_module']     = 'User';
            $activity['description']    = __('New User created by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $user->workspace_id;
            $activity['created_by']     = $user->created_by;
            $activity->save();
        }
    }
}
