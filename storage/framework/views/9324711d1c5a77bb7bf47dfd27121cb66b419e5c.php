
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Setup')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Setup')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-action'); ?>
    <div>
        <?php if(URL::previous() == URL::current()): ?>
            <a href="<?php echo e(route('product-service.index')); ?>" class="btn-submit btn btn-sm btn-primary " data-toggle="tooltip"
                title="<?php echo e(__('Back')); ?>">
                <i class=" ti ti-arrow-back-up"></i> </a>
        <?php else: ?>
            <a href="<?php echo e(url(URL::previous())); ?>" class="btn-submit btn btn-sm btn-primary " data-toggle="tooltip"
                title="<?php echo e(__('Back')); ?>">
                <i class=" ti ti-arrow-back-up"></i> </a>
        <?php endif; ?>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            <a href="#product_category-settings" id="product_category-tab"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Product & Services Category')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>

                            <a href="#income_category-settings" id="income_category-tab"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Invoice /Proposal')); ?>

                                <?php if(module_is_active('Account')): ?>
                                    <?php echo e(__('/Revenue')); ?>

                                <?php endif; ?> <?php echo e(__(' Category')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>

                            <a href="#expance_category-settings" id="expance_category-tab"
                                class="list-group-item list-group-item-action border-0">
                                <?php if(module_is_active('Account') && module_is_active('Pos')): ?>
                                    <?php echo e(__('Bill / Purchase')); ?>

                                <?php elseif(module_is_active('Account')): ?>
                                    <?php echo e(__('Bill')); ?>

                                <?php elseif(module_is_active('Pos')): ?>
                                    <?php echo e(__('Purchase')); ?>

                                <?php endif; ?>
                                <?php echo e(__(' Category')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#tax-settings" id="tax-tab"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Tax')); ?> <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                            <a href="#unit-settings" id="unit-tab"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Unit')); ?> <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div id="product_category-settings" class="">
                        <div class="">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-11">
                                                <h5 class="">
                                                    <?php echo e(__('Product & Services Category')); ?>

                                                </h5>
                                            </div>
                                            <div class="col-1 text-end">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category create')): ?>
                                                    <a  data-url="<?php echo e(route('category.create', ['type' => 0])); ?>"
                                                        data-ajax-popup="true" data-bs-toggle="tooltip"
                                                        title="<?php echo e(__('Create')); ?>" title="<?php echo e(__('Create')); ?>"
                                                        data-title="<?php echo e(__('Create New Category')); ?>"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="ti ti-plus"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table mb-0 ">
                                            <thead>
                                                <tr>
                                                    <th> <?php echo e(__('Category')); ?></th>
                                                    <th scope="col"><?php echo e(__('Color')); ?></th>
                                                    <?php if(Gate::check('category edit') || Gate::check('category delete')): ?>
                                                        <th width="10%"> <?php echo e(__('Action')); ?></th>
                                                    <?php endif; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $product_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr>
                                                        <td class="font-style"><?php echo e($category->name); ?></td>
                                                        <td><span class="badge"
                                                                style="background: <?php echo e($category->color); ?>">&nbsp;&nbsp;&nbsp;</span>
                                                        </td>

                                                        <?php if(Gate::check('category edit') || Gate::check('category delete')): ?>
                                                            <td class="Action">
                                                                <span>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category edit')): ?>
                                                                        <div class="action-btn bg-info ms-2">
                                                                            <a
                                                                                class="mx-3 btn btn-sm align-items-center"
                                                                                data-url="<?php echo e(route('category.edit', $category->id)); ?>"
                                                                                data-ajax-popup="true"
                                                                                data-title="<?php echo e(__('Edit Product Category')); ?>"
                                                                                data-bs-toggle="tooltip"
                                                                                title="<?php echo e(__('Edit')); ?>"
                                                                                data-original-title="<?php echo e(__('Edit')); ?>">
                                                                                <i class="ti ti-pencil text-white"></i>
                                                                            </a>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category edit')): ?>
                                                                        <div class="action-btn bg-danger ms-2">
                                                                            <?php echo Form::open([
                                                                                'method' => 'DELETE',
                                                                                'route' => ['category.destroy', $category->id],
                                                                                'id' => 'delete-form-' . $category->id,
                                                                            ]); ?>

                                                                            <a
                                                                                class="mx-3 btn btn-sm align-items-center bs-pass-para show_confirm"
                                                                                data-bs-toggle="tooltip"
                                                                                title="<?php echo e(__('Delete')); ?>"
                                                                                data-original-title="<?php echo e(__('Delete')); ?>"
                                                                                data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                                                data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                                                data-confirm-yes="document.getElementById('delete-form-<?php echo e($category->id); ?>').submit();">
                                                                                <i class="ti ti-trash text-white"></i>
                                                                            </a>
                                                                            <?php echo Form::close(); ?>

                                                                        </div>
                                                                    <?php endif; ?>
                                                                </span>
                                                            </td>
                                                        <?php endif; ?>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <?php echo $__env->make('layouts.nodatafound', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="income_category-settings" class="">
                        <div class="">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-11">
                                                <h5 class="">
                                                    <?php echo e(__('Invoice /Proposal')); ?>

                                                    <?php if(module_is_active('Account')): ?>
                                                        <?php echo e(__('/Revenue')); ?>

                                                    <?php endif; ?> <?php echo e(__(' Category')); ?>

                                                </h5>
                                            </div>
                                            <div class="col-1 text-end">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category create')): ?>
                                                    <a
                                                        data-url="<?php echo e(route('category.create', ['type' => 1])); ?>"
                                                        data-ajax-popup="true" data-bs-toggle="tooltip"
                                                        title="<?php echo e(__('Create')); ?>" title="<?php echo e(__('Create')); ?>"
                                                        data-title="<?php echo e(__('Create New Category')); ?>"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="ti ti-plus"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table mb-0 ">
                                            <thead>
                                                <tr>
                                                    <th> <?php echo e(__('Category')); ?></th>
                                                    <th scope="col"><?php echo e(__('Color')); ?></th>
                                                    <?php if(Gate::check('category edit') || Gate::check('category delete')): ?>
                                                        <th width="10%"> <?php echo e(__('Action')); ?></th>
                                                    <?php endif; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $income_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr>
                                                        <td class="font-style"><?php echo e($category->name); ?></td>
                                                        <td><span class="badge"
                                                                style="background: <?php echo e($category->color); ?>">&nbsp;&nbsp;&nbsp;</span>
                                                        </td>
                                                        <?php if(Gate::check('category edit') || Gate::check('category delete')): ?>
                                                            <td class="Action">
                                                                <span>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category edit')): ?>
                                                                        <div class="action-btn bg-info ms-2">
                                                                            <a
                                                                                class="mx-3 btn btn-sm align-items-center"
                                                                                data-url="<?php echo e(route('category.edit', $category->id)); ?>"
                                                                                data-ajax-popup="true"
                                                                                data-title="<?php echo e(__('Edit Product Category')); ?>"
                                                                                data-bs-toggle="tooltip"
                                                                                title="<?php echo e(__('Edit')); ?>"
                                                                                data-original-title="<?php echo e(__('Edit')); ?>">
                                                                                <i class="ti ti-pencil text-white"></i>
                                                                            </a>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category edit')): ?>
                                                                        <div class="action-btn bg-danger ms-2">
                                                                            <?php echo Form::open([
                                                                                'method' => 'DELETE',
                                                                                'route' => ['category.destroy', $category->id],
                                                                                'id' => 'delete-form-' . $category->id,
                                                                            ]); ?>

                                                                            <a
                                                                                class="mx-3 btn btn-sm align-items-center bs-pass-para show_confirm"
                                                                                data-bs-toggle="tooltip"
                                                                                title="<?php echo e(__('Delete')); ?>"
                                                                                data-original-title="<?php echo e(__('Delete')); ?>"
                                                                                data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                                                data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                                                data-confirm-yes="document.getElementById('delete-form-<?php echo e($category->id); ?>').submit();">
                                                                                <i class="ti ti-trash text-white"></i>
                                                                            </a>
                                                                            <?php echo Form::close(); ?>

                                                                        </div>
                                                                    <?php endif; ?>
                                                                </span>
                                                            </td>
                                                        <?php endif; ?>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <?php echo $__env->make('layouts.nodatafound', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="expance_category-settings" class="">
                        <div class="">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-11">
                                                <h5 class="">
                                                    <?php if(module_is_active('Account') && module_is_active('Pos')): ?>
                                                        <?php echo e(__('Bill / Purchase')); ?>

                                                    <?php elseif(module_is_active('Account')): ?>
                                                        <?php echo e(__('Bill')); ?>

                                                    <?php elseif(module_is_active('Pos')): ?>
                                                        <?php echo e(__('Purchase')); ?>

                                                    <?php endif; ?>
                                                    <?php echo e(__(' Category')); ?>

                                                </h5>
                                            </div>
                                            <div class="col-1 text-end">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category create')): ?>
                                                    <a
                                                        data-url="<?php echo e(route('category.create', ['type' => 2])); ?>"
                                                        data-ajax-popup="true" data-bs-toggle="tooltip"
                                                        title="<?php echo e(__('Create')); ?>" title="<?php echo e(__('Create')); ?>"
                                                        data-title="<?php echo e(__('Create New Category')); ?>"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="ti ti-plus"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table mb-0 ">
                                            <thead>
                                                <tr>
                                                    <th> <?php echo e(__('Category')); ?></th>
                                                    <th scope="col"><?php echo e(__('Color')); ?></th>
                                                    <?php if(Gate::check('category edit') || Gate::check('category delete')): ?>
                                                        <th width="10%"> <?php echo e(__('Action')); ?></th>
                                                    <?php endif; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $expance_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr>
                                                        <td class="font-style"><?php echo e($category->name); ?></td>
                                                        <td><span class="badge"
                                                                style="background: <?php echo e($category->color); ?>">&nbsp;&nbsp;&nbsp;</span>
                                                        </td>
                                                        <?php if(Gate::check('category edit') || Gate::check('category delete')): ?>
                                                            <td class="Action">
                                                                <span>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category edit')): ?>
                                                                        <div class="action-btn bg-info ms-2">
                                                                            <a
                                                                                class="mx-3 btn btn-sm align-items-center"
                                                                                data-url="<?php echo e(route('category.edit', $category->id)); ?>"
                                                                                data-ajax-popup="true"
                                                                                data-title="<?php echo e(__('Edit Product Category')); ?>"
                                                                                data-bs-toggle="tooltip"
                                                                                title="<?php echo e(__('Edit')); ?>"
                                                                                data-original-title="<?php echo e(__('Edit')); ?>">
                                                                                <i class="ti ti-pencil text-white"></i>
                                                                            </a>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category edit')): ?>
                                                                        <div class="action-btn bg-danger ms-2">
                                                                            <?php echo Form::open([
                                                                                'method' => 'DELETE',
                                                                                'route' => ['category.destroy', $category->id],
                                                                                'id' => 'delete-form-' . $category->id,
                                                                            ]); ?>

                                                                            <a
                                                                                class="mx-3 btn btn-sm align-items-center bs-pass-para show_confirm"
                                                                                data-bs-toggle="tooltip"
                                                                                title="<?php echo e(__('Delete')); ?>"
                                                                                data-original-title="<?php echo e(__('Delete')); ?>"
                                                                                data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                                                data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                                                data-confirm-yes="document.getElementById('delete-form-<?php echo e($category->id); ?>').submit();">
                                                                                <i class="ti ti-trash text-white"></i>
                                                                            </a>
                                                                            <?php echo Form::close(); ?>

                                                                        </div>
                                                                    <?php endif; ?>
                                                                </span>
                                                            </td>
                                                        <?php endif; ?>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <?php echo $__env->make('layouts.nodatafound', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="tax-settings" class="">
                        <div class="">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-11">
                                                <h5 class="">
                                                    <?php echo e(__('Tax')); ?>

                                                </h5>
                                            </div>
                                            <div class="col-1 text-end">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tax create')): ?>
                                                    <div class="float-end">
                                                        <a  data-url="<?php echo e(route('tax.create')); ?>"
                                                            data-ajax-popup="true" data-title="<?php echo e(__('Create Tax Rate')); ?>"
                                                            data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"
                                                            class="btn btn-sm btn-primary">
                                                            <i class="ti ti-plus"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table mb-0 ">
                                            <thead>
                                                <tr>
                                                <tr>
                                                    <th> <?php echo e(__('Tax Name')); ?></th>
                                                    <th> <?php echo e(__('Rate %')); ?></th>
                                                    <?php if(Gate::check('tax edit') || Gate::check('tax delete')): ?>
                                                        <th width="10%"> <?php echo e(__('Action')); ?></th>
                                                    <?php endif; ?>
                                                </tr>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr class="font-style">
                                                        <td><?php echo e($taxe->name); ?></td>
                                                        <td><?php echo e($taxe->rate); ?></td>
                                                        <?php if(Gate::check('tax edit') || Gate::check('tax delete')): ?>
                                                            <td class="Action">
                                                                <span>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tax edit')): ?>
                                                                        <div class="action-btn bg-info ms-2">
                                                                            <a
                                                                                class="mx-3 btn btn-sm align-items-center"
                                                                                data-url="<?php echo e(route('tax.edit', $taxe->id)); ?>"
                                                                                data-ajax-popup="true"
                                                                                data-title="<?php echo e(__('Edit Tax Rate')); ?>"
                                                                                data-bs-toggle="tooltip"
                                                                                title="<?php echo e(__('Edit')); ?>"
                                                                                data-original-title="<?php echo e(__('Edit')); ?>">
                                                                                <i class="ti ti-pencil text-white"></i>
                                                                            </a>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tax delete')): ?>
                                                                        <div class="action-btn bg-danger ms-2">
                                                                            <?php echo Form::open([
                                                                                'method' => 'DELETE',
                                                                                'route' => ['tax.destroy', $taxe->id],
                                                                                'id' => 'delete-form-' . $taxe->id,
                                                                            ]); ?>

                                                                            <a
                                                                                class="mx-3 btn btn-sm align-items-center bs-pass-para show_confirm"
                                                                                data-bs-toggle="tooltip"
                                                                                title="<?php echo e(__('Delete')); ?>"
                                                                                data-original-title="<?php echo e(__('Delete')); ?>"
                                                                                data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                                                data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                                                data-confirm-yes="document.getElementById('delete-form-<?php echo e($taxe->id); ?>').submit();">
                                                                                <i class="ti ti-trash text-white"></i>
                                                                            </a>
                                                                            <?php echo Form::close(); ?>

                                                                        </div>
                                                                    <?php endif; ?>

                                                                </span>
                                                            </td>
                                                        <?php endif; ?>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <?php echo $__env->make('layouts.nodatafound', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="unit-settings" class="">
                        <div class="">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-11">
                                                <h5 class="">
                                                    <?php echo e(__('Unit')); ?>

                                                </h5>
                                            </div>
                                            <div class="col-1 text-end">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('unit cerate')): ?>
                                                    <div class="float-end">
                                                        <a  data-url="<?php echo e(route('units.create')); ?>"
                                                            data-ajax-popup="true" data-title="<?php echo e(__('Create New Unit')); ?>"
                                                            data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"
                                                            class="btn btn-sm btn-primary">
                                                            <i class="ti ti-plus"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table mb-0 " >
                                            <thead>
                                                <tr>
                                                    <th> <?php echo e(__('Unit')); ?></th>
                                                    <?php if(Gate::check('unit edit') || Gate::check('unit delete')): ?>
                                                        <th width="10%"> <?php echo e(__('Action')); ?></th>
                                                    <?php endif; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr>
                                                        <td><?php echo e($unit->name); ?></td>
                                                        <?php if(Gate::check('unit edit') || Gate::check('unit delete')): ?>
                                                            <td class="Action">
                                                                <span>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('unit edit')): ?>
                                                                        <div class="action-btn bg-info ms-2">
                                                                            <a
                                                                                class="mx-3 btn btn-sm align-items-center"
                                                                                data-url="<?php echo e(route('units.edit', $unit->id)); ?>"
                                                                                data-ajax-popup="true"
                                                                                title="<?php echo e(__('Edit')); ?>"
                                                                                data-bs-toggle="tooltip"
                                                                                data-original-title="<?php echo e(__('Edit')); ?>">
                                                                                <i class="ti ti-pencil text-white"></i>
                                                                            </a>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('unit delete')): ?>
                                                                        <div class="action-btn bg-danger ms-2">

                                                                            <?php echo Form::open([
                                                                                'method' => 'DELETE',
                                                                                'route' => ['units.destroy', $unit->id],
                                                                                'id' => 'delete-form-' . $unit->id,
                                                                            ]); ?>

                                                                            <a
                                                                                class="mx-3 btn btn-sm align-items-center bs-pass-para show_confirm"
                                                                                data-bs-toggle="tooltip"
                                                                                title="<?php echo e(__('Delete')); ?>"
                                                                                data-original-title="<?php echo e(__('Delete')); ?>"
                                                                                data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                                                data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                                                data-confirm-yes="document.getElementById('delete-form-<?php echo e($unit->id); ?>').submit();">
                                                                                <i class="ti ti-trash text-white"></i>
                                                                            </a>
                                                                            <?php echo Form::close(); ?>

                                                                        </div>
                                                                    <?php endif; ?>
                                                                </span>
                                                            </td>
                                                        <?php endif; ?>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <?php echo $__env->make('layouts.nodatafound', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ sample-page ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\dsi_crm\Modules/ProductService\Resources/views/category/index.blade.php ENDPATH**/ ?>