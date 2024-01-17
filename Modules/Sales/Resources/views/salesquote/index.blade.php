@extends('layouts.main')
@section('page-title')
    {{ __('Manage Sales Quote') }}
@endsection
@section('title')
    {{ __('Sales Quote') }}
@endsection
@section('page-breadcrumb')
    {{ __('Sales Quote') }}
@endsection
@section('page-action')
    <div>
        @can('salesquote create')
            <a href="{{route('salesquote.create')}}" data-bs-toggle="tooltip"
               data-title="{{ __('Create New Sales Quote') }}" title="{{ __('Create') }}"class="btn btn-sm btn-primary btn-icon">
                <i class="ti ti-plus"></i>
            </a>
        @endcan
    </div>
@endsection
@section('filter')
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive overflow_hidden">
                        <table class="table mb-0 pc-dt-simple" id="assets">
                            <thead>
                            <tr>
                                <th scope="col" class="sort" data-sort="name">{{ __('Sales Quote') }}</th>
                                <th scope="col" class="sort" data-sort="name">{{ __('Customer') }}</th>
                                <th scope="col" class="sort" data-sort="budget">{{ __('Status') }}</th>
                                <th scope="col" class="sort" data-sort="budget">{{ __('Issue Date') }}</th>
                                <th scope="col" class="sort" data-sort="budget">{{ __('Amount') }}</th>
                                <th scope="col" class="sort" data-sort="budget">{{ __('Created At') }}</th>
                                <th scope="col" class="sort" data-sort="budget">{{ __('Contact person') }}</th>
                                @if(\Auth::user()->type =="company")
                                    <th scope="col" class="sort" data-sort="budget">{{ __('Quote Status') }}</th>
                                @endif
                                @if (Gate::check('salesquote edit') || Gate::check('salesquote delete'))
                                    <th scope="col" class="sort" data-sort="status">{{ __('Action') }}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($salesquotes as $salesquote)
                                <tr>
                                    <td>
                                        <a class="btn btn-outline-primary" href="{{route('salesquote.showquote',$salesquote->id)}}"> {{ \Modules\Sales\Entities\SalesQuote::quoteNumberFormat($salesquote->quote_id) }} </a>
                                        <!-- <a href="{{route('salesquote.show',encrypt($salesquote->id))}}" class="btn btn-outline-primary"></a> -->
                                    </td>
                                    <td>{{$salesquote->customer->name}}</td>
                                    <td>@if(date('Y-m-d') > $salesquote->quote_validity)
                                            <span class="badge fix_badges bg-danger p-2 px-3 rounded">Expired</span>
                                        @else
                                            <span class="badge fix_badges bg-primary p-2 px-3 rounded">Active</span>
                                        @endif</td>
                                    <td>{{ company_date_formate($salesquote->issue_date) }}</td>
                                    <td></td>
                                    <td>{{company_date_formate($salesquote->created_at) }}</td>
                                    <td>{{$salesquote->contactperson->name}}</td>
                                    @php
                                        if(isset($salesquote->quote_status))
                                        {
                                            if($salesquote->quote_status==0)
                                            {
                                               $quotestatus="Pending";
                                            }
                                            elseif($salesquote->quote_status==1)
                                            {
                                                $quotestatus="Accept";
                                            }
                                            else
                                            {
                                                $quotestatus="Reject";
                                            }
                                        }
                                    @endphp

                                    @if(\Auth::user()->type =="company")
                                        <td>
                                            @if(isset($salesquote->quote_status))
                                                @if($quotestatus=="Pending")
                                                    <span class="badge fix_badges bg-warning p-2 px-3 rounded">{{$quotestatus}}</span>
                                                @elseif($quotestatus=="Accept")
                                                    <span class="badge fix_badges bg-primary p-2 px-3 rounded">{{$quotestatus}}</span>
                                                @elseif($quotestatus=="Reject")
                                                    <span class="badge fix_badges bg-danger p-2 px-3 rounded">{{$quotestatus}}</span>
                                                @else
                                                    <span class="badge fix_badges bg-warning p-2 px-3 rounded">Pending</span>
                                                @endif
                                            @else
                                                <span class="badge fix_badges bg-danger p-2 px-3 rounded">Pending</span>
                                            @endif
                                        </td>
                                    @endif
                                    @if (Gate::check('salesquote edit') || Gate::check('salesquote delete') || Gate::check('salesquote create'))

                                        <td class="Action">
                                            <div class="action-btn bg-primary ms-2">
                                                <a href="#" class="btn btn-sm  align-items-center cp_link" data-link="{{route('print.salesquote',\Illuminate\Support\Facades\Crypt::encrypt($salesquote->id))}}" data-bs-toggle="tooltip" title="{{__('Copy')}}" data-original-title="{{__('Click to copy invoice link')}}">
                                                    <i class="ti ti-file text-white"></i>
                                                </a>
                                            </div>

                                            @can('salesquote create')
                                                <div class="action-btn bg-secondary ms-2">
                                                    {!! Form::open([
                                                        'method' => 'get',
                                                        'route' => ['salesquote.duplicate', $salesquote->id],
                                                        'id' => 'duplicate-form-' . $salesquote->id,
                                                    ]) !!}

                                                    <a href="#"
                                                       class="mx-3 btn btn-sm align-items-center text-white show_confirm"
                                                       data-bs-toggle="tooltip" data-title="{{ __('Duplicate') }}"
                                                       title="{{ __('Duplicate') }}"
                                                       data-confirm="{{ __('You want to confirm this action') }}"
                                                       data-text="{{ __('Press Yes to continue or No to go back') }}"
                                                       data-confirm-yes="document.getElementById('duplicate-form-{{ $salesquote->id }}').submit();">
                                                        <i class="ti ti-copy"></i>
                                                        {!! Form::close() !!}
                                                    </a>
                                                </div>
                                            @endcan

                                            @if ($salesquote->converted_salesorder_id == 0)
                                                <div class="action-btn bg-success ms-2">
                                                    {!! Form::open([
                                                        'method' => 'get',
                                                        'route' => ['salesquote.convert', $salesquote->id],
                                                        'id' => 'quotes-form-' . $salesquote->id,
                                                    ]) !!}

                                                    <a href="#"
                                                       class="mx-3 btn btn-sm align-items-center text-white show_confirm"
                                                       data-bs-toggle="tooltip"
                                                       data-title="{{ __('Convert to Sales Order') }}"
                                                       title="{{ __('Conver to Sale Order') }}"
                                                       data-confirm="{{ __('You want to confirm convert to sales order.') }}"
                                                       data-text="{{ __('Press Yes to continue or No to go back') }}"
                                                       data-confirm-yes="document.getElementById('quotes-form-{{ $salesquote->id }}').submit();">
                                                        <i class="ti ti-exchange"></i>
                                                        {!! Form::close() !!}
                                                    </a>
                                                </div>
                                            @else
                                                <div class="action-btn bg-success ms-2">
                                                    <a href="{{ route('salesorder.show', $salesquote->converted_salesorder_id) }}"
                                                       class="mx-3 btn btn-sm align-items-center text-white"
                                                       data-bs-toggle="tooltip"
                                                       data-original-title="{{ __('Sales Order Details') }}"
                                                       title="{{ __('SalesOrders Details') }}">
                                                        <i class="fab fa-stack-exchange"></i>
                                                    </a>
                                                </div>
                                            @endif

                                            <div class="action-btn bg-warning ms-2">
                                                <a href="{{ route('salesquote.show',encrypt($salesquote->id)) }}"
                                                   data-size="md"class="mx-3 btn btn-sm align-items-center text-white "
                                                   data-bs-toggle="tooltip" title="{{ __('Quick View') }}"
                                                   data-title="{{ __('SalesQuote Details') }}">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                            </div>
                                            @can('salesquote edit')
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="{{route('salesquote.showquote',$salesquote->id)}}"
                                                       class="mx-3 btn btn-sm  align-items-center"
                                                       data-bs-toggle="tooltip"
                                                       data-bs-original-title="{{ __('Edit') }}">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('salesquote delete')
                                                <div class="action-btn bg-danger ms-2">
                                                    {!! Form::open(['method' => 'get', 'route' => ['salesquote.destroy', $salesquote->id]]) !!}
                                                    <a href="#!"
                                                       class="mx-3 btn btn-sm   align-items-center text-white show_confirm"
                                                       data-bs-toggle="tooltip" title='Delete'>
                                                        <i class="ti ti-trash"></i>
                                                    </a>
                                                    {!! Form::close() !!}
                                                </div>
                                            @endcan
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @endsection
        @push('scripts')
            <script>
                $(document).on('click', '#billing_data', function() {
                    $("[name='shipping_address']").val($("[name='billing_address']").val());
                    $("[name='shipping_city']").val($("[name='billing_city']").val());
                    $("[name='shipping_state']").val($("[name='billing_state']").val());
                    $("[name='shipping_country']").val($("[name='billing_country']").val());
                    $("[name='shipping_postalcode']").val($("[name='billing_postalcode']").val());
                })

                $(document).on('change', 'select[name=opportunity]', function() {

                    var opportunities = $(this).val();
                    getaccount(opportunities);
                });

                function getaccount(opportunities_id) {
                    $.ajax({
                        url: '{{ route('quote.getaccount') }}',
                        type: 'POST',
                        data: {
                            "opportunities_id": opportunities_id,
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            $('#amount').val(data.opportunitie.amount);
                            $('#account_name').val(data.account.name);
                            $('#account_id').val(data.account.id);
                            $('#billing_address').val(data.account.billing_address);
                            $('#shipping_address').val(data.account.shipping_address);
                            $('#billing_city').val(data.account.billing_city);
                            $('#billing_state').val(data.account.billing_state);
                            $('#shipping_city').val(data.account.shipping_city);
                            $('#shipping_state').val(data.account.shipping_state);
                            $('#billing_country').val(data.account.billing_country);
                            $('#billing_postalcode').val(data.account.billing_postalcode);
                            $('#shipping_country').val(data.account.shipping_country);
                            $('#shipping_postalcode').val(data.account.shipping_postalcode);

                        }
                    });
                }
            </script>
                <script>
                    $(document).on("click",".cp_link",function() {
                        var value = $(this).attr('data-link');
                        var $temp = $("<input>");
                        $("body").append($temp);
                        $temp.val(value).select();
                        document.execCommand("copy");
                        $temp.remove();
                        toastrs('success', '{{__('Link Copy on Clipboard')}}', 'success')
                    });
                </script>
    @endpush

