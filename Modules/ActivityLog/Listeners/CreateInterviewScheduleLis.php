<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;
use Modules\Recruitment\Entities\JobApplication;

class CreateInterviewScheduleLis
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
            $schedule = $event->schedule;
            $candidate = JobApplication::find($schedule->candidate);

            $activity                   = new AllActivityLog();
            $activity['module']         = 'HRM';
            $activity['sub_module']     = 'Recruitment';
            $activity['description']    = __('New Interview Schedule created for candidate ') . $candidate->name . __(' by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $schedule->workspace;
            $activity['created_by']     = $schedule->created_by;
            $activity->save();
        }
    }
}
