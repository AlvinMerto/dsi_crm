<?php

namespace Modules\ActivityLog\Listeners;

use App\Models\Proposal;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class ResentProposalLis
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
            $proposal = $event->proposal;
            $user = User::find($proposal->customer_id);

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Proposal';
            $activity['sub_module']     = '--';
            $activity['description']    = __('Proposal ') . Proposal::proposalNumberFormat($proposal->proposal_id) . __(' Resend to ') . $user->name . __(' by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $proposal->workspace;
            $activity['created_by']     = $proposal->created_by;
            $activity->save();
        }
    }
}