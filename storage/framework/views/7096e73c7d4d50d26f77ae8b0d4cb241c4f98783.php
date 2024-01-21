
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Assets')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection("page-breadcrumb"); ?>
    <?php echo e(__('Assets')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-action'); ?>
    <div>
        <?php echo $__env->yieldPushContent('addButtonHook'); ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('assets import')): ?>
            <a href="#"  class="btn btn-sm btn-primary" data-ajax-popup="true" data-title="<?php echo e(__('Assets Import')); ?>" data-url="<?php echo e(route('assets.file.import')); ?>"  data-toggle="tooltip" title="<?php echo e(__('Import')); ?>"><i class="ti ti-file-import"></i>
            </a>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('assets create')): ?>
            <a  class="btn btn-sm btn-primary" data-size="md" data-url="<?php echo e(route('asset.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Assets')); ?>"  data-bs-toggle="tooltip"  data-bs-original-title="<?php echo e(__('Create')); ?>">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0 pc-dt-simple" id="assets">
                            <thead>
                            <tr>
                                <?php if(module_is_active('Hrm')): ?>
                                <?php if(in_array(\Auth::user()->type, \Auth::user()->not_emp_type)): ?>
                                    <th><?php echo e(__('Employee')); ?></th>
                                <?php endif; ?>
                                <?php endif; ?>

                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Purchase Date')); ?></th>
                                <th><?php echo e(__('Supported Date')); ?></th>
                                <th><?php echo e(__('Amount')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                                <?php if(Gate::check('assets edit') || Gate::check('assets delete')): ?>
                                    <th class="text-end"><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php if(module_is_active('Hrm')): ?>

                                        <td><?php echo e(!empty( Modules\Hrm\Entities\Employee::getEmployee($asset->user_id)) ? Modules\Hrm\Entities\Employee::getEmployee($asset->user_id)->name : ''); ?></td>
                                    <?php endif; ?>
                                        <td class="font-style"><?php echo e($asset->name); ?></td>
                                        <td class="font-style"><?php echo e(company_date_formate($asset->purchase_date)); ?></td>
                                        <td class="font-style"><?php echo e(company_date_formate($asset->supported_date)); ?></td>
                                        <td class="font-style"><?php echo e(currency_format($asset->amount)); ?>  <?php echo e(company_setting('defult_currancy') ? company_setting('defult_currancy') : 'USD'); ?></td>
                                        <td class="font-style"><?php echo e(!empty($asset->description)?$asset->description:'-'); ?></td>
                                    <?php if(Gate::check('assets edit') || Gate::check('assets delete')): ?>
                                        <td class="text-end">
                                            <span>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('assets edit')): ?>
                                                        <div class="action-btn bg-info ms-2">
                                                            <a  class="mx-3 btn btn-sm align-items-center" data-url="<?php echo e(route('asset.edit',$asset->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Assets')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                                                <i class="ti ti-pencil text-white"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('assets delete')): ?>
                                                        <div class="action-btn bg-danger ms-2" data-bs-whatever="<?php echo e(__('Delete Asset')); ?>" data-bs-toggle="tooltip" title="" data-bs-original-title="<?php echo e(__('Delete')); ?>">
                                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['asset.destroy', $asset->id],'id'=>'delete-form-'.$asset->id]); ?>

                                                            <a  class="mx-3 btn btn-sm align-items-center bs-pass-para show_confirm" data-confirm="<?php echo e(__('Are You Sure?')); ?>" data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($asset->id); ?>').submit();">
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

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DSI_crm\Modules/Assets\Resources/views/index.blade.php ENDPATH**/ ?>