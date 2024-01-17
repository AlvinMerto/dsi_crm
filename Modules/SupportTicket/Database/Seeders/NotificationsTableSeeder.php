<?php

namespace Modules\SupportTicket\Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *

     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

          // slack notification
         $notifications = [
            'New Ticket','New Ticket Reply'
        ];
        $types = [
            'slack','telegram','whatsapp'
        ];
        foreach($types as $t){
            foreach($notifications as $n){
                $ntfy = Notification::where('action',$n)->where('type',$t)->where('module','SupportTicket')->count();
                if($ntfy == 0){
                    $new = new Notification();
                    $new->action = $n;
                    $new->status = 'on';
                    $new->module = 'SupportTicket';
                    $new->type = $t;
                    $new->save();
                }
            }
        }

         // email notification

            $notifications = [
                'New Ticket','New Ticket Reply'
            ];
            $permissions = [
                'ticket create',
                'ticket reply',
            ];
                foreach($notifications as $key=>$n){
                    $ntfy = Notification::where('action',$n)->where('type','mail')->where('module','SupportTicket')->count();
                    if($ntfy == 0){
                        $new = new Notification();
                        $new->action = $n;
                        $new->status = 'on';
                        $new->permissions = $permissions[$key];
                        $new->module = 'SupportTicket';
                        $new->type = 'mail';
                        $new->save();
                    }
                }
        // $this->call("OthersTableSeeder");
    }
}
