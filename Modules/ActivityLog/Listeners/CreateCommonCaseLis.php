<?php

namespace Modules\ActivityLog\Listeners;

use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class CreateCommonCaseLis
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
            $commoncase = $event->commoncase;
            $user = User::find($commoncase->user_id);
            
            $activity                   = new AllActivityLog();
            $activity['module']         = 'Sales';
            $activity['sub_module']     = 'Cases';
            if(isset($user->name))
            {
                $activity['description']    = __('New Case Created for ') . $user->name . __(' by the ') . Auth::user()->name . '.';
            }
            else
            {
                $activity['description']    = __('New Case Created  by the ') . Auth::user()->name . '.';
            }
            $activity['url']            = '';
            $activity['workspace']      = $commoncase->workspace;
            $activity['created_by']     = $commoncase->created_by;
            $activity->save();
        }
    }
}
