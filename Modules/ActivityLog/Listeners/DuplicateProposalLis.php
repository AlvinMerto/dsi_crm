<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class DuplicateProposalLis
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
            $duplicateProposal = $event->duplicateProposal;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Proposal';
            $activity['sub_module']     = '--';
            $activity['description']    = __('Duplicate Proposal Created by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $duplicateProposal->workspace;
            $activity['created_by']     = $duplicateProposal->created_by;
            $activity->save();
        }
    }
}
