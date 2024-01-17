<?php

namespace Modules\ActivityLog\Listeners;

use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class UpdateOpportunitiesLis
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
            $opportunities = $event->opportunities;
            $user = User::find($opportunities->user_id);

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Sales';
            $activity['sub_module']     = 'Opportunities';
            if(isset($user->name))
            {
                $activity['description']    = __('New Opportunity Updated for ') . $user->name . __(' by the ') . Auth::user()->name . '.';
            }
            else
            {
                $activity['description']    = __('New Opportunity Updated by the ') . Auth::user()->name . '.';
            }
            $activity['url']            = '';
            $activity['workspace']      = $opportunities->workspace;
            $activity['account_id']      = isset($opportunities->account)?$opportunities->account:0;
            $activity['contact_id']      = isset($opportunities->contact)?$opportunities->contact:0;
            $activity['created_by']     = $opportunities->created_by;
            $activity->save();
        }
    }
}
