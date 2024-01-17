<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class ImageGeneratLis
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
            $aiImage = $event->request;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Ai';
            $activity['sub_module']     = 'AI Image';
            $activity['description']    = __('New Ai Image created by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $aiImage->workspace_id;
            $activity['created_by']     = $aiImage->created_by;
            $activity->save();
        }
    }
}
