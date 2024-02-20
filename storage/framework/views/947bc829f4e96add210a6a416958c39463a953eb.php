
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Account')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(session('status')): ?>
        <div class="alert alert-success" role="alert">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xxl-7">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="theme-avtar bg-primary">
                                        <i class="ti ti-users"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2"><?php echo e(__('Total')); ?></p>
                                    <h6 class="mb-3 text-primary"><?php echo e(__('Customers')); ?></h6>
                                    <h3 class="mb-0 text-primary">
                                        <?php echo e(\Modules\Account\Entities\AccountUtility::countCustomers()); ?>


                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="theme-avtar bg-info">
                                        <i class="ti ti-note"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2"><?php echo e(__('Total')); ?></p>
                                    <h6 class="mb-3 text-info"><?php echo e(__('Vendors')); ?></h6>
                                    <h3 class="mb-0 text-info">
                                        <?php echo e(\Modules\Account\Entities\AccountUtility::countVendors()); ?>

                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="theme-avtar bg-warning">
                                        <i class="ti ti-file-invoice"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2"><?php echo e(__('Total')); ?></p>
                                    <h6 class="mb-3 text-warning"><?php echo e(__('Invoices')); ?></h6>
                                    <h3 class="mb-0 text-warning"><?php echo e(\App\Models\Invoice::countInvoices()); ?> </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="theme-avtar bg-danger">
                                        <i class="ti ti-report-money"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2"><?php echo e(__('Total')); ?></p>
                                    <h6 class="mb-3 text-danger"><?php echo e(__('Bills')); ?></h6>
                                    <h3 class="mb-0 text-danger">
                                        <?php echo e(\Modules\Account\Entities\AccountUtility::countBills()); ?> </h3>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card" style="min-height: 370px;">
                        <div class="card-header">
                            <h5 class="mt-1 mb-0"><?php echo e(__('Account Balance')); ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Bank')); ?></th>
                                            <th><?php echo e(__('Holder Name')); ?></th>
                                            <th><?php echo e(__('Balance')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $bankAccountDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bankAccount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr class="font-style">
                                                <td><?php echo e($bankAccount->bank_name); ?></td>
                                                <td><?php echo e($bankAccount->holder_name); ?></td>
                                                <td><?php echo e(currency_format_with_sym($bankAccount->opening_balance)); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="4">
                                                    <div class="text-center">
                                                        <h6><?php echo e(__('there is no account balance')); ?></h6>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mt-1 mb-0"><?php echo e(__('Cashflow')); ?></h5>
                        </div>
                        <div class="card-body">
                            <div id="cash-flow"></div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mt-1 mb-0"><?php echo e(__('Income Vs Expense')); ?></h5>
                            <div class="row mt-4">

                                <div class="col-md-6 col-12 my-2">
                                    <div class="d-flex align-items-start">
                                        <div class="theme-avtar bg-primary">
                                            <i class="ti ti-report-money"></i>
                                        </div>
                                        <div class="ms-2">
                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Income Today')); ?></p>
                                            <h4 class="mb-0 text-success">
                                                <?php echo e(currency_format_with_sym(\Modules\Account\Entities\AccountUtility::todayIncome())); ?>

                                            </h4>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 my-2">
                                    <div class="d-flex align-items-start">
                                        <div class="theme-avtar bg-info">
                                            <i class="ti ti-file-invoice"></i>
                                        </div>
                                        <div class="ms-2">
                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Expense Today')); ?></p>
                                            <h4 class="mb-0 text-info">
                                                <?php echo e(currency_format_with_sym(\Modules\Account\Entities\AccountUtility::todayExpense())); ?>

                                            </h4>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 my-2">
                                    <div class="d-flex align-items-start">
                                        <div class="theme-avtar bg-warning">
                                            <i class="ti ti-report-money"></i>
                                        </div>
                                        <div class="ms-2">
                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Income This Month')); ?></p>
                                            <h4 class="mb-0 text-warning">
                                                <?php echo e(currency_format_with_sym(\Modules\Account\Entities\AccountUtility::incomeCurrentMonth())); ?>

                                            </h4>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 my-2">
                                    <div class="d-flex align-items-start">
                                        <div class="theme-avtar bg-danger">
                                            <i class="ti ti-file-invoice"></i>
                                        </div>
                                        <div class="ms-2">
                                            <p class="text-muted text-sm mb-0"><?php echo e(__('Expense This Month')); ?></p>
                                            <h4 class="mb-0 text-danger">
                                                <?php echo e(currency_format_with_sym(\Modules\Account\Entities\AccountUtility::expenseCurrentMonth())); ?>

                                            </h4>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-7">
                    <div class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Income & Expense')); ?>

                                <span class="float-end text-muted"><?php echo e(__('Current Year') . ' - ' . $currentYear); ?></span>
                            </h5>

                        </div>
                        <div class="card-body">
                            <div id="incExpBarChart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-5">
                    <div class="card" style="height: 315px">
                        <div class="card-header">
                            <h5><?php echo e(__('Income By Category')); ?>

                                <span class="float-end text-muted"><?php echo e(__('Year') . ' - ' . $currentYear); ?></span>
                            </h5>

                        </div>
                        <div class="card-body">
                            <div id="incomeByCategory"></div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-7">
                    <div class="card" style="min-height: 369px;">
                        <div class="card-header">
                            <h5 class="mt-1 mb-0"><?php echo e(__('Latest Income')); ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Date')); ?></th>
                                            <th><?php echo e(__('Customer')); ?></th>
                                            <th><?php echo e(__('Amount Due')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $latestIncome; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $income): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e(company_date_formate($income->date)); ?></td>
                                                <td><?php echo e(!empty($income->customer) ? $income->customer->name : '-'); ?></td>
                                                <td><?php echo e(currency_format_with_sym($income->amount)); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <?php echo $__env->make('layouts.nodatafound', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-xxl-5">
                    <div class="card" style="height: 369px">
                        <div class="card-header">
                            <h5><?php echo e(__('Expense By Category')); ?>

                                <span class="float-end text-muted"><?php echo e(__('Year') . ' - ' . $currentYear); ?></span>
                            </h5>

                        </div>
                        <div class="card-body">
                            <div id="expenseByCategory"></div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mt-1 mb-0"><?php echo e(__('Latest Expense')); ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Date')); ?></th>
                                            <th><?php echo e(__('Customer')); ?></th>
                                            <th><?php echo e(__('Amount Due')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $latestExpense; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e(company_date_formate($expense->date)); ?></td>
                                                <td><?php echo e(!empty($expense->customer) ? $expense->customer->name : '-'); ?></td>
                                                <td><?php echo e(currency_format_with_sym($expense->amount)); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <?php echo $__env->make('layouts.nodatafound', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-7">
                    <div class="card" style="min-height: 395px;">
                        <div class="card-header">
                            <h5 class="mt-1 mb-0"><?php echo e(__('Recent Invoices')); ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo e(__('Customer')); ?></th>
                                            <th><?php echo e(__('Issue Date')); ?></th>
                                            <th><?php echo e(__('Due Date')); ?></th>
                                            <th><?php echo e(__('Amount')); ?></th>
                                            <th><?php echo e(__('Status')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $recentInvoice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e(\App\Models\Invoice::invoiceNumberFormat($invoice->invoice_id)); ?>

                                                </td>
                                                <td><?php echo e(!empty($invoice->customer) ? $invoice->customer->name : ''); ?> </td>
                                                <td><?php echo e(company_date_formate($invoice->issue_date)); ?></td>
                                                <td><?php echo e(company_date_formate($invoice->due_date)); ?></td>
                                                <td><?php echo e(currency_format_with_sym($invoice->getTotal())); ?></td>
                                                <td>
                                                    <?php if($invoice->status == 0): ?>
                                                        <span
                                                            class="p-2 px-3 fix_badges rounded badge bg-secondary"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                                    <?php elseif($invoice->status == 1): ?>
                                                        <span
                                                            class="p-2 px-3 fix_badges rounded badge bg-warning"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                                    <?php elseif($invoice->status == 2): ?>
                                                        <span
                                                            class="p-2 px-3 fix_badges rounded badge bg-danger"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                                    <?php elseif($invoice->status == 3): ?>
                                                        <span
                                                            class="p-2 px-3 fix_badges rounded badge bg-info"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                                    <?php elseif($invoice->status == 4): ?>
                                                        <span
                                                            class="p-2 px-3 fix_badges rounded badge bg-success"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <?php echo $__env->make('layouts.nodatafound', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-5">
                    <div class="card" style="height: 396px">
                        <div class="card-body">

                            <ul class="nav nav-pills mb-5" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-Dashboard-tab" data-bs-toggle="pill"
                                        href="#invoice_weekly_statistics" role="tab" aria-controls="pills-home"
                                        aria-selected="true"><?php echo e(__('Invoices Weekly Statistics')); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                        href="#invoice_monthly_statistics" role="tab" aria-controls="pills-profile"
                                        aria-selected="false"><?php echo e(__('Invoices Monthly Statistics')); ?></a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="invoice_weekly_statistics" role="tabpanel"
                                    aria-labelledby="pills-home-tab">
                                    <div class="table-responsive">
                                        <table class="table align-items-center mb-0 ">
                                            <tbody class="list">
                                                <tr>
                                                    <td>
                                                        <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                        <p class="text-muted text-sm mb-0"><?php echo e(__('Invoice Generated')); ?>

                                                        </p>

                                                    </td>
                                                    <td>
                                                        <h4 class="text-muted">
                                                            <?php echo e(currency_format_with_sym($weeklyInvoice['invoiceTotal'])); ?>

                                                        </h4>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                        <p class="text-muted text-sm mb-0"><?php echo e(__('Paid')); ?></p>
                                                    </td>
                                                    <td>
                                                        <h4 class="text-muted">
                                                            <?php echo e(currency_format_with_sym($weeklyInvoice['invoicePaid'])); ?>

                                                        </h4>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                        <p class="text-muted text-sm mb-0"><?php echo e(__('Due')); ?></p>
                                                    </td>
                                                    <td>
                                                        <h4 class="text-muted">
                                                            <?php echo e(currency_format_with_sym($weeklyInvoice['invoiceDue'])); ?>

                                                        </h4>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="invoice_monthly_statistics" role="tabpanel"
                                    aria-labelledby="pills-profile-tab">
                                    <div class="table-responsive">
                                        <table class="table align-items-center mb-0 ">
                                            <tbody class="list">
                                                <tr>
                                                    <td>
                                                        <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                        <p class="text-muted text-sm mb-0"><?php echo e(__('Invoice Generated')); ?>

                                                        </p>

                                                    </td>
                                                    <td>
                                                        <h4 class="text-muted">
                                                            <?php echo e(currency_format_with_sym($monthlyInvoice['invoiceTotal'])); ?>

                                                        </h4>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                        <p class="text-muted text-sm mb-0"><?php echo e(__('Paid')); ?></p>
                                                    </td>
                                                    <td>
                                                        <h4 class="text-muted">
                                                            <?php echo e(currency_format_with_sym($monthlyInvoice['invoicePaid'])); ?>

                                                        </h4>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                        <p class="text-muted text-sm mb-0"><?php echo e(__('Due')); ?></p>
                                                    </td>
                                                    <td>
                                                        <h4 class="text-muted">
                                                            <?php echo e(currency_format_with_sym($monthlyInvoice['invoiceDue'])); ?>

                                                        </h4>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-7">
                    <div class="card" style="min-height: 408px;">
                        <div class="card-header">
                            <h5 class="mt-1 mb-0"><?php echo e(__('Recent Bills')); ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo e(__('Vendor')); ?></th>
                                            <th><?php echo e(__('Bill Date')); ?></th>
                                            <th><?php echo e(__('Due Date')); ?></th>
                                            <th><?php echo e(__('Amount')); ?></th>
                                            <th><?php echo e(__('Status')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $recentBill; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e(\Modules\Account\Entities\Bill::billNumberFormat($bill->bill_id)); ?>

                                                </td>
                                                <td><?php echo e(!empty($bill->vendor) ? $bill->vendor->name : ''); ?> </td>
                                                <td><?php echo e(company_date_formate($bill->bill_date)); ?></td>
                                                <td><?php echo e(company_date_formate($bill->due_date)); ?></td>
                                                <td><?php echo e(currency_format_with_sym($bill->getTotal())); ?></td>
                                                <td>
                                                    <?php if($bill->status == 0): ?>
                                                        <span
                                                            class="p-2 px-3 fix_badge rounded badge bg-secondary"><?php echo e(__(\Modules\Account\Entities\Bill::$statues[$bill->status])); ?></span>
                                                    <?php elseif($bill->status == 1): ?>
                                                        <span
                                                            class="p-2 px-3 fix_badge rounded badge bg-warning"><?php echo e(__(\Modules\Account\Entities\Bill::$statues[$bill->status])); ?></span>
                                                    <?php elseif($bill->status == 2): ?>
                                                        <span
                                                            class="p-2 px-3 fix_badge rounded badge bg-danger"><?php echo e(__(\Modules\Account\Entities\Bill::$statues[$bill->status])); ?></span>
                                                    <?php elseif($bill->status == 3): ?>
                                                        <span
                                                            class="p-2 px-3 fix_badge rounded badge bg-info"><?php echo e(__(\Modules\Account\Entities\Bill::$statues[$bill->status])); ?></span>
                                                    <?php elseif($bill->status == 4): ?>
                                                        <span
                                                            class="p-2 px-3 fix_badge rounded badge bg-success"><?php echo e(__(\Modules\Account\Entities\Bill::$statues[$bill->status])); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <?php echo $__env->make('layouts.nodatafound', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-5">
                    <div class="card" style="height: 408px">
                        <div class="card-body">

                            <ul class="nav nav-pills mb-5" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                        href="#bills_weekly_statistics" role="tab" aria-controls="pills-home"
                                        aria-selected="true"><?php echo e(__('Bills Weekly Statistics')); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                        href="#bills_monthly_statistics" role="tab" aria-controls="pills-profile"
                                        aria-selected="false"><?php echo e(__('Bills Monthly Statistics')); ?></a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="bills_weekly_statistics" role="tabpanel"
                                    aria-labelledby="pills-home-tab">
                                    <div class="table-responsive">
                                        <table class="table align-items-center mb-0 ">
                                            <tbody class="list">
                                                <tr>
                                                    <td>
                                                        <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                        <p class="text-muted text-sm mb-0"><?php echo e(__('Bill Generated')); ?></p>

                                                    </td>
                                                    <td>
                                                        <h4 class="text-muted">
                                                            <?php echo e(currency_format_with_sym($weeklyBill['billTotal'])); ?></h4>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                        <p class="text-muted text-sm mb-0"><?php echo e(__('Paid')); ?></p>
                                                    </td>
                                                    <td>
                                                        <h4 class="text-muted">
                                                            <?php echo e(currency_format_with_sym($weeklyBill['billPaid'])); ?></h4>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                        <p class="text-muted text-sm mb-0"><?php echo e(__('Due')); ?></p>
                                                    </td>
                                                    <td>
                                                        <h4 class="text-muted">
                                                            <?php echo e(currency_format_with_sym($weeklyBill['billDue'])); ?></h4>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="bills_monthly_statistics" role="tabpanel"
                                    aria-labelledby="pills-profile-tab">
                                    <div class="table-responsive">
                                        <table class="table align-items-center mb-0 ">
                                            <tbody class="list">
                                                <tr>
                                                    <td>
                                                        <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                        <p class="text-muted text-sm mb-0"><?php echo e(__('Bill Generated')); ?></p>

                                                    </td>
                                                    <td>
                                                        <h4 class="text-muted">
                                                            <?php echo e(currency_format_with_sym($monthlyBill['billTotal'])); ?></h4>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                        <p class="text-muted text-sm mb-0"><?php echo e(__('Paid')); ?></p>
                                                    </td>
                                                    <td>
                                                        <h4 class="text-muted">
                                                            <?php echo e(currency_format_with_sym($monthlyBill['billPaid'])); ?></h4>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 class="mb-0"><?php echo e(__('Total')); ?></h5>
                                                        <p class="text-muted text-sm mb-0"><?php echo e(__('Due')); ?></p>
                                                    </td>
                                                    <td>
                                                        <h4 class="text-muted">
                                                            <?php echo e(currency_format_with_sym($monthlyBill['billDue'])); ?></h4>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <?php if(module_is_active('Goal')): ?>
                    <?php echo $__env->make('goal::dashboard.dshboard_div', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/apexcharts.min.js')); ?>"></script>
    <script>
        (function() {
            var chartBarOptions = {
                series: [{
                        name: "<?php echo e(__('Income')); ?>",
                        data: <?php echo json_encode($incExpLineChartData['income']); ?>

                    },
                    {
                        name: "<?php echo e(__('Expense')); ?>",
                        data: <?php echo json_encode($incExpLineChartData['expense']); ?>

                    }
                ],

                chart: {
                    height: 250,
                    type: 'area',
                    dropShadow: {
                        enabled: true,
                        color: '#000',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.2
                    },
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                title: {
                    text: '',
                    align: 'left'
                },
                xaxis: {
                    categories: <?php echo json_encode($incExpLineChartData['day']); ?>,
                    title: {
                        text: '<?php echo e(__('Date')); ?>'
                    }
                },
                colors: ['#ffa21d', '#FF3A6E'],

                grid: {
                    strokeDashArray: 4,
                },
                legend: {
                    show: false,
                },
                yaxis: {
                    title: {
                        text: '<?php echo e(__('Amount')); ?>'
                    },

                }

            };
            var arChart = new ApexCharts(document.querySelector("#cash-flow"), chartBarOptions);
            arChart.render();
        })();

        (function() {
            var options = {
                chart: {
                    height: 180,
                    type: 'bar',
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
                    name: "<?php echo e(__('Income')); ?>",
                    data: <?php echo json_encode($incExpBarChartData['income']); ?>

                }, {
                    name: "<?php echo e(__('Expense')); ?>",
                    data: <?php echo json_encode($incExpBarChartData['expense']); ?>

                }],
                xaxis: {
                    categories: <?php echo json_encode($incExpBarChartData['month']); ?>,
                },
                colors: ['#3ec9d6', '#FF3A6E'],
                fill: {
                    type: 'solid',
                },
                grid: {
                    strokeDashArray: 4,
                },
                legend: {
                    show: true,
                    position: 'top',
                    horizontalAlign: 'right',
                },
                markers: {
                    size: 4,
                    colors: ['#3ec9d6', '#FF3A6E', ],
                    opacity: 0.9,
                    strokeWidth: 2,
                    hover: {
                        size: 7,
                    }
                }
            };
            var chart = new ApexCharts(document.querySelector("#incExpBarChart"), options);
            chart.render();
        })();

        (function() {
            var options = {
                chart: {
                    height: 140,
                    type: 'donut',
                },
                dataLabels: {
                    enabled: false,
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%',
                        }
                    }
                },
                series: <?php echo json_encode($expenseCatAmount); ?>,
                colors: <?php echo json_encode($expenseCategoryColor); ?>,
                labels: <?php echo json_encode($expenseCategory); ?>,
                legend: {
                    show: true
                }
            };
            var chart = new ApexCharts(document.querySelector("#expenseByCategory"), options);
            chart.render();
        })();

        (function() {
            var options = {
                chart: {
                    height: 140,
                    type: 'donut',
                },
                dataLabels: {
                    enabled: false,
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%',
                        }
                    }
                },
                series: <?php echo json_encode($incomeCatAmount); ?>,
                colors: <?php echo json_encode($incomeCategoryColor); ?>,
                labels: <?php echo json_encode($incomeCategory); ?>,
                legend: {
                    show: true
                }
            };
            var chart = new ApexCharts(document.querySelector("#incomeByCategory"), options);
            chart.render();
        })();
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\dsi_crm\Modules/Account\Resources/views/dashboard/dashboard.blade.php ENDPATH**/ ?>