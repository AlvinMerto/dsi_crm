<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class CreateProjectLis
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
        if(module_is_active('ActivityLog'))
        {
        $project = $event->project;

        $activity                   = new AllActivityLog();
        $activity['module']         = 'Projects';
        $activity['sub_module']     = 'Project';
        $activity['description']    = __('New Project created by the ') . Auth::user()->name . '.';
        $activity['url']            = '';
        $activity['workspace']      = $project->workspace;
        $activity['account_id']      = isset($project->account_id)?$project->account_id:0;
        $activity['contact_id']      = isset($project->contact_id)?$project->contact_id:0;
        $activity['created_by']     = $project->created_by;
        $activity->save();
        }
    }
}
