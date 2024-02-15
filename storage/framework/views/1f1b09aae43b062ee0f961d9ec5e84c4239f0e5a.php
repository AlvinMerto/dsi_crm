

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Pipelines')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-action'); ?>
    <div class="row align-items-center m-1">
        <div class="col-auto pe-0">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pipeline create')): ?>
                <a data-size="md" class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Create Pipeline')); ?>" data-ajax-popup="true" data-size="md" data-title="<?php echo e(__('Create Pipeline')); ?>" data-url="<?php echo e(route('pipelines.create')); ?>"><i class="ti ti-plus text-white"></i></a>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Setup')); ?>,
    <?php echo e(__('Pipelines')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-3 col-12">
            <?php echo $__env->make('lead::layouts.system_setup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-xl-9">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table " id="pipeline">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Pipeline')); ?></th>
                                    <th width="250px"><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $pipelines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pipeline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($pipeline->name); ?></td>
                                        <td class="Action">
                                            <span>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pipeline edit')): ?>
                                                <div class="action-btn bg-info ms-2">
                                                    <a data-size="md" data-url="<?php echo e(URL::to('pipelines/'.$pipeline->id.'/edit')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Pipeline')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Edit Pipeline')); ?>" ><i class="ti ti-pencil text-white"></i></a>
                                                </div>
                                                <?php endif; ?>
                                                <?php if(count($pipelines) > 1): ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pipeline delete')): ?>
                                                        <div class="action-btn bg-danger mx-2">
                                                            <div class="action-btn bg-danger">
                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['pipelines.destroy', $pipeline->id]]); ?>

                                                                <a href="#!" class="btn btn-sm d-inline-flex align-items-center show_confirm" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Delete')); ?>">
                                                                    <span class="text-white"> <i class="ti ti-trash"></i></span></a>
                                                                <?php echo Form::close(); ?>

                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </span>
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

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\dsi_crm\Modules/Lead\Resources/views/pipelines/index.blade.php ENDPATH**/ ?>