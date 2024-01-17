<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class UpdateAppointmentLis
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
            $appointment = $event->appointment;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Appointment';
            $activity['sub_module']     = 'Appointments';
            $activity['description']    = __('Appointment Updated by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $appointment['workspace'];
            $activity['created_by']     = $appointment['created_by'];
            $activity->save();
        }
    }
}
