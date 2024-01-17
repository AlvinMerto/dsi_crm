<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class CreateCallLis
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
            $call = $event->call;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Sales';
            $activity['sub_module']     = 'Calls';
            $activity['description']    = __('New Call Created by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $call->workspace;
            $activity['account_id']      = isset($call->account)?$call->account:0;
            $activity['contact_id']      = isset($call->attendees_contact)?$call->attendees_contact:0;
            $activity['created_by']     = $call->created_by;
            $activity->save();
        }
    }
}
