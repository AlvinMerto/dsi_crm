<?php

namespace Modules\ActivityLog\Listeners;

use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class CreateContactLis
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
            $contact = $event->contact;
            $user = User::find($contact->user_id);

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Sales';
            $activity['sub_module']     = 'Contact';
            $activity['description']    = __('New Contact Created by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $contact->workspace;
            $activity['account_id']      = isset($contact->account)?$contact->account:0;
            $activity['contact_id']      = isset($contact->id)?$contact->id:0;
            $activity['created_by']     = $contact->created_by;
            $activity->save();
        }
    }
}
