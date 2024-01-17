<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Report')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('SalesQuote Profit')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Report')); ?>,
    <?php echo e(__('SalesQuote Profit')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-action'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(Module::asset('Sales:Resources/assets/css/custom.css')); ?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="collapse show float-end" id="collapseExample" style="">
                        <?php echo e(Form::open(array('route' => array('report.salesquotetotalprofit'),'method'=>'get','class'=>'add_filter'))); ?>

                        <div class="row filter-css">
                            <div class="col-auto">
                                <input class="form-control form-control-solid" placeholder="Pick date rage" id="report_range"/>
                                <input type="hidden" name="startDate" id="start_date" value="">
                                <input type="hidden" name="endDate" id="end_date" value="">
                            </div>
                            <div class="col-auto float-end ms-3 mt-1">
                                <button type="submit" class="btn btn-sm  btn-primary" data-bs-toggle="tooltip" data-title="<?php echo e(__('Apply')); ?>" title="<?php echo e(__('Apply')); ?>"><i class="ti ti-search"></i></button>
                                <a href="<?php echo e(route('report.salesquotetotalprofit')); ?>" data-bs-toggle="tooltip" data-title="<?php echo e(__('Reset')); ?>" title="<?php echo e(__('Reset')); ?>" class="btn btn-sm btn-danger"><i class="ti ti-trash-off"></i></a>
                                <a href="#" onclick="saveAsPDF();" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-title="<?php echo e(__('Download')); ?>" title="<?php echo e(__('Download')); ?>" id="download-buttons">
                                    <i class="ti ti-download"></i>
                                </a>
                                <a href="#" onclick="saveAsPrint();" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-title="<?php echo e(__('Print')); ?>" title="<?php echo e(__('Print')); ?>" id="download-buttons">
                                    <i class="ti ti-printer"></i>
                                </a>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

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



                                <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Date')); ?></th>
                                <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Profit')); ?></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $__currentLoopData = $salesquotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salesquote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>





                                        <?php if($timetype!='year'): ?>
                                            <td><?php echo e(company_date_formate($salesquote->issue_date)); ?></td>
                                        <?php else: ?>
                                            <td><?php echo e(date('Y-m',strtotime($salesquote->issue_date))); ?></td>
                                        <?php endif; ?>
                                    <td><?php echo e(currency_format_with_sym($salesquote->totalprofit)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript" src="<?php echo e(asset('js/html2pdf.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/apexcharts.min.js')); ?>"></script>

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
                }
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
    </script>

        <script>
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
                    series: <?php echo json_encode($chartData['order']['series']); ?>,
                    labels:<?php echo json_encode($chartData['order']['date']); ?>,
                    xaxis: {
                        categories: [],
                        title: {
                            text: '<?php echo e(__('Salesquote Profit')); ?>'
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dimensionsystems/webcrm.dimensionsystems.com/Modules/Sales/Resources/views/report/salesquoteprofit.blade.php ENDPATH**/ ?>