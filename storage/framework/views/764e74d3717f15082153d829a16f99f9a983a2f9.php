<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Bank Transfer Request')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Bank Transfer Request')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable pc-dt-simple" id="test">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Order Id')); ?></th>
                                <th><?php echo e(__('Date')); ?></th>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Price')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Attachment')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $bank_transfer_payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank_transfer_payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($bank_transfer_payment->order_id); ?></td>
                                    <td><?php echo e(company_datetime_formate($bank_transfer_payment->created_at)); ?></td>
                                    <td><?php echo e(!empty($bank_transfer_payment->User) ? $bank_transfer_payment->User->name : ''); ?></td>
                                    <td><?php echo e($bank_transfer_payment->price.' '.$bank_transfer_payment->price_currency); ?></td>
                                    <td>
                                        <?php if($bank_transfer_payment->status == 'Approved'): ?>
                                            <span class="bg-success p-1 px-3 rounded text-white"><?php echo e(ucfirst($bank_transfer_payment->status)); ?></span>
                                        <?php elseif($bank_transfer_payment->status == 'Pending'): ?>
                                            <span class="bg-warning p-1 px-3 rounded text-white"><?php echo e(ucfirst($bank_transfer_payment->status)); ?></span>
                                        <?php else: ?>
                                            <span class="bg-danger p-1 px-3 rounded text-white"><?php echo e(ucfirst($bank_transfer_payment->status)); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if(!empty($bank_transfer_payment->attachment) && (check_file($bank_transfer_payment->attachment))): ?>
                                        <div class="action-btn bg-primary ms-2">
                                            <a class="mx-3 btn btn-sm align-items-center" href="<?php echo e(get_file($bank_transfer_payment->attachment)); ?>" download>
                                                <i class="ti ti-download text-white"></i>
                                            </a>
                                        </div>
                                            <div class="action-btn bg-secondary ms-2">
                                                <a class="mx-3 btn btn-sm align-items-center" href="<?php echo e(get_file($bank_transfer_payment->attachment)); ?>" target="_blank"  >
                                                    <i class="ti ti-crosshair text-white" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Preview')); ?>"></i>
                                                </a>
                                            </div>
                                        <?php else: ?>
                                            <p>-</p>
                                        <?php endif; ?>
                                    </td>
                                    <td class="Action">
                                        <span>
                                            <div class="action-btn bg-primary ms-2">
                                                <a  class="mx-3 btn btn-sm  align-items-center"
                                                    data-url="<?php echo e(route('bank-transfer-request.edit', $bank_transfer_payment->id)); ?>"
                                                    data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip" title=""
                                                    data-title="<?php echo e(__('Request Action')); ?>"
                                                    data-bs-original-title="<?php echo e(__('Action')); ?>">
                                                    <i class="ti ti-caret-right text-white"></i>
                                                </a>
                                            </div>
                                            <div class="action-btn bg-danger ms-2">
                                                <?php echo e(Form::open(array('route'=>array('bank-transfer-request.destroy', $bank_transfer_payment->id),'class' => 'm-0'))); ?>

                                                <?php echo method_field('DELETE'); ?>
                                                    <a
                                                        class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm"
                                                        data-bs-toggle="tooltip" title="" data-bs-original-title="Delete"
                                                        aria-label="Delete" data-confirm="<?php echo e(__('Are You Sure?')); ?>" data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"  data-confirm-yes="delete-form-<?php echo e($bank_transfer_payment->id); ?>"><i
                                                            class="ti ti-trash text-white text-white"></i></a>
                                                <?php echo e(Form::close()); ?>

                                            </div>
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

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DSI_Laravel\resources\views/bank_transfer/index.blade.php ENDPATH**/ ?>