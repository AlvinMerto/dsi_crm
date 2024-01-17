<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Sales Account')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Account')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Sales Account')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-action'); ?>
    <div>
        <?php echo $__env->yieldPushContent('addButtonHook'); ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesaccount import')): ?>
            <a href="#" class="btn btn-sm btn-primary" data-ajax-popup="true" data-title="<?php echo e(__('Sales Account Import')); ?>"
                data-url="<?php echo e(route('salesaccount.file.import')); ?>" data-toggle="tooltip" title="<?php echo e(__('Import')); ?>"><i
                    class="ti ti-file-import"></i>
            </a>
        <?php endif; ?>
        <a href="<?php echo e(route('salesaccount.grid')); ?>" class="btn btn-sm btn-primary btn-icon"
            data-bs-toggle="tooltip"title="<?php echo e(__('Grid View')); ?>">
            <i class="ti ti-layout-grid text-white"></i>
        </a>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesaccount create')): ?>
            <a data-url="<?php echo e(route('salesaccount.create', ['account', 0])); ?>" data-size="lg" data-ajax-popup="true"
                data-bs-toggle="tooltip" data-title="<?php echo e(__('Create New Sales Account')); ?>"title="<?php echo e(__('Create')); ?>"
                class="btn btn-sm btn-primary btn-icon">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(Module::asset('Sales:Resources/assets/css/custom.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive overflow_hidden">
                        <table class="table mb-0 pc-dt-simple" id="assets">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                    <th scope="col" class="sort" data-sort="Email"><?php echo e(__('Email')); ?></th>
                                    <th scope="col" class="sort" data-sort="Phone"><?php echo e(__('Phone')); ?></th>
                                    <th scope="col" class="sort" data-sort="Website"><?php echo e(__('Website')); ?></th>
                                    <?php if(Gate::check('salesaccount show') || Gate::check('salesaccount edit') || Gate::check('salesaccount delete')): ?>
                                        <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo e(route('salesaccount.edit', $account->id)); ?>" data-size="md"
                                                data-title="<?php echo e(__('Account Details')); ?>" class="action-item text-primary">
                                                <?php echo e(ucfirst($account->name)); ?>

                                            </a>
                                        </td>
                                        <td class="budget">
                                            <?php echo e($account->email); ?>

                                        </td>
                                        <td>
                                            <span class="budget"> <?php echo e($account->phone); ?> </span>
                                        </td>
                                        <td>
                                            <span class="budget"><?php echo e($account->website); ?></span>
                                        </td>

                                        <?php if(Gate::check('salesaccount show') || Gate::check('salesaccount edit') || Gate::check('salesaccount delete')): ?>
                                            <td class="text-end">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesaccount show')): ?>
                                                    <div class="action-btn bg-warning ms-2">
                                                        <a data-size="md"
                                                            data-url="<?php echo e(route('salesaccount.show', $account->id)); ?>"
                                                            data-ajax-popup="true" data-bs-toggle="tooltip"
                                                            title="<?php echo e(__('Quick View')); ?>"
                                                            data-title="<?php echo e(__('Sales Account Details')); ?>"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-eye"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesaccount edit')): ?>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="<?php echo e(route('salesaccount.edit', $account->id)); ?>"
                                                            data-size="md"class="mx-3 btn btn-sm d-inline-flex align-items-center text-white "
                                                            data-bs-toggle="tooltip"data-title="<?php echo e(__('Account Edit')); ?>"
                                                            title="<?php echo e(__('Details')); ?>"><i class="ti ti-pencil"></i></a>

                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesaccount delete')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['salesaccount.destroy', $account->id]]); ?>

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
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DSI_Laravel\Modules/Sales\Resources/views/salesaccount/index.blade.php ENDPATH**/ ?>