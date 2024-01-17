<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class itemextensionflds extends Model
{
    use HasFactory;

    protected $fillable = [
        "itemid",
        "product_services_id",
        "shippingfee",
        "endoflife",
        "markupstatus"
    ];
    
    protected $table = "sales_quotes_item_info_more_flds";
    
    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\ItemextensionfldsFactory::new();
    }
}
