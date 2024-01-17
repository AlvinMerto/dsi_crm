<?php

namespace Modules\ActivityLog\Database\Seeders;

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
        $check = Sidebar::where('title','Activity Log')->where('parent_id', 0)->where('type', 'company')->exists();
        if (!$check)
        {
            Sidebar::create([
                'title' => __('Activity Log'),
                'icon' => 'ti ti-activity',
                'parent_id' => 0,
                'sort_order' => 480,
                'route' => 'activitylog.index',
                'module' => 'ActivityLog',
                'type' => 'company',
                'permissions' => 'activitylog manage',
            ]);
        }
    }
}
