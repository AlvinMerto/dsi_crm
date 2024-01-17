<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class CreateRatingLis
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
            $rating = $event->rating;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Feedback';
            $activity['sub_module']     = 'Template';
            $activity['description']    = __('New Rating created.');
            $activity['url']            = '';
            $activity['workspace']      = $rating->workspace;
            $activity['created_by']     = $rating->created_by;
            $activity->save();
        }
    }
}
