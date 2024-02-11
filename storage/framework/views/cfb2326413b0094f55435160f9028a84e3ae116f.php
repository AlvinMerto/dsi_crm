
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Cases')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Cases')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Cases')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(Module::asset('Sales:Resources/assets/css/custom.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-action'); ?>
    <div>
        <?php echo $__env->yieldPushContent('addButtonHook'); ?>

        <a href="<?php echo e(route('commoncases.grid')); ?>" class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip"
            title="<?php echo e(__('Grid View')); ?>">
            <i class="ti ti-layout-grid text-white"></i>
        </a>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('case create')): ?>
            <a data-size="lg" data-url="<?php echo e(route('commoncases.create', ['commoncases', 0])); ?>" data-ajax-popup="true"
                data-bs-toggle="tooltip" data-title="<?php echo e(__('Create New Case')); ?>"title="<?php echo e(__('Create')); ?>"
                class="btn btn-sm btn-primary btn-icon">
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
                                    <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                    <th scope="col" class="sort" data-sort="budget"><?php echo e(__('File')); ?></th>
                                    <th scope="col" class="sort" data-sort="name"><?php echo e(__('Number')); ?></th>
                                    <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Account')); ?></th>
                                    <th scope="col" class="sort" data-sort="status"><?php echo e(__('Status')); ?></th>
                                    <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Priority')); ?></th>
                                    <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Assigned User')); ?></th>
                                    <?php if(Gate::check('case show') || Gate::check('case edit') || Gate::check('case delete')): ?>
                                        <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $cases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $case): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo e(route('commoncases.edit', $case->id)); ?>" data-size="md"
                                                data-title="<?php echo e(__('Cases Details')); ?>" class="text-primary">
                                                <?php echo e($case->name); ?>

                                            </a>
                                        </td>
                                        <td class="budget">
                                            <?php if(!empty($case->attachments)): ?>
                                                <a href="<?php echo e(get_file($case->attachments)); ?>" download=""><i
                                                        class="ti ti-download"></i></a>
                                            <?php else: ?>
                                                <span>
                                                    <?php echo e(__('No File')); ?>

                                                </span>
                                            <?php endif; ?>

                                        </td>
                                        <td><?php echo e($case->number); ?></td>
                                        <td>
                                            <?php echo e(!empty($case->accounts->name) ? $case->accounts->name : '--'); ?>

                                        </td>
                                        <td>
                                            <?php if($case->status == 0): ?>
                                                <span class="badge bg-success p-2 px-3 rounded"
                                                    style="width: 73px;"><?php echo e(__(Modules\Sales\Entities\CommonCase::$status[$case->status])); ?></span>
                                            <?php elseif($case->status == 1): ?>
                                                <span class="badge bg-info p-2 px-3 rounded"
                                                    style="width: 73px;"><?php echo e(__(Modules\Sales\Entities\CommonCase::$status[$case->status])); ?></span>
                                            <?php elseif($case->status == 2): ?>
                                                <span class="badge bg-warning p-2 px-3 rounded"
                                                    style="width: 73px;"><?php echo e(__(Modules\Sales\Entities\CommonCase::$status[$case->status])); ?></span>
                                            <?php elseif($case->status == 3): ?>
                                                <span class="badge bg-danger p-2 px-3 rounded"
                                                    style="width: 73px;"><?php echo e(__(Modules\Sales\Entities\CommonCase::$status[$case->status])); ?></span>
                                            <?php elseif($case->status == 4): ?>
                                                <span class="badge bg-danger p-2 px-3 rounded"
                                                    style="width: 73px;"><?php echo e(__(Modules\Sales\Entities\CommonCase::$status[$case->status])); ?></span>
                                            <?php elseif($case->status == 5): ?>
                                                <span class="badge bg-warning p-2 px-3 rounded"
                                                    style="width: 73px;"><?php echo e(__(Modules\Sales\Entities\CommonCase::$status[$case->status])); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($case->priority == 0): ?>
                                                <span class="badge bg-primary p-2 px-3 rounded"
                                                    style="width: 73px;"><?php echo e(__(Modules\Sales\Entities\CommonCase::$priority[$case->priority])); ?></span>
                                            <?php elseif($case->priority == 1): ?>
                                                <span class="badge bg-info p-2 px-3 rounded"
                                                    style="width: 73px;"><?php echo e(__(Modules\Sales\Entities\CommonCase::$priority[$case->priority])); ?></span>
                                            <?php elseif($case->priority == 2): ?>
                                                <span class="badge bg-warning p-2 px-3 rounded"
                                                    style="width: 73px;"><?php echo e(__(Modules\Sales\Entities\CommonCase::$priority[$case->priority])); ?></span>
                                            <?php elseif($case->priority == 3): ?>
                                                <span class="badge bg-danger  p-2 px-3 rounded"
                                                    style="width: 73px;"><?php echo e(__(Modules\Sales\Entities\CommonCase::$priority[$case->priority])); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo e(!empty($case->assign_user) ? $case->assign_user->name : ''); ?>

                                        </td>
                                        <?php if(Gate::check('case show') || Gate::check('case edit') || Gate::check('case delete')): ?>
                                            <td class="text-end">

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('case show')): ?>
                                                    <div class="action-btn bg-warning ms-2">
                                                        <a data-size="md" data-url="<?php echo e(route('commoncases.show', $case->id)); ?>"
                                                            data-ajax-popup="true" data-bs-toggle="tooltip"
                                                            data-title="<?php echo e(__('Cases Details')); ?>"title="<?php echo e(__('Quick View')); ?>"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-eye"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('case edit')): ?>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="<?php echo e(route('commoncases.edit', $case->id)); ?>"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white "
                                                            data-bs-toggle="tooltip"
                                                            data-title="<?php echo e(__('Edit Cases')); ?>"title="<?php echo e(__('Details')); ?>"><i
                                                                class="ti ti-pencil"></i></a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('case delete')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['commoncases.destroy', $case->id]]); ?>

                                                        <a href="#!"
                                                            class="mx-3 btn btn-sm   align-items-center text-white show_confirm"
                                                            data-bs-toggle="tooltip" title='Delete'>
                                                            <i class="ti ti-trash"></i>
                                                        </a>
                                                        <?php echo Form::close(); ?>

                                                    <?php endif; ?>
                                                </div>
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

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\dsi_crm\Modules/Sales\Resources/views/commoncase/index.blade.php ENDPATH**/ ?>