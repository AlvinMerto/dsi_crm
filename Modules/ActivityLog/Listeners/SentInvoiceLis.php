<?php

namespace Modules\ActivityLog\Listeners;

use App\Models\Invoice;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class SentInvoiceLis
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
        $invoice = $event->invoice;
        $user = User::find($invoice->user_id);

        $activity                   = new AllActivityLog();
        $activity['module']         = 'Invoice';
        $activity['sub_module']     = '--';
        $activity['description']    = __('Invoice ') . Invoice::invoiceNumberFormat($invoice->invoice_id) . __(' Send to ') . $user->name . __(' by the ') . Auth::user()->name . '.';
        $activity['url']            = '';
        $activity['workspace']      = $invoice->workspace;
        $activity['created_by']     = $invoice->created_by;
        $activity->save();
        }
    }
}
