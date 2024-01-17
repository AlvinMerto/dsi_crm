<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;
use Modules\Sales\Entities\SalesOrder;

class UpdateSalesOrderLis
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
            $salesOrder = $event->salesOrder;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Sales';
            $activity['sub_module']     = 'Sales Order';
            $activity['description']    = __('Sales Order ') . SalesOrder::salesorderNumberFormat($salesOrder->salesorder_id) . __(' Updated by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $salesOrder->workspace;
            $activity['account_id']      = isset($salesOrder->account)?$salesOrder->account:0;
            $activity['contact_id']      = isset($salesOrder->shipping_contact)?$salesOrder->shipping_contact:0;
            $activity['opportunity_id']      = isset($salesOrder->opportunity)?$salesOrder->opportunity:0;
            $activity['created_by']     = $salesOrder->created_by;
            $activity->save();
        }
    }
}
