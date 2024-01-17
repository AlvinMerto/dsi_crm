<?php

namespace Modules\ActivityLog\Listeners;

use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;
use Modules\Contract\Entities\Contract;

class SendMailContractLis
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
            $contract = $event->contract;
            $user = User::find($contract->user_id);

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Contract';
            $activity['sub_module']     = 'Contract';
            $activity['description']    = __('Contract ') . Contract::contractNumberFormat($contract->id) . __(' Send to ') . $user->name . __(' by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $contract->workspace;
            $activity['created_by']     = $contract->created_by;
            $activity->save();
        }
    }
}
