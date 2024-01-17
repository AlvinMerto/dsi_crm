<?php $__env->startSection('breadcrumb'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Sales')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">

    <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="row">
                <?php if(\Auth::user()->type == 'company'): ?>
                <div class="col-xxl-7">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="theme-avtar bg-warning">
                                        <i class="ti ti-user"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2"></p>
                                    <h6 class="mb-3"><?php echo e(__('Total User')); ?></h6>
                                    <h3 class="mb-0"><?php echo e($data['totalUser']); ?> </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="theme-avtar bg-success">
                                        <i class="ti ti-building"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2"></p>
                                    <h6 class="mb-3"><?php echo e(__('Total Account')); ?></h6>
                                    <h3 class="mb-0"><?php echo e($data['totalAccount']); ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="theme-avtar bg-danger">
                                        <i class="fas fa-id-badge"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2"></p>
                                    <h6 class="mb-3"><?php echo e(__('Total Contact')); ?></h6>
                                    <h3 class="mb-0"><?php echo e($data['totalContact']); ?> </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="theme-avtar bg-info">
                                        <i class="ti ti-currency-dollar-singapore"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2"></p>
                                    <h6 class="mb-3"><?php echo e(__('Total Opportunities')); ?></h6>
                                    <h3 class="mb-0"><?php echo e($data['totalOpportunities']); ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="theme-avtar bg-primary">
                                        <i class="ti ti-receipt"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2"></p>
                                    <h6 class="mb-3"><?php echo e(__('Total Invoices')); ?></h6>
                                    <h3 class="mb-0"><?php echo e($data['totalInvoice']); ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="theme-avtar bg-secondary">
                                        <i class="ti ti-file-invoice"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4"></p>
                                    <h6 class="mb-3"><?php echo e(__('Total Salesorder')); ?></h6>
                                    <h3 class="mb-0"><?php echo e($data['totalSalesorder']); ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if(\Auth::user()->type == 'company'): ?>
                 <div class="col-xxl-5">
                    <div class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Invoice'.' '.'&'.' '.'Quote'.' '.'&'.' '.'Sales Order')); ?></h5>
                        </div>
                        <div class="card-body adj_card">
                            <div id="traffic-chart"></div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(\Auth::user()->type != 'company'): ?>
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Invoice'.' '.'&'.' '.'Quote'.' '.'&'.' '.'Sales Order')); ?></h5>
                        </div>
                        <div class="card-body">
                            <div id="traffic-chart"></div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="col-xxl-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-xl-4 col-md-6">
                                    <div class="card" style="min-height:200px;">
                                        <div class="card-header">
                                            <h5><?php echo e(__('Invoice Overview')); ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="progress">
                                                <?php $__currentLoopData = $data['invoice']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="progress-bar bg-<?php echo e($data['invoiceColor'][$invoice['status']]); ?>" role="progressbar" style="width: <?php echo e($invoice['percentage']); ?>%" aria-valuenow="<?php echo e($invoice['percentage']); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <div class="row mt-3">
                                                <?php $__empty_1 = true; $__currentLoopData = $data['invoice']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <div class="col-md-6 text-justify">
                                                        <span class="text-sm text-<?php echo e($data['invoiceColor'][$invoice['status']]); ?>">●</span>
                                                        <small><?php echo e($invoice['data'].' '.__($invoice['status'])); ?> (<a href="#" class="text-sm text-muted"><?php echo e(number_format($invoice['percentage'],'2')); ?>%</a>)</small>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <div class="col-md-12 text-center mt-3">
                                                        <h6><?php echo e(__('Invoice record not found')); ?></h6>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6">
                                    <div class="card" style="min-height:205px;">
                                        <div class="card-header">
                                            <h5><?php echo e(__('Quote Overview')); ?></h5>
                                        </div>
                                        <div class="card-body">

                                            <div class="progress">
                                                <?php $__currentLoopData = $data['quote']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="progress-bar bg-<?php echo e($data['invoiceColor'][$quote['status']]); ?>" role="progressbar" style="width: <?php echo e($quote['percentage']); ?>%" aria-valuenow="<?php echo e($quote['percentage']); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <div class="row mt-3">
                                                <?php $__empty_1 = true; $__currentLoopData = $data['quote']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <div class="col-md-6 text-justify">
                                                        <span class="text-sm text-<?php echo e($data['invoiceColor'][$quote['status']]); ?>">●</span>
                                                        <small><?php echo e($quote['data'].' '.__($quote['status'])); ?> (<a href="#" class="text-sm text-muted"><?php echo e(number_format($quote['percentage'],'2')); ?>%</a>)</small>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <div class="col-md-12 text-center mt-3">
                                                        <h6><?php echo e(__('Quote record not found')); ?></h6>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6">
                                    <div class="card" style="min-height:205px;">
                                        <div class="card-header">
                                            <h5><?php echo e(__('Sales Order Overview')); ?></h5>
                                        </div>
                                        <div class="card-body">

                                            <div class="progress">
                                                <?php $__currentLoopData = $data['salesOrder']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salesOrder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="progress-bar bg-<?php echo e($data['invoiceColor'][$salesOrder['status']]); ?>" role="progressbar" style="width: <?php echo e($salesOrder['percentage']); ?>%" aria-valuenow="<?php echo e($salesOrder['percentage']); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <div class="row mt-3">
                                                <?php $__empty_1 = true; $__currentLoopData = $data['salesOrder']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salesOrder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <div class="col-md-6 text-justify">
                                                        <span class="text-sm text-<?php echo e($data['invoiceColor'][$salesOrder['status']]); ?>">●</span>
                                                        <small><?php echo e($salesOrder['data'].' '.__($salesOrder['status'])); ?> (<a href="#" class="text-sm text-muted"><?php echo e(number_format($salesOrder['percentage'],'2')); ?>%</a>)</small>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <div class="col-md-12 text-center mt-3">
                                                        <h6><?php echo e(__('Invoice record not found')); ?></h6>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xxl-12">
                    <div class="card card-fluid">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0"><?php echo e(__('Meeting Schedule')); ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="list-group overflow-auto list-group-flush dashboard-box">
                            <?php $__empty_1 = true; $__currentLoopData = $data['topMeeting']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col ml-n2">
                                            <a href="#!" class=" h6 mb-0"><?php echo e($meeting->name); ?></a>
                                            <div>
                                                <small><?php echo e($meeting->description); ?></small>
                                            </div>
                                        </div>
                                         <div class="col-auto">
                                            <span data-toggle="tooltip" data-title="<?php echo e(__('Meetign Date')); ?>"><?php echo e($meeting->start_date); ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="col-md-12 text-center">
                                    <h6 class="m-3"><?php echo e(__('Meeting schedule not found')); ?></h6>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                    <!-- [ sample-page ] end -->
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
    <!-- [ Main Content ] end -->
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('assets/js/plugins/apexcharts.min.js')); ?>"></script>
<script>
    (function () {
        var options = {
            chart: {
                height: 250,
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
            series: [
                {
                name: "<?php echo e(__('Quote')); ?>",
                data:  <?php echo json_encode($data['lineChartData']['quoteAmount']); ?>

            }, {
                name: "<?php echo e(__('Invoice')); ?>",
                data: <?php echo json_encode($data['lineChartData']['invoiceAmount']); ?>

            }, {
                name: "<?php echo e(__('Sales Order')); ?>",
                 data: <?php echo json_encode($data['lineChartData']['salesorderAmount']); ?>

            }
            ],
            xaxis: {
                categories: <?php echo json_encode($data['lineChartData']['day']); ?>,
                title: {
                    text: "<?php echo e(__('Days')); ?>"
                }
            },
            colors: ['#453b85', '#FF3A6E', '#3ec9d6'],

            grid: {
                strokeDashArray: 2,
            },
            legend: {
                show: true,
                position: 'top',
                horizontalAlign: 'right',
            },

            yaxis: {
                min: 100,
                title: {
                    text: '<?php echo e(__('Amount')); ?>'
                },
            }
        };
        var chart = new ApexCharts(document.querySelector("#traffic-chart"), options);
        chart.render();
    })();
</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dimensionsystems/webcrm.dimensionsystems.com/Modules/Sales/Resources/views/dashboard/index.blade.php ENDPATH**/ ?>