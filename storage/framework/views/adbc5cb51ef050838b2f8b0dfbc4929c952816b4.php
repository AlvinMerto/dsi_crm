<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Custom Field')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Custom Field')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-action'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customfield create')): ?>
        <div class="float-end">
            <a href="#" data-url="<?php echo e(route('custom-field.create')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"
                data-ajax-popup="true" data-title="<?php echo e(__('Create New Custom Field')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0 pc-dt-simple" id="custom_field">
                            <thead>
                                <tr>
                                    <th> <?php echo e(__('Custom Field')); ?></th>
                                    <th> <?php echo e(__('Type')); ?></th>
                                    <th> <?php echo e(__('Module')); ?></th>
                                    <?php if(Gate::check('customfield edit') || Gate::check('customfield delete')): ?>
                                        <th width="10%"> <?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $custom_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($field->name); ?></td>
                                        <td><?php echo e($field->type); ?></td>
                                        <td>
                                            <div class="page-header">
                                                <ul class="breadcrumb  m-1">
                                                    <li class="breadcrumb-item"> <?php echo e(ucfirst( Module_Alias_Name($field->module))); ?></li>
                                                    <?php if(!empty($field->sub_module)): ?>
                                                        <li class="breadcrumb-item"> <?php echo e(ucfirst($field->sub_module)); ?> </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </td>
                                        <?php if(Gate::check('customfield edit') || Gate::check('customfield delete')): ?>
                                            <td class="Action">
                                                <span>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customfield edit')): ?>
                                                        <div class="action-btn bg-info ms-2">
                                                            <a href="#" class="mx-3 btn btn-sm align-items-center"
                                                                data-url="<?php echo e(route('custom-field.edit', $field->id)); ?>"
                                                                data-ajax-popup="true"
                                                                data-title="<?php echo e(__('Edit Custom Field')); ?>"
                                                                data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>"
                                                                data-original-title="<?php echo e(__('Edit')); ?>">
                                                                <i class="ti ti-pencil text-white"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customfield delete')): ?>
                                                        <div class="action-btn bg-danger ms-2">
                                                            <?php echo Form::open([
                                                                'method' => 'DELETE',
                                                                'route' => ['custom-field.destroy', $field->id],
                                                                'id' => 'delete-form-' . $field->id,
                                                            ]); ?>

                                                            <a href="#"
                                                                class="mx-3 btn btn-sm align-items-center show_confirm"
                                                                data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"
                                                                data-original-title="<?php echo e(__('Delete')); ?>"
                                                                data-confirm="<?php echo e(__('Are You Sure?')); ?>" data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                                data-confirm-yes="document.getElementById('delete-form-<?php echo e($field->id); ?>').submit();">
                                                                <i class="ti ti-trash text-white"></i>
                                                            </a>
                                                            <?php echo Form::close(); ?>

                                                        </div>
                                                    <?php endif; ?>
                                                </span>
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

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dimensionsystems/webcrm.dimensionsystems.com/Modules/CustomField/Resources/views/index.blade.php ENDPATH**/ ?>