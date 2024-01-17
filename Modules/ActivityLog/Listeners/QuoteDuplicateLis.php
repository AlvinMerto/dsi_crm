<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class QuoteDuplicateLis
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
            
            $duplicate = $event->duplicate;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Sales';
            $activity['sub_module']     = 'Quote';
            $activity['description']    = __('Duplicate Quote created by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $duplicate->workspace;
            $activity['created_by']     = $duplicate->created_by;
            $activity->save();
        }
    }
}
