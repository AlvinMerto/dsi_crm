<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;
use Modules\Hrm\Entities\Employee;

class UpdateAllowanceLis
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
            $allowance = $event->allowance;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'HRM';
            $activity['sub_module']     = 'Payroll';
            $activity['description']    = __('Allowance Updated of employee ') . Employee::employeeIdFormat($allowance->employee_id) . __(' by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $allowance->workspace;
            $activity['created_by']     = $allowance->created_by;
            $activity->save();
        }
    }
}