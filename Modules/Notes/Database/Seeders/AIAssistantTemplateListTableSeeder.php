<?php

namespace Modules\Notes\Database\Seeders;

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
                'template_name'=>'title',
                'template_module'=>'note',
                'prompt'=> "provide personal notes description for following title,related to ##title##",
                'field_json'=>'{"field":[{"label":"Note Title","placeholder":"e.g. ","field_type":"text_box","field_name":"title"}]}',
                'is_tone'=> 0,
            ],
            [
                'template_name'=>'text',
                'template_module'=>'note',
                'prompt'=> "provide personal notes name for following description,related to ##description##",
                'field_json'=>'{"field":[{"label":"Description","placeholder":"e.g.  ","field_type":"textarea","field_name":"description"}]}',
                'is_tone'=> 0,
            ],
        ];

        foreach($defaultTemplate as $temp)
        {
            $check = AssistantTemplate::where('template_module',$temp['template_module'])->where('module','Notes')->where('template_name',$temp['template_name'])->exists();
            if(!$check)
            {
                AssistantTemplate::create(
                    [
                        'template_name' => $temp['template_name'],
                        'template_module' => $temp['template_module'],
                        'module' => 'Notes',
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
