<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class CreateAssetsLis
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
            $assets = $event->assets;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Assets';
            $activity['sub_module']     = '--';
            $activity['description']    = __('New Asset created by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $assets->workspace_id;
            $activity['created_by']     = $assets->created_by;
            $activity->save();
        }
    }
}
