<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\Account\Entities\Bill;
use Modules\ActivityLog\Entities\AllActivityLog;

class CreateBillLis
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
            $bill = $event->bill;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Accounting';
            $activity['sub_module']     = 'Expense';
            $activity['description']    = __('New Bill ') . Bill::billNumberFormat($bill->bill_id) . __(' created by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $bill->workspace;
            $activity['created_by']     = $bill->created_by;
            $activity->save();
        }
    }
}
