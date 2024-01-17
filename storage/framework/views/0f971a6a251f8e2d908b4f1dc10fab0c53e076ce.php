<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Quote')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Quote')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Quote')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-action'); ?>
    <div>
        <a href="<?php echo e(route('quote.grid')); ?>" class="btn btn-sm btn-primary"
            data-bs-toggle="tooltip"title="<?php echo e(__('Grid View')); ?>">
            <i class="ti ti-layout-grid text-white"></i>
        </a>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('quote create')): ?>
            <a data-url="<?php echo e(route('quote.create', ['quote', 0])); ?>" data-size="lg" data-ajax-popup="true" data-bs-toggle="tooltip"
                data-title="<?php echo e(__('Create New Quote')); ?>" title="<?php echo e(__('Create')); ?>"class="btn btn-sm btn-primary btn-icon">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive overflow_hidden">
                        <table class="table mb-0 pc-dt-simple" id="assets">
                            <thead>
                                <tr>
                                    <th scope="col" class="sort" data-sort="name"><?php echo e(__('ID')); ?></th>
                                    <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                    <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Account')); ?></th>
                                    <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Contact')); ?></th>
                                    <th scope="col" class="sort" data-sort="status"><?php echo e(__('Status')); ?></th>
                                    <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Created At')); ?></th>
                                    <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Amount')); ?></th>
                                    <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Assign User')); ?></th>
                                    <?php if(Gate::check('quote create') ||
                                            Gate::check('quote show') ||
                                            Gate::check('quote edit') ||
                                            Gate::check('quote delete')): ?>
                                        <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $quotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $contact=\Modules\Sales\Entities\Contact::find($quote->shipping_contact);
                                    ?>
                                    <tr>
                                        <td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('quote edit')): ?>
                                                <a href="<?php echo e(route('quote.edit', $quote->id)); ?>" class="btn btn-outline-primary"
                                                    data-title="<?php echo e(__('Quote Details')); ?>">
                                                    <?php echo e(Modules\Sales\Entities\Quote::quoteNumberFormat($quote->quote_id)); ?>

                                                </a>
                                            <?php else: ?>
                                                <a href="#" class="btn btn-outline-primary">
                                                    <?php echo e(Modules\Sales\Entities\Quote::quoteNumberFormat($quote->quote_id)); ?></a>
                                            <?php endif; ?>
                                        </td>
                                        <td> <?php echo e(ucfirst($quote->name)); ?></td>
                                        <td>
                                            <?php echo e(ucfirst(!empty($quote->accounts) ? $quote->accounts->name : '--')); ?>

                                        </td>
                                        <td>
                                            <?php echo e(isset($contact->name)?$contact->name:""); ?>

                                        </td>
                                        <td>
                                            <?php if($quote->status == 0): ?>
                                                <span class="badge bg-secondary p-2 px-3 rounded"
                                                    style="width: 79px;"><?php echo e(__(Modules\Sales\Entities\Quote::$status[$quote->status])); ?></span>
                                            <?php elseif($quote->status == 1): ?>
                                                <span class="badge bg-info p-2 px-3 rounded"
                                                    style="width: 79px;"><?php echo e(__(Modules\Sales\Entities\Quote::$status[$quote->status])); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="budget"><?php echo e(company_date_formate($quote->created_at)); ?></span>
                                        </td>
                                        <td>
                                            <span class="budget"><?php echo e(currency_format_with_sym($quote->getTotal())); ?></span>
                                        </td>
                                        <td>
                                            <span class="col-sm-12"><span
                                                    class="text-m"><?php echo e(ucfirst(!empty($quote->assign_user) ? $quote->assign_user->name : '-')); ?></span></span>
                                        </td>

                                        <?php if(Gate::check('quote create') ||
                                                Gate::check('quote show') ||
                                                Gate::check('quote edit') ||
                                                Gate::check('quote delete')): ?>
                                            <td class="text-end">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('quote create')): ?>
                                                    <div class="action-btn bg-secondary ms-2">
                                                        <?php echo Form::open([
                                                            'method' => 'get',
                                                            'route' => ['quote.duplicate', $quote->id],
                                                            'id' => 'duplicate-form-' . $quote->id,
                                                        ]); ?>


                                                        <a href="#"
                                                            class="mx-3 btn btn-sm align-items-center text-white show_confirm"
                                                            data-bs-toggle="tooltip" data-title="<?php echo e(__('Duplicate')); ?>"
                                                            title="<?php echo e(__('Duplicate')); ?>"
                                                            data-confirm="<?php echo e(__('You want to confirm this action')); ?>"
                                                            data-text="<?php echo e(__('Press Yes to continue or No to go back')); ?>"
                                                            data-confirm-yes="document.getElementById('duplicate-form-<?php echo e($quote->id); ?>').submit();">
                                                            <i class="ti ti-copy"></i>
                                                            <?php echo Form::close(); ?>

                                                        </a>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if($quote->converted_salesorder_id == 0): ?>
                                                    <div class="action-btn bg-success ms-2">
                                                        <?php echo Form::open([
                                                            'method' => 'get',
                                                            'route' => ['quote.convert', $quote->id],
                                                            'id' => 'quotes-form-' . $quote->id,
                                                        ]); ?>


                                                        <a href="#"
                                                            class="mx-3 btn btn-sm align-items-center text-white show_confirm"
                                                            data-bs-toggle="tooltip"
                                                            data-title="<?php echo e(__('Convert to Sales Order')); ?>"
                                                            title="<?php echo e(__('Conver to Sale Order')); ?>"
                                                            data-confirm="<?php echo e(__('You want to confirm convert to sales order.')); ?>"
                                                            data-text="<?php echo e(__('Press Yes to continue or No to go back')); ?>"
                                                            data-confirm-yes="document.getElementById('quotes-form-<?php echo e($quote->id); ?>').submit();">
                                                            <i class="ti ti-exchange"></i>
                                                            <?php echo Form::close(); ?>

                                                        </a>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="action-btn bg-success ms-2">
                                                        <a href="<?php echo e(route('salesorder.show', $quote->converted_salesorder_id)); ?>"
                                                            class="mx-3 btn btn-sm align-items-center text-white"
                                                            data-bs-toggle="tooltip"
                                                            data-original-title="<?php echo e(__('Sales Order Details')); ?>"
                                                            title="<?php echo e(__('SalesOrders Details')); ?>">
                                                            <i class="fab fa-stack-exchange"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('quote show')): ?>
                                                    <div class="action-btn bg-warning ms-2">
                                                        <a href="<?php echo e(route('quote.show', $quote->id)); ?>"
                                                            data-size="md"class="mx-3 btn btn-sm align-items-center text-white "
                                                            data-bs-toggle="tooltip" title="<?php echo e(__('Quick View')); ?>"
                                                            data-title="<?php echo e(__('Quote Details')); ?>">
                                                            <i class="ti ti-eye"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('quote edit')): ?>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="<?php echo e(route('quote.edit', $quote->id)); ?>"
                                                            class="mx-3 btn btn-sm align-items-center text-white"
                                                            data-bs-toggle="tooltip" title="<?php echo e(__('Details')); ?>"
                                                            data-title="<?php echo e(__('Edit Quote')); ?>"><i
                                                                class="ti ti-pencil"></i></a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('quote delete')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['quote.destroy', $quote->id]]); ?>

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
                    url: '<?php echo e(route('quote.getaccount')); ?>',
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

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DSI_Laravel\Modules/Sales\Resources/views/quote/index.blade.php ENDPATH**/ ?>