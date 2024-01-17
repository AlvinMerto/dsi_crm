<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class CreateNotesLis
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
            $note = $event->note;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Notes';
            $activity['sub_module']     = '--';
            $activity['description']    = __('New Note created by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $note->workspace_id;
            $activity['account_id']      = isset($note->account_id)?$note->account_id:0;
            $activity['contact_id']      = isset($note->contact_id)?$note->contact_id:0;
            $activity['opportunity_id']      = isset($note->opportunity_id)?$note->opportunity_id:0;
            $activity['created_by']     = $note->created_by;
            $activity->save();
        }
    }
}
