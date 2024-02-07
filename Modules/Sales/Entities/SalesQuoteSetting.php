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
        'qid',
        'workspace',
        'created_by'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\SalesQuoteSettingFactory::new();
    }

    public function salesquotesetting($qid = false)
    {

        $data = \DB::table('sales_quotes_setting');

        // $data = $data->where('workspace', '=', getActiveWorkSpace())->get();
        $data    = $data->where("qid",$qid)->get();

        $settings = ["profit"        => true,
                     "markup"        => true,
                     "cost"          => true,
                     "supplier"      => true,
                     "supplier_num"  => true,
                     "manu"          => true,
                     "manu_num"      => true,
                     "description"   => true,
                     "qty"           => true,
                     "shipping"      => true,
                     "price"         => true,
                     "extended"      => true,
                     "tax"           => true,
                     "sub"           => true,
                     "subitem"       => true
                ];
            
        if (count($data) > 0) {
            $settings = [];
        }

        foreach ($data as $row) {
            $settings[$row->key] = true;
        }

        return $settings;
    }
}
