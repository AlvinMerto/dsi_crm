<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class CreateWorkorderLis
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
            $workorder = $event->workorder;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'CMMS';
            $activity['sub_module']     = 'Work Order';
            $activity['description']    = __('New Work Order Created by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $workorder->workspace;
            $activity['created_by']     = $workorder->created_by;
            $activity->save();
        }
    }
}
