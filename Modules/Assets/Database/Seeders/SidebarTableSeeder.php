<?php

namespace Modules\Assets\Database\Seeders;

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

        $check = Sidebar::where('title',__('Assets'))->where('type','company')->exists();
        if(!$check){
            Sidebar::create( [
                'title' => __('Assets'),
                'icon' => 'ti ti-calculator',
                'parent_id' => 0,
                'sort_order' => 420,
                'route' => 'asset.index',
                'permissions' => 'assets manage',
                'type'   => 'company',
                'module' => 'Assets',
            ]);
        }
    }
}
