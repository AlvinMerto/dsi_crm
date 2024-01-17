<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class CreateAvailabilityLis
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
            $availability = $event->availability;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Rotas';
            $activity['sub_module']     = 'Availability';
            $activity['description']    = __('New Availability created by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $availability->workspace;
            $activity['created_by']     = $availability->created_by;
            $activity->save();
        }
    }
}
