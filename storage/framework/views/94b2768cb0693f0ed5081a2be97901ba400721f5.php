<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Report')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Quote Analytic')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Report')); ?>,
    <?php echo e(__('Quote Analytic')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(Module::asset('Sales:Resources/assets/css/custom.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="collapse show float-end" id="collapseExample" style="">

                        <?php echo e(Form::open(array('route' => array('report.quoteanalytic'),'method'=>'get'))); ?>

                        <div class="row filter-css">
                           <div class="col-auto">
                                <?php echo e(Form::month('start_month',isset($_GET['start_month'])?$_GET['start_month']:date('Y-01'),array('class'=>'form-control'))); ?>

                            </div>
                           <div class="col-auto">
                                <?php echo e(Form::month('end_month',isset($_GET['end_month'])?$_GET['end_month']:date('Y-12'),array('class'=>'form-control'))); ?>

                            </div>
                            <div class="col-auto" style="margin-left: -29px;">
                                <?php echo e(Form::select('status', [''=>'Select Status']+$status,isset($_GET['status'])?$_GET['status']:'', array('class' => 'form-control ','style'=>'margin-left: 29px;'))); ?>

                            </div>
                            <div class="col-auto float-end ms-3 mt-1">
                                <button type="submit" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-title="<?php echo e(__('Apply')); ?>" title="Apply"><i class="ti ti-search"></i>
                                </button>
                                <a href="<?php echo e(route('report.quoteanalytic')); ?>" class="btn btn-sm btn-danger "
                                    data-bs-toggle="tooltip" title="<?php echo e(__('Reset')); ?>"
                                    data-original-title="<?php echo e(__('Reset')); ?>">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off "></i></span>
                                </a>
                                <a href="#"  onclick="saveAsPDF();" class="btn btn-sm btn-primary "
                                    data-bs-toggle="tooltip" title="<?php echo e(__('Download')); ?>"
                                    data-original-title="<?php echo e(__('Download')); ?>" id="download-buttons">
                                    <span class="btn-inner--icon"><i class="ti ti-download text-white-off "></i></span>
                                </a>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="printableArea">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <dl class="row">
                            <?php if(isset($report['startDateRange']) || isset($report['endDateRange'])): ?>
                                <input type="hidden" value="<?php echo e(__('Quote Report of').' '.$report['startDateRange'].' to '.$report['endDateRange']); ?>" id="filesname">
                            <?php else: ?>
                                <input type="hidden" value="<?php echo e(__('Quote Report')); ?>" id="filesname">
                            <?php endif; ?>
                            <div class="col">
                                <?php echo e(__('Report')); ?> : <h6><?php echo e(__('Quote Summary')); ?></h6>
                            </div>
                            <div class="col">
                                <?php echo e(__('Duration')); ?> : <h6><?php echo e($report['startDateRange'].' to '.$report['endDateRange']); ?></h6>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div id="report-chart"></div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive mt-3">
                        <table class="table mb-0 pc-dt-simple" id="assets">
                            <thead>
                                <tr>
                                    <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                    <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Account Name')); ?></th>
                                    <th scope="col" class="sort" data-sort="name"><?php echo e(__('Assign User')); ?></th>
                                    <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Status')); ?></th>
                                    <th scope="col" class="sort" data-sort="name"><?php echo e(__('Date Quote')); ?></th>
                                </tr>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $quote; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <?php echo e($result['name']); ?>

                            </td>
                            <td>
                                <?php echo e(!empty($result['accounts']['name'])?$result['accounts']['name']:'-'); ?>

                            </td>
                            <td class="">
                                <?php echo e(!empty($result['assign_user']['name'])?$result['assign_user']['name']:'-'); ?>

                            </td>
                            <td>
                                <?php if($result->status == 0): ?>
                                    <span class="badge bg-secondary p-2 px-3 status-btn rounded"><?php echo e(__(Modules\Sales\Entities\Quote::$status[$result->status])); ?></span>
                                <?php elseif($result->status == 1): ?>
                                    <span class="badge bg-info p-2 px-3 status-btn rounded"><?php echo e(__(Modules\Sales\Entities\Quote::$status[$result->status])); ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="">
                                <?php echo e(company_date_formate($result['date_quoted'])); ?>

                            </td>
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
<script src="<?php echo e(asset('assets/js/plugins/apexcharts.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/html2pdf.bundle.min.js')); ?>"></script>
    <script>
        var WorkedHoursChart = (function () {
            var $chart = $('#report-chart');

            (function () {
        var options = {
            chart: {
                width: '100%',
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
            series: [{
                name: 'Quote',
                data: <?php echo json_encode($quoteTotal); ?>,
            }],
            xaxis: {
                categories: <?php echo json_encode($monthList); ?>,
                title: {
                            text: '<?php echo e(__('Quote')); ?>'
                        },
            },
            colors: ['#453b85', '#FF3A6E'],

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

        })();
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dimensionsystems/webcrm.dimensionsystems.com/Modules/Sales/Resources/views/report/quoteanalytic.blade.php ENDPATH**/ ?>