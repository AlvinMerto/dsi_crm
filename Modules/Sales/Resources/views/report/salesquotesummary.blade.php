@extends('layouts.main')
@section('page-title')
    {{__('Report')}}
@endsection
@section('title')
    {{__('SalesQuote Summary')}}
@endsection
@section('page-breadcrumb')
    {{ __('Report') }},
    {{__('SalesQuote Summary')}}
@endsection
@section('page-action')
@endsection
@push('css')
    <link rel="stylesheet" href="{{ Module::asset('Sales:Resources/assets/css/custom.css') }}">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="collapse show float-end" id="collapseExample" style="">
                        {{ Form::open(array('route' => array('report.salesquotesummary'),'method'=>'get','class'=>'add_filter')) }}
                        <div class="row filter-css">
                            <div class="col-auto">
                                <label class="form-label">Date</label>
                                <input class="form-control form-control-solid" placeholder="Pick date rage" id="report_range"/>
                                <input type="hidden" name="startDate" id="start_date" value="">
                                <input type="hidden" name="endDate" id="end_date" value="">
                            </div>
                            <div class="col-auto">
                                <lable class="form-label">Employee</lable>
                                {{ Form::select('employee',$employee,isset($_GET['employee'])?$_GET['employee']:'', array('class' => 'form-control ')) }}
                            </div>
                            <div class="col-auto float-end ms-3 mt-1">
                                <button type="submit" class="btn btn-sm  btn-primary" data-bs-toggle="tooltip" data-title="{{__('Apply')}}" title="{{__('Apply')}}"><i class="ti ti-search"></i></button>
                                <a href="{{route('report.salesquotesummary')}}" data-bs-toggle="tooltip" data-title="{{__('Reset')}}" title="{{__('Reset')}}" class="btn btn-sm btn-danger"><i class="ti ti-trash-off"></i></a>
                                <a href="#" onclick="saveAsPDF();" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-title="{{__('Download')}}" title="{{__('Download')}}" id="download-buttons">
                                    <i class="ti ti-download"></i>
                                </a>
                                <a href="#" onclick="saveAsPrint();" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-title="{{__('Print')}}" title="{{__('Print')}}" id="download-buttons">
                                    <i class="ti ti-printer"></i>
                                </a>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="printableArea">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div id="report-chart"></div>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive overflow_hidden">
                        <table class="table mb-0 pc-dt-simple" id="assets">
                            <thead>
                            <tr>
{{--                                <th scope="col" class="sort" data-sort="name">{{ __('Sales Quote') }}</th>--}}
                                <th scope="col" class="sort" data-sort="budget">{{ __('Issue Date') }}</th>
                                <th scope="col" class="sort" data-sort="budget">{{ __('Sales') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($salesquotes as $salesquote)
                                <tr>
{{--                                    <td>--}}
{{--                                        <a href="{{route('salesquote.show',encrypt($salesquote->id))}}" class="btn btn-outline-primary">{{ \Modules\Sales\Entities\SalesQuote::quoteNumberFormat($salesquote->quote_id) }}</a>--}}
{{--                                    </td>--}}
                                    <td>{{ company_date_formate($salesquote->issue_date) }}</td>
                                    <td>{{ currency_format_with_sym($salesquote->getTotalTax() + $salesquote->totalextend()) }}</td>
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
    <script type="text/javascript" src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.js"></script>
    <script>
        function saveAsPrint() {
            $.print("#printableArea");
        }
    </script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        var performanceChart;
        $(document).ready(function () {
            // var start = moment().subtract(30, "days"), end = moment().subtract(1, "days");
            var start = moment().subtract(7, "days"), end = moment().subtract(1, "days");

            $("#report_range").daterangepicker({
                startDate: start,
                endDate: end,
                locale: {
                    format: "YYYY-MM-DD"
                },
                ranges: {
                    "Today": [moment(), moment()],
                    "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                    "Last 7 Days": [moment().subtract(7, "days"), moment().subtract(1, "days")],
                    "Last 30 Days": [moment().subtract(30, "days"), moment().subtract(1, "days")],
                    "This Month": [moment().startOf("month"), moment().subtract(1, "days")],
                    "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")],
                    "This Year": [moment().startOf("year"), moment()],
                    "Last Year": [moment().subtract(1, "year").startOf("year"), moment().subtract(1, "year").endOf("year")],
                },
            });
        });
        $(".add_filter").submit(function (event) {
            event.preventDefault();
           var startdate= $("#report_range").data('daterangepicker').startDate.format('YYYY-MM-DD')
           var enddate= $("#report_range").data('daterangepicker').endDate.format('YYYY-MM-DD')
            $('#start_date').val(startdate);
            $('#end_date').val(enddate);
            $(this).unbind('submit').submit();
            // $('#report_range').startDate.format('YYYY-MM-DD');
        });


{{--    <script>--}}
        var filename = $('#filesname').val();

        function saveAsPDF() {
            var element = document.getElementById('printableArea');
            var opt = {
                margin: 0.3,
                filename: filename,
                image: {type: 'jpeg', quality: 1},
                html2canvas: {scale: 4, dpi: 72, letterRendering: true},
                jsPDF: {unit: 'in', format: 'A2'}
            };
            html2pdf().set(opt).from(element).save();
        }
    </script>

    <script>
        var WorkedHoursChart = (function () {
            var $chart = $('#report-chart');

            (function () {
                var options = {
                    chart: {
                        height: 180,
                        type: 'area',
                        toolbar: {
                            show: false,
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: 2,
                        curve: 'smooth'
                    },
                    series: {!! json_encode($chartData['order']['series']) !!},
                    labels:{!! json_encode($chartData['order']['date']) !!},
                    xaxis: {
                        categories: [],
                        title: {
                            text: '{{__('Salesquote')}}'
                        },
                    },
                    colors: ['#3ec9d6', '#FF3A6E'],

                    grid: {
                        strokeDashArray: 4,
                    },
                    legend: {
                        show: true,
                        position: 'top',
                        horizontalAlign: 'right',
                    },

                };
                var chart = new ApexCharts(document.querySelector("#report-chart"), options);
                chart.render();
            })();




            // Events
            if ($chart.length) {
                $chart.each(function () {
                    init($(this));
                });
            }
        })();
    </script>
@endpush