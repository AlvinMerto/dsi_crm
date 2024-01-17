<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class CreateGoalTrackingLis
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
            $goalTracking = $event->goalTracking;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'HRM';
            $activity['sub_module']     = 'Performance';
            $activity['description']    = __('New Goal Tracking created by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $goalTracking->workspace;
            $activity['created_by']     = $goalTracking->created_by;
            $activity->save();
        }
    }
}
