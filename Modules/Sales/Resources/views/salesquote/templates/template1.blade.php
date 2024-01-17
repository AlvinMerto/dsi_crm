<!DOCTYPE html>
<html lang="en" dir="{{ $settings['site_rtl'] == 'on'?'rtl':''}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{Modules\Sales\Entities\SalesQuote::quoteNumberFormat($salesquotes->quote_id,$salesquotes->created_by,$salesquotes->workspace)}} | {{ !empty(company_setting('title_text',$salesquotes->created_by,$salesquotes->workspace)) ? company_setting('title_text',$salesquotes->created_by,$salesquotes->workspace) : (!empty(admin_setting('title_text')) ? admin_setting('title_text') :'WorkDo') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <style type="text/css">
        html[dir="rtl"]  {
            letter-spacing: 0.1px;
        }
        :root {
            --theme-color: {{$color}};
            --white: #ffffff;
            --black: #000000;
        }
        body {
            font-family: 'Lato', sans-serif;
        }

        p,
        li,
        ul,
        ol {
            margin: 0;
            padding: 0;
            list-style: none;
            line-height: 1.5;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table tr th {
            padding: 0.75rem;
            text-align: left;
        }

        table tr td {
            padding: 0.50rem;
            text-align: left;
        }

        table th small {
            display: block;
            font-size: 12px;
        }

        .invoice-preview-main {
            max-width: 700px;
            width: 100%;
            margin: 0 auto;
            background: #ffff;
            box-shadow: 0 0 10px #ddd;
        }

        .invoice-logo {
            max-width: 200px;
            width: 100%;
        }

        .invoice-header table td {
            padding: 15px 30px;
        }

        .text-right {
            text-align: right;
        }

        .no-space tr td {
            padding: 0;
            white-space: nowrap;
        }

        .vertical-align-top td {
            vertical-align: top;
        }

        .view-qrcode {
            max-width: 139px;
            height: 139px;
            width: 100%;
            margin-left: auto;
            margin-top: 15px;
            background: var(--white);
            padding: 13px;
            border-radius: 10px;
        }

        .view-qrcode img{
            width: 100%;
            height: 100%;
        }

        .invoice-body {
            padding: 30px 15px 0;
        }

        table.add-border tr {
            border-top: 1px solid var(--theme-color);
        }

        tfoot tr:first-of-type {
            border-bottom: 1px solid var(--theme-color);
        }

        .total-table tr:first-of-type td {
            padding-top: 0;
        }

        .total-table tr:first-of-type {
            border-top: 0;
        }

        .sub-total {
            padding-right: 0;
            padding-left: 0;
        }

        .border-0 {
            border: none !important;
        }

        .invoice-summary td,
        .invoice-summary th {
            font-size: 12px;
            font-weight: 600;
        }

        .total-table td:last-of-type {
            width: 146px;
        }

        .invoice-footer {
            padding: 15px 20px;
        }

        .itm-description td {
            padding-top: 0;
        }
        html[dir="rtl"] table tr td,
        html[dir="rtl"] table tr th{
            text-align: right;
        }
        html[dir="rtl"]  .text-right{
            text-align: left;
        }
        html[dir="rtl"] .view-qrcode{
            margin-left: 0;
            margin-right: auto;
        }
        p:not(:last-of-type){
            margin-bottom: 15px;
        }
        .invoice-summary p{
            margin-bottom: 0;
        }
    </style>
</head>

<body>
<div class="invoice-preview-main" id="boxes">
    <div class="invoice-header" style="background-color: var(--theme-color); color: {{$font_color}};">
        <table>
            <tbody>
            <tr>
                <td>
                    <img class="invoice-logo" src="{{$img}}" alt="">
                </td>
                <td class="text-right">
                    <h3 style="text-transform: uppercase; font-size: 40px; font-weight: bold; ">{{ __('Quote')}}</h3>
                </td>
            </tr>
            </tbody>
        </table>
        <table class="vertical-align-top">
            <tbody>
            <tr>
                <td>
                    <p>
                        @if(!empty($settings['company_name'])){{$settings['company_name']}}@endif<br>
                        @if(!empty($settings['company_email'])){{$settings['company_email']}}@endif<br>
                        @if(!empty($settings['company_telephone'])){{$settings['company_telephone']}}@endif<br>
                        @if(!empty($settings['company_address'])){{$settings['company_address']}}@endif
                        @if(!empty($settings['company_city'])) <br> {{$settings['company_city']}}, @endif
                        @if(!empty($settings['company_state'])){{$settings['company_state']}}@endif<br>
                        @if(!empty($settings['company_country'])) {{$settings['company_country']}}@endif
                        @if(!empty($settings['company_zipcode'])) - {{$settings['company_zipcode']}}@endif<br>
                        @if(!empty($settings['registration_number'])){{__('Registration Number')}} : {{$settings['registration_number']}} @endif<br>
                        @if(!empty($settings['tax_type']) && !empty($settings['vat_number'])){{$settings['tax_type'].' '. __('Number')}} : {{$settings['vat_number']}} <br>@endif
                    </p>
                </td>
                <td style="width: 60%;">
                    <table class="no-space">
                        <tbody>
                        <tr>
                            <td>{{ __('Number: ')}}</td>
                            <td class="text-right">{{Modules\Sales\Entities\SalesQuote::quoteNumberFormat($salesquotes->quote_id,$salesquotes->created_by,$salesquotes->workspace)}}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Issue Date:')}}</td>
                            <td class="text-right">{{$salesquotes->issue_date,$salesquotes->created_by,$salesquotes->workspace}}</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="invoice-body">
        <table>
            <tbody>
            <tr>
                <td>
                    <strong style="margin-bottom: 10px; display:block;">{{ __('Bill To')}}:</strong>
                    <p>
                        {{!empty($customer->name)?$customer->name:''}}<br>
                        {{!empty($customer->email)?$customer->email:''}}<br>
                        {{!empty($customer->mobile)?$customer->mobile:''}}<br>
                        {{!empty($customer->bill_address)?$customer->bill_address:''}}<br>
                        {{!empty($customer->bill_city)?$customer->bill_city:'' . ', '}} {{!empty($customer->bill_state)?$customer->bill_state:''}},{{!empty($customer->bill_country)?$customer->bill_country:''}}<br>
                        {{!empty($customer->bill_zip)?$customer->bill_zip:''}}
                    </p>
                </td>
{{--                @if($settings['quote_shipping_display']=='on')--}}
                    <td class="text-right">
                        <strong style="margin-bottom: 10px; display:block;">{{__('Ship To')}}:</strong>
                        <p>
                            {{!empty($customer->name)?$customer->name:''}}<br>
                            {{!empty($customer->email)?$customer->email:''}}<br>
                            {{!empty($customer->mobile)?$customer->mobile:''}}<br>
                            {{!empty($customer->address)?$customer->address:''}}<br>
                            {{!empty($customer->city)?$customer->city:'' . ', '}},{{!empty($customer->state)?$customer->state:''}},{{!empty($customer->country)?$customer->country:''}}<br>
                            {{!empty($customer->zip)?$customer->zip:''}}
                        </p>
                    </td>
{{--                @endif--}}
            </tr>
            </tbody>
        </table>
        <table class="add-border invoice-summary" style="margin-top: 30px;align-items: center;">
            <thead style="background-color: var(--theme-color);color: black;">
                <tr>
                    <th>{{__('Profit')}}</th>
                    <th>{{__('Markup')}}</th>
                    <th>{{__('Cost')}}</th>
                    <th>{{__('Supplier')}}</th>
                    @if(\Auth::user()->type!="client" || $setting['supplier_part_number']=="on")
                        <th>{{__('Supplier #')}}</th>
                    @endif
                    <th>{{__('MFG')}}</th>
                    @if(\Auth::user()->type!="client" || $setting['manufacturer_part_number']=="on")
                        <th>{{__('MFG#')}}</th>
                    @endif
                    <th>{{__('Description')}}</th>
                    <th>{{__('QTY')}}</th>
                    <th>{{__('Price')}}</th>
                    <th>{{__('Extended')}}</th>
{{--                    <th>{{__('Tax')}}</th>--}}
                </tr>
            </thead>
            <tbody>
{{--            @dd($setting)--}}
            @if(isset($salesquotes->itemData) && count($salesquotes->itemData) > 0)
                @foreach($salesquotes->itemData as $key => $item)
                    @if($item->type=="substart")
                        <tr>
                            <td>{{$item->profit}}</td>
                            <td>{{$item->markup}}</td>
                            <td>{{$item->purchase_price}}</td>
                            <td></td>
                            @if(\Auth::user()->type!="client" || $setting['supplier_part_number']=="on")
                                <td></td>
                            @endif
                            <td></td>
                            @if(\Auth::user()->type!="client" || $setting['manufacturer_part_number']=="on")
                                <td>{{$item->supplier_name}}</td>
                            @endif
                            <td>{{$item->subtotal_description}}</td>
                            <td>{{$item->subtotal_quantity}}</td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->extended}}</td>
{{--                            <td></td>--}}
                        </tr>
                    @elseif($item->type=="subitem")
                        @if(\Auth::user()->type!="client" || $setting['text_within_groups']=="on")
                            <tr>
                                <td>{{$item->profit}}</td>
                                <td>{{$item->markup}}</td>
                                <td>{{$item->purchase_price}}</td>
                                <td>{{$item->supplier_name}}</td>
                                @if(\Auth::user()->type!="client" || $setting['supplier_part_number']=="on")
                                    <td>{{$item->supplier_part_number}}</td>
                                @endif
                                <td>{{$item->manufacturer_name}}</td>
                                @if(\Auth::user()->type!="client" || $setting['manufacturer_part_number']=="on")
                                    <td>{{$item->manufacturer_part_number}}</td>
                                @endif
                                <td>{{$item->item}}</td>
                                <td>{{$item->quantity}}</td>
                                @if(\Auth::user()->type!="client" || $setting['subtotal']=="on")
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->extended}}</td>
                                @endif
                            </tr>
                        @endif
                    @elseif($item->type=="subcustomitem")

                        @if(\Auth::user()->type!="client" || $setting['text_within_groups']=="on")
                            <tr>
                                <td>{{$item->profit}}</td>
                                <td>{{$item->markup}}</td>
                                <td>{{$item->purchase_price}}</td>
                                <td>{{$item->supplier_name}}</td>
                                @if(\Auth::user()->type!="client" || $setting['supplier_part_number']=="on")
                                    <td>{{$item->supplier_part_number}}</td>
                                @endif
                                <td>{{$item->manufacturer_name}}</td>
                                @if(\Auth::user()->type!="client" || $setting['manufacturer_part_number']=="on")
                                    <td>{{$item->manufacturer_part_number}}</td>
                                @endif
                                <td>{{$item->item}}</td>
                                <td>{{$item->quantity}}</td>
                                @if(\Auth::user()->type!="client" || $setting['subtotal']=="on")
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->extended}}</td>
                                @endif
                            </tr>
                        @endif

                    @elseif($item->type=="subcomment")
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            @if(\Auth::user()->type!="client" || $setting['supplier_part_number']=="on")
                                <td></td>
                            @endif
                            <td></td>
                            @if(\Auth::user()->type!="client" || $setting['manufacturer_part_number']=="on")
                                <td></td>
                            @endif
                            <td>{{$item->sample_comment}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
{{--                            <td></td>--}}
                        </tr>
                    @elseif($item->type=="subblank")
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            @if(\Auth::user()->type!="client" || $setting['supplier_part_number']=="on")
                                <td></td>
                            @endif
                            <td></td>

                            @if(\Auth::user()->type!="client" || $setting['manufacturer_part_number']=="on")
                                <td></td>
                            @endif
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
{{--                            <td></td>--}}
                        </tr>
                    @elseif($item->type=="substop")
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            @if(\Auth::user()->type!="client" || $setting['supplier_part_number']=="on")
                                <td></td>
                            @endif
                            <td></td>
                            @if(\Auth::user()->type!="client" || $setting['manufacturer_part_number']=="on")
                                <td>"SubStop"</td>
                            @endif
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
{{--                            <td></td>--}}
                        </tr>
                    @endif
                @endforeach
            @else
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>
                        <p>-</p>
                        <p>-</p>
                    </td>
                    <td>-</td>
                    <td>-</td>
                <tr class="border-0 itm-description ">
                    <td colspan="6">-</td>
                </tr>
                </tr>
            @endif
            </tbody>
            <tfoot>
{{--            <tr>--}}
{{--                <td>{{__('Total')}}</td>--}}
{{--                <td>{{$salesquotes->totalQuantity}}</td>--}}
{{--                <td>{{currency_format_with_sym($quote->totalRate,$quote->created_by,$quote->workspace)}}</td>--}}
{{--                <td>{{currency_format_with_sym($quote->totalDiscount,$quote->created_by,$quote->workspace)}}</td>--}}
{{--                <td>{{currency_format_with_sym($quote->totalTaxPrice,$quote->created_by,$quote->workspace) }}</td>--}}
{{--                <td>{{currency_format_with_sym($quote->getSubTotal(),$quote->created_by,$quote->workspace)}}</td>--}}
{{--            </tr>--}}
            <tr>
                @php
                    $colspan=9;
                    if(\Auth::user()->type=="client" && $setting['manufacturer_part_number']=="on")
                    {
                        $colspan=$colspan-1;
                    }
                    if(\Auth::user()->type=="client" && $setting['supplier_part_number']=="on")
                    {
                        $colspan=$colspan-1;
                    }
                @endphp
                @if(\Auth::user()->type!="client" || $setting['grand_total']=="on")
                    <td colspan="{{$colspan}}"></td>
                    <td colspan="2" class="sub-total">
                        <table class="total-table">
                            @if($salesquotes->totalcost())
                                <tr>
                                    <td>{{__('Total Cost')}}:</td>
                                    <td>{{currency_format_with_sym($salesquotes->totalcost(),$salesquotes->created_by,$salesquotes->workspace)}}</td>
                                </tr>
                            @endif
                            @if($salesquotes->totalcost())
                                <tr>
                                    <td>{{__('Product')}}:</td>
                                    <td>{{currency_format_with_sym($salesquotes->totalcost()- (!empty( $salesquotes->shipping_cost() ) ? $salesquotes->shipping_cost():0) -  (!empty( $salesquotes->labor_cost() ) ? $salesquotes->labor_cost():0),$salesquotes->created_by,$salesquotes->workspace)}}</td>
                                </tr>
                            @endif
                            @if(\Auth::user()->type!="client" || $setting['shipping_total']=="on")
                                @if($salesquotes->shipping_cost())
                                    <tr>
                                        <td>{{__('Shipping')}}:</td>
                                        <td>{{currency_format_with_sym($salesquotes->shipping_cost(),$salesquotes->created_by,$salesquotes->workspace)}}</td>
                                    </tr>
                                @endif
                            @endif
                            @if(\Auth::user()->type!="client" || $setting['labor_total']=="on")
                                @if($salesquotes->labor_cost())
                                    <tr>
                                        <td>{{__('Labor')}}:</td>
                                        <td>{{currency_format_with_sym($salesquotes->labor_cost(),$salesquotes->created_by,$salesquotes->workspace)}}</td>
                                    </tr>
                                @endif
                            @endif
                            @if($salesquotes->totalProfit())
                                <tr>
                                    <td>{{__('Total Profit')}}:</td>
                                    <td>{{currency_format_with_sym($salesquotes->totalProfit(),$salesquotes->created_by,$salesquotes->workspace)}}</td>
                                </tr>
                            @endif
                            @if($salesquotes->totalgp())
                                <tr>
                                    <td>{{__('GP')}}:</td>
                                    <td>{{currency_format_with_sym($salesquotes->totalgp(),$salesquotes->created_by,$salesquotes->workspace)}}</td>
                                </tr>
                            @endif
                            @if($salesquotes->totalextend())
                                <tr>
                                    <td>{{__('Sub Total')}}:</td>
                                    <td>{{currency_format_with_sym($salesquotes->totalextend(),$salesquotes->created_by,$salesquotes->workspace)}}</td>
                                </tr>
                            @endif
                            @if($salesquotes->totalextend())
                                <tr>
                                    <td>{{__('Main Total')}}:</td>
                                    <td>{{currency_format_with_sym($salesquotes->totalextend(),$salesquotes->created_by,$salesquotes->workspace)}}</td>
                                </tr>
                            @endif
                        </table>
                    </td>
                @endif
            </tr>
            </tfoot>
        </table>
        <div class="invoice-footer">
            <p> {{$settings['quote_footer_title']}} <br>
                {{$settings['quote_footer_notes']}} </p>
        </div>
    </div>
</div>
@if($type=="print")
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.js"></script>

<script>
    // $( document ).ready(function() { // select print button with class "print," then on click run callback function
        document.title = "{{Modules\Sales\Entities\SalesQuote::quoteNumberFormat($salesquotes->quote_id,$salesquotes->created_by)}}";
        $.print("#boxes");
    setTimeout(function () {
        window.history.back();
    }, 1000);
    // });
</script>
@endif
@if(!isset($preview))
    @include('sales::salesquote.script');
@endif
</body>
</html>
