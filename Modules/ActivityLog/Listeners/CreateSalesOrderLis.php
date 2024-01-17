<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;
use Modules\Sales\Entities\SalesOrder;

class CreateSalesOrderLis
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
            $salesorder = $event->salesorder;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Sales';
            $activity['sub_module']     = 'Sales Order';
            $activity['description']    = __('New Sales Order ') . SalesOrder::salesorderNumberFormat($salesorder->salesorder_id) . __(' created by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $salesorder->workspace;
            $activity['account_id']      = isset($salesorder->account)?$salesorder->account:0;
            $activity['contact_id']      = isset($salesorder->shipping_contact)?$salesorder->shipping_contact:0;
            $activity['opportunity_id']      = isset($salesorder->opportunity)?$salesorder->opportunity:0;
            $activity['created_by']     = $salesorder->created_by;
            $activity->save();
        }
    }
}
