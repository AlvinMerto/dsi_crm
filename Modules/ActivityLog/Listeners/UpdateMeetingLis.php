<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class UpdateMeetingLis
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
            $meeting = $event->meeting;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Sales';
            $activity['sub_module']     = 'Meeting';
            $activity['description']    = __('Meeting Updated by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $meeting->workspace;
            $activity['account_id']      = isset($meeting->account)?$meeting->account:0;
            $activity['contact_id']      = isset($meeting->attendees_contact)?$meeting->attendees_contact:0;
            $activity['created_by']     = $meeting->created_by;
            $activity->save();
        }
    }
}
