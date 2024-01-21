<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class CreateZoommeetingLis
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
            $new = $event->new;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Zoom Meeting';
            $activity['sub_module']     = '--';
            $activity['description']    = __('New Meeting created by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $new->workspace_id;
            $activity['created_by']     = $new->created_by;
            $activity->save();
        }
    }
}