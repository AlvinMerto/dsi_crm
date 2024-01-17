<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class UpdateBusinessLis
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
            $business = $event->request;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'vCard';
            $activity['sub_module']     = 'Businesss';
            $activity['description']    = __('Business ') . $business->title . __(' Details Updated by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $business->workspace;
            $activity['created_by']     = $business->created_by;
            $activity->save();
        }
    }
}
