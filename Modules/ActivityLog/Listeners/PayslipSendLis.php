<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;
use Modules\Hrm\Entities\Employee;

class PayslipSendLis
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
            $payslip = $event->payslip;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'HRM';
            $activity['sub_module']     = 'Payroll';
            $activity['description']    = __('Payslip Send to employee ') . Employee::employeeIdFormat($payslip->employee_id) . __(' by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $payslip->workspace;
            $activity['created_by']     = $payslip->created_by;
            $activity->save();
        }
    }
}
