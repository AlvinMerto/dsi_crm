<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Sales Invoice')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Invoice')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Sales Invoice')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-action'); ?>
    <div class="action-btn ms-2">
        <?php echo $__env->yieldPushContent('addButtonHook'); ?>

        <a href="<?php echo e(route('salesinvoice.grid')); ?>" class="btn btn-sm btn-primary"
            data-bs-toggle="tooltip"title="<?php echo e(__('Grid View')); ?>">
            <i class="ti ti-layout-grid text-white"></i>
        </a>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesinvoice create')): ?>
            <a data-size="lg" data-url="<?php echo e(route('salesinvoice.create', ['invoice', 0])); ?>" data-ajax-popup="true"
                data-bs-toggle="tooltip" data-title="<?php echo e(__('Create New Sales Invoice')); ?>" title=" <?php echo e(__('Create')); ?>"
                class="btn btn-sm btn-primary btn-icon m-1">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0 pc-dt-simple" id="assets">
                            <thead>
                                <tr>
                                    <th scope="col" class="sort" data-sort="id"><?php echo e(__('ID')); ?></th>
                                    <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                    <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Account')); ?></th>
                                    <th scope="col" class="sort" data-sort="status"><?php echo e(__('Status')); ?></th>
                                    <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Created At')); ?>

                                    </th>
                                    <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Amount')); ?></th>
                                    <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Assigned User')); ?>

                                    </th>
                                    <?php if(Gate::check('salesinvoice show') || Gate::check('salesinvoice edit') || Gate::check('salesinvoice delete')): ?>
                                        <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesinvoice edit')): ?>
                                                <a href="<?php echo e(route('salesinvoice.edit', $invoice->id)); ?>"
                                                    class="btn btn-outline-primary" data-title="<?php echo e(__('Quote Details')); ?>">
                                                    <?php echo e(Modules\Sales\Entities\SalesInvoice::invoiceNumberFormat($invoice->invoice_id)); ?>

                                                </a>
                                            <?php else: ?>
                                                <a href="#" class="btn btn-outline-primary"
                                                    data-title="<?php echo e(__('Quote Details')); ?>">
                                                    <?php echo e(Modules\Sales\Entities\SalesInvoice::invoiceNumberFormat($invoice->invoice_id)); ?>

                                                </a>
                                            <?php endif; ?>

                                        </td>
                                        <td>
                                            <span class="budget">
                                                <?php echo e(ucfirst($invoice->name)); ?>


                                            </span>
                                        </td>
                                        <td>
                                            <span class="budget">
                                                <?php echo e(ucfirst(!empty($invoice->accounts) ? $invoice->accounts->name : '--')); ?></span>
                                        </td>
                                        <td>
                                            <?php if($invoice->status == 0): ?>
                                                <span class="badge bg-secondary p-2 px-3 rounded"
                                                    style="width: 91px;"><?php echo e(__(Modules\Sales\Entities\SalesInvoice::$status[$invoice->status])); ?></span>
                                            <?php elseif($invoice->status == 1): ?>
                                                <span class="badge bg-danger p-2 px-3 rounded"
                                                    style="width: 91px;"><?php echo e(__(Modules\Sales\Entities\SalesInvoice::$status[$invoice->status])); ?></span>
                                            <?php elseif($invoice->status == 2): ?>
                                                <span class="badge bg-warning p-2 px-3 rounded"
                                                    style="width: 91px;"><?php echo e(__(Modules\Sales\Entities\SalesInvoice::$status[$invoice->status])); ?></span>
                                            <?php elseif($invoice->status == 3): ?>
                                                <span class="badge bg-success p-2 px-3 rounded"
                                                    style="width: 91px;"><?php echo e(__(Modules\Sales\Entities\SalesInvoice::$status[$invoice->status])); ?></span>
                                            <?php elseif($invoice->status == 4): ?>
                                                <span class="badge bg-info p-2 px-3 rounded"
                                                    style="width: 91px;"><?php echo e(__(Modules\Sales\Entities\SalesInvoice::$status[$invoice->status])); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="budget"><?php echo e(company_date_formate($invoice->created_at)); ?></span>
                                        </td>
                                        <td>
                                            <span
                                                class="budget"><?php echo e(currency_format_with_sym($invoice->getTotal())); ?></span>
                                        </td>
                                        <td>
                                            <span
                                                class="budget"><?php echo e(ucfirst(!empty($invoice->assign_user) ? $invoice->assign_user->name : '-')); ?></span>
                                        </td>
                                        <?php if(Gate::check('salesinvoice show') || Gate::check('salesinvoice edit') || Gate::check('salesinvoice delete')): ?>
                                            <td class="text-end">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesinvoice create')): ?>
                                                    <div class="action-btn bg-secondary ms-2">
                                                        <?php echo Form::open([
                                                            'method' => 'get',
                                                            'route' => ['salesinvoice.duplicate', $invoice->id],
                                                            'id' => 'duplicate-form-' . $invoice->id,
                                                        ]); ?>


                                                        <a href="#"
                                                            class="mx-3 btn btn-sm align-items-center text-white show_confirm"
                                                            data-bs-toggle="tooltip" title="<?php echo e(__('Duplicate')); ?>"
                                                            data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>"
                                                            data-confirm="<?php echo e(__('You want to confirm this action')); ?>"
                                                            data-text="<?php echo e(__('Press Yes to continue or No to go back')); ?>"
                                                            data-confirm-yes="document.getElementById('duplicate-form-<?php echo e($invoice->id); ?>').submit();">
                                                            <i class="ti ti-copy"></i>
                                                            <?php echo Form::close(); ?>

                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesinvoice show')): ?>
                                                    <div class="action-btn bg-warning ms-2">
                                                        <a href="<?php echo e(route('salesinvoice.show', $invoice->id)); ?>"
                                                            data-bs-toggle="tooltip" title="<?php echo e(__('Quick View')); ?>"
                                                            class="mx-3 btn btn-sm align-items-center text-white "
                                                            data-title="<?php echo e(__('Invoice Details')); ?>">
                                                            <i class="ti ti-eye"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesinvoice edit')): ?>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="<?php echo e(route('salesinvoice.edit', $invoice->id)); ?>"
                                                            data-bs-toggle="tooltip" title="<?php echo e(__('Details')); ?>"
                                                            class="mx-3 btn btn-sm align-items-center text-white "
                                                            data-title="<?php echo e(__('Edit Invoice')); ?>"><i
                                                                class="ti ti-pencil"></i></a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesinvoice delete')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['salesinvoice.destroy', $invoice->id]]); ?>

                                                        <a href="#!"
                                                            class="mx-3 btn btn-sm   align-items-center text-white show_confirm"
                                                            data-bs-toggle="tooltip" title='Delete'>
                                                            <i class="ti ti-trash"></i>
                                                        </a>
                                                        <?php echo Form::close(); ?>

                                                    </div>
                                                <?php endif; ?>

                                            </td>
                                        <?php endif; ?>
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
                url: '<?php echo e(route('salesinvoice.getaccount')); ?>',
                type: 'POST',
                data: {
                    "opportunities_id": opportunities_id,
                    "_token": "<?php echo e(csrf_token()); ?>",
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dimensionsystems/webcrm.dimensionsystems.com/Modules/Sales/Resources/views/salesinvoice/index.blade.php ENDPATH**/ ?>