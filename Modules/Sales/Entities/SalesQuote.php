<?php

namespace Modules\Sales\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Modules\Sales\Entities\SalesAccount;
use Modules\Sales\Entities\Contact;

class SalesQuote extends Model
{
    use HasFactory;

    protected $table='sales_quotes';

    protected $fillable = [
        'quote_id',
        'customer_id',
        'contact_person',
        'issue_date',
        'quote_validity',
        'quote_status',
        'converted_salesorder_id',
        'workspsace',
        'created_by'
    ];

    public static function quoteNumberFormat($number,$company_id = null,$workspace = null)
    {
        if(!empty($company_id) && empty($workspace)){
            $data = !empty(company_setting('quote_prefix',$company_id)) ? company_setting('quote_prefix',$company_id) : '#QUO';
        }elseif(!empty($company_id) && !empty($workspace)){
            $data = !empty(company_setting('quote_prefix',$company_id,$workspace)) ? company_setting('quote_prefix',$company_id,$workspace) : '#QUO';
        }else{
            $data = !empty(company_setting('quote_prefix')) ? company_setting('quote_prefix') : '#QUO';
        }
        return $data. sprintf("%05d", $number);
    }
    
    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\SalesQuoteFactory::new();
    }

    // public function customer()
    // {
    //     return $this->hasOne(User::class, 'id', 'customer_id');
    // }

    public function customer() {
        return $this->hasOne(SalesAccount::class,"id","customer_id");
    }

    public function contactperson()
    {
        return $this->hasOne(Contact::class,"id","contact_person");
        // return $this->hasOne(User::class, 'id', 'contact_person');
    }

    public static function cont_person($quote_id) {
        // sales_quotes
        // return SalesQuote::join("contacts","account","=","contact_person")
        //                  ->where("sales_quotes.quote_id",$quote_id)
        //                  ->get();
    }

    public function items()
    {
//        $data=Salesquote::join('sales_quotes_items','sales_quotes_items.quote_id','sales_quotes.id')
//            ->where('sales_quotes_items.quote_id',4)
//            ->get();
//    dd($data,$this);
        return $this->hasMany(SalesQuoteItem::class, 'quote_id', 'id');
    }

    public function totalcost()
    {
        $totalcost = 0;
        foreach ($this->items as $product) {

            if($product->type=="substart")
            {
                $totalcost= $totalcost + $product->totalmaincost;
            }
        }
        return $totalcost;
    }

    public function costallsum()
    {
        $totalcost = 0;
        foreach ($this->items as $product) {

            if($product->type=="substart")
            {
                $totalcost= $totalcost + $product->purchase_price;
            }
        }
        return $totalcost;
    }

    public function totalProfit()
    {
        $totalprofit = 0;

        foreach ($this->items as $product) {

            if($product->type=="substart")
            {
                $totalprofit= $totalprofit + $product->profit;
            }
        }
        return $totalprofit;
    }

    public function totalprice()
    {
        $totalprice = 0;

        foreach ($this->items as $product) {

            if($product->type=="substart")
            {
                $totalprice= $totalprice + $product->price;
            }
        }
        return $totalprice;
    }

    public function totalgp()
    {
       $totalgp=($this->totalprice() - $this->costallsum())/ $this->totalprice()*100;
       return number_format($totalgp, 2);;
    }

    public static function totalTaxRate($taxes)
    {
        if(module_is_active('ProductService'))
        {
            $taxArr  = explode(',', $taxes);
            $taxRate = 0;
            foreach($taxArr as $tax)
            {
                $tax     = \Modules\ProductService\Entities\Tax::find($tax);
                $taxRate += !empty($tax->rate) ? $tax->rate : 0;
            }
            return $taxRate;
        }
        else
        {
            return 0;
        }
    }


    public function getTotalTax()
    {
        $totalTax = 0;
        $taxes    = 0;
        foreach ($this->items as $product)
        {
            if(module_is_active('ProductService'))
            {
                $taxes = $this->totalTaxRate($product->tax);
            }
            else
            {
                $taxes = 0;
            }
            $totalTax += ($taxes / 100) * (($product->price * $product->quantity) - $product->discount);
        }
        // return 1;
         return $totalTax;
    }

    public function totalextend()
    {
        $totalextend = 0;
        foreach ($this->items as $product) {

            if($product->type=="substart")
            {
                $totalextend= $totalextend + $product->extended;
            }
        }
        return $totalextend;
    }

    public function grandtotal()
    {
        $total = $this->totalextend() + $this->getTotalTax();

        return $total;
    }

    public function shipping_cost()
    {
        $dataitem=0;
        foreach ($this->items as $product) {

            if($product->type=="substart")
            {
                $quantity = $product->subtotal_quantity;
            }
            if($product->item == "shipping" || $product->item == "Shipping")
            {
                $dataitem += $product->purchase_price*$quantity;
            }
        }
        return $dataitem;
    }

    public function labor_cost()
    {
        $dataitem=0;
        foreach ($this->items as $product) {

            if($product->type=="substart")
            {
                $quantity = $product->subtotal_quantity;
            }
            if($product->item == "labor" || $product->item == "Labor")
            {
                $dataitem += $product->purchase_price*$quantity;
            }
        }
        return $dataitem;
    }


    public static function salesquotesetting()
    {
        $data = DB::table('sales_quotes_setting');
        $data->where('created_by', '=', creatorId())->where('workspace',getActiveWorkSpace());
        $data = $data->get();


        $settings = [
            "supplier_part_number" => "off",
            "manufacturer_part_number"=> "off",
            "subtotal"=> "off",
            "text_within_groups" => "off",
            "labor_total"=> "off",
            "shipping_total"=> "off",
            "grand_total"=> "off",

        ];
        foreach($data as $row)
        {
            $settings[$row->key] = $row->value;
        }

        return $settings;
    }

}
