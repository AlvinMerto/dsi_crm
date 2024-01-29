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
        'inside_sub_order',
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

    public function create_grp() {

    }

    public function create_order_number($qid) {
        $max = SalesQuoteItem::where("quote_id", $qid)->max("itemorder");
        return $max+1;
    }

    public function create_inner_number($grppid) {
        $max = SalesQuoteItem::where(["grp_id"=>$grppid])->max("inside_sub_order");
        return $max+1;
    }

    public function get_the_current_itemorder($itemid) {
        return SalesQuoteItem::where("id",$itemid)->get("itemorder")[0]->itemorder;
    }

    public function re_order_itemorders($quote_id, $grpid) {
        
    }

    public function taxes()
    {
        return $this->hasOne('Modules\ProductService\Entities\Tax', 'id', 'tax')->first();
    }

}
