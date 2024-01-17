<?php

namespace Modules\ActivityLog\Listeners;

use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class UpdateWorkScheduleLis
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
            $employees = $event->employees;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Rotas';
            $activity['sub_module']     = 'Work Schedule';
            $activity['description']    = __('Work Schedule Updated of ') . $employees->name . __(' by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $employees->workspace;
            $activity['created_by']     = $employees->created_by;
            $activity->save();
        }
    }
}
