<?php

namespace Modules\Notes\Database\Seeders;

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
        $check = Sidebar::where('title',__('Notes'))->where('type','company')->exists();
        if(!$check){
            Sidebar::create( [
                'title' => __('Notes'),
                'icon' => 'ti ti-calendar-event',
                'parent_id' => 0,
                'sort_order' => 490,
                'route' => 'notes.index',
                'permissions' => 'note manage',
                'type'   => 'company',
                'module' => 'Notes',
            ]);
        }
    }
}
