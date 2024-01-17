<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesQuoteSetting extends Model
{
    use HasFactory;

    protected $table = 'sales_quotes_setting';

    protected $fillable = [
        'id',
        'key',
        'value',
        'workspace',
        'created_by'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\SalesQuoteSettingFactory::new();
    }

    public static function salesquotesetting()
    {

        $data = \DB::table('sales_quotes_setting');

            $data = $data->where('workspace', '=', getActiveWorkSpace())->get();

        $settings = [
            'supplier_part_number'=>"off",
            'manufacturer_part_number'=>"off",
            'subtotal'=>"off",
            'labor_total'=>"off",
            'shipping_total'=>"off",
            'grand_total'=>"off",
        ];

        foreach ($data as $row) {
            $settings[$row->name] = $row->value;
        }

        return $settings;
    }
}
