@extends('layouts.main')
@section('page-title')
    {{__('Quote')}}
@endsection
@section('title')
    {{__('Sales Quote')}} {{ '('. $salesquote->name .')' }}
@endsection
@section('page-breadcrumb')
    {{__('Sales Quote')}},
    {{__('show')}}
@endsection

@section('page-action')
    <div>
        @if(\Auth::user()->type!="client")
            <a data-url="{{ route('salesquote.setting') }}" data-size="lg" data-ajax-popup="true"
               data-bs-toggle="tooltip" data-title="{{ __('Manage Salesquote Setting') }}" title="{{ __('Manage Salesquote Setting') }}"
               class="btn btn-sm btn-primary btn-icon">
                <i class="ti ti-settings"></i>
            </a>
        @endif
            <a href="{{route('salesquote.pdf',['id'=> \Crypt::encrypt($salesquote->id),'type'=>'pdf'])}}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" target="_blank" data-title="{{__('PDF')}}" title="{{__('PDF')}}" id="download-buttons">
                <i class="ti ti-download"></i>
            </a>
            <a href="{{route('salesquote.pdf',['id'=> \Crypt::encrypt($salesquote->id),'type'=>'print'])}}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-title="{{__('Print')}}" title="{{__('Print')}}" id="download-buttons">
                <i class="ti ti-printer"></i>
            </a>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="invoice">
                    <div class="invoice-print">
                        <div class="row invoice-title mt-2">
                            <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12">
                                <h2>{{ __('Sales Quote') }}</h2>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12 text-end">
                                <h3 class="invoice-number">
                                    {{Modules\Sales\Entities\SalesQuote::quoteNumberFormat($salesquote->quote_id) }}</h3>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col text-end">
                                <div class="d-flex align-items-center justify-content-end">
                                    <div class="me-4">
                                        <small>
                                            <strong>{{ __('Issue Date') }} :</strong><br>
                                            {{ company_date_formate($salesquote->issue_date) }}<br><br>
                                        </small>
                                    </div>
                                </div>
                                @if(date('Y-m-d') > $salesquote->quote_validity)
                                    <span class="badge fix_badges bg-danger p-2 px-3 rounded">Expired</span>
                                @else
                                    <span class="badge fix_badges bg-primary p-2 px-3 rounded">Active</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            @if (!empty($customer->billing_name) && !empty($customer->billing_address) && !empty($customer->billing_zip))
                                <div class="col">
                                    <small class="font-style">
                                        <strong>{{ __('Billed To') }} :</strong><br>
                                        {{ !empty($customer->billing_name) ? $customer->billing_name : '' }}<br>
                                        {{ !empty($customer->billing_address) ? $customer->billing_address : '' }}<br>
                                        {{ !empty($customer->billing_city) ? $customer->billing_city . ' ,' : '' }}
                                        {{ !empty($customer->billing_state) ? $customer->billing_state . ' ,' : '' }}
                                        {{ !empty($customer->billing_zip) ? $customer->billing_zip : '' }}<br>
                                        {{ !empty($customer->billing_country) ? $customer->billing_country : '' }}<br>
                                        {{ !empty($customer->billing_phone) ? $customer->billing_phone : '' }}<br>
                                        <strong>{{ __('Tax Number ') }} :
                                        </strong>{{ !empty($customer->tax_number) ? $customer->tax_number : '' }}

                                    </small>
                                </div>
                            @endif
                            @if (company_setting('invoice_shipping_display') == 'on')
                                @if (!empty($customer->shipping_name) && !empty($customer->shipping_address) && !empty($customer->shipping_zip))
                                    <div class="col ">
                                        <small>
                                            <strong>{{ __('Shipped To') }} :</strong><br>
                                            {{ !empty($customer->shipping_name) ? $customer->shipping_name : '' }}<br>
                                            {{ !empty($customer->shipping_address) ? $customer->shipping_address : '' }}<br>
                                            {{ !empty($customer->shipping_city) ? $customer->shipping_city . ' ,' : '' }}
                                            {{ !empty($customer->shipping_state) ? $customer->shipping_state . ' ,' : '' }}
                                            {{ !empty($customer->shipping_zip) ? $customer->shipping_zip : '' }}<br>
                                            {{ !empty($customer->shipping_country) ? $customer->shipping_country : '' }}<br>
                                            {{ !empty($customer->shipping_phone) ? $customer->shipping_phone : '' }}<br>
                                            <strong>{{ __('Tax Number ') }} :
                                            </strong>{{ !empty($customer->tax_number) ? $customer->tax_number : '' }}
                                        </small>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="font-weight-bold">{{ __('Item Summary') }}</div>
                                <small>{{ __('All items here cannot be deleted.') }}</small>
                                <div class="table-responsive mt-2">
                                    <table class="table mb-0 table-striped">
                                        <tr>
                                            <th data-width="40" class="text-dark">#</th>
                                            <th class="text-dark">{{ __('Profit') }}</th>
                                            <th class="text-dark">{{ __('Markup') }}</th>
                                            <th class="text-dark">{{ __('Cost') }}</th>
                                            <th class="text-dark">{{ __('Supplier Name') }}</th>
                                            <th class="text-dark">{{ __('Supplier Part Number') }}</th>
                                            <th class="text-dark">{{ __('Manufacturer Name') }}</th>
                                            <th class="text-dark">{{ __('Manufacturer Part Number') }}</th>
                                            <th class="text-dark">{{ __('Description') }}</th>
                                            <th class="text-dark">{{ __('Quantity') }}</th>
                                            <th class="text-right text-dark" width="12%">{{ __('Price') }}
                                            </th>
                                            <th>{{__('Extended')}}</th>
                                            <th>{{__('Tax')}}</th>
                                            {{--                                            <th></th>--}}
                                        </tr>
                                        @php
                                            $totalQuantity = 0;
                                            $totalRate = 0;
                                            $totalTaxPrice = 0;
                                            $totalDiscount = 0;
                                            $taxesData = [];
                                            $TaxPrice_array = [];
                                        @endphp
                                        @foreach ($salesquoteitems as $key => $iteam)
                                            @if (!empty($iteam->tax))
                                                @php
                                                    $taxes = \App\Models\Invoice::tax($iteam->tax);
                                                    $totalQuantity += $iteam->quantity;
                                                    $totalRate += $iteam->price;
                                                    $totalDiscount += $iteam->discount;
                                                    foreach ($taxes as $taxe) {
                                                        $taxDataPrice = \App\Models\Invoice::taxRate($taxe->rate, $iteam->price, $iteam->quantity, $iteam->discount);
                                                        if (array_key_exists($taxe->name, $taxesData)) {
                                                            $taxesData[$taxe->name] = $taxesData[$taxe->name] + $taxDataPrice;
                                                        } else {
                                                            $taxesData[$taxe->name] = $taxDataPrice;
                                                        }
                                                    }
                                                @endphp
                                            @endif 
                                            @if($iteam->type=="substart")
                                                <tr>
                                                    <td>
                                                        {{ $key + 1 }}
                                                    </td>
                                                    <td>{{$iteam->profit}}</td>
                                                    <td>{{$iteam->markup}}</td>
                                                    <td>{{$iteam->purchase_price}}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>"SubStart"</td>
                                                    <td>{{$iteam->subtotal_description}}</td>
                                                    <td>{{$iteam->subtotal_quantity}}</td>
                                                    <td>{{$iteam->price}}</td>
                                                    <td>{{$iteam->extended}}</td>
                                                    <td>
                                                        @if (!empty($iteam->tax))
                                                            <table>
                                                                @php
                                                                    $totalTaxRate = 0;
                                                                    $data = 0;
                                                                @endphp
                                                                @foreach ($taxes as $tax)
                                                                    @php
                                                                        $taxPrice = \App\Models\Invoice::taxRate($tax->rate, $iteam->price, $iteam->quantity, $iteam->discount);
                                                                        $totalTaxPrice += $taxPrice;
                                                                        $data += $taxPrice;
                                                                    @endphp
                                                                    <tr>
                                                                        <td>{{ $tax->name . ' (' . $tax->rate . '%)' }}</td>
                                                                        <td>{{ currency_format_with_sym($taxPrice) }}</td>
                                                                    </tr>
                                                                @endforeach
                                                                @php
                                                                    array_push($TaxPrice_array, $data);
                                                                @endphp
                                                            </table>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                </tr>
                                            @elseif($iteam->type=="subitem")
                                                @php
                                                    $productservice=\Modules\ProductService\Entities\ProductService::where('id',$iteam->item)->first();
                                                @endphp
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{$iteam->profit}}</td>
                                                    <td>{{$iteam->markup}}</td>
                                                    <td>{{$iteam->purchase_price}}</td>
                                                    <td>{{isset($productservice->supplier_name)?$productservice->supplier_name:""}}</td>
                                                    <td>{{isset($productservice->supplier_part_number)?$productservice->supplier_part_number:""}}</td>
                                                    <td>{{isset($productservice->manufacturer_name)?$productservice->manufacturer_name:""}}</td>
                                                    <td>{{isset($productservice->manufacturer_part_number)?$productservice->manufacturer_part_number:""}}</td>
                                                    <td>{{$productservice->name}}</td>
                                                    <td>{{$iteam->quantity}}</td>
                                                    <td>{{$iteam->price}}</td>
                                                    <td>{{$iteam->extended}}</td>
                                                    <td>
                                                        @if (!empty($iteam->tax))
                                                            <table>
                                                                @php
                                                                    $totalTaxRate = 0;
                                                                    $data = 0;
                                                                @endphp
                                                                @foreach ($taxes as $tax)
                                                                    @php
                                                                        $taxPrice = \App\Models\Invoice::taxRate($tax->rate, $iteam->price, $iteam->quantity, $iteam->discount);
                                                                        $totalTaxPrice += $taxPrice;
                                                                        $data += $taxPrice;
                                                                    @endphp
                                                                    <tr>
                                                                        <td>{{ $tax->name . ' (' . $tax->rate . '%)' }}</td>
                                                                        <td>{{ currency_format_with_sym($taxPrice) }}</td>
                                                                    </tr>
                                                                @endforeach
                                                                @php
                                                                    array_push($TaxPrice_array, $data);
                                                                @endphp
                                                            </table>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                </tr>
                                            @elseif($iteam->type=="subcustomitem")
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{$iteam->profit}}</td>
                                                    <td>{{$iteam->markup}}</td>
                                                    <td>{{$iteam->purchase_price}}</td>
                                                    <td>{{isset($iteam->supplier_name)?$iteam->supplier_name:""}}</td>
                                                    <td>{{isset($iteam->supplier_part_number)?$iteam->supplier_part_number:""}}</td>
                                                    <td>{{isset($iteam->manufacturer_name)?$iteam->manufacturer_name:""}}</td>
                                                    <td>{{isset($iteam->manufacturer_part_number)?$iteam->manufacturer_part_number:""}}</td>
                                                    <td>{{$iteam->item}}</td>
                                                    <td>{{$iteam->quantity}}</td>
                                                    <td>{{$iteam->price}}</td>
                                                    <td>{{$iteam->extended}}</td>
                                                    <td>
                                                        @if (!empty($iteam->tax))
                                                            <table>
                                                                @php
                                                                    $totalTaxRate = 0;
                                                                    $data = 0;
                                                                @endphp
                                                                @foreach ($taxes as $tax)
                                                                    @php
                                                                        $taxPrice = \App\Models\Invoice::taxRate($tax->rate, $iteam->price, $iteam->quantity, $iteam->discount);
                                                                        $totalTaxPrice += $taxPrice;
                                                                        $data += $taxPrice;
                                                                    @endphp
                                                                    <tr>
                                                                        <td>{{ $tax->name . ' (' . $tax->rate . '%)' }}</td>
                                                                        <td>{{ currency_format_with_sym($taxPrice) }}</td>
                                                                    </tr>
                                                                @endforeach
                                                                @php
                                                                    array_push($TaxPrice_array, $data);
                                                                @endphp
                                                            </table>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                </tr>
                                            @elseif($iteam->type=="subcomment")
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>{{$iteam->sample_comment}}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            @elseif($iteam->type=="subblank")
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            @elseif($iteam->type=="substop")
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>"SubStop"</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                        @endforeach


                                        <tfoot>
                                        @php
                                            $colspan = 10;
                                        @endphp
                                        <tr>
                                            <td colspan="{{ $colspan }}"></td>
                                            <td class="text-right"><b>{{ __('Total Cost') }}</b></td>
                                            <td class="text-right">
                                            <td class="text-right">
                                                {{ currency_format_with_sym($salesquote->totalcost()) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="11"></td>
                                            <td class="text-right"><b>{{ __('Product') }}</b></td>
                                            <td class="text-right">
                                                {{ currency_format_with_sym($salesquote->totalcost()- (!empty( $salesquote->shipping_cost() ) ? $salesquote->shipping_cost():0) -  (!empty( $salesquote->labor_cost() ) ? $salesquote->labor_cost():0)) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="11"></td>
                                            <td class="text-right"><b>{{ __('Shipping') }}</b></td>
                                            <td class="text-right">
                                                {{ currency_format_with_sym($salesquote->shipping_cost()) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="11"></td>
                                            <td class="text-right"><b>{{ __('Labor') }}</b></td>
                                            <td class="text-right">
                                                {{ currency_format_with_sym($salesquote->labor_cost()) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="{{ $colspan }}"></td>
                                            <td class="text-right"><b>{{ __('Total Profit') }}</b></td>
                                            <td class="text-right">
                                                {{ currency_format_with_sym($salesquote->totalProfit()) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="{{ $colspan }}"></td>
                                            <td class="text-right"><b>{{ __('GP') }}</b></td>
                                            <td class="text-right">
                                                {{ currency_format_with_sym($salesquote->totalgp()) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="{{ $colspan }}"></td>
                                            <td class="text-right"><b>{{ __('Sub Total') }}</b></td>
                                            <td class="text-right">
                                                {{ currency_format_with_sym($salesquote->totalextend()) }}</td>
                                        </tr>
                                        @if (!empty($taxesData))
                                            @foreach ($taxesData as $taxName => $taxPrice)
                                                <tr>
                                                    <td colspan="{{ $colspan }}"></td>
                                                    <td class="text-right"><b>{{ $taxName }}</b></td>
                                                    <td class="text-right">{{ currency_format_with_sym($taxPrice) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        <tr>
                                            <td colspan="{{ $colspan }}"></td>
                                            <td class="text-right"><b>{{ __('Total Amount') }}</b></td>
                                            @if(!empty($taxesData))
                                                <td class="text-right">
                                                    {{ currency_format_with_sym($salesquote->totalextend() + $taxPrice) }}</td>
                                            @else
                                                <td class="text-right">
                                                    {{ currency_format_with_sym($salesquote->totalextend()) }}</td>
                                            @endif
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection