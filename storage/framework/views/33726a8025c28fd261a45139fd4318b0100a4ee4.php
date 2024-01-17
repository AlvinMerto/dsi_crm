<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Bank Account')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
<?php echo e(__('Bank Account')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-action'); ?>
<div>
    <?php echo $__env->yieldPushContent('addButtonHook'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bank account create')): ?>
        <a  class="btn btn-sm btn-primary" data-ajax-popup="true" data-size="md" data-title="<?php echo e(__('Create New Account')); ?>" data-url="<?php echo e(route('bank-account.create')); ?>" data-bs-toggle="tooltip"  data-bs-original-title="<?php echo e(__('Create')); ?>">
            <i class="ti ti-plus"></i>
        </a>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0 pc-dt-simple" id="assets">
                            <thead>
                            <tr>
                                <th> <?php echo e(__('Name')); ?></th>
                                <th> <?php echo e(__('Bank')); ?></th>
                                <th> <?php echo e(__('Account Number')); ?></th>
                                <th> <?php echo e(__('Current Balance')); ?></th>
                                <th> <?php echo e(__('Contact Number')); ?></th>
                                <th> <?php echo e(__('Bank Branch')); ?></th>
                                <?php if(Gate::check('bank account edit') || Gate::check('bank account delete')): ?>
                                    <th width="10%"> <?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="font-style">
                                    <td><?php echo e($account->holder_name); ?></td>
                                    <td><?php echo e($account->bank_name); ?></td>
                                    <td><?php echo e($account->account_number); ?></td>
                                    <td><?php echo e(currency_format_with_sym($account->opening_balance)); ?></td>
                                    <td><?php echo e($account->contact_number); ?></td>
                                    <td><?php echo e($account->bank_address); ?></td>
                                    <?php if(Gate::check('bank account edit') || Gate::check('bank account delete')): ?>
                                        <td class="Action">
                                            <span>
                                            <?php if($account->holder_name!='Cash'): ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bank account edit')): ?>
                                                        <div class="action-btn bg-info ms-2">
                                                            <a  class="mx-3 btn btn-sm align-items-center" data-url="<?php echo e(route('bank-account.edit',$account->id)); ?>" data-ajax-popup="true" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Edit Bank Account')); ?>"data-bs-toggle="tooltip"  data-size="md"  data-original-title="<?php echo e(__('Edit')); ?>">
                                                                <i class="ti ti-pencil text-white"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bank account delete')): ?>
                                                        <div class="action-btn bg-danger ms-2">
                                                            <?php echo e(Form::open(array('route'=>array('bank-account.destroy', $account->id),'class' => 'm-0'))); ?>

                                                            <?php echo method_field('DELETE'); ?>
                                                                <a
                                                                    class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm"
                                                                    data-bs-toggle="tooltip" title="" data-bs-original-title="Delete"
                                                                    aria-label="Delete" data-confirm="<?php echo e(__('Are You Sure?')); ?>" data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"  data-confirm-yes="delete-form-<?php echo e($account->id); ?>"><i
                                                                        class="ti ti-trash text-white text-white"></i></a>
                                                            <?php echo e(Form::close()); ?>

                                                        </div>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    -
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

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DSI_Laravel\Modules/Account\Resources/views/bankAccount/index.blade.php ENDPATH**/ ?>