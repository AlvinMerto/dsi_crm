<?php

namespace Modules\ActivityLog\Listeners;

use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class CreateSalesDocumentLis
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
            $salesdocument = $event->salesdocument;
            $user = User::find($salesdocument->user_id);

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Sales';
            $activity['sub_module']     = 'Sales Document';
            if(isset($user))
            {
                $activity['description']    = __('New Sales Document Created for ') . $user->name . __(' by the ') . Auth::user()->name . '.';
            }
            else
            {
                $activity['description']    = __('New Sales Document Created by the ') . Auth::user()->name . '.';
            }
            $activity['url']            = '';
            $activity['opportunity_id']      = isset($salesdocument->opportunities)?$salesdocument->opportunities:0;
            $activity['workspace']      = $salesdocument->workspace;
            $activity['created_by']     = $salesdocument->created_by;
            $activity->save();
        }
    }
}
