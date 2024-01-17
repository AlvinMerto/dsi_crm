<?php

namespace Modules\ActivityLog\Listeners;

use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class UpdateCommonCaseLis
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
            $commonCase = $event->commonCase;
            $user = User::find($commonCase->user_id);
            
            $activity                   = new AllActivityLog();
            $activity['module']         = 'Sales';
            $activity['sub_module']     = 'Cases';
            if(isset($user->name))
            {
                $activity['description']    = __('Case Updated for ') . $user->name . __(' by the ') . Auth::user()->name . '.';
            }
            else
            {
                $activity['description']    = __('Case Updated  by the ') . Auth::user()->name . '.';
            }
            $activity['url']            = '';
            $activity['workspace']      = $commonCase->workspace;
            $activity['created_by']     = $commonCase->created_by;
            $activity->save();
        }
    }
}
