<?php

namespace Modules\Assets\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\AIAssistant\Entities\AssistantTemplate;

class AIAssistantTemplateListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $defaultTemplate = [
            [
                'template_name'=>'description',
                'template_module'=>'asset',
                'prompt'=> "Generate a descriptive response for a given ##title##. The response should be detailed, engaging, and informative, providing relevant information and capturing the reader's interest",
                'field_json'=>'{"field":[{"label":"Asset name","placeholder":"","field_type":"text_box","field_name":"title"}]}',
                'is_tone'=> 0,
            ],
        ];

        foreach($defaultTemplate as $temp)
        {
            $check = AssistantTemplate::where('template_module',$temp['template_module'])->where('module','Assets')->where('template_name',$temp['template_name'])->exists();
            if(!$check)
            {
                AssistantTemplate::create(
                    [
                        'template_name' => $temp['template_name'],
                        'template_module' => $temp['template_module'],
                        'module' => 'Assets',
                        'prompt' => $temp['prompt'],
                        'field_json' => $temp['field_json'],
                        'is_tone' => $temp['is_tone'],
                        "created_at" => date('Y-m-d H:i:s'),
                        "updated_at" => date('Y-m-d H:i:s')
                    ]
                );
            }
        }
        // $this->call("OthersTableSeeder");
    }
}
