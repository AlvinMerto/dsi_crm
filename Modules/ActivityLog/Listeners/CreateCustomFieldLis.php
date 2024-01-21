<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class CreateCustomFieldLis
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
            $custom_field = $event->custom_field;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Custom Field';
            $activity['sub_module']     = '--';
            $activity['description']    = __('New Custom Field created by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $custom_field->workspace_id;
            $activity['created_by']     = $custom_field->created_by;
            $activity->save();
        }
    }
}