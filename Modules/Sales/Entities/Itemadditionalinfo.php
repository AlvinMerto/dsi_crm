<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class itemadditionalinfo extends Model
{
    use HasFactory;

    protected $fillable = [
        "item_id",
        "title",
        "label",
        "description"
    ];
    
    protected $table    = "sales_quotes_item_add_info";
    
    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\ItemadditionalinfoFactory::new();
    }
}
