<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class AddDayoffLis
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
            $profile = $event->profile;
            if (!empty($profile->custom_day_off)) {
                $activity                   = new AllActivityLog();
                $activity['module']         = 'Rotas';
                $activity['sub_module']     = 'Rota';
                $activity['description']    = __('Day Off Added by the ') . Auth::user()->name . '.';
                $activity['url']            = '';
                $activity['workspace']      = $profile->workspace;
                $activity['created_by']     = $profile->created_by;
                $activity->save();
            }
        }
    }
}
