<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;
use Modules\Sales\Entities\Quote;

class UpdateQuoteLis
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
            $quote = $event->quote;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Sales';
            $activity['sub_module']     = 'Quote';
            $activity['description']    = __('Quote ') . Quote::quoteNumberFormat($quote->quote_id) . __(' Updated by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $quote->workspace;
            $activity['account_id']      = isset($quote->account)?$quote->account:0;
            $activity['contact_id']      = isset($quote->shipping_contact)?$quote->shipping_contact:0;
            $activity['opportunity_id']      = isset($quote->opportunity)?$quote->opportunity:0;
            $activity['created_by']     = $quote->created_by;
            $activity->save();
        }
    }
}
