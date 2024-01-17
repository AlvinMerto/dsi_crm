<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class CreateTicketLis
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
            $ticket = $event->ticket;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Support Ticket';
            $activity['sub_module']     = 'Tickets';
            $activity['description']    = __('New Ticket ') . $ticket->ticket_id . __(' created by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $ticket->workspace_id;
            $activity['account_id']      = isset($ticket->account_id)?$ticket->account_id:0;
            $activity['contact_id']      = isset($ticket->contact_id)?$ticket->contact_id:0;
            $activity['created_by']     = $ticket->created_by;
            $activity->save();
        }
    }
}
