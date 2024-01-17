<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class UpdateWarehouseLis
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
            $warehouse = $event->request;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'POS';
            $activity['sub_module']     = 'Warehouse';
            $activity['description']    = __('Warehouse Updated by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $warehouse->workspace;
            $activity['created_by']     = $warehouse->created_by;
            $activity->save();
        }
    }
}
