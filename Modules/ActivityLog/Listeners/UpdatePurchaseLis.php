<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;
use Modules\Pos\Entities\Purchase;

class UpdatePurchaseLis
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
            $purchase = $event->request;
            // $purchase = $event->request;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'POS';
            $activity['sub_module']     = 'Purchase';
            $activity['description']    = __('Purchase ') . Purchase::purchaseNumberFormat($purchase->purchase_id) . __(' Updated by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $purchase->workspace;
            $activity['created_by']     = $purchase->created_by;
            $activity->save();
        }
    }
}
