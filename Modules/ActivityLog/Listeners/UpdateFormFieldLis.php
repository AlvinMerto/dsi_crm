<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class UpdateFormFieldLis
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
            $formField = $event->form;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'CRM';
            $activity['sub_module']     = 'Form Builder';
            $activity['description']    = __('Form Field Updated in Form ') . $formField->name . __(' by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $formField->workspace;
            $activity['created_by']     = $formField->created_by;
            $activity->save();
        }
    }
}
