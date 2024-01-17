<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class JobApplicationArchiveLis
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
            $UpdateJobBoard = $event->UpdateJobBoard;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'HRM';
            $activity['sub_module']     = 'Recruitment';
            if ($UpdateJobBoard->is_archive == 1) {
                $activity['description']    = __('Job Application Add to Archive by the ') . Auth::user()->name . '.';
            } else {
                $activity['description']    = __('Job Application Unarchive by the ') . Auth::user()->name . '.';
            }
            $activity['url']            = '';
            $activity['workspace']      = $UpdateJobBoard->workspace;
            $activity['created_by']     = $UpdateJobBoard->created_by;
            $activity->save();
        }
    }
}
