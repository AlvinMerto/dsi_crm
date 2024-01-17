<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class SendRotasViaEmailLis
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
            $rotas_data = $event->rotas_data;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Rotas';
            $activity['sub_module']     = 'Rota';
            $activity['description']    = __('Rota Send by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $rotas_data[0]['workspace'];
            $activity['created_by']     = $rotas_data[0]['create_by'];
            $activity->save();
        }
    }
}
