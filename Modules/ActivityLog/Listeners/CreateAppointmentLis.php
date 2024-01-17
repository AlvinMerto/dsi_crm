<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class CreateAppointmentLis
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
            $appointment = $event->post;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Appointment';
            $activity['sub_module']     = 'Appointments';
            $activity['description']    = __('New Appointment created by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $appointment['workspace'];
            $activity['created_by']     = $appointment['created_by'];
            $activity->save();
        }
    }
}
