<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesQuoteItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote_id',
        'itemorder',
        'type',
        'profit',
        'totalmaincost',
        'markup',
        'purchase_price',
        'item',
        'quantity',
        'price',
        'extended',
        'tax',
        'itemtaxprice',
        'itemtaxrate',
        'amount',
        'subtotal_description',
        'subtotal_quantity',
        'sample_comment',
        'supplier_name',
        'supplier_part_number',
        'manufacturer_name',
        'manufacturer_part_number',
        'created_by',
    ];

    protected $table='sales_quotes_items';
    
    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\SalesQuoteItemFactory::new();
    }

    public function taxes()
    {
        return $this->hasOne('Modules\ProductService\Entities\Tax', 'id', 'tax')->first();
    }

}
