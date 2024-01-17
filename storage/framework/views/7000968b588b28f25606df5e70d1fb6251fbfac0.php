<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Customers')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Customers')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).on('click', '#billing_data', function () {
            $("[name='shipping_name']").val($("[name='billing_name']").val());
            $("[name='shipping_country']").val($("[name='billing_country']").val());
            $("[name='shipping_state']").val($("[name='billing_state']").val());
            $("[name='shipping_city']").val($("[name='billing_city']").val());
            $("[name='shipping_phone']").val($("[name='billing_phone']").val());
            $("[name='shipping_zip']").val($("[name='billing_zip']").val());
            $("[name='shipping_address']").val($("[name='billing_address']").val());
        })
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-action'); ?>
<div>
    <?php echo $__env->yieldPushContent('addButtonHook'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customer import')): ?>
        <a href="#"  class="btn btn-sm btn-primary" data-ajax-popup="true" data-title="<?php echo e(__('Customer Import')); ?>" data-url="<?php echo e(route('customer.file.import')); ?>"  data-toggle="tooltip" title="<?php echo e(__('Import')); ?>"><i class="ti ti-file-import"></i>
        </a>
    <?php endif; ?>
    <a href="<?php echo e(route('customer.grid')); ?>" class="btn btn-sm btn-primary btn-icon"
            data-bs-toggle="tooltip"title="<?php echo e(__('Grid View')); ?>">
            <i class="ti ti-layout-grid text-white"></i>
        </a>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customer create')): ?>
        <a  class="btn btn-sm btn-primary" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Create New Customer')); ?>" data-url="<?php echo e(route('customer.create')); ?>" data-bs-toggle="tooltip"  data-bs-original-title="<?php echo e(__('Create')); ?>">
            <i class="ti ti-plus"></i>
        </a>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table mb-0 pc-dt-simple" id="assets">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th> <?php echo e(__('Name')); ?></th>
                                <th> <?php echo e(__('Contact')); ?></th>
                                <th> <?php echo e(__('Email')); ?></th>
                                <th> <?php echo e(__('Balance')); ?></th>
                                <?php if(Gate::check('customer edit') || Gate::check('customer delete') || Gate::check('customer show')): ?>
                                    <th width="200px"><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php if(!empty($customer['customer_id'])): ?>
                                    <td class="Id">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customer show')): ?>
                                            <a href="<?php echo e(route('customer.show',\Crypt::encrypt($customer['id']))); ?>" class="btn btn-outline-primary">
                                                <?php echo e(Modules\Account\Entities\Customer::customerNumberFormat($customer['customer_id'])); ?>

                                            </a>
                                        <?php else: ?>
                                            <a class="btn btn-outline-primary">
                                                <?php echo e(Modules\Account\Entities\Customer::customerNumberFormat($customer['customer_id'])); ?>

                                            </a>
                                        <?php endif; ?>
                                    </td>
                                <?php else: ?>
                                    <td>--</td>
                                <?php endif; ?>
                                <td class="font-style"><?php echo e($customer['name']); ?></td>
                                <td><?php echo e($customer['contact']); ?></td>
                                <td><?php echo e($customer['email']); ?></td>
                                <td><?php echo e(currency_format_with_sym($customer['balance'])); ?></td>
                                <?php if(Gate::check('customer edit') || Gate::check('customer delete') || Gate::check('customer show')): ?>
                                    <td class="Action">
                                        <?php if($customer->is_disable == 1): ?>
                                            <span>
                                                <?php if(!empty($customer['customer_id'])): ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customer show')): ?>
                                                    <div class="action-btn bg-warning ms-2">
                                                        <a href="<?php echo e(route('customer.show',\Crypt::encrypt($customer['id']))); ?>" class="mx-3 btn btn-sm align-items-center"
                                                        data-bs-toggle="tooltip" title="<?php echo e(__('View')); ?>">
                                                            <i class="ti ti-eye text-white text-white"></i>
                                                        </a>
                                                    </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customer edit')): ?>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a  class="mx-3 btn btn-sm  align-items-center"
                                                            data-url="<?php echo e(route('customer.edit',$customer['id'])); ?>" data-ajax-popup="true"  data-size="lg"
                                                            data-bs-toggle="tooltip" title=""
                                                            data-title="<?php echo e(__('Edit Customer')); ?>"
                                                            data-bs-original-title="<?php echo e(__('Edit')); ?>">
                                                            <i class="ti ti-pencil text-white"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if(!empty($customer['customer_id'])): ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customer delete')): ?>
                                                        <div class="action-btn bg-danger ms-2">
                                                            <?php echo e(Form::open(array('route'=>array('customer.destroy', $customer['id']),'class' => 'm-0'))); ?>

                                                            <?php echo method_field('DELETE'); ?>
                                                                <a
                                                                    class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm"
                                                                    data-bs-toggle="tooltip" title="" data-bs-original-title="Delete"
                                                                    aria-label="Delete" data-confirm="<?php echo e(__('Are You Sure?')); ?>" data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"  data-confirm-yes="delete-form-<?php echo e($customer['id']); ?>"><i
                                                                        class="ti ti-trash text-white text-white"></i></a>
                                                            <?php echo e(Form::close()); ?>

                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </span>
                                        <?php else: ?>
                                            <div class="text-center">
                                                <i class="ti ti-lock"></i>
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

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DSI_Laravel\Modules/Account\Resources/views/customer/index.blade.php ENDPATH**/ ?>