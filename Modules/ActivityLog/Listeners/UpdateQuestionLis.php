<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class UpdateQuestionLis
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
            $question = $event->question;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Appointment';
            $activity['sub_module']     = 'Questions';
            $activity['description']    = __('Question Updated by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $question['workspace'];
            $activity['created_by']     = $question['created_by'];
            $activity->save();
        }
    }
}
