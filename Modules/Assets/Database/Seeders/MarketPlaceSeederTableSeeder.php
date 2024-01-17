<?php

namespace Modules\Assets\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\LandingPage\Entities\MarketplacePageSetting;

class MarketPlaceSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $data['product_main_banner'] = '';
        $data['product_main_status'] = 'on';
        $data['product_main_heading'] = 'Assets';
        $data['product_main_description'] = '<p>Assets Management for Perfex CRM, is a module that provides the ability of managing company’s assets inside Perfex’s dashboard. You will be able to separate your assets based on groups/locations/units and assign them to staff members. Check the next section of this description, for a complete list with functionality actions.</p>';
        $data['product_main_demo_link'] = '#';
        $data['product_main_demo_button_text'] = 'View Live Demo';
        $data['dedicated_theme_heading'] = 'Assetes Management';
        $data['dedicated_theme_description'] = '<p>The Fixed Assets module enables accurate management and tracking of an organization`s capital assets.</p>';
        $data['dedicated_theme_sections'] = '[{"dedicated_theme_section_image":"","dedicated_theme_section_heading":"What are the benefits of using Assets?","dedicated_theme_section_description":"<p>First, let’s talk a little about the difference between asset management and asset tracking. The short version is that management refers to the holistic process of overseeing high-value assets - like equipment, tools or even people. This process should include a written plan, along with organizational accountability measures.<\/p>","dedicated_theme_section_cards":{"1":{"title":null,"description":null},"2":{"title":"null","description":null},"3":{"title":null,"description":null}}},{"dedicated_theme_section_image":"","dedicated_theme_section_heading":"What Is an Asset?","dedicated_theme_section_description":" <p>An asset is a resource with economic value that an individual, corporation, or country owns or controls with the expectation that it will provide a future benefit. Assets are reported on a company`s balance sheet. They`re classified as current, fixed, financial, and intangible. They are bought or created to increase a firm`s value or benefit the firm`s operations.<\/p>","dedicated_theme_section_cards":{"1":{"title":null,"description":null},"2":{"title":null,"description":null},"3":{"title":null,"description":null}}}]';
        $data['dedicated_theme_sections_heading'] = '';
        $data['screenshots'] = '[{"screenshots":"","screenshots_heading":"Assets"},{"screenshots":"","screenshots_heading":"Assets"},{"screenshots":"","screenshots_heading":"Assets"},{"screenshots":"","screenshots_heading":"Assets"},{"screenshots":"","screenshots_heading":"Assets"}]';
        $data['addon_heading'] = 'Why choose dedicated modulesfor Your Business?';
        $data['addon_description'] = '<p>With Dash, you can conveniently manage all your business functions from a single location.</p>';
        $data['addon_section_status'] = 'on';
        $data['whychoose_heading'] = 'Why choose dedicated modulesfor Your Business?';
        $data['whychoose_description'] = '<p>With Dash, you can conveniently manage all your business functions from a single location.</p>';
        $data['pricing_plan_heading'] = 'Empower Your Workforce with DASH';
        $data['pricing_plan_description'] = '<p>Access over Premium Add-ons for Accounting, HR, Payments, Leads, Communication, Management, and more, all in one place!</p>';
        $data['pricing_plan_demo_link'] = '#';
        $data['pricing_plan_demo_button_text'] = 'View Live Demo';
        $data['pricing_plan_text'] = '{"1":{"title":"Pay-as-you-go"},"2":{"title":"Unlimited installation"},"3":{"title":"Secure cloud storage"}}';
        $data['whychoose_sections_status'] = 'on';
        $data['dedicated_theme_section_status'] = 'on';

        foreach($data as $key => $value){
            if(!MarketplacePageSetting::where('name', '=', $key)->where('module', '=', 'assets')->exists()){
                MarketplacePageSetting::updateOrCreate(
                [
                    'name' => $key,
                    'module' => 'assets'

                ],
                [
                    'value' => $value
                ]);
            }
        }
    }
}
