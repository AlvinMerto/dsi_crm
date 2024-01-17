<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Modules\Account\Entities\Bill;
use Modules\ActivityLog\Entities\AllActivityLog;

class ResentBillLis
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
            $user = User::find($bill->user_id);

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Accounting';
            $activity['sub_module']     = 'Expense';
            $activity['description']    = __('Bill ') . Bill::billNumberFormat($bill->bill_id) . __(' Resend to ') . $user->name . __(' by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $bill->workspace;
            $activity['created_by']     = $bill->created_by;
            $activity->save();
        }
    }
}
