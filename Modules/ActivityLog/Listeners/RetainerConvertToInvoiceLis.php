<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class RetainerConvertToInvoiceLis
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
            $convertInvoice = $event->convertInvoice;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Retainer';
            $activity['sub_module']     = '--';
            $activity['description']    = __('Retainer Converted to Invoice by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $convertInvoice->workspace;
            $activity['created_by']     = $convertInvoice->created_by;
            $activity->save();
        }
    }
}
