<?php

namespace Modules\SupportTicket\Database\Seeders;

use App\Models\Sidebar;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SidebarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $dashboard = Sidebar::where('title',__('Dashboard'))->where('parent_id',0)->where('type','company')->first();
        $check = Sidebar::where('title',__('Support Dashboard'))->where('parent_id',$dashboard->id)->where('type','company')->exists();
        if(!$check)
        {
            $check = Sidebar::create( [
                'title' => 'Support Dashboard',
                'icon' => '',
                'parent_id' => $dashboard->id,
                'sort_order' => 90,
                'route' => 'dashboard.support-tickets',
                'permissions' => 'supportticket dashboard manage',
                'type'   => 'company',
                'module' => 'SupportTicket',
            ]);
        }

        $sidebar = Sidebar::where('title',__('Support Ticket'))->where('parent_id',0)->where('type','company')->first();
        if($sidebar == null){
            $sidebar = Sidebar::create( [
                'title' =>__('Support Ticket'),
                'icon' => 'ti ti-headphones',
                'parent_id' => 0,
                'sort_order' => 390,
                'route' => '',
                'type'   => 'company',
                'module' => 'SupportTicket',
                'permissions'=>'supportticket manage'
            ]);
        }
        $tickets = Sidebar::where('title',__('Tickets'))->where('parent_id',$sidebar->id)->where('type','company')->first();
        if($tickets == null){
            Sidebar::create( [
                'title' =>__('Tickets'),
                'icon' => '',
                'parent_id' => $sidebar->id,
                'sort_order' => 10,
                'route' => 'support-tickets.index',
                'type'   => 'company',
                'module' => 'SupportTicket',
                'permissions'=>'ticket manage'
            ]);
        }

        $knowledge_base = Sidebar::where('title',__('Knowledge Base'))->where('parent_id',$sidebar->id)->first();
        if($knowledge_base == null){
            Sidebar::create( [
                'title' =>__('Knowledge Base'),
                'icon' => '',
                'parent_id' => $sidebar->id,
                'sort_order' => 15,
                'route' => 'support-ticket-knowledge.index',
                'type'   => 'company',
                'module' => 'SupportTicket',
                'permissions'=>'knowledgebase manage'
            ]);
        }

        $faq = Sidebar::where('title',__('FAQ'))->where('parent_id',$sidebar->id)->where('type','company')->first();
        if($faq == null){
            Sidebar::create( [
                'title' =>__('FAQ'),
                'icon' => '',
                'parent_id' => $sidebar->id,
                'sort_order' => 20,
                'route' => 'support-ticket-faq.index',
                'type'   => 'company',
                'module' => 'SupportTicket',
                'permissions'=>'faq manage'
            ]);
        }

        $systemsetup = Sidebar::where('title',__('System Setup'))->where('parent_id',$sidebar->id)->where('type','company')->first();
        if($systemsetup == null){
            $systemsetup = Sidebar::create( [
                'title' =>'System Setup',
                'icon' => '',
                'parent_id' => $sidebar->id,
                'sort_order' => 40,
                'route' => 'ticket-category.index',
                'type'   => 'company',
                'module' => 'SupportTicket',
                'permissions'=>'supportticket setup manage'
            ]);
        }
    }
}
