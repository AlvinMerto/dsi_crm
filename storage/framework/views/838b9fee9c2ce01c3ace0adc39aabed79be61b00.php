<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Opportunities')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Opportunities')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Opportunities')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(Module::asset('Sales:Resources/assets/css/custom.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-action'); ?>
    <div>
        <?php echo $__env->yieldPushContent('addButtonHook'); ?>

        <a href="<?php echo e(route('opportunities.grid')); ?>" class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip"
            title="<?php echo e(__('Kanban View')); ?>">
            <i class="ti ti-layout-kanban"></i>
        </a>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('opportunities create')): ?>
            <a data-url="<?php echo e(route('opportunities.create', ['opportunities', 0])); ?>" data-size="lg" data-ajax-popup="true"
                data-bs-toggle="tooltip" data-title="<?php echo e(__('Create New Opportunities')); ?>" title="<?php echo e(__('Create')); ?>"
                class="btn btn-sm btn-primary btn-icon">
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
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                    <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Account')); ?></th>
                                    <th scope="col" class="sort" data-sort="contact"><?php echo e(__('Contact')); ?></th>
                                    <th scope="col" class="sort" data-sort="stage"><?php echo e(__('Stage')); ?></th>
                                    <th scope="col" class="sort" data-sort="amount"><?php echo e(__('Amount')); ?></th>
                                    <th scope="col" class="sort" data-sort="assign_user"><?php echo e(__('Assigned User')); ?></th>
                                    <th scope="col" class="sort" data-sort="created_at"><?php echo e(__('Created AT')); ?></th>
                                    <?php if(Gate::check('opportunities show') || Gate::check('opportunities edit') || Gate::check('opportunities delete')): ?>
                                        <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $opportunitiess; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opportunities): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $contact=\Modules\Sales\Entities\Contact::find($opportunities->contact);
                                    ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo e(route('opportunities.edit', $opportunities->id)); ?>" data-size="md"
                                                data-title="<?php echo e(__('Opportunities Details')); ?>"
                                                class="action-item text-primary">
                                                <?php echo e(ucfirst($opportunities->name)); ?>

                                            </a>
                                        </td>
                                        <td>
                                            <span
                                                class="budget"><?php echo e(ucfirst(!empty($opportunities->accounts) ? $opportunities->accounts->name : '-')); ?></span>
                                        </td>
                                        <td><?php echo e(isset($contact->name)?$contact->name:""); ?></td>
                                        <td>
                                            <span class="budget">
                                                <?php echo e(ucfirst(!empty($opportunities->stages) ? $opportunities->stages->name : '-')); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <span
                                                class="budget"><?php echo e(currency_format_with_sym($opportunities->amount)); ?></span>
                                        </td>
                                        <td>
                                            <span
                                                class="budget"><?php echo e(ucfirst(!empty($opportunities->assign_user) ? $opportunities->assign_user->name : '-')); ?></span>
                                        </td>
                                        <td><?php echo e(company_date_formate($opportunities->created_at)); ?></td>

                                        <?php if(Gate::check('opportunities show') || Gate::check('opportunities edit') || Gate::check('opportunities delete')): ?>
                                            <td class="text-end">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('opportunities show')): ?>
                                                    <div class="action-btn bg-warning ms-2">
                                                        <a data-size="md"
                                                            data-url="<?php echo e(route('opportunities.show', $opportunities->id)); ?>"
                                                            data-bs-toggle="tooltip"title="<?php echo e(__('Quick View')); ?>"
                                                            data-ajax-popup="true"
                                                            data-title="<?php echo e(__('Opportunities Details')); ?>"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-eye"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('opportunities edit')): ?>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="<?php echo e(route('opportunities.edit', $opportunities->id)); ?>"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white "
                                                            data-bs-toggle="tooltip" title="<?php echo e(__('Details')); ?>"
                                                            data-title="<?php echo e(__('Opportunities Edit')); ?>"><i
                                                                class="ti ti-pencil"></i></a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('opportunities delete')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['opportunities.destroy', $opportunities->id]]); ?>

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

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dimensionsystems/webcrm.dimensionsystems.com/Modules/Sales/Resources/views/opportunities/index.blade.php ENDPATH**/ ?>