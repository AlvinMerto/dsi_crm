<?php

namespace Modules\ActivityLog\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\ActivityLog\Entities\AllActivityLog;

class CreateRotaLis
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
            $rotas = $event->rotas;

            $activity                   = new AllActivityLog();
            $activity['module']         = 'Rotas';
            $activity['sub_module']     = 'Rota';
            $activity['description']    = __('New Rota created by the ') . Auth::user()->name . '.';
            $activity['url']            = '';
            $activity['workspace']      = $rotas->workspace;
            $activity['created_by']     = $rotas->create_by;
            $activity->save();
        }
    }
}
