<?php

namespace Modules\Sales\Http\Controllers;

use App\Models\EmailTemplate;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Modules\Account\Entities\Customer;
use Modules\ProductService\Entities\Category;
use Modules\ProductService\Entities\ProductService;
use Modules\ProductService\Entities\Tax;
use Modules\ProductService\Entities\Unit;
use Modules\Sales\Entities\Quote;
use Modules\Sales\Entities\QuoteItem;
use Modules\Sales\Entities\SalesOrder;
use Modules\Sales\Entities\SalesOrderItem;
use Modules\Sales\Entities\SalesQuote;
use Modules\Sales\Entities\SalesQuoteItem;
use Modules\Sales\Entities\SalesQuoteSetting;
use Modules\Sales\Entities\SalesUtility;
use Modules\Sales\Entities\Stream;
use Modules\Sales\Entities\SalesAccount;
use Modules\Sales\Entities\Contact;
use Modules\Sales\Events\CreateSalesOrderConvert;

use Modules\Sales\Entities\Itemadditionalinfo as itemadditionalinfo;
use Modules\Sales\Entities\Salessubs as salessubs;
use Modules\Sales\Entities\Itemextensionflds as itemextensionflds;

use DB;

class SalesQuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $salesquotes = null;
        if(\Auth::user()->can('salesquote manage'))
        {
            if(\Auth::user()->type=="client")
            {
                $salesquotes=SalesQuote::where('workspace', '=', getActiveWorkSpace())->where('customer_id',\Auth::user()->id)->orderBy("id","DESC")->get();
            }
            else
            {
                $salesquotes=SalesQuote::where('workspace', '=', getActiveWorkSpace())->orderBy("id","DESC")->get();
            }
            
            return view('sales::salesquote.index',compact('salesquotes'));
        }
        else
        {
            return redirect()->back()->with('error',__('Permission denied'));
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {   
        
        if(\Auth::user()->can('salesquote create'))
        {
            $showsection  = false;
            $quote_number = SalesQuote::quoteNumberFormat($this->quoteNumber());
            $customers    = SalesAccount::get()->pluck("name","id");
            //$customers    = User::where('workspace_id','=',getActiveWorkSpace())->where('type','Client')->get()->pluck('name', 'id');
            // $hey          = SalesAccount::get();

            //var_dump($hey);

            // $customers    = SalesAccount::where('workspace_id','=',getActiveWorkSpace())->get();
            $users        = User::where('workspace_id','=',getActiveWorkSpace())->where('type','staff')->get()->pluck('name', 'id');
            // 2024-01-15
            $issue_date   = date("Y-m-d");

            $date_valid   = null;
            return view('sales::salesquote.create',compact('customers','quote_number','users','showsection','issue_date','date_valid'));
        }
        else
        {
            return redirect()->back()->with('error',__('Permission denied'));
        }
    }

    public static function quoteNumber()
    {
        $latest = SalesQuote::where('created_by', '=', creatorId())->latest()->first();
        if(!$latest)
        {
            return 1;
        }

        return $latest->quote_id + 1;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if($request->invoice_type == "salesquote")
        {
            if(\Auth::user()->can('salesquote create'))
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'customer_id' => 'required',
                                       'contact_person' => 'required',
                                       'issue_date' => 'required',
                                       'quote_validity' => 'required',
                                       'quote' => 'required',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                $salesquote=New SalesQuote();
                $salesquote->quote_id= $this->quoteNumber();
                $salesquote->customer_id=$request->customer_id;
                $salesquote->contact_person=$request->contact_person;
                $salesquote->issue_date=$request->issue_date;
                $salesquote->quote_validity=date('Y-m-d',strtotime($request->quote_validity));
                $salesquote->workspace      = getActiveWorkSpace();
                $salesquote->created_by     = Auth::user()->id;
                $salesquote->save();

                $customer=User::find($salesquote->customer_id);

                $quotes = $request->quote;

                foreach($quotes as $quote)
                {
                    foreach($quote as $data)
                    {
                        $salesquoteproduct                 = new SalesQuoteItem();
                        $salesquoteproduct->quote_id     = $salesquote->id;
                        $salesquoteproduct->type         = $data['type'];
                        $salesquoteproduct->profit       = !empty($data['profit'])?$data['profit']:0;
                        $salesquoteproduct->totalmaincost= !empty($data['totalmaincost'])?$data['totalmaincost']:0;
                        $salesquoteproduct->markup       = !empty($data['markup'])?$data['markup']:0;
                        $salesquoteproduct->purchase_price       = !empty($data['purchase_price'])?$data['purchase_price']:0;
                        $salesquoteproduct->subtotal_description       = !empty($data['subtotal_description'])?$data['subtotal_description']:null;
                        $salesquoteproduct->item       = !empty($data['item'])?$data['item']:null;
                        $salesquoteproduct->quantity       = !empty($data['quantity'])?$data['quantity']:0;
                        $salesquoteproduct->price       = !empty($data['price'])?$data['price']:0;
                        $salesquoteproduct->extended       = !empty($data['extended'])?$data['extended']:0;
                        $salesquoteproduct->tax       = !empty($data['tax'])?$data['tax']:null;
                        $salesquoteproduct->itemTaxPrice       = !empty($data['itemTaxPrice'])?$data['itemTaxPrice']:0;
                        $salesquoteproduct->itemTaxRate       = !empty($data['itemTaxRate'])?$data['itemTaxRate']:0;
                        $salesquoteproduct->amount       = !empty($data['amount'])?$data['amount']:0;
                        $salesquoteproduct->subtotal_quantity       = !empty($data['subtotal_quantity'])?$data['subtotal_quantity']:null;
                        $salesquoteproduct->sample_comment       = !empty($data['sample_comment'])?$data['sample_comment']:null;
                        $salesquoteproduct->supplier_name       = !empty($data['supplier_name'])?$data['supplier_name']:null;
                        $salesquoteproduct->supplier_part_number       = !empty($data['supplier_part_number'])?$data['supplier_part_number']:null;
                        $salesquoteproduct->manufacturer_name       = !empty($data['manufacturer_name'])?$data['manufacturer_name']:null;
                        $salesquoteproduct->manufacturer_part_number       = !empty($data['manufacturer_part_number'])?$data['manufacturer_part_number']:null;
                        $salesquoteproduct->created_by       = Auth::user()->id;
                        $salesquoteproduct->save();
                    }
                }
                $address = (!empty(company_setting('company_name')) ? company_setting('company_name') . "<br>" : "") .
                    (!empty(company_setting('company_address')) ? company_setting('company_address') . "<br>" : "") .
                    (!empty(company_setting('company_city')) ? company_setting('company_city') : "") .
                    (!empty(company_setting('company_state')) ? ", " . company_setting('company_state') : "") . "<br>" .
                    (!empty(company_setting('company_zipcode')) ? company_setting('company_zipcode') . "<br>" : "") .
                    (!empty(company_setting('company_country')) ? company_setting('company_country') . "<br>" : "") .
                    (!empty(company_setting('company_telephone')) ? company_setting('company_telephone') : "");

                if(!empty(company_setting('Salesquote Create')) && company_setting('Salesquote Create')  == true)
                {
                    $uArr = [
                        'customer_name' => $customer->name,
                        'quote_number' => \Modules\Sales\Entities\SalesQuote::quoteNumberFormat($salesquote->quote_id),
                        'salesquote_url' => route('print.salesquote',\Illuminate\Support\Facades\Crypt::encrypt($salesquote->id)),
                        'company_name' => \Auth::user()->name,
                        'company_logo'=> get_file(sidebar_logo()),
                        'company_address' => $address
                    ];
                    try
                    {
                        $resp = EmailTemplate::sendEmailTemplate('Salesquote Create', [$customer->id => $customer->email], $uArr);
                    }
                    catch(\Exception $e)
                    {
                        $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
                    }
                }
                return redirect()->route('salesquote.index')->with('success', __('Sales quote successfully created.'));
            }
            else
            {
                return redirect()->back()->with('error',__('Permission denied'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        try {
            $id       = Crypt::decrypt($id);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('Sales Quote Not Found.'));
        }
        $salesquote=SalesQuote::find($id);
        if($salesquote)
        {
            if($salesquote->workspace == getActiveWorkSpace())
            {
                $salesquoteitems=SalesQuoteItem::where('quote_id',$salesquote->id)->get();
            }
        }
        return view('sales::salesquote.show', compact('salesquote', 'salesquoteitems'));

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        if(\Auth::user()->can('salesquote edit'))
        {
            $id=decrypt($id);
            $salesquote=SalesQuote::where('workspace',getActiveWorkSpace())->where('id',$id)->first();
            $salesquote_number = SalesQuote::quoteNumberFormat($salesquote->quote_id);
            $salesquoteitems=SalesQuoteItem::where('quote_id',$salesquote->id)->get();

            $customers = User::where('workspace_id','=',getActiveWorkSpace())->where('type','Client')->get()->pluck('name', 'id');
            $users = User::where('workspace_id','=',getActiveWorkSpace())->where('type','staff')->get()->pluck('name', 'id');

            return view('sales::salesquote.edit',compact('salesquote','salesquoteitems','customers','users','salesquote_number'));
        }
        else
        {
            return redirect()->back()->with('error',__('Permission denied'));
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {

        if(\Auth::user()->can('salesquote edit'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'customer_id' => 'required',
                                   'contact_person' => 'required',
                                   'issue_date' => 'required',
                                   'quote_validity' => 'required',
                                   'quote' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $salesquote=SalesQuote::find($id);
            $salesquote->quote_id= $salesquote->quote_id;
            $salesquote->customer_id=$request->customer_id;
            $salesquote->contact_person=$request->contact_person;
            $salesquote->issue_date=$request->issue_date;
            $salesquote->quote_validity=date('Y-m-d',strtotime($request->quote_validity));
            $salesquote->save();

            $quotes=$request->quote;
            $quoteitems=SalesQuoteItem::where('quote_id',$salesquote->id)->delete();
            foreach($quotes as $quote)
            {
                foreach($quote as $data)
                {

//                    if(isset($data['id']))
//                    {
//                        $salesquoteproduct = SalesQuoteItem::find($data['id']);
//                    }
//                    if($salesquoteproduct == null || !isset($data['id']))
//                    {
                        $salesquoteproduct             = new SalesQuoteItem();
                        $salesquoteproduct->quote_id = $salesquote->id;
//                    }
                    $salesquoteproduct->type         = $data['type'];
                    $salesquoteproduct->profit       = !empty($data['profit'])?$data['profit']:0;
                    $salesquoteproduct->totalmaincost= !empty($data['totalmaincost'])?$data['totalmaincost']:0;
                    $salesquoteproduct->markup       = !empty($data['markup'])?$data['markup']:0;
                    $salesquoteproduct->purchase_price       = !empty($data['purchase_price'])?$data['purchase_price']:0;
                    $salesquoteproduct->subtotal_description       = !empty($data['subtotal_description'])?$data['subtotal_description']:null;
                    $salesquoteproduct->item       = !empty($data['item'])?$data['item']:null;
                    $salesquoteproduct->quantity       = !empty($data['quantity'])?$data['quantity']:0;
                    $salesquoteproduct->price       = !empty($data['price'])?$data['price']:0;
                    $salesquoteproduct->extended       = !empty($data['extended'])?$data['extended']:0;
                    $salesquoteproduct->tax       = !empty($data['tax'])?$data['tax']:null;
                    $salesquoteproduct->itemTaxPrice       = !empty($data['itemTaxPrice'])?$data['itemTaxPrice']:0;
                    $salesquoteproduct->itemTaxRate       = !empty($data['itemTaxRate'])?$data['itemTaxRate']:0;
                    $salesquoteproduct->amount       = !empty($data['amount'])?$data['amount']:0;
                    $salesquoteproduct->subtotal_quantity       = !empty($data['subtotal_quantity'])?$data['subtotal_quantity']:null;
                    $salesquoteproduct->sample_comment       = !empty($data['sample_comment'])?$data['sample_comment']:null;
                    $salesquoteproduct->supplier_name       = !empty($data['supplier_name'])?$data['supplier_name']:null;
                    $salesquoteproduct->supplier_part_number       = !empty($data['supplier_part_number'])?$data['supplier_part_number']:null;
                    $salesquoteproduct->manufacturer_name       = !empty($data['manufacturer_name'])?$data['manufacturer_name']:null;
                    $salesquoteproduct->manufacturer_part_number       = !empty($data['manufacturer_part_number'])?$data['manufacturer_part_number']:null;
                    $salesquoteproduct->created_by       = Auth::user()->id;
                    $salesquoteproduct->save();
                }
            }

            return redirect()->route('salesquote.index')->with('success', __('Sales quote successfully Edited.'));
        }
        else
        {
            return redirect()->back()->with('error',__('Permission denied'));
        }

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        if(\Auth::user()->can('salesquote delete'))
        {
            $salesquote=SalesQuote::find($id);
            $salesquoteitem=SalesQuoteItem::where('quote_id',$salesquote->id)->delete();
            $salesquote->delete();
            return redirect()->back()->with('success',__('Salesquote Deleted successfully'));
        }
        else
        {
            return redirect()->back()->with('error',__('Permission denied'));
        }
    }

    public function getsubtotal(Request $request)
    {

        if(isset($request->acction) && $request->acction == "edit")
        {
            if(isset($request->invoice_id))
            {
                $acction="edit";
                $salesquote=SalesQuote::find($request->invoice_id);

                $salesquoteitems=SalesQuoteItem::where('quote_id',$salesquote->id)->get();
                $subid=0;

//                if($salesquoteitems->type=="subcustomitem")
//                {
//                    $html=view('sales::salesquote.getsubtotal',compact('acction','subid','data'))->render();
//                }
//                else
//                {
                    $html=view('sales::salesquote.getsubtotal',compact('acction','subid','salesquoteitems'))->render();
//                }

                $data=[
                    "success" => true,
                    "data" => $html,
                ];
                return $data;
            }
        }
        else
        {
            $type=$request->type;
            if(isset($request->id) && ($request->id != "NaN"))
            {
                if($type=="substart")
                {
                    $id=($request->id)+1;
                }
                else
                {
                    $id= $request->id;
                }
            }
            else
            {
                $id= 0;
            }
            if(isset($request->datasubid))
            {
                $subid=($request->datasubid)+1;
            }
            else
            {
                $subid=0;
            }

            if($type=="subcustomitem")
            {
                $data=$request->all();
                $html=view('sales::salesquote.getsubtotal',compact('id','type','subid','data'))->render();
            }
            else
            {
                $html=view('sales::salesquote.getsubtotal',compact('id','type','subid'))->render();
            }

            $data=[
                "success" => true,
                "data" => $html,
            ];
            return $data;
        }

    }

    public function pdf(Request $request,$id)
    {

        try {
            $quoteid = Crypt::decrypt($id);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('Invoice Not Found.'));
        }
        $salesquotes   = SalesQuote::where('id', $quoteid)->first();
        if(module_is_active('Account'))
        {
            $customer         = \Modules\Account\Entities\Customer::where('user_id', $salesquotes->customer_id)->first();
        }
        else
        {
            $customer         = User::where('id', $salesquotes->customer_id)->first();
        }

        $items         = [];
        $taxesData     = [];

        foreach($salesquotes->items as $salesquote)
        {
            if($salesquote->type=="substart")
            {
                $item                           = new \stdClass();
                $item->type                     = $salesquote->type;
                $item->profit                   = $salesquote->profit;
                $item->markup                   = $salesquote->markup;
                $item->purchase_price           = $salesquote->purchase_price;
                $item->manufacturer_part_number ="";
                $item->manufacturer_name        ="";
                $item->supplier_part_number     ="";
                $item->supplier_name            ="SubStart";
                $item->subtotal_description     =$salesquote->subtotal_description;
                $item->subtotal_quantity        =$salesquote->subtotal_quantity;
                $item->price                    =$salesquote->price;
                $item->extended                 =$salesquote->extended;
                $item->tax                      =$salesquote->tax;
                $item->itemTaxPrice             =$salesquote->itemTaxPrice;
                $item->itemTaxRate              =$salesquote->itemTaxRate;
            }
            elseif($salesquote->type=="subitem")
            {
                $productservice=ProductService::where('id',$salesquote->item)->first();

                $item                           = new \stdClass();
                $item->type                     = $salesquote->type;
                $item->profit                   =$salesquote->profit;
                $item->markup                   =$salesquote->markup;
                $item->purchase_price           =$salesquote->purchase_price;
                $item->manufacturer_part_number =$productservice->manufacturer_part_number;
                $item->manufacturer_name        =$productservice->manufacturer_name;
                $item->supplier_part_number     =$productservice->supplier_part_number;
                $item->supplier_name            =$productservice->supplier_name;
                $item->item                     =$productservice->name;
                $item->quantity                 =$salesquote->quantity;
                $item->price                    =$salesquote->price;
                $item->extended                 =$salesquote->extended;
                $item->tax                      =$salesquote->tax;
                $item->itemTaxPrice             =$salesquote->itemTaxPrice;
                $item->itemTaxRate              =$salesquote->itemTaxRate;

                if(module_is_active('ProductService'))
                {
                    $taxes = \Modules\ProductService\Entities\Tax::tax($salesquote->tax);
                    $itemTaxes = [];
                    $totalTaxPrice = 0;
                    $tax_price = 0;
                    if(!empty($item->tax))
                    {
                        foreach($taxes as $tax)
                        {
                            $taxPrice      = Invoice::taxRate($tax->rate, $item->price, $item->quantity,0);

                            $tax_price  += $taxPrice;
                            $totalTaxPrice += $taxPrice;

                            $itemTax['name']  = $tax->name;
                            $itemTax['rate']  = $tax->rate . '%';
                            $itemTax['price'] = currency_format_with_sym($taxPrice,$salesquote->created_by);
                            $itemTaxes[]      = $itemTax;

                            if(array_key_exists($tax->name, $taxesData))
                            {
                                $taxesData[$tax->name] = $taxesData[$tax->name] + $taxPrice;
                            }
                            else
                            {
                                $taxesData[$tax->name] = $taxPrice;
                            }
                        }
                        $item->itemTax = $itemTaxes;
                        $item->tax_price = $tax_price;
                    }
                    else
                    {
                        $item->itemTax = [];
                    }
                }

            }
            elseif($salesquote->type=="subcustomitem")
            {
                $item                           = new \stdClass();
                $item->type                     = $salesquote->type;
                $item->profit                   =$salesquote->profit;
                $item->markup                   =$salesquote->markup;
                $item->purchase_price           =$salesquote->purchase_price;
                $item->manufacturer_part_number =$salesquote->manufacturer_part_number;
                $item->manufacturer_name        =$salesquote->manufacturer_name;
                $item->supplier_part_number     =$salesquote->supplier_part_number;
                $item->supplier_name            =$salesquote->supplier_name;
                $item->item                     =$salesquote->item;
                $item->quantity                 =$salesquote->quantity;
                $item->price                    =$salesquote->price;
                $item->extended                 =$salesquote->extended;
                $item->tax                      =$salesquote->tax;
                $item->itemTaxPrice             =$salesquote->itemTaxPrice;
                $item->itemTaxRate              =$salesquote->itemTaxRate;

                if(module_is_active('ProductService'))
                {
                    $taxes = \Modules\ProductService\Entities\Tax::tax($salesquote->tax);
                    $itemTaxes = [];
                    $totalTaxPrice = 0;
                    $tax_price = 0;
                    if(!empty($item->tax))
                    {
                        foreach($taxes as $tax)
                        {
                            $taxPrice      = Invoice::taxRate($tax->rate, $item->price, $item->quantity,0);

                            $tax_price  += $taxPrice;
                            $totalTaxPrice += $taxPrice;

                            $itemTax['name']  = $tax->name;
                            $itemTax['rate']  = $tax->rate . '%';
                            $itemTax['price'] = currency_format_with_sym($taxPrice,$salesquote->created_by);
                            $itemTaxes[]      = $itemTax;

                            if(array_key_exists($tax->name, $taxesData))
                            {
                                $taxesData[$tax->name] = $taxesData[$tax->name] + $taxPrice;
                            }
                            else
                            {
                                $taxesData[$tax->name] = $taxPrice;
                            }
                        }
                        $item->itemTax = $itemTaxes;
                        $item->tax_price = $tax_price;
                    }
                    else
                    {
                        $item->itemTax = [];
                    }
                }

            }
            elseif($salesquote->type=="subcomment")
            {
                $item                 = new \stdClass();
                $item->type           = $salesquote->type;
                $item->sample_comment =$salesquote->sample_comment;
            }
            elseif($salesquote->type=="subblank")
            {
                $item        = new \stdClass();
                $item->type  = $salesquote->type;
                $item->type  =$salesquote->type;
            }
            elseif($salesquote->type=="substop")
            {
                $item        = new \stdClass();
                $item->type  = $salesquote->type;
                $item->type  =$salesquote->type;
            }
            $items[] = $item;
        }

        $salesquotes->itemData      = $items;
        $salesquotes->totalcost     = !empty($salesquotes->totalcost())?currency_format_with_sym($salesquotes->totalcost()):0;
        $salesquotes->totalProfit   = !empty($salesquotes->totalProfit())?currency_format_with_sym($salesquotes->totalProfit()):0;
        $salesquotes->totalgp       = !empty($salesquotes->totalgp())?currency_format_with_sym($salesquotes->totalgp()):0;
        $salesquotes->totalextend   = !empty($salesquotes->totalextend())?currency_format_with_sym($salesquotes->totalextend()):0;
        $salesquotes->totalTaxPrice = $totalTaxPrice;
        $salesquotes->mainamount     = ($salesquotes->totalextend() + $totalTaxPrice);

        //Set your logo
        $company_logo = get_file(sidebar_logo());
        $quote_logo = company_setting('quote_logo',$salesquotes->created_by,$salesquotes->workspace);
        if(isset($quote_logo) && !empty($quote_logo))
        {
            $img  = get_file($quote_logo);
        }
        else{
            $img  = $company_logo;
        }
        if($salesquotes)
        {
            $settings['site_rtl'] = company_setting('site_rtl',$salesquotes->created_by,$salesquotes->workspace);
            $settings['company_name'] = company_setting('company_name',$salesquotes->created_by,$salesquotes->workspace);
            $settings['company_email'] = company_setting('company_email',$salesquotes->created_by,$salesquotes->workspace);
            $settings['company_telephone'] = company_setting('company_telephone',$salesquotes->created_by,$salesquotes->workspace);
            $settings['company_address'] = company_setting('company_address',$salesquotes->created_by,$salesquotes->workspace);
            $settings['company_city'] = company_setting('company_city',$salesquotes->created_by,$salesquotes->workspace);
            $settings['company_state'] = company_setting('company_state',$salesquotes->created_by,$salesquotes->workspace);
            $settings['company_zipcode'] = company_setting('company_zipcode',$salesquotes->created_by,$salesquotes->workspace);
            $settings['company_country'] = company_setting('company_country',$salesquotes->created_by,$salesquotes->workspace);
            $settings['registration_number'] = company_setting('registration_number',$salesquotes->created_by,$salesquotes->workspace);
            $settings['tax_type'] = company_setting('tax_type',$salesquotes->created_by,$salesquotes->workspace);
            $settings['vat_number'] = company_setting('vat_number',$salesquotes->created_by,$salesquotes->workspace);
            $settings['quote_footer_title'] = company_setting('quote_footer_title',$salesquotes->created_by,$salesquotes->workspace);
            $settings['quote_footer_notes'] = company_setting('quote_footer_notes',$salesquotes->created_by,$salesquotes->workspace);
            $settings['quote_shipping_display'] = company_setting('quote_shipping_display',$salesquotes->created_by,$salesquotes->workspace);
            $settings['quote_template'] = company_setting('quote_template',$salesquotes->created_by,$salesquotes->workspace);
            $settings['quote_color'] = company_setting('quote_color',$salesquotes->created_by,$salesquotes->workspace);
            $color      = '#' . $settings['quote_color'];
            $font_color = SalesUtility::getFontColor($color);

            $type=$request->type;

            $setting=SalesQuote::salesquotesetting();

            return view('sales::salesquote.templates.template1', compact('salesquotes', 'color', 'settings', 'customer', 'img', 'font_color','type','setting'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }

    public function deleteItem(Request $request)
    {
        if(\Auth::user()->can('salesquote delete'))
        {
            if(isset($request->id))
            {
                $salesquoteitem=SalesQuoteItem::where('id',$request->id)->first();
                $salesquoteitem->delete();
                return true;
            }
        }
        else
        {
            return redirect()->back()->with('error',__('Permission denied'));
        }

    }

    public function setting()
    {
        $setting=SalesQuote::salesquotesetting();
        return view('sales::salesquote.setting',compact('setting'));
    }
    public function settingstore(Request $request)
    {
        $post=[];
        if(isset($request->supplier_part_number) && ($request->supplier_part_number=="on"))
        {
            $post['supplier_part_number']="on";
        }
        else
        {
            $post['supplier_part_number']="off";
        }
        if(isset($request->manufacturer_part_number) && ($request->manufacturer_part_number=="on"))
        {
            $post['manufacturer_part_number']="on";
        }
        else
        {
            $post['manufacturer_part_number']="off";
        }
        if(isset($request->subtotal) && ($request->subtotal=="on"))
        {
            $post['subtotal']="on";
        }
        else
        {
            $post['subtotal']="off";
        }
        if(isset($request->text_within_groups) && ($request->text_within_groups=="on"))
        {
            $post['text_within_groups']="on";
        }
        else
        {
            $post['text_within_groups']="off";
        }
        if(isset($request->labor_total) && ($request->labor_total=="on"))
        {
            $post['labor_total']="on";
        }
        else
        {
            $post['labor_total']="off";
        }
        if(isset($request->shipping_total) && ($request->shipping_total=="on"))
        {
            $post['shipping_total']="on";
        }
        else
        {
            $post['shipping_total']="off";
        }
        if(isset($request->grand_total) && ($request->grand_total=="on"))
        {
            $post['grand_total']="on";
        }
        else
        {
            $post['grand_total']="off";
        }
        foreach($post as $key => $data)
        {
            \DB::insert(
                'insert into sales_quotes_setting (`value`, `key`,`workspace`,`created_by`) values (?, ?, ?,?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', [
                                                                                                                                                                      $data,
                                                                                                                                                                      $key,
                                                                                                                                                                      getActiveWorkSpace(),
                                                                                                                                                                      creatorId(),
                                                                                                                                                                  ]
            );
        }
        return redirect()->back()->with('success', 'Setting successfully updated.');
    }

    public function changestatus(Request $request,$id)
    {
        $id=decrypt($id);
        $salesquote=SalesQuote::where('id',$id)->first();

        if(isset($request->type))
        {
            if($request->type=="accept")
            {
                $salesquote->quote_status= 1;
            }
            else
            {
                $salesquote->quote_status= 2;
            }
            $salesquote->save();
            return redirect()->back()->with('success',__('Status Changes Successfully'));
        }
        else
        {
            return redirect()->back()->with('success',__('Status Changes UnSuccessfully'));
        }
    }

    public function duplicate($id)
    {
        if(\Auth::user()->can('salesquote create'))
        {
            $quote                            = SalesQuote::find($id);

            $duplicate                        = new SalesQuote();
            $duplicate['quote_id']            = $this->quoteNumber();
            $duplicate['customer_id']         = $quote->customer_id;
            $duplicate['contact_person']      = $quote->contact_person;
            $duplicate['issue_date']          = $quote->issue_date;
            $duplicate['quote_validity']      = $quote->quote_validity;
            //            $duplicate['quote_status']        = $quote->quote_status;
            $duplicate['workspace']           = getActiveWorkSpace();
            $duplicate['created_by']          = creatorId();
            $duplicate->save();

            //            Stream::create(
            //                [
            //                    'user_id' => Auth::user()->id,
            //                    'created_by' => creatorId(),
            //                    'log_type' => 'created',
            //                    'remark' => json_encode(
            //                        [
            //                            'owner_name' => Auth::user()->username,
            //                            'title' => 'quote',
            //                            'stream_comment' => '',
            //                            'user_name' => $quote->name,
            //                        ]
            //                    ),
            //                ]
            //            );

            if($duplicate)
            {
                $quoteItem = SalesQuoteItem::where('quote_id', $quote->id)->get();


                foreach($quoteItem as $item)
                {
                    $salesquoteproduct             = new SalesQuoteItem();
                    $salesquoteproduct->quote_id    = $duplicate->id;
                    $salesquoteproduct->type         = $item->type;
                    $salesquoteproduct->profit       = !empty($item->profit)?$item->profit:0;
                    $salesquoteproduct->totalmaincost= !empty($item->totalmaincost)?$item->totalmaincost:0;
                    $salesquoteproduct->markup       = !empty($item->markup)?$item->markup:0;
                    $salesquoteproduct->purchase_price       = !empty($item->purchase_price)?$item->purchase_price:0;
                    $salesquoteproduct->subtotal_description       = !empty($item->subtotal_description)?$item->subtotal_description:null;
                    $salesquoteproduct->item       = !empty($item->item)?$item->item:null;
                    $salesquoteproduct->quantity       = !empty($item->quantity)?$item->quantity:0;
                    $salesquoteproduct->price       = !empty($item->price)?$item->price:0;
                    $salesquoteproduct->extended       = !empty($item->extended)?$item->extended:0;
                    $salesquoteproduct->tax       = !empty($item->tax)?$item->tax:null;
                    $salesquoteproduct->itemTaxPrice       = !empty($item->itemTaxPrice)?$item->itemTaxPrice:0;
                    $salesquoteproduct->itemTaxRate       = !empty($item->itemTaxRate)?$item->itemTaxRate:0;
                    $salesquoteproduct->amount       = !empty($item->amount)?$item->amount:0;
                    $salesquoteproduct->subtotal_quantity       = !empty($item->subtotal_quantity)?$item->subtotal_quantity:null;
                    $salesquoteproduct->sample_comment       = !empty($item->sample_comment)?$item->sample_comment:null;
                    $salesquoteproduct->created_by       = Auth::user()->id;
                    $salesquoteproduct->save();

                }
            }
            //            event(new QuoteDuplicate($duplicate,$quoteItem));

            return redirect()->back()->with('success', __('Quote duplicate successfully.'));
        }
    }

    function salesorderNumber()
    {
        $latest = SalesOrder::where('created_by', '=', creatorId())->where('workspace',getActiveWorkSpace())->latest()->first();

        if(!$latest)
        {
            return 1;
        }

        return $latest->salesorder_id + 1;
    }

    public function convert($id)
    {
        $salesquote = SalesQuote::find($id);
        $user=Customer::where('user_id',$salesquote->customer_id)->first();

        $salesorder                        = new SalesOrder();
        $salesorder['user_id']             = $salesquote->customer_id;
        $salesorder['salesorder_id']       = $this->salesorderNumber();
        $salesorder['name']                = null;
        $salesorder['quote']               = $id;
        $salesorder['opportunity']         = null;
        $salesorder['status']              = $salesquote->quote_status;
        $salesorder['account']             = null;
        $salesorder['amount']              = null;
        $salesorder['date_quoted']         = $salesquote->issue_date;
        $salesorder['quote_number']        = $salesquote->quote_id;
        $salesorder['billing_address']     = isset($user->billing_address)?$user->billing_address:null;
        $salesorder['billing_city']        = isset($user->billing_city)?$user->billing_city:null;
        $salesorder['billing_state']       = isset($user->billing_state)?$user->billing_state:null;
        $salesorder['billing_country']     = isset($user->billing_country)?$user->billing_country:null;
        $salesorder['billing_postalcode']  = null;
        $salesorder['shipping_address']    = isset($user->shipping_address)?$user->shipping_address:null;
        $salesorder['shipping_city']       = isset($user->shipping_city)?$user->shipping_city:null;
        $salesorder['shipping_state']      = isset($user->shipping_state)?$user->shipping_state:null;
        $salesorder['shipping_country']    = isset($user->shipping_country)?$user->shipping_country:null;
        $salesorder['shipping_postalcode'] = null;
        $salesorder['billing_contact']     = $salesquote->billing_name;
        $salesorder['shipping_contact']    = $salesquote->shipping_name;
        $salesorder['tax']                 = null;
        $salesorder['shipping_provider']   = null;
        $salesorder['description']         = null;
        $salesorder['workspace']           = getActiveWorkSpace();
        $salesorder['created_by']          = $salesquote->created_by;
        $salesorder->save();

        if(!empty($salesorder))
        {
            $salesquote->converted_salesorder_id = $salesorder->id;
            $salesquote->save();
        }
        Stream::create(
            [
                'user_id' => Auth::user()->id,
                'created_by' => creatorId(),
                'log_type' => 'created',
                'remark' => json_encode(
                    [
                        'owner_name' => Auth::user()->username,
                        'title' => 'salesorder',
                        'stream_comment' => '',
                        'user_name' => $salesorder->name,
                    ]
                ),
            ]
        );

        if($salesorder)
        {
            $quotesProduct = SalesQuoteItem::where('quote_id', $salesquote->id)->get();

            foreach($quotesProduct as $product)
            {
                $salesorderProduct                = new SalesOrderItem();
                $salesorderProduct->salesorder_id = $salesorder->id;
                $salesorderProduct->item          = $product->item;
                $salesorderProduct->quantity      = $product->quantity;
                $salesorderProduct->price         = $product->price;
                //                $salesorderProduct->discount      = $product->discount;
                $salesorderProduct->tax           = isset($product->tax)?$product->tax:null;
                $salesorderProduct->description   = isset($product->description)?$product->description:null;
                $salesorderProduct->created_by    = $product->created_by;
                $salesorderProduct->save();
            }
        }
        event(new CreateSalesOrderConvert($salesorder,$quotesProduct));

        return redirect()->back()->with('success', __('Quotes to SalesOrder Successfully Converted.'));
    }

    public function printsalesquote($id)
    {
        try {
            $id       = Crypt::decrypt($id);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('Sales Quote Not Found.'));
        }
        $salesquote=SalesQuote::find($id);
        if($salesquote)
        {
//            if($salesquote->workspace == getActiveWorkSpace())
//            {
                $salesquoteitems=SalesQuoteItem::where('quote_id',$salesquote->id)->get();
//            }
        }

        $company_id = $salesquote->created_by;
        $workspace_id = $salesquote->workspace;

        return view('sales::salesquote.printview', compact('salesquote', 'salesquoteitems','company_id','workspace_id'));
    }
    public function getcustomitem()
    {
        $category     = Category::where('created_by', '=',creatorId())->where('workspace_id', '=', getActiveWorkSpace())->where('type', '=', 0)->get()->pluck('name', 'id');

        $tax          = Tax::where('created_by', '=',creatorId())->where('workspace_id', '=', getActiveWorkSpace())->get()->pluck('name', 'id');

        return view('sales::salesquote.customitem',compact('category','tax'));
    }

    public function getlaborwindow() {
        return view("sales::salesquote.labor");
    }

    public function getcustomers(Request $req) {
        $companyid  = $req->input("id");

        $contact    = Contact::where("account",$companyid)->get(["name","id"])->toArray();

        return response()->json($contact);
    }

    public function calculate_item($values) {
            // "istaxable"    => $istaxable,
            // "shippingfee"  => $shippingfee,
            // "ccost"        => $cost,
            // "markup"       => $markup,
            // "qty"          => $qty
        
        $istaxable = null;

        if (gettype($values['istaxable']) == "string") {
            $istaxable               = (String) $values["istaxable"];
        } else if (gettype($values['istaxable']) == "boolean") {
            $istaxable               = (Boolean) $values["istaxable"];
        }
            
        $cost                    = $values["ccost"];
        $markup                  = $values["markup"];
        $qty                     = $values['qty'];

        $shippingfee             = $values["shippingfee"];
       

        // tax
            $taxprice                 = 0;
            $taxrate                  = 0;
            $taxation_used            = null;
            $taxation_id              = null;

                if ($istaxable == "true") {
                    $taxation_used    = "GRT";
                } else if ($istaxable == "false") {
                    $taxation_used    = "None";
                } else if ($istaxable == true) {
                    $taxation_used    = "GRT";
                } else if ($istaxable == false) {
                    $taxation_used    = "None";
                }

                    $t                = tax::where("name",$taxation_used)->get(["rate","id"]);
                
                    if (count($t)>0) {
                        $taxrate      = $t[0]->rate;
                        $taxprice     = $taxrate/100;
                        $taxation_id  = $t[0]->id;
                    }
  
        // end tax

        // save as a main quote item
            // calculations
                $amount               = 0;
                $profit               = 0;

                // calculating the cost with markup
                    $markup_in_dec    = $markup/100;
                    $markup_value     = $cost*$markup_in_dec;
                // end calculations of markup
            // end calculations

        $itemshipping            = ($shippingfee*$markup_in_dec)+$shippingfee; // 2:: ITEMSHIPPING
        $totalmaincost           = ($cost*$markup_in_dec)+$cost; // 3:: TOTALMAINCOST
        $price                   = $itemshipping+$totalmaincost; // 4:: PRICE
        // $pricewithtax            = $price*$taxprice; 
        $amount                  = ($price*$taxprice)+$price; // 5:: PRICE WITH TAX
        $extended                = $amount*$qty;

        $profit                  = $totalmaincost-$cost; // profit per item
        $total_profit            = $profit*$qty; 
       
        // $extended     = ($price*$qty)+$shippingfee;

        // computation of tax
        // $tax_value            = $extended*$taxprice;  // tax value
        $tax_value               = $price*$taxprice;
        
        // $amount       = ($price*$qty)+$shippingfee; // (total price * qty) + shipping fee
        
        // price     = purchase price + markup
        // profit    = price - purchase price
        // extended  = :: same with price
        // amount    = (purchase price * qty) + shipping fee
    
        // $price         = $price*$qty;
        return [
            "markupvalue"   => $markup,
            "price"         => $price, 
            "tax_in_dec"    => $taxprice,
            "tax_value"     => $tax_value,
            "tax_used"      => $taxation_id,
            "extended"      => $extended,
            "amount"        => $amount,
            "profit"        => $profit,
            "totalprofit"   => $total_profit,
            "totalmaincost" => $totalmaincost,
            "itemshipping"  => $itemshipping,
            "ccost"         => $cost
        ];
        
    }

    public function addcustomitem(Request $req) {
        $istaxable               = $req->input("istaxable");
        
        $expiry                  = $req->input("expiry");
        $shippingfee             = $req->input("shippingfee");
        $productlineid           = $req->input("productlineid");

        $qty                     = $req->input('quantity');
        $cost                    = $req->input("cost");
        $markup                  = $req->input("markup");
        $description             = $req->input("description");
        $type                    = $req->input("type");

        $qid                     = $req->input("qid");

        $additional_info         = (array) $req->input("additional_info");

        // $additional_info         = ['title'=>"this is title","label"=>"this is label","description"=>"this is description"];
        // $istaxable               = "false";
        
        // $expiry                  = false;
        // $shippingfee             = "100";
        // $productlineid           = "1";

        // $qty                     = "1";
        // $cost                    = "100";
        // $markup                  = "65";
        // $description             = "Lorem ipsum dolor set amit consectitur adelpiscing";
        // $qid                     = "78";

        $values = $this->calculate_item([
            "istaxable"    => $istaxable,
            "shippingfee"  => $shippingfee,
            "ccost"        => $cost,
            "markup"       => $markup,
            "qty"          => $qty
        ]);

        /*
            "markupvalue"   => $markup,
            "price"         => $price, 
            "tax_in_dec"    => $taxprice,
            "tax_value"     => $tax_value,
            "tax_used"      => $taxation_id,
            "extended"      => $extended,
            "amount"        => $amount,
            "profit"        => $profit,
            "totalprofit"   => $total_profit,
            "totalmaincost" => $totalmaincost,
            "itemshipping"  => $itemshipping,
            "ccost"         => $cost
        */

        $salesquoteproduct                                 = new SalesQuoteItem();
        $salesquoteproduct->quote_id                       = $qid;
        $salesquoteproduct->itemorder                      = $salesquoteproduct->create_order_number($qid);
        $salesquoteproduct->inside_sub_order               = null;
        $salesquoteproduct->type                           = $type;
        $salesquoteproduct->profit                         = $values['profit'];
        $salesquoteproduct->totalmaincost                  = $values['totalmaincost'];
        $salesquoteproduct->markup                         = $markup;
        $salesquoteproduct->purchase_price                 = $cost;
        $salesquoteproduct->subtotal_description           = null;
        $salesquoteproduct->item                           = $description;
        $salesquoteproduct->quantity                       = $qty;
        $salesquoteproduct->price                          = $values['price'];
        $salesquoteproduct->extended                       = $values['extended'];
        $salesquoteproduct->tax                            = $values['tax_used'];
        $salesquoteproduct->itemTaxPrice                   = $values['tax_in_dec'];
        $salesquoteproduct->itemTaxRate                    = $values['tax_value'];
        $salesquoteproduct->amount                         = $values['amount'];
        $salesquoteproduct->subtotal_quantity              = null;
        $salesquoteproduct->sample_comment                 = null;
        $salesquoteproduct->supplier_name                  = null;
        $salesquoteproduct->supplier_part_number           = null;
        $salesquoteproduct->manufacturer_name              = null;
        $salesquoteproduct->manufacturer_part_number       = null;
        $salesquoteproduct->created_by                     = Auth::user()->id;
        $salesquoteproduct->save();

        // save to item info
        // use Modules\Sales\Entities\itemadditionalinfo;
        // use Modules\Sales\Entities\itemextensionflds;
        $markups = $this->get_markup();

        $status  = "for approval";

        if (in_array($markup, $markups)) {
            $status = "approved";
        }

            $other_iteminfo                         = new itemextensionflds();
            $other_iteminfo->itemid                 = $salesquoteproduct->id;
            $other_iteminfo->product_services_id    = 1;
            $other_iteminfo->shippingfee            = $shippingfee;
            $other_iteminfo->itemshipping           = $values['itemshipping'];
            $other_iteminfo->endoflife              = ($expiry==false)?null:$expiry;
            $other_iteminfo->markupstatus           = $status;
            $other_iteminfo->save();

        // // save to item additional information
        // 
        $otherinfo               = (object)[];

        foreach($additional_info as $ai) {
            $ai                                     = (array) $ai;
            $add_info                               = new itemadditionalinfo();
            $add_info->item_id                      = $salesquoteproduct->id;
            $add_info->title                        = $ai['title'];
            $add_info->label                        = $ai['label'];
            $add_info->description                  = $ai['description'];
            $add_info->save();

            $otherinfo->{"title"}       = $ai['title'];
            $otherinfo->{"description"} = $ai['description'];
            $otherinfo->{"label"}       = $ai['label'];
        }

        $values['otherinfo']    = $this->get_otherfields($salesquoteproduct->id, ["Manufacturer","Supplier"]);;
        $values['id']           = $salesquoteproduct->id;
 
        $values['shippingfee']  = number_format($shippingfee,2);
        $values['itemorderid']  = 1;
        $values['subtotal_gpr'] = null;
        $values['status']       = $status;

        array_push($markups,$markup);
        $count                 = 1;
        $datetoday             = date("Y-m-d");

        $showsettings = $this->showsettings();
        $qt_window     = true;
        $intextbox     = true;

        $html      = view('sales::salesquote.quote_item', compact('values','description','qty','datetoday','markups','count',"showsettings","intextbox","qt_window"))->render();
  
        return response()->json($html);
    }

    public function getnovalue(Request $req) {
        $item_id        = $req->input("item_id");
        
        $collection     = SalesQuoteItem::where("id",$item_id)->get();
        $values = [
            "id"    => $collection[0]->id
        ];
        $type           = $collection[0]->type;
        $description    = $collection[0]->item;

        $count          = 0;
        // $showsettings   = ["profit"        => true,
        //                     "markup"        => true,
        //                     "cost"          => true,
        //                     "supplier"      => true,
        //                     "supplier_num"  => true,
        //                     "manu"          => true,
        //                     "manu_num"      => true,
        //                     "description"   => true,
        //                     "qty"           => true,
        //                     "shipping"      => true,
        //                     "price"         => true,
        //                     "extended"      => true,
        //                     "tax"           => true,
        //                     "sub"           => true,
        //                     "subitem"       => true
        //                 ];
        $showsettings = $this->showsettings();
        
        $html           = view('sales::salesquote.novalueitem', compact('values',"description","count","type","showsettings"))->render();
        return response()->json($html);
    }

    public function postcreatequote(Request $req) {
        $qid = $req->input("qid");
       
        $quoteid = null;
        if ($qid == NULL) {
            // create new
            $salesquote                 = New SalesQuote();
            $salesquote->quote_id       = $this->quoteNumber();
            $salesquote->customer_id    = $req->input("customer_id");
            $salesquote->contact_person = $req->input("contact_person");
            $salesquote->issue_date     = $req->input("issue_date");
            $salesquote->quote_validity = date('Y-m-d',strtotime($req->input("quote_validity")));
            $salesquote->workspace      = getActiveWorkSpace();
            $salesquote->created_by     = Auth::user()->id;
            $salesquote->save();

            $quoteid = $salesquote->id;
        } else {
            // update existing
            $update_arr = [
                "customer_id"       => $req->input("customer_id"),
                "contact_person"    => $req->input("contact_person"),
                "issue_date"        => $req->input("issue_date"),
                "quote_validity"    => date('Y-m-d',strtotime($req->input("quote_validity")))
            ];

            //var_dump($update_arr); return;
            $salesquote             = SalesQuote::where("id",$qid)->update($update_arr);
            $quoteid                = $qid;
        }

        return redirect()->route("salesquote.showquote",[$quoteid]);
        // return redirect()->route("salesquote.show",[$quoteid]);
    }

    public function showquote($quoteid) {
        if(\Auth::user()->can('salesquote create'))
        {
            $showsection  = true;
            $quote_number = SalesQuote::quoteNumberFormat($this->quoteNumber());
            
            $thequote     = $salesquote=SalesQuote::find($quoteid);
                                        
            $customers    = SalesAccount::get()->pluck("name","id");
            $cont_person  = Contact::get()->pluck("name","account");
        
            $users        = User::where('workspace_id','=',getActiveWorkSpace())->where('type','staff')->get()->pluck('name', 'id');
            
            $cust_sel     = $thequote->customer_id;
            $cont_sel     = $thequote->contact_person;

            $issue_date   = null;
            $date_valid   = null;
            //var_dump($thequote);
            //return;
            // if (count($thequote) > 0) {
                $issue_date = $thequote->issue_date;
                $date_valid = $thequote->quote_validity;
            // }

            return view('sales::salesquote.create',compact('customers','quote_number','users',"showsection","quoteid","cust_sel","cont_sel","issue_date","date_valid"));
        }
        else
        {
            return redirect()->back()->with('error',__('Permission denied'));
        }
    }

    public function getquote_items(Request $req) {
        $qid             = $req->input("qid");
        // $qid    = 77;
        $show   = ["profit"        => true,
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
                   "subitem"       => true,
                   "itemshipping"  => true,
                   "itemcost"      => true,
                   "pricewithtax"  => true
        ];

        $html            = $this->get_quote_item($qid, $show, true);
   
        return response()->json($html);  
    }

    public function check_markup($quote_id) {
        $salesquoteitems = SalesQuoteItem::where(['quote_id'=>$quote_id, "markupstatus" => "for approval"])
                                            ->orWhere("markupstatus","declined")
                                            ->leftjoin("sales_quotes_item_info_more_flds","sales_quotes_items.id","=","sales_quotes_item_info_more_flds.itemid")
                                            ->orderBy("itemorder","ASC")
                                            ->get();
        
        return count($salesquoteitems);
    }

    public function check_item_status(Request $req) {
        $itemid = $req->input("itemid");

        $collection = itemextensionflds::where("itemid",$itemid)->get();

        if (count($collection) > 0) {
            if ($collection[0]->markupstatus == "approved") {
                return response()->json("approved");
            } else {
                return response()->json("for approval");
            }
        } else {
            return response()->json("nofound");
        }
    }

    public function set_order(Request $req) {
        $quote_id       = $req->input("quote_id");
        $order_to_use   = $req->input("order_to_use");
        $item_id        = $req->input("item_id");

        // update inside tbody 
        $inside_tbody   = $req->input("order_to_use_");
        
        $update         = $this->update_order($quote_id, $order_to_use, $item_id,$inside_tbody);
        return response()->json( $update );
    }

    public function update_order($quote_id, $order_to_use, $item_id, $inside_tbody = "false") {
        $itemorder         = "itemorder";
        $collection        = SalesQuoteItem::where("id",$item_id)->get([$itemorder,"grp_id"]);
        $origorderid       = $collection[0]->itemorder;
        $grpid             = $collection[0]->grp_id;

        // if outside subtotal 
            // update the orderid using the order_to_use
        // if inside subtotal
            // update the orderid using the origorderid 
            // update inside_sub_order using the order_to_use
        // update the groupid using the grpid
        
        $update     = null;
        $where      = null;
        $andwhere   = null;

        if ($origorderid < $order_to_use) {
            $min      = $origorderid + 1;
            $update   = "{$itemorder} = ({$itemorder}-1)";
            // $where    = "where itemorder >= {$min} and itemorder <= {$order_to_use}";
            $where    = "where {$itemorder} between {$min} and {$order_to_use}";
        } else if ($origorderid > $order_to_use) {
            $min    = $origorderid - 1;
            $update = "{$itemorder} = ({$itemorder}+1)";
            // $where  = "where itemorder >= {$order_to_use} and itemorder = {$min}";
            $where  = "where {$itemorder} between {$order_to_use} and {$min}";
        }

        if ($origorderid != $order_to_use) {
            $up    = DB::select(DB::raw("update sales_quotes_items set {$update} {$where} and quote_id='{$quote_id}'"));
            $up    = DB::select(DB::raw("update sales_quotes_items set {$itemorder} = '{$order_to_use}' where id = '{$item_id}'"));
        }

        if ($grpid != null) {
           //  $andwhere = "and grp_id = {$grpid}";
        }

        //  return $up;
         return ["update sales_quotes_items set {$update} {$where} and quote_id='{$quote_id}' {$andwhere}",
                 "update sales_quotes_items set {$itemorder} = '{$order_to_use}' where id = '{$item_id}'"];
    }

    public function get_quote_item($qid, $showsettings = null, $intextbox = false, $qt_window = true) {
        $salesquoteitems = SalesQuoteItem::where('quote_id',$qid)
                                            ->leftjoin("sales_quotes_item_info_more_flds","sales_quotes_items.id","=","sales_quotes_item_info_more_flds.itemid")
                                            ->orderBy("itemorder","ASC")
                                            ->get();

            $html        = "";
            $markups     = $this->get_markup();

            date_default_timezone_set('UTC');
            $datetoday = date("Y-m-d");

            $html  = "<thead>";
            $html .= "<tr>";
            $html .= "<th style='width: 0px; padding:10px 0px; text-align:center;'>*</th>";

            if (isset($showsettings['profit'])) {
                $html .= "<th style='width: 0px; text-align:right;'>Profit</th>";
            }

            if (isset($showsettings['markup'])) {
                $html .= "<th style='width: 0px; text-align:center;'>Mark-Up</th>";
            }

            if (isset($showsettings['cost'])) {
                $html .= "<th style='width: 0px; text-align:right;'>Unit Cost</th>";
            }

            if (isset($showsettings['shipping'])) {
                $html .= "<th style='width: 0px; text-align:right;'>Unit Shipping Cost</th>";
            }

            if (isset($showsettings['supplier'])) {
                $html .= "<th style='width: 0px;'>Supplier</th>";
            }

            if (isset($showsettings['supplier_num'])) {
                $html .= "<th style='width: 0px;'>Supplier #</th>";
            }

            if (isset($showsettings['manu'])) {
                $html .= "<th style='width: 0px;'>MFG</th>";
            }

            if (isset($showsettings['manu_num'])) {
                $html .= "<th style='width: 0px;'>MFG #</th>";
            }

            if (isset($showsettings['description'])) {
                $html .= "<th style='text-align:left;'>Description</th>";
            }

            

            if (isset($showsettings['qty'])) {
                $html .= "<th style='width: 0px; text-align:center;'>QTY</th>";
            }

            // if (isset($showsettings['itemshipping'])) {
            //     $html .= "<th style='min-width: 5%; text-align:right;'>Item Shipping</th>";
            // }

            // if (isset($showsettings['itemcost'])) {
            //     $html .= "<th style='min-width: 5%; text-align:right;'>Item Cost</th>";
            // }

            // if (isset($showsettings['price'])) {
            //     $html .= "<th style='min-width: 5%; text-align:right;'>Price</th>";
            // }

            if (isset($showsettings['price'])) { // price with tax
                $html .= "<th style='width: 0px; text-align:right;'>Price</th>";
            }

            if (isset($showsettings['extended'])) {
                $html .= "<th style='width: 0px; text-align:right;'>Extended</th>";
            }

            if ($qt_window == true) {
                if (isset($showsettings['tax'])) {
                    $html .= "<th style='width: 0px; text-align:center;' colspan='2'>Tax</th>";
                    // $html .= "<th> </th>";
                }
            }

            $html .= "</tr>";
            $html .= "</thead>";

            $postedgroup = [];
            $postedid    = [];

            $hollow_row  = [];
            // $html .= "<tbody> <tr> <td colspan=10> </td> </tr> </tbody>";
            foreach($salesquoteitems as $aa) {

                if ($aa->grp_id !== null) {

                    if (!in_array($aa->grp_id,$postedgroup)) {
                        
                        $html .= "<tbody data-tid={$aa->grp_id}>";
                        // if not posted yet
                        array_push($postedgroup,$aa->grp_id);

                        $st           = $this->get_subtotal($aa->grp_id);

                        $grpid        = $aa->grp_id;
                        $desc         = null;
                        $qty          = 1;

                        // $price        = $st['subs'][0]->price;
                        $pricewithtax = $st['subs'][0]->pricewithtax;

                        $shippingfee  = $st['subs'][0]->shipping; 
                        $itemshipping = $st['subs'][0]->itemshipping; // itemshipping

                        $totalmaincost = $st['subs'][0]->totalmaincost;

                        $amount        = $st['subs'][0]->extended; 

                        $profit       = $st['subs'][0]->profit;
                        $cost         = $st['subs'][0]->cost;
                        $markup       = 0;

                        $totalprofit  = $st['subs'][0]->profit;
                        $totalcost    = $totalcost = $st['subs'][0]->cost;
                        $totalmup     = $totalmup = $st['subs'][0]->gp; 

                        if (count($st['sales']) > 0) {
                            $grpid       = $st['sales'][0]->grpid;

                            if ($st['sales'][0]->description != null) {
                                $desc        = $st['sales'][0]->description;  
                            }

                            if ($st['sales'][0]->quantity != null || strlen($st['sales'][0]->quantity) > 0) {
                                $qty         = 2;
                            } else {
                                $qty         = 1; 
                            }

                            if ($st['sales'][0]->price != null || strlen($st['sales'][0]->price) > 0) {
                                $price       = $st['sales'][0]->price;
                            } else {
                                $price       = $st['subs'][0]->price;
                            }

                            // change here
                                if ($st['sales'][0]->shippingfee != null) {
                                    $shippingfee = $st['sales'][0]->shippingfee;
                                } else if (strlen($st['sales'][0]->shippingfee) > 0){
                                    $shippingfee = $st['sales'][0]->shippingfee;
                                } else {
                                    $shippingfee = $st['subs'][0]->shipping; 
                                }
                            // end recode

                            if ($st['sales'][0]->itemshipping != null || strlen($st['sales'][0]->itemshipping) > 0) {
                                $itemshipping = $st['sales'][0]->itemshipping;
                            } else {
                                $itemshipping = $st['subs'][0]->itemshipping; 
                            }

                            if ($st['sales'][0]->extended != null || strlen($st['sales'][0]->extended) > 0) {
                                $amount         = $st['sales'][0]->extended;
                            } else {
                                $amount         = $st['subs'][0]->extended*$qty;
                            }

                            if ($st['sales'][0]->totalcost != null || strlen($st['sales'][0]->totalcost) > 0) {
                                $totalcost = $st['sales'][0]->totalcost;
                            } else {
                                $totalcost = $st['subs'][0]->cost;
                            }

                            if ($st['sales'][0]->totalprofit != null || strlen($st['sales'][0]->totalprofit) > 0) {
                                $totalprofit = $st['sales'][0]->totalprofit;
                            } else {
                                $totalprofit = $st['subs'][0]->profit;
                            }

                            if ($st['sales'][0]->markup != null || strlen($st['sales'][0]->markup) > 0) {
                                // $totalmup = $st['subs'][0]->gp; 
                                $totalmup = $st['sales'][0]->markup; 
                            } else {
                                $totalmup = $st['subs'][0]->gp; 
                                // $totalmup = 0;
                            }

                            // mark 1
                            // if ($st['sales'][0]->totalmaincost != null || strlen($st['sales'][0]->totalmaincost) > 0) {
                            //     $totalmaincost = $st['sales'][0]->totalmaincost; 
                            // } else {
                            //     $totalmaincost = $st['subs'][0]->totalmaincost; 
                            // }
                            // 

                        } else {
                            $amount = $amount*$qty;
                        }

                        if (isset($showsettings['sub'])) {
                            $colspan = 4;
                            $addtd   = "";
                            // if ($intextbox) {
                                
                            //     $colspan = 4;
                            // }
                            if (!isset($showsettings['supplier'])) {
                                $colspan -= 1;
                            } else {
                                $addtd   .= "<td> &nbsp; </td>";
                            }
                
                            if (!isset($showsettings['supplier_num'])) {
                                $colspan -= 1;
                            } else {
                                $addtd   .= "<td> &nbsp; </td>";
                            }
                
                            if (!isset($showsettings['manu'])) {
                                $colspan -= 1;
                            } else {
                                $addtd   .= "<td> &nbsp; </td>";
                            }
                
                            if (!isset($showsettings['manu_num'])) {
                                $colspan -= 1;
                            } else {
                                $addtd   .= "<td> &nbsp; </td>";
                            }

                            $html .= "<tr class='substart_click hollow_row' data-tid='{$grpid}' style='border-top:1px solid #000;'>";
                            $html .= "<td> </td>";

                            if (isset($showsettings['profit'])) {
                                $html .= "<td style='text-align:right;' id='{$grpid}_profit'> ";
                                if ($intextbox) {
                                    $html .= "<strong>".number_format($totalprofit,2)."</strong>";
                                } else {
                                    $html .= number_format($totalprofit,2);
                                }
                                $html .= "</td>";
                            }

                            if (isset($showsettings['markup'])) {
                                $html .= "<td style='text-align:center; font-weight:bold;' id='{$grpid}_gp'>";
                                if ($intextbox) {
                                    $html .= $totalmup."%";
                                } else {
                                    $html .= $totalmup."%";
                                }
                                $html .= "</td>";
                            }

                            if (isset($showsettings['cost'])) {
                                $html .= "<td style='text-align:right; padding-right: 4px;' id='{$grpid}_cost'> ";
                                if ($intextbox) {
                                    $html .= "<strong>".number_format($totalcost,2)."</strong>";
                                } else {
                                    $html .= number_format($totalcost,2);
                                }
                                $html .= "</td>";
                            }

                            if (isset($showsettings['shipping'])) {
                                $html .= "<td class='number'>";
                                if ($intextbox) {
                                    $html .= "<input id = '{$grpid}_shippingfee' data-id='{$grpid}' data-fld='shippingfee' data-removecomma = 'true' style='font-weight:bold;' class='textsubtotal form-control' type='text' value='".number_format($shippingfee,2)."'/>";
                                } else {
                                    $html .= number_format($shippingfee,2);
                                }
                                $html .= "</td>";
                            }

                            if ($qt_window == true) {
                                $html .= "<td colspan='{$colspan}' style='text-align:right;'> <i> Sub Start </i> &nbsp; </td>";

                                if (isset($showsettings['description'])) {
                                    $html .= "<td class='number'>";
                                    if ($intextbox) {
                                        $html .= "<input id = '{$grpid}_desc' data-id='{$grpid}' data-fld='description' data-removecomma = 'false' style='text-align:left; font-weight:bold;' class='textsubtotal form-control bold_input' type='text' value='{$desc}'/>";
                                    } else {
                                        $html .= $desc;
                                    }
                                    $html .= "</td>";
                                }

                            } else {
                                $html .= $addtd;
                                $html .= "<td colspan='{$colspan}' style='text-align:left;'>".$desc."</td>";
                            }

                            if (isset($showsettings['qty'])) {
                                $html .= "<td style='text-align:center;' id='{$grpid}_qty'>";
                                if ($intextbox) {
                                    $html .="<input id = '{$grpid}_qty' data-id='{$grpid}' data-fld='quantity' data-removecomma = 'true' style='text-align:center; font-weight:bold;' class='textsubtotal form-control' type='text' value='{$qty}'/>";
                                } else {
                                    $html .= $qty;
                                }
                                $html .= "</td>";
                            }

                            // if (isset($showsettings['itemshipping'])) {
                            //     $html .= "<td class='number' id = '{$grpid}_itemshipping'>";
                            //     //if ($intextbox) {
                            //         // $html .= "<input id = '{$grpid}_shippingfee' data-id='{$grpid}' data-fld='shippingfee'  data-removecomma = 'true' style='font-weight:bold;' class='textsubtotal form-control' type='text' value='".number_format($shippingfee,2)."'/>";
                            //     //} else {
                            //         $html .= number_format($itemshipping,2);
                            //     //}
                            //     $html .= "</td>";
                            // }

                            // if (isset($showsettings['itemcost'])) {
                            //     $html .= "<td style='text-align:right; padding-right: 4px;' id='{$grpid}_totalmaincost'> ";
                            //     if ($intextbox) {
                            //         $html .= "<strong>".number_format($totalmaincost,2)."</strong>";
                            //     } else {
                            //         $html .= number_format($totalmaincost,2);
                            //     }
                            //     $html .= "</td>";
                            // }

                            // if (isset($showsettings['price'])) {
                            //     $html .= "<td class='number'>";
                            //     if ($intextbox) {
                            //         $html .= "<input id = '{$grpid}_price' data-id='{$grpid}' data-fld='price'  data-removecomma = 'true' style='font-weight:bold;' class='textsubtotal form-control' type='text' value='".number_format($price,2)."'/>";
                            //     } else {
                            //         $html .= number_format($price,2);
                            //     }
                            //     $html .= "</td>";
                            // }

                            if (isset($showsettings['price'])) { // price with tax :: textsubtotal
                                $html .= "<td class='number'>"; 
                                if ($intextbox) {
                                    $html .= "<input id = '{$grpid}_price' data-id='{$grpid}' data-fld='price'  data-removecomma = 'true' style='font-weight:bold;' class=' form-control' type='text' value='".number_format($pricewithtax,2)."'/>";
                                } else {
                                    $html .= number_format($pricewithtax,2);
                                }
                                $html .= "</td>";
                            }

                            if (isset($showsettings['extended'])) {
                                $html .= "<td class='number'>";
                                if ($intextbox) {
                                    $html .="<input id = '{$grpid}_amount' data-id='{$grpid}' data-fld='extended' data-removecomma = 'true' style='font-weight:bold;' class=' form-control' type='text' value='".number_format($amount,2)."'/>";
                                } else {
                                    $html .= number_format($amount,2); 
                                }
                                $html .= "</td>";
                            }

                            if ($qt_window == true) {
                                if (isset($showsettings['tax'])) {
                                    $html .= "<td> &nbsp; </td>";
                                    $html .= "<td> &nbsp; </td>";
                                }
                            }

                            $html .= "</tr>";
                        }

                        $count     = 1;

                            foreach($salesquoteitems as $si) {
                                $other_info      = $this->get_otherfields($si->itemid, ["Manufacturer","Supplier"]);

                                if ($si->grp_id === $aa->grp_id) { 
                                    $values = [
                                        "id"                => $si->itemid,
                                        "profit"            => $si->profit,
                                        "markupvalue"       => $si->markup,
                                        "ccost"             => $si->purchase_price,
                                        "totalmaincost"     => $si->totalmaincost,
                                        "extended"          => $si->extended,
                                        "amount"            => $si->amount,
                                        "tax_value"         => $si->itemtaxrate,
                                        "shippingfee"       => number_format($si->shippingfee,2),
                                        "itemshipping"      => $si->itemshipping,
                                        'subtotal_gpr'      => $si->grp_id,
                                        "expiry"            => $si->endoflife,
                                        "price"             => $si->price,
                                        'itemorderid'       => $si->itemorder,
                                        'status'            => $si->markupstatus,
                                        'otherinfo'         => $other_info
                                    ];

                                    if (!in_array($si->markup, $markups)) {
                                        array_push($markups,$si->markup);
                                    }

                                    $description = $si->item;
                                    $qty         = $si->quantity;

                                    if ($si->type == "comment" || $si->type == "blank") {
                                        $type      = $si->type;
                                        $include   = true;

                                        if ($aa->grp_id !== null) {
                                            if (isset($showsettings['subitem'])) {
                                                $include = true;
                                            } else {
                                                $include = false;
                                            }
                                        } else {
                                            $include = true;
                                        }

                                        if ($include) {
                                            $html     .= view('sales::salesquote.novalueitem', compact('values',"description","count","type","showsettings","intextbox"))->render();
                                        }

                                    } else {
                                        $include   = true;

                                        if ($aa->grp_id !== null) {
                                            if (isset($showsettings['subitem'])) {
                                                $include = true;
                                            } else {
                                                $include = false;
                                            }
                                        } else {
                                            $include = true;
                                        }

                                        if ($include) {
                                            $html     .= view('sales::salesquote.quote_item', compact('values',"description","qty","markups","datetoday","count","showsettings","intextbox","qt_window"))->render();
                                        }
                                    }
                                }

                            $count++;
                        }

                            if ($aa->grp_id !== null) {
                                if (isset($showsettings['sub'])) {
                                    $colspan_substop = 9;
                                    
                                    // if ($intextbox) {
                                    //     $colspan = 8;
                                    // }
                                    if (!isset($showsettings['profit'])) {
                                        $colspan_substop -= 1;
                                    }

                                    if (!isset($showsettings['markup'])) {
                                        $colspan_substop -= 1;
                                    }

                                    if (!isset($showsettings['cost'])) {
                                        $colspan_substop -= 1;
                                    }

                                    if (!isset($showsettings['supplier'])) {
                                        $colspan_substop -= 1;
                                    }
                        
                                    if (!isset($showsettings['supplier_num'])) {
                                        $colspan_substop -= 1;
                                    }
                        
                                    if (!isset($showsettings['manu'])) {
                                        $colspan_substop -= 1;
                                    }
                        
                                    if (!isset($showsettings['manu_num'])) {
                                        $colspan_substop -= 1;
                                    }

                                    if ($qt_window == true) {
                                        $substop = "Sub Stop";
                                    } else {
                                        $substop = null;
                                    }

                                    if ($substop != null) {
                                        $html .= "<tr class='hollow_row'>";
                                        $html .= "<td colspan='{$colspan_substop}' style='text-align:right; padding-top:4px; padding-bottom:4px;'> <i> {$substop} </i> &nbsp; </td>";
                                        
                                        if (isset($showsettings['description'])) {
                                            $html .= "<td> </td>";
                                        }
                                        if (isset($showsettings['qty'])) {
                                            $html .= "<td> </td>";
                                        }
                                        if (isset($showsettings['shipping'])) {
                                            $html .= "<td> </td>";
                                        }
                                        if (isset($showsettings['price'])) {
                                            $html .= "<td> </td>";
                                        }
                                        if (isset($showsettings['extended'])) {
                                            $html .= "<td> </td>";
                                        }
                                        if (isset($showsettings['tax'])) {
                                            $html .= "<td> </td>";
                                        }
                                        if (isset($showsettings['tax'])) {
                                            $html .= "<td> </td>";
                                        }
                                        
                                        $html .= "</tr>";
                                    }
                                }
                            }
                            $html .= "</tbody>";
                        }
                } else {
                    if (!in_array($aa->itemid,$postedid)) {
                        // $html .= "<tbody data-tid={$aa->grp_id}>";
                        array_push($postedid,$aa->itemid);

                        $count = 1;
                        $other_info      = $this->get_otherfields($aa->itemid, ["Manufacturer","Supplier"]);

                        $values          = [
                            "id"                => $aa->itemid,
                            "profit"            => $aa->profit,
                            "markupvalue"       => $aa->markup,
                            "ccost"             => $aa->purchase_price,
                            "extended"          => $aa->extended,
                            "amount"            => $aa->amount,
                            "tax_value"         => $aa->itemtaxrate,
                            "shippingfee"       => number_format($aa->shippingfee,2),
                            'subtotal_gpr'      => $aa->grp_id,
                            "expiry"            => $aa->endoflife,
                            "price"             => $aa->price,
                            'itemorderid'       => $aa->itemorder,
                            'status'            => $aa->markupstatus,
                            "totalmaincost"     => $aa->totalmaincost,
                            "itemshipping"      => number_format($aa->itemshipping,2),
                            'otherinfo'         => $other_info
                        ];

                        if (!in_array($aa->markup, $markups)) {
                            array_push($markups,$aa->markup);
                        }

                        $description = $aa->item;
                        $qty         = $aa->quantity;

                        if ($aa->type == "comment" || $aa->type == "blank") {
                            $type      = $aa->type;
                            $include   = true;

                            if ($aa->grp_id !== null) {
                                if (isset($showsettings['subitem'])) {
                                    $include = true;
                                } else {
                                    $include = false;
                                }
                            } else {
                                $include = true;
                            }

                            if ($include) {
                                $html     .= view('sales::salesquote.novalueitem', compact('values',"description","count","type","showsettings","intextbox"))->render();
                            }
                        } else {
                            $include   = true;

                            if ($aa->grp_id !== null) {
                                if (isset($showsettings['subitem'])) {
                                    $include = true;
                                } else {
                                    $include = false;
                                }
                            } else {
                                $include = true;
                            }

                            if ($include) {
                                $html     .= view('sales::salesquote.quote_item', compact('values',"description","qty","markups","datetoday","count","showsettings","intextbox","qt_window"))->render();
                            }

                        }
                        // $html .= "</tbody>";
                    }
                }
            }

            if (count($salesquoteitems) == 0) {
                $html .= "<tbody> </tbody>";
                // $html .= "<tbody> <tr> <td> &nbsp; </td> <td> &nbsp; </td> <td> &nbsp; </td> <td> &nbsp; </td> <td> &nbsp; </td> <td> &nbsp; </td> <td> &nbsp; </td> <td> &nbsp; </td> <td> &nbsp; </td> <td> &nbsp; </td> </tr> </tbody>";
            }
        return $html;
    }

    function copythis(Request $req) {
        return response()->json($this->make_a_copy($req->input("ids")));
    }

    function make_a_copy($ids) {
        $tables = [
            "sales_quotes_items",
            "sales_quotes_item_add_info",
            "sales_quotes_item_info_more_flds"
        ];

        $get  = null;
        $save = null;

        $html         = "";
        $other_info   = null;
        $shippingfee  = 0;
        $endoflife    = null;
        $markupstatus = null;

        $id           = null;
        $salesquoteid = null;
        
        $profit         = null;
        $markupvalue    = null;
        $ccost          = null;
        $extended       = null;
        $amount         = null;
        $tax_value      = null;
        $shippingfee    = null;
        $subtotal_gpr   = null;
        $expiry         = null;
        $price          = null;
        $itemorderid    = null;
        $status         = null;
        $otherinfo      = null;

        $itemshipping   = 0;
        $totalmaincost  = null;

        $showsettings    = $this->showsettings();
        $other_info      = null;
        $markups         = $this->get_markup();
        $datetoday       = date("Y-m-d");
        $count           = 1;
        $intextbox       = true;
        $description     = null;
        $qty             = null;

        foreach($ids as $is) {
            foreach($tables as $ts) {
                if ($ts == "sales_quotes_items") {
                    $get = DB::table($ts)->where("id",$is)->get()->toArray();

                    if (count($get) > 0) {
                        $get = (array) $get[0];
                        
                        unset($get['id']);
               
                        $salesquoteid = DB::table($ts)->insertGetId($get);

                        // $showsettings    = $this->showsettings();
                        
                        $markups         = $this->get_markup();
                        $count           = 1;
                        $description     = $get['item'];
                        $qty             = $get['quantity'];
                        
                        $profit            = $get['profit'];
                        $markupvalue       = $get['markup'];
                        $ccost             = $get['purchase_price'];
                        $extended          = $get['extended'];
                        $amount            = $get['amount'];
                        $tax_value         = $get['itemtaxrate'];

                        $totalmaincost     = $get['totalmaincost'];

                        $subtotal_gpr      = $get['grp_id'];
                        
                        $price             = $get['price'];
                        $itemorderid       = 1;
                        $otherinfo         = $other_info;
                    }
                }

                if ($ts == "sales_quotes_item_add_info") {
                    $get = DB::table($ts)->where("item_id",$is)->get()->toArray();

                    if (count($get) > 0) {
                        foreach($get as $g) {
                            $get = (array) $g;

                                unset($get['id']);
                                $get['item_id']         = $salesquoteid;

                            $id = DB::table($ts)->insertGetId($get);
                        }
                    }
                }

                if ($ts == "sales_quotes_item_info_more_flds") {
                    $get = DB::table($ts)->where("itemid",$is)->get()->toArray();

                    if (count($get) > 0) {
                        $get = (array) $get[0];

                        unset($get['id']);
                        $get['itemid'] = $salesquoteid;

                        $id = DB::table($ts)->insertGetId($get);

                        $shippingfee  = $get['shippingfee'];
                        $endoflife    = $get['endoflife'];
                        $markupstatus = $get['markupstatus'];
                        $itemshipping = $get['itemshipping'];
                    }
                }
            }
            
            $other_info      = $this->get_otherfields($salesquoteid, ["Manufacturer","Supplier"]);

            $values = [
                "id"                => $salesquoteid,
                "profit"            => $profit,
                "markupvalue"       => $markupvalue,
                "ccost"             => $ccost,
                "extended"          => $extended,
                "amount"            => $amount,
                "tax_value"         => $tax_value,
                "shippingfee"       => number_format($shippingfee,2),
                'subtotal_gpr'      => $subtotal_gpr,
                "expiry"            => $endoflife,
                "price"             => $price,
                'itemorderid'       => 1,
                'status'            => $markupstatus,
                "totalmaincost"     => $totalmaincost,
                "itemshipping"      => number_format($itemshipping,2),
                'otherinfo'         => $other_info
            ];

            $qt_window     = true;
            $html     .= view('sales::salesquote.quote_item', compact('values',"description","qty","markups","datetoday","count","showsettings","intextbox","qt_window"))->render();

        }
   
        return $html;
    }

    function showsettings($qid = false) {
        $defaults = ["profit"        => true,
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
                    "subitem"       => true,
                    "itemshipping"  => true,
                    "itemcost"      => true,
                    "pricewithtax"  => true
                ];
        
        if ($qid == false) {
            return $defaults;
        }
        
        $qs         = new SalesQuoteSetting();
        $settings   = $qs->salesquotesetting($qid);

        // if (count($settings) == 0) {
        //     return [];
        // }

        return $settings;
    }
    
    function settings($qid) {
        $qs     = new SalesQuoteSetting();
        $data   = $qs->salesquotesetting($qid);

        return view("sales::salesquote.settings", compact("data","qid"));
    }

    function saveview_sets(Request $req) {
        $qid    = $req->input('qid');
        $data   = $req->input("data");

        $save   = false;

        // delete
        $delete = SalesQuoteSetting::where("qid",$qid)->delete();

        // save again
        foreach($data as $d) {
            $qs             = new SalesQuoteSetting();
            $qs->key        = $d;
            $qs->qid        = $qid;
            $qs->value      = "on";
            $qs->created_by = Auth::id();
            $save           = $qs->save();
        }
        
        return response()->json($save);
    }

    function blursave(Request $req) {
        $fld        = $req->input("fld");
        $id         = (int) $req->input("id");
        $theval     = $req->input("theval");
        $table      = $req->input("table");
        $updatetbl  = $req->input("updatetbl");
     //   $itemkey    = $req->input("itemkey");

        // $fld      = "purchase_price";
        // $id       = 208;
        // $theval   = 1000;
        // $table    = "sales_quotes_items";
        
        // $up       = DB::table($table)->where("id",$id)->update([$fld=>$theval]);
        $vals        = DB::table($table)->where("id",$id)->get();
        $addtnl_info = DB::table("sales_quotes_item_info_more_flds")->where("itemid",$id)->get(); 

        $istaxable   = ($vals[0]->tax == 1)?false:true;
        $shippingfee = $addtnl_info[0]->shippingfee;
        $ccost       = $vals[0]->purchase_price;
        $markup      = $vals[0]->markup;
        $qty         = $vals[0]->quantity;
        $item        = $vals[0]->item;

        // 
        $saveshipping = false;
        switch($fld) {
            case "markup":         
                $markup      = $theval; 

                // update markup status
                $markupstatus     = "approved";

                if (!in_array($theval, $this->get_markup())) {
                    $markupstatus = "for approval";
                }

                $s_vals = [
                    "markupstatus" => $markupstatus
                ];
    
                $saveship = DB::table("sales_quotes_item_info_more_flds")->where("itemid",$id)->update($s_vals);

                break;
            case "purchase_price": 
                $ccost       = str_replace(",","",$theval); 
                break;
            case "quantity":       
                $qty         = $theval; 
                break;
            case "item":           
                $item        = $theval; 
                break;
            case "istaxable":      
                $istaxable   = $theval;
                break;
            case "shippingfee":
                $shippingfee  = str_replace(",","",$theval); 
                $saveshipping = true;
                break;
            case "markupstatus":
                $markupstatus = $theval;
                $savemarkupstatus = true;
                break;
            // case for shippingfee
        }

        $values = $this->calculate_item([
            "istaxable"    => $istaxable,
            "shippingfee"  => $shippingfee,
            "ccost"        => $ccost,
            "markup"       => $markup,
            "qty"          => $qty
        ]);
        
        /*
           "markupvalue"   => $markup,
            "price"         => $price, 
            "tax_in_dec"    => $taxprice,
            "tax_value"     => $tax_value,
            "tax_used"      => $taxation_id,
            "extended"      => $extended,
            "amount"        => $amount, // price with tax
            "profit"        => $profit,
            "totalprofit"   => $total_profit,
            "totalmaincost" => $totalmaincost,
            "itemshipping"  => $itemshipping,
            "ccost"         => $cost
        */
        // mark 2
        $valsss = [
                'profit'                         => $values['profit'],
                'markup'                         => $markup,
                'purchase_price'                 => $ccost,
                'item'                           => $item,
                'quantity'                       => $qty,
                'price'                          => $values['price'],
                'extended'                       => $values['extended'],
                'tax'                            => $values['tax_used'],
                'itemTaxPrice'                   => $values['tax_in_dec'],
                'itemTaxRate'                    => $values['tax_value'],
                'amount'                         => $values['amount'],
                "totalmaincost"                  => $values['totalmaincost']
            ];
            
            $up = DB::table($table)->where("id",$id)->update($valsss);

        if ($saveshipping) {
            $s_vals = [
                "shippingfee"  => $shippingfee,
                "itemshipping" => $values['itemshipping']
            ];

            $saveship = DB::table("sales_quotes_item_info_more_flds")->where("itemid",$id)->update($s_vals);
        }

        $valsss = [
            'profit'                         => number_format($values['profit'],2),
            'markup'                         => $markup,
            'purchase_price'                 => number_format($ccost,2),
            'item'                           => $item,
            'quantity'                       => $qty,
            'price'                          => number_format($values['price'],2),
            'extended'                       => number_format($values['extended'],2),
            'tax'                            => number_format($values['tax_used'],2),
            'itemTaxPrice'                   => number_format($values['tax_in_dec'],2),
            'itemTaxRate'                    => number_format($values['tax_value'],2),
            'amount'                         => number_format($values['amount'],2),
            'totalprofit'                    => number_format($values['totalprofit'],2),
            'totalmaincost'                  => number_format($values['totalmaincost'],2),
            'itemshipping'                   => number_format($values['itemshipping'],2),
        ];

        return response()->json($valsss);
    }

    function compute_subtotal(Request $req) {           
        $subs = $this->get_subtotal($req->input("grp_id"), true);

        array_map(function($a) {
            $a->cost   = number_format($a->cost,2);
            $a->price  = number_format($a->price,2);
            $a->profit = number_format($a->profit,2);
            $a->pricewithtax = number_format($a->pricewithtax,2);
            $a->extended = number_format($a->extended,2);
            $a->shipping = number_format($a->shipping,2);
            $a->itemshipping = number_format($a->itemshipping,2);

            return $a;
        }, $subs['subs']);

        return response()->json($subs);
    }

    function get_otherfields($item_id, $getwhat) {
        return itemadditionalinfo::where("item_id",$item_id)->whereIn("title",$getwhat)->get();
    }

    function get_inside_items($grpid) {
        return SalesQuoteItem::where("grp_id", $grpid)->orderBy("inside_sub_order","ASC")->get();
    }

    function get_subtotal($grpid, $update_subs_first = false) {
        // qty
        // purchase price
        // shipping fee
        // amount   
        // $grpid = 77;
        // mark sub
        $sql  = "select sum(quantity) as qty, 
                        sum(purchase_price) as purchase_price, 
                        sum(totalmaincost) as totalmaincost,
                        sum(price) as price, 
                        sum(amount) as pricewithtax,
                        sum(extended) as extended,
                        sum(purchase_price) as cost,
                        sum(profit) as profit,
                        sum(shippingfee) as shipping,
                        sum(itemshipping) as itemshipping,
                        (((sum(price)-sum(purchase_price))/sum(price))*100) as gp
                    from sales_quotes_items as sqi
                        left join sales_quotes_item_info_more_flds as sqiimf on sqi.id = sqiimf.itemid
                        where grp_id = '{$grpid}'";

        $subs = DB::select(DB::raw($sql));

        array_map(function($a) {
            $a->gp = number_format($a->gp,2);

            return $a;
        }, $subs);

        if ($update_subs_first == true) {
            // update subs here
                if (count($subs) >= 0) {
                    $update = salessubs::where("grpid",$grpid)->update([
                        "price"        => $subs[0]->price,
                        "extended"     => $subs[0]->extended,
                        "shippingfee"  => $subs[0]->shipping,
                        "itemshipping" => $subs[0]->itemshipping,
                        "totalprofit"  => $subs[0]->profit,
                        "totalcost"    => $subs[0]->cost,
                        "markup"       => $subs[0]->gp
                    ]);
                }
            // end 
        }

        $salessubs = salessubs::where("grpid",$grpid)->get();
        
        return ["subs"  => $subs,
                "sales" => $salessubs
               ];
        
    }

    function get_total(Request $req) {
        $quote_id = $req->input("quote_id");

        return response()->json( $this->compute_totality($quote_id) );
    }

    function compute_totality($quote_id) {
        // ->leftjoin("sales_quotes_item_info_more_flds","sales_quotes_items.id","=","sales_quotes_item_info_more_flds.itemid")
        $salesquoteitems = SalesQuoteItem::where('quote_id',$quote_id)
                                            ->leftjoin("sales_quotes_item_info_more_flds","sales_quotes_items.id","=","sales_quotes_item_info_more_flds.itemid")
                                            ->get();

        $totals = [
            "product"       => 0,
            "shipping"      => 0,
            "labor"         => 0,
            "profit"        => 0,
            "subtotal"      => 0,
            "tax"           => 0,
            "totalamount"   => 0
        ];

        foreach($salesquoteitems as $sqi) {
            if ($sqi->type == "subcustomitem" || $sqi->type == "subitem") {
                // $totals['product'] += $sqi->purchase_price; 
                $totals['product'] += $sqi->extended;
            }

            if ( $sqi->type == "labor" ) {
                $totals['labor']   += $sqi->price; // $sqi->price;
            }

            // if ($sqi->type == "shipping") {
            //     $totals['shipping'] += $sqi->price;
            // }

            $totals['shipping'] += $sqi->shippingfee;
            $totals['profit']   += $sqi->profit;
            $totals['tax']      += $sqi->itemtaxrate;
        }

        // $totals['subtotal']     = $totals['product']+$totals['shipping']+$totals['labor']+$totals['profit'];
        // $totals['totalamount']  = $totals['subtotal']+$totals['tax'];

        $totals['subtotal']      = $totals['product'];
        $totals['totalamount']   = $totals['subtotal'];

        $totals["product"]       = number_format($totals['product'],2);
        $totals["shipping"]      = number_format($totals['shipping'],2);
        $totals["labor"]         = number_format($totals['labor'],2);
        $totals["profit"]        = number_format($totals['profit'],2);
        $totals["subtotal"]      = number_format($totals['subtotal'],2);
        $totals["tax"]           = number_format($totals['tax'],2);
        $totals["totalamount"]   = number_format($totals['totalamount'],2);

        return $totals;
    }

    function viewitemdetails(Request $req) {
        $itemid         = $req->input("id");

        $quoteitems     = SalesQuoteItem::leftjoin("sales_quotes_item_info_more_flds","sales_quotes_items.id","=","sales_quotes_item_info_more_flds.itemid")
                                     ->where("sales_quotes_items.id", $itemid)->get();

        $additionalinfo = $this->getadd_info($itemid);

        return view("sales::salesquote.itemdetails", compact("quoteitems","additionalinfo","itemid"));
    }

    function add_newinfo(Request $req) {
        $title  = $req->input("title");
        $lbl    = $req->input("lbl");
        $desc   = $req->input("desc");
        $itemid = $req->input("itemid");

        $newitem              = new itemadditionalinfo();
        $newitem->item_id     = $itemid;
        $newitem->title       = $title;
        $newitem->label       = $lbl;
        $newitem->description = $desc;
        $newitem->save();

    //    $theid = $newitem->id;

        return response()->json($newitem);
    }
    
    function get_add_info_ajax(Request $req) {
        $itemid = $req->input("itemid");

        $html   = $this->getadd_info($itemid);
        return response()->json($html);
    }

    function getadd_info($itemid) {
        $additionalinfo = itemadditionalinfo::where("item_id",$itemid)->get();

        $html           = view("sales::salesquote.addtionalinfo", compact('additionalinfo'))->render();
        return $html;
    }

    function addshippingfee() {
        return view("sales::salesquote.shippingfee");
       //  return view("sales::salesquote.labor");
    }

    function addcomment() {
        return view("sales::salesquote.comment");
    }

    function create_subtotal(Request $req) {
        $ids         = (array) $req->input("ids");

        $subtotal_id = md5( date("mdyhisa") );
        
        $updated     = false;
        $first       = true;

        $original_itemorder = null;

        foreach($ids as $i) {
            $newsales     = new SalesQuoteItem();

            if ($first) {
                $original_itemorder = $newsales->get_the_current_itemorder($i);
                $first = false;
            }

            $inside_num   = $newsales->create_inner_number($subtotal_id);
            $updated      = SalesQuoteItem::where("id",$i)->update(["grp_id"=>$subtotal_id,"inside_sub_order"=>$inside_num,"itemorder"=>$original_itemorder]);
            
        }

        $salessubs              = new salessubs();
        $salessubs->grpid       = $subtotal_id;
        $salessubs->save();

        // save to salessubs
         $values = $this->get_subtotal($subtotal_id, true);

        // $salessubs              = new salessubs();
        // $salessubs->quoteid     = null;
        // $salessubs->grpid       = $subtotal_id;
        // $salessubs->description = null;
        // $salessubs->quantity    = 1;
        // $salessubs->price       = $values[0]->price;
        // $salessubs->extended    = $values[0]->extended;
        // $salessubs->shippingfee = $values[0]->shipping;
        // $salessubs->totalprofit = $values[0]->profit;
        // $salessubs->markup      = $values[0]->gp;
        // $salessubs->totalcost   = $values[0]->cost;
        // $salessubs->tax         = null;
        // $salessubs->save();
        
        return response()->json($updated);
    }

    function savethis(Request $req) {
        $data  = $req->input("data");
        $table = $req->input("table");

        $val  = (array) $data;

        if ($table == "sales_quotes_items") {

            $itemorder = $val['itemorder'];
            $grp_id    = (isset($val['grp_id'])?$val['grp_id']:null);

            $values = $this->calculate_item([
                 "istaxable"    => $val['taxable'],
                 "shippingfee"  => 0,
                 "ccost"        => $val['ccost'],
                 "markup"       => $val['markup'],
                 "qty"          => $val['quantity']
             ]);

             $v = [
                "type"                           => $val['type'],
                "quote_id"                       => $val['quote_id'],
                'profit'                         => $values['profit'],
                'markup'                         => $val['markup'],
                'purchase_price'                 => $val['ccost'],
                'item'                           => $val['item'],
                'quantity'                       => $val['quantity'],
                'price'                          => $values['price'],
                'extended'                       => $values['extended'],
                'tax'                            => $values['tax_used'],
                "grp_id"                         => $grp_id,
                'itemorder'                      => $itemorder,
                'itemTaxPrice'                   => $values['tax_in_dec'],
                'itemTaxRate'                    => $values['tax_value'],
                'amount'                         => $values['amount'],
            ];

             $val = $v;
        }

        $id   = DB::table($table)->insertGetId($val);

        return response()->json($id);
    }

    function update_fld(Request $req) {
        $fld    = $req->input("fld");
        $id     = (int) $req->input("id");
        $grpid  = $req->input("id");
        $theval = $req->input("theval");
        $table  = $req->input("table");

        $removecomma = $req->input("removecomma");

        $up     = false;

        if ($removecomma) {
            $theval = str_replace(",","",$theval); 
        }

        $ret        = [];
        if ($table == "salessubs") {
                $up     = DB::table($table)
                              ->updateOrInsert(
                                ["grpid" => $grpid],
                                [$fld => $theval]
                               );
                $ret = DB::table($table)->where("grpid",$grpid)->get()->toArray();
        } else {
            $up      = DB::table($table)->where("id",$id)->update([$fld=>$theval]);
            $ret     = DB::table($table)->where("id",$id)->get()->toArray();
        }

        return response()->json($ret);
    }

    function update_this(Request $req) {
        $fld    = $req->input("fld");
        $id     = (int) $req->input("id");
        $id_fld = $req->input("id_fld");
        $theval = $req->input("theval");
        $table  = $req->input("table");

        $up      = DB::table($table)->where($id_fld,$id)->update([$fld=>$theval]);
        
        return response()->json($up);
    }

    function removethis(Request $req) {
        $id    = $req->input("id");
        $tbl   = $req->input("tbl");
        $idfld = $req->input("idfld");

        $up  = DB::table($tbl)->where($idfld,$id)->delete();

        return response()->json($up);
    }

    function bulkremove(Request $req) {
        $id    = (array) $req->input("id");
        $tbl   = $req->input("tbl");
        $idfld = $req->input("idfld");

        $del   = false;
        // foreach($id as $i) {
            $del  = DB::table($tbl)->whereIn($idfld,$id)->delete();
        // }

        return response()->json($del);
    }

    function get_markup() {
        return [
            "65","75"
        ];
    }

    function email_quote(Request $req) {
        $quote_id      = $req->input("quote_id");
        // $quote_id      = 78;
        
        // check mark up
            if ( $this->check_markup($quote_id) > 0 ) {
                return response()->json("markup_error");
            }
        // end

        $quote_details = SalesQuote::where("id",$quote_id)->get();
        $customer      = contact::find($quote_details[0]->contact_person);
        $comp_details  = SalesAccount::where("id",$customer->account)->get();
        $email         = $customer->email;
        $id            = $customer->id;
        $address       = " ";
        $name          = $customer->name;

        // compute total
        $get_total     = $this->compute_totality($quote_id);
        $amount        = $get_total["totalamount"];
        $quoteNumber   = $quote_details[0]->quote_id;
        
        $subject       = "Quotation for {$name}";
        $url           = route("quote.displayquote", $quote_id);

        $uArr = [
                'customer_name'   => $name,
                'quote_number'    => \Modules\Sales\Entities\SalesQuote::quoteNumberFormat($quoteNumber),
                'salesquote_url'  => route('print.salesquote',\Illuminate\Support\Facades\Crypt::encrypt($quote_id)),
                'company_name'    => \Auth::user()->name,
                'company_logo'    => get_file(sidebar_logo()),
                'company_address' => $address,
                'amount'          => $amount,
                'online_link'     => $url,
                "thefile"         => route('quote.pdf',[$quote_id])
                ];

        $opportunity   = 0;
        $status        = 0;
        $tax           = 0;
        $shipping_prov = "test";
        $desc          = "test";
        $account       = 0;

 // var_dump($comp_details[0]->shipping_postalcode); return;
      
        $quote_ = [
                'quote_id'                  => $quote_id,
                'user_id'                   => $quote_details[0]->contact_person,
                'name'                      => $name,
                'opportunity'               => $opportunity,
                'status'                    => $status,
                'account'                   => $account,
                'amount'                    => $amount,
                'date_quoted'               => date("Y-m-d"),
                'quote_number'              => $quoteNumber,
                'billing_address'           => $comp_details[0]->billing_address,
                'billing_city'              => $comp_details[0]->billing_city,
                'billing_state'             => $comp_details[0]->billing_state,
                'billing_country'           => $comp_details[0]->billing_country,
                'billing_postalcode'        => $comp_details[0]->billing_postalcode,
                'shipping_address'          => $comp_details[0]->shipping_address,
                'shipping_city'             => $comp_details[0]->shipping_city,
                'shipping_state'            => $comp_details[0]->shipping_state,
                'shipping_country'          => $comp_details[0]->shipping_country,
                'shipping_postalcode'       => $comp_details[0]->shipping_postalcode,
                'billing_contact'           => $customer->phone,
                'shipping_contact'          => $customer->phone,
                'tax'                       => $tax,
                'shipping_provider'        => $shipping_prov,
                'description'               => $desc,
                'created_by'                => Auth::user()->id,
                'updated_by'                => Auth::user()->id,
                'converted_salesorder_id'   => 0,
                'workspace'                 => 1,
                'created_at'                => null,
                'updated_at'                => null,
            ];
            // var_dump($quote_); return;
            // $save = Quote::create($quote_);
        
        try
            {
                $resp = EmailTemplate::sendEmailTemplate('Salesquote Create', [$id => $email], $uArr,null, null,$subject);

                return response()->json($resp);
            }
        catch(\Exception $e)
            {
                $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
                return $response()->json($smtp_error);
            }
    }

    function updatetax(Request $req) {
        $item_id           = $req->input("id");
        $istaxable         = $req->input("istaxable");

     //   return response()->json($istaxable);

        $quoteitems = SalesQuoteItem::leftjoin("sales_quotes_item_info_more_flds","sales_quotes_items.id","=","sales_quotes_item_info_more_flds.itemid")
                                     ->where("sales_quotes_items.id", $item_id)->get();

        $values = $this->calculate_item([
            "istaxable"    => $istaxable,
            "shippingfee"  => $quoteitems[0]->shippingfee,
            "ccost"        => $quoteitems[0]->purchase_price,
            "markup"       => $quoteitems[0]->markup,
            "qty"          => $quoteitems[0]->quantity
        ]);

        $update = SalesQuoteItem::where("id",$item_id)->update([
            "tax"           => $values['tax_used'],
            "itemtaxprice"  => $values['tax_in_dec'],
            "itemtaxrate"   => $values['tax_value']
        ]);

        return response()->json( number_format($values['tax_value'],2));
        /*
            "markupvalue" => $markup_value,
            "price"       => $price, // price
            "tax_in_dec"  => $taxprice,
            "tax_value"   => $tax_value,
            "tax_used"    => $taxation_used,
            "extended"    => $price,
            "amount"      => $amount,
            "profit"      => $profit,
            "totalprofit" => $total_profit,
            "ccost"       => $cost
        */
    }

    function fortest(Request $req) {
        $qtid = 81;
        $sq_collection1 = SalesQuote::where("id",$qtid)->get();
        $sq_collection  = $sq_collection1->toArray();
        
        // var_dump($sq_collection);
        echo $sq_collection[0]['workspace'];
        // return response()->json($v);

        // var_dump($sq[0]->items->totalmaincost);
        // $qs     = new SalesQuoteSetting();
        
        // $data   = $qs->salesquotesetting('78');

        // var_dump($data);
        // return $this->make_a_copy([376,377,379]);
        // $subs  = $this->get_subtotal("3b15dd6ec9e138dcd3ec3d9f02942594", true);

        // array_map(function($a) {
        //     $a->profit   = number_format($a->profit,2);
        //     $a->price    = number_format($a->purchase_price,2);
        //     $a->amount   = number_format($a->amount,2);
        //     $a->cost     = number_format($a->cost,2);
        //     $a->extended = number_format($a->extended,2);

        //     return $a;
        // }, $subs['subs']);

        // var_dump($subs);
        // $otherinfo = $this->get_otherfields(369, ["Manufacturer","Supplier"]);

        // echo count($otherinfo);

        // var_dump (  );
        // $url = route("quote.displayquote", 77);
        // echo $url;
        // $values = $this->calculate_item([
        //     "istaxable"    => true,
        //     "shippingfee"  => "100",
        //     "ccost"        => "10",
        //     "markup"       => "65",
        //     "qty"          => "2"
        // ]);

        // $values['id'] = "1";
        // $description = "test";
        // $qty         = "2";
        // $markups     = $this->get_markup();
        // $count = 1;
        // $datetoday = date("Y-m-d");

        // $html  = view('sales::salesquote.quote_item', compact('values',"description","qty","markups","datetoday","count"))->render();
        // $html = "yawa";
        // echo $html;
        // return $html;
        // $table = "sales_quotes_items";
        // $id    = "207";
        // $fld   = "purchase_price";
        // $theval = "100";

        // $up     = DB::table($table)->where("id",$id)->update([$fld=>$theval]);
        // $vals   = DB::table($table)->where("id",$id)->get();

        // return response()->json($vals);
        // $this->get_subtotal(12);
        // echo substr( md5(date("mdyhisa")),0,8 );
        // echo "<br/>";
        // echo md5( date("mdyhisa") );

        // $customer = contact::find(1);
        // $address  = "test address";
        // $amount   = "1,000,000.00";

        // $uArr = [
        //         'customer_name'   => "test customer name",
        //         'quote_number'    => \Modules\Sales\Entities\SalesQuote::quoteNumberFormat(65),
        //         'salesquote_url'  => route('print.salesquote',\Illuminate\Support\Facades\Crypt::encrypt(77)),
        //         'company_name'    => \Auth::user()->name,
        //         'company_logo'    => get_file(sidebar_logo()),
        //         'company_address' => $address,
        //         'amount'          => $amount,
        //         'online_link'     => "https://google.com",
        //         "thefile"         => "https://static-ph.lamudi.com/static/media/bm9uZS9ub25l/774x491/c81bdc4e9e5574.webp"
        //         ];
 
        // try
        //     {
        //         $resp = EmailTemplate::sendEmailTemplate('Salesquote Create', [1 => "merto.alvinjay@gmail.com"], $uArr);
        //     }
        // catch(\Exception $e)
        //     {
        //         $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
        //     }

        //  $show   = ["profit"        => true,
        //            "markup"        => true,
        //            "cost"          => true,
        //            "supplier"      => true,
        //            "supplier_num"  => true,
        //            "manu"          => true,
        //            "manu_num"      => true,
        //            "description"   => true,
        //            "qty"           => true,
        //            "shipping"      => true,
        //            "price"         => true,
        //            "extended"      => true,
        //            "tax"           => true,
        //            "sub"           => true,
        //            "subitem"       => true
        // ];

        // echo $show['sub'];
        // return $this->get_quote_item(77,$show);

        // $curl = curl_init();

        // // set our url with curl_setopt()
        // curl_setopt($curl, CURLOPT_URL, "http://httpbin.org/ip");

        // // return the transfer as a string, also with setopt()
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        // // curl_exec() executes the started curl session
        // // $output contains the output string
        // $output = curl_exec($curl);

        // // close curl resource to free up system resources
        // // (deletes the variable made by curl_init)
        // curl_close($curl);

        // $ip = json_decode($output, true);

        // return $ip['origin'];
    }

    public function test_quote() {
        $show   = ["profit"        => true,
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

        return "<html><body><table>".$this->get_quote_item_test(78, $show )."</table></body></html>";
    }

public function get_quote_item_test($qid, $showsettings = null, $intextbox = false) {
    $salesquoteitems = SalesQuoteItem::where('quote_id',$qid)
                                        ->leftjoin("sales_quotes_item_info_more_flds","sales_quotes_items.id","=","sales_quotes_item_info_more_flds.itemid")
                                        ->orderBy("itemorder","ASC")
                                        ->get();
    
    $html            = "";
    $markups         = $this->get_markup();

    date_default_timezone_set('UTC');
    $datetoday = date("Y-m-d");

    $html  = "<thead>";
        $html .= "<tr>";
            $html .= "<th style='min-width: 5%;'>*</th>";

            if (isset($showsettings['profit'])) {
                $html .= "<th style='min-width: 5%; text-align:right;'>Profit</th>";
            }

            if (isset($showsettings['markup'])) {
                $html .= "<th style='min-width: 5%; text-align:center;'>Mark-Up</th>";
            }

            if (isset($showsettings['cost'])) {
                $html .= "<th style='min-width: 5%; text-align:right;'>Cost</th>";
            }

            if (isset($showsettings['supplier'])) {
                $html .= "<th style='min-width: 5%;'>Supplier</th>";
            }

            if (isset($showsettings['supplier_num'])) {
                $html .= "<th style='min-width: 5%;'>Supplier #</th>";
            }

            if (isset($showsettings['manu'])) {
                $html .= "<th style='min-width: 5%;'>MFG</th>";
            }

            if (isset($showsettings['manu_num'])) {
                $html .= "<th style='min-width: 5%;'>MFG #</th>";
            }

            if (isset($showsettings['description'])) {
                $html .= "<th>Description</th>";
            }

            if (isset($showsettings['qty'])) {
                $html .= "<th style='min-width: 5%; text-align:center;'>QTY</th>";
            }

            if (isset($showsettings['shipping'])) {
                $html .= "<th style='min-width: 5%; text-align:right;'>Shipping</th>";
            }

            if (isset($showsettings['price'])) {
                $html .= "<th style='min-width: 5%; text-align:right;'>Price</th>";
            }

            if (isset($showsettings['extended'])) {
                $html .= "<th style='min-width: 5%; text-align:right;'>Extended</th>";
            }

            if (isset($showsettings['tax'])) {
                $html .= "<th style='min-width: 5%; text-align:right;'>Tax</th>";
                $html .= "<th> </th>";
            }

            $html .= "</tr>";
    $html .= "</thead>";

    $postedgroup = [];
    $postedid    = [];

    foreach($salesquoteitems as $aa) {
        
        $html .= "<tbody data-tid={$aa->grp_id}>";

        if ($aa->grp_id !== null) {

            if (!in_array($aa->grp_id,$postedgroup)) {

                // if not posted yet
                array_push($postedgroup,$aa->grp_id);

                $st          = $this->get_subtotal($aa->grp_id);
                
                $grpid       = $aa->grp_id;
                $desc        = null;
                $qty         = 1;
                $price       = $st['subs'][0]->price;

                $shippingfee = 0; 
                $amount      = $st['subs'][0]->extended; 

                $profit      = $st['subs'][0]->profit;
                $cost        = $st['subs'][0]->cost;
                $markup      = 0;

                $totalprofit = 0;
                $totalcost   = 0;
                $totalmup    = 0;

                if (count($st['sales']) > 0) {
                    $grpid       = $st['sales'][0]->grpid;
            
                    if ($st['sales'][0]->description != null) {
                        $desc        = $st['sales'][0]->description;  
                    }

                    if ($st['sales'][0]->quantity != null || strlen($st['sales'][0]->quantity) > 0) {
                        $qty         = 2;
                    } else {
                        $qty         = 1; 
                    }

                    if ($st['sales'][0]->price != null || strlen($st['sales'][0]->price) > 0) {
                        $price       = $st['sales'][0]->price;
                    } else {
                        $price       = $st['subs'][0]->price;
                    }

                    if ($st['sales'][0]->shippingfee != null || strlen($st['sales'][0]->shippingfee) > 0) {
                        $shippingfee = $st['sales'][0]->shippingfee;
                    } else {
                        $shippingfee = $st['subs'][0]->shipping; 
                    }

                    if ($st['sales'][0]->extended != null || strlen($st['sales'][0]->extended) > 0) {
                        $amount         = $st['sales'][0]->extended;
                    } else {
                        $amount         = $st['subs'][0]->extended*$qty;
                    }

                    if ($st['sales'][0]->totalcost != null || strlen($st['sales'][0]->totalcost) > 0) {
                        $totalcost = $st['sales'][0]->totalcost;
                    } else {
                        $totalcost = $st['subs'][0]->cost;
                    }

                    if ($st['sales'][0]->totalprofit != null || strlen($st['sales'][0]->totalprofit) > 0) {
                        $totalprofit = $st['sales'][0]->totalprofit;
                    } else {
                        $totalprofit = $st['subs'][0]->profit;
                    }

                    if ($st['sales'][0]->markup != null || strlen($st['sales'][0]->markup) > 0) {
                        $totalmup = $st['subs'][0]->gp; 
                    } else {
                        $totalmup = 0;
                    }

                } else {
                    $amount = $amount*$qty;
                }

                if (isset($showsettings['sub'])) {
                    $colspan = 4;
                    if ($intextbox) {
                        $colspan = 1;
                    }
                    $html .= "<tr class='substart_click' data-tid='{$grpid}'>";
                    $html .= "<td> </td>";

                    if (isset($showsettings['profit'])) {
                            $html .= "<td style='text-align:right;' id='{$grpid}_profit'> ";
                                if (!$intextbox) {
                                    $html .= "<strong>".number_format($totalprofit,2)."</strong>";
                                } else {
                                    $html .= number_format($totalprofit,2);
                                }
                            $html .= "</td>";
                        }

                        if (isset($showsettings['markup'])) {
                            $html .= "<td style='text-align:center; font-weight:bold;' id='{$grpid}_gp'>";
                                if (!$intextbox) {
                                    $html .= $totalmup."%";
                                } else {
                                    $html .= $totalmup."%";
                                }
                            $html .= "</td>";
                        }

                        if (isset($showsettings['cost'])) {
                            $html .= "<td style='text-align:right; padding-right: 4px;' id='{$grpid}_cost'> ";
                                if (!$intextbox) {
                                    $html .= "<strong>".number_format($totalcost,2)."</strong>";
                                } else {
                                    $html .= number_format($totalcost,2);
                                }
                            $html .= "</td>";
                        }
                    
                        $html .= "<td colspan='{$colspan}' style='text-align:right;'> <i> Sub Start </i> &nbsp; </td>";

                        if (isset($showsettings['description'])) {
                            $html .= "<td class='number'>";
                                if (!$intextbox) {
                                    $html .= "<input id = '{$grpid}_desc' data-id='{$grpid}' data-fld='description' data-removecomma = 'false' style='text-align:left; font-weight:bold;' class='textsubtotal form-control bold_input' type='text' value='{$desc}'/>";
                                } else {
                                    $html .= $desc;
                                }
                            $html .= "</td>";
                        }

                        if (isset($showsettings['qty'])) {
                            $html .= "<td style='text-align:center;' id='{$grpid}_qty'>";
                                if (!$intextbox) {
                                    $html .="<input id = '{$grpid}_qty' data-id='{$grpid}' data-fld='quantity' data-removecomma = 'true' style='text-align:center; font-weight:bold;' class='textsubtotal form-control' type='text' value='{$qty}'/>";
                                } else {
                                    $html .= $qty;
                                }
                            $html .= "</td>";
                        }

                        if (isset($showsettings['shipping'])) {
                            $html .= "<td class='number'>";
                                if (!$intextbox) {
                                    $html .= "<input id = '{$grpid}_shippingfee' data-id='{$grpid}' data-fld='shippingfee'  data-removecomma = 'true' style='font-weight:bold;' class='textsubtotal form-control' type='text' value='".number_format($shippingfee,2)."'/>";
                                } else {
                                    $html .= $shippingfee;
                                }
                            $html .= "</td>";
                        }

                        if (isset($showsettings['price'])) {
                            $html .= "<td class='number'>";
                                if (!$intextbox) {
                                    $html .= "<input id = '{$grpid}_price' data-id='{$grpid}' data-fld='price'  data-removecomma = 'true' style='font-weight:bold;' class='textsubtotal form-control' type='text' value='".number_format($price,2)."'/>";
                                } else {
                                    $html .= $price;
                                }
                            $html .= "</td>";
                        }

                        if (isset($showsettings['extended'])) {
                            $html .= "<td class='number'>";
                                if (!$intextbox) {
                                    $html .="<input id = '{$grpid}_amount' data-id='{$grpid}' data-fld='extended' data-removecomma = 'true' style='font-weight:bold;' class='textsubtotal form-control' type='text' value='".$amount."'/>";
                                } else {
                                    $html .= $amount; 
                                }
                            $html .= "</td>";
                        }
                        $html .= "<td> &nbsp; </td>";
                        $html .= "<td> &nbsp; </td>";
                    $html .= "</tr>";
                }

                $count     = 1;
                
                //get_inside_items($grpid)
                foreach($this->get_inside_items($aa->grp_id) as $si) {
                    $other_info      = $this->get_otherfields($si->itemid, ["Manufacturer","Supplier"]);

                    if ($si->grp_id === $aa->grp_id) { 
                        $values          = [
                            "id"                => $si->itemid,
                            "profit"            => $si->profit,
                            "markupvalue"       => $si->markup,
                            "ccost"             => $si->purchase_price,
                            "extended"          => $si->extended,
                            "amount"            => $si->amount,
                            "tax_value"         => $si->itemtaxrate,
                            "shippingfee"       => number_format($si->shippingfee,2),
                            'subtotal_gpr'      => $si->grp_id,
                            "expiry"            => $si->endoflife,
                            "price"             => $si->price,
                            'itemorderid'       => $si->itemorder,
                            'status'            => $si->markupstatus,
                            'otherinfo'         => $other_info
                        ];

                        if (!in_array($si->markup, $markups)) {
                            array_push($markups,$si->markup);
                        }

                        $description = $si->item;
                        $qty         = $si->quantity;
                        
                        if ($si->type == "comment" || $si->type == "blank") {
                            $type      = $si->type;
                            $include   = true;

                            if ($aa->grp_id !== null) {
                                if (isset($showsettings['subitem'])) {
                                    $include = true;
                                } else {
                                    $include = false;
                                }
                            } else {
                                $include = true;
                            }

                            if ($include) {
                                $html     .= view('sales::salesquote.novalueitem', compact('values',"description","count","type","showsettings"))->render();
                            }
                        } else {
                            $include   = true;

                            if ($aa->grp_id !== null) {
                                if (isset($showsettings['subitem'])) {
                                    $include = true;
                                } else {
                                    $include = false;
                                }
                            } else {
                                $include = true;
                            }

                            if ($include) {
                                $html     .= view('sales::salesquote.quote_item', compact('values',"description","qty","markups","datetoday","count","showsettings","intextbox"))->render();
                            }
                        }
                    }

                    $count++;
                }

                if ($aa->grp_id !== null) {
                    if (isset($showsettings['sub'])) {
                        $colspan = 8;
                        if ($intextbox) {
                            $colspan = 1;
                        }

                        $html .= "<tr>";
                            $html .= "<td colspan='{$colspan}' style='text-align:right; padding-top:4px; padding-bottom:4px;'> <i> Sub Stop </i> &nbsp; </td>";
                            $html .= "<td> </td>";
                            $html .= "<td> </td>";
                            $html .= "<td> </td>";
                            $html .= "<td> </td>";
                            $html .= "<td> </td>";
                            $html .= "<td> </td>";
                            $html .= "<td> &nbsp; </td>";
                        $html .= "</tr>";
                    }
                }

            }
        } else {
            if (!in_array($aa->itemid,$postedid)) {
                
                array_push($postedid,$aa->itemid);

                $count = 1;
                $other_info      = $this->get_otherfields($aa->itemid, ["Manufacturer","Supplier"]);

                        $values          = [
                            "id"                => $aa->itemid,
                            "profit"            => $aa->profit,
                            "markupvalue"       => $aa->markup,
                            "ccost"             => $aa->purchase_price,
                            "extended"          => $aa->extended,
                            "amount"            => $aa->amount,
                            "tax_value"         => $aa->itemtaxrate,
                            "shippingfee"       => number_format($aa->shippingfee,2),
                            'subtotal_gpr'      => $aa->grp_id,
                            "expiry"            => $aa->endoflife,
                            "price"             => $aa->price,
                            'itemorderid'       => $aa->itemorder,
                            'status'            => $aa->markupstatus,
                            'otherinfo'         => $other_info
                        ];

                        if (!in_array($aa->markup, $markups)) {
                            array_push($markups,$aa->markup);
                        }

                        $description = $aa->item;
                        $qty         = $aa->quantity;
                        
                        if ($aa->type == "comment" || $aa->type == "blank") {
                            $type      = $aa->type;
                            $include   = true;

                            if ($aa->grp_id !== null) {
                                if (isset($showsettings['subitem'])) {
                                    $include = true;
                                } else {
                                    $include = false;
                                }
                            } else {
                                $include = true;
                            }

                            if ($include) {
                                $html     .= view('sales::salesquote.novalueitem', compact('values',"description","count","type","showsettings"))->render();
                            }
                        } else {
                            $include   = true;

                            if ($aa->grp_id !== null) {
                                if (isset($showsettings['subitem'])) {
                                    $include = true;
                                } else {
                                    $include = false;
                                }
                            } else {
                                $include = true;
                            }

                            if ($include) {
                                $html     .= view('sales::salesquote.quote_item', compact('values',"description","qty","markups","datetoday","count","showsettings","intextbox"))->render();
                            }
                        }
            }
            $html .= "</tbody>";
        }
    }

    return $html;
}

}