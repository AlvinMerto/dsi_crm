<?php

namespace Modules\CustomField\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomField extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'module',
        'created_by',
        'workspace_id',
    ];
    public static $fieldTypes = [
        'text' => 'Text',
        'email' => 'Email',
        'number' => 'Number',
        'date' => 'Date',
        'textarea' => 'Textarea',
    ];
    public static function saveData($obj, $data)
    {

        if($data)
        {
            $RecordId = $obj->id;
            foreach($data as $fieldId => $value)
            {
                if($value != null){
                    \DB::insert('insert into custom_field_values (`record_id`, `field_id`,`value`,`created_at`,`updated_at`) values (?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`),`updated_at` = VALUES(`updated_at`) ',
                        [
                            $RecordId,$fieldId,$value,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')
                        ]
                    );
                }
            }
        }
    }
    public static function getData($obj, $module,$sub_module)
    {

        return \DB::table('custom_field_values')->select(
            [
                'custom_field_values.value',
                'custom_fields.id',
            ]
        )->join('custom_fields', 'custom_field_values.field_id', '=', 'custom_fields.id')->where('custom_fields.module', '=', $module)->where('custom_fields.sub_module', '=', $sub_module)->where('record_id', '=', $obj->id)->get()->pluck('value', 'id');
    }
    protected static function newFactory()
    {
        return \Modules\CustomField\Database\factories\CustomFieldFactory::new();
    }
}