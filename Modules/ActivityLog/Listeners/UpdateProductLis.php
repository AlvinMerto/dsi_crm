<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class UpdateProductLis
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
            $productService = $event->request;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Product & Service';
            $activity['sub_module']     = $productService->type;
            $activity['description']    = $productService->type . __(' Updated by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $productService->workspace_id;
            $activity['created_by']     = $productService->created_by;
            $activity->save();
        }
    }
}
