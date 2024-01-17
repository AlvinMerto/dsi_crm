<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;
use Modules\Sales\Entities\SalesInvoice;

class UpdateSalesInvoiceLis
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
            $invoice = $event->invoice;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Sales';
            $activity['sub_module']     = 'Sales Invoice';
            $activity['description']    = __('Sales Invoice ') . SalesInvoice::invoiceNumberFormat($invoice->invoice_id) . __(' Updated by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $invoice->workspace;
            $activity['account_id']      = isset($invoice->account)?$invoice->account:0;
            $activity['contact_id']      = isset($invoice->shipping_contact)?$invoice->shipping_contact:0;
            $activity['opportunity_id']      = isset($invoice->opportunity)?$invoice->opportunity:0;
            $activity['created_by']     = $invoice->created_by;
            $activity->save();
        }
    }
}
