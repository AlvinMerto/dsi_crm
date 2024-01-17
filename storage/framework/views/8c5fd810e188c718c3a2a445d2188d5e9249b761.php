<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Product & Services')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Product & Services')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Product & Services')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-action'); ?>
    <div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product&service import')): ?>
            <a href="#"  class="btn btn-sm btn-primary" data-ajax-popup="true" data-title="<?php echo e(__('Product & Service Import')); ?>" data-url="<?php echo e(route('product-service.file.import')); ?>"  data-toggle="tooltip" title="<?php echo e(__('Import')); ?>"><i class="ti ti-file-import"></i>
            </a>
        <?php endif; ?>
        <a href="<?php echo e(route('product-service.index')); ?>" class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip"
            title="<?php echo e(__('List View')); ?>">
            <i class="ti ti-list text-white"></i>
        </a>
        <a href="<?php echo e(route('category.index')); ?>"data-size="md"  class="btn btn-sm btn-primary" data-bs-toggle="tooltip"data-title="<?php echo e(__('Setup')); ?>" title="<?php echo e(__('Setup')); ?>"><i class="ti ti-settings"></i></a>

        <a href="<?php echo e(route('productstock.index')); ?>"data-size="md"  class="btn btn-sm btn-primary" data-bs-toggle="tooltip"data-title="<?php echo e(__(' Product Stock')); ?>" title="<?php echo e(__('Product Stock')); ?>"><i class="ti ti-shopping-cart"></i></a>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product&service create')): ?>
            <a  class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"
                data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Create New Product')); ?>"
                data-url="<?php echo e(route('product-service.create')); ?>">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="filters-content">
        <div class="col-sm-12">
            <div class=" multi-collapse mt-2" id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::open(['route' => ['product-service.grid'], 'method' => 'GET', 'id' => 'product_service'])); ?>

                        <div class="d-flex align-items-center justify-content-end">
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="btn-box">
                                    <?php echo e(Form::label('category', __('Category'), ['class' => 'text-type form-label d-none'])); ?>

                                    <?php echo e(Form::select('category', $category, !empty($_GET['category']) ? $_GET['category'] : null, ['class' => 'form-control ', 'required' => 'required', 'placeholder' => 'Select Category'])); ?>

                                </div>
                            </div>
                            <div class="col-auto float-end ms-2">
                                <a  class="btn btn-sm btn-primary"
                                    onclick="document.getElementById('product_service').submit(); return false;"
                                    data-bs-toggle="tooltip" title="<?php echo e(__('apply')); ?>">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="<?php echo e(route('product-service.grid')); ?>" class="btn btn-sm btn-danger"
                                    data-bs-toggle="tooltip" title="<?php echo e(__('Reset')); ?>">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off"></i></span>
                                </a>
                            </div>

                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="row grid">
            <?php if(isset($productServices)): ?>
                <?php $__currentLoopData = $productServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 col-xl-3 All <?php echo e($productService->status); ?>">
                        <div class="card">
                            <div class="card-header border-0 pb-0">
                                <div class="d-flex align-items-center">
                                    <?php
                                    if (check_file($productService->image) == false) {
                                        $path = asset('Modules/ProductService/Resources/assets/image/img01.jpg');
                                    } else {
                                        $path = get_file($productService->image);
                                    }
                                    ?>
                                    <td>
                                        <a href="<?php echo e($path); ?>" target="_blank">
                                            <img src=" <?php echo e($path); ?>" class=" me-3"
                                                style="border-radius: 10px;
                                            max-width: 50px !important;">
                                        </a>
                                    </td>

                                    <h5 class="mb-0">
                                        <a  title="<?php echo e($productService->name); ?>"
                                            class=""><?php echo e($productService->name); ?></a>
                                    </h5>
                                </div>
                                <div class="card-header-right">
                                    <div class="btn-group card-option">

                                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="feather icon-more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <?php if(module_is_active('Pos')): ?>
                                                    <a  class="dropdown-item"
                                                        data-url="<?php echo e(route('productservice.detail', $productService->id)); ?>"
                                                        data-ajax-popup="true" data-size="lg"
                                                        data-title="<?php echo e(__('Warehouse Details')); ?>">
                                                        <i class="ti ti-eye"></i> <span><?php echo e(__('Details')); ?></span>
                                                    </a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product&service edit')): ?>
                                                <a  class="dropdown-item" data-ajax-popup="true" data-size="lg"
                                                    data-title="<?php echo e(__('Edit Product')); ?>"
                                                    data-url="<?php echo e(route('product-service.edit', [$productService->id])); ?>">
                                                    <i class="ti ti-pencil"></i> <span><?php echo e(__('Edit')); ?></span>
                                                </a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product&service delete')): ?>
                                                <form id="delete-form-<?php echo e($productService->id); ?>"
                                                    action="<?php echo e(route('product-service.destroy', [$productService->id])); ?>"
                                                    method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <a
                                                        class="dropdown-item text-danger delete-popup bs-pass-para show_confirm"
                                                        data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                        data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                        data-confirm-yes="delete-form-<?php echo e($productService->id); ?>">
                                                        <i class="ti ti-trash"></i><span><?php echo e(__('Delete')); ?></span>
                                                    </a>
                                                    <?php echo method_field('DELETE'); ?>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row g-2 justify-content-between">
                                    <div class="col-auto"><span
                                            class="badge rounded-pill bg-success"><?php echo e(!empty($productService->category) ? $productService->category->name : ''); ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <p class="mb-0"class="text-center"><?php echo e($productService->sku); ?></p>
                                    </div>
                                </div>
                                <div class="card mb-0 mt-3">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-4">
                                                <h6 class="mb-0"><?php echo e($productService->quantity); ?></h6>
                                                <p class="text-muted text-sm mb-0"><?php echo e(__('Quantity')); ?></p>
                                            </div>
                                            <div class="col-4">
                                                <h6 class="mb-0 text-center">

                                                    <?php if(!empty($productService->tax_id)): ?>
                                                        <?php
                                                            $taxes = Modules\ProductService\Entities\Tax::tax($productService->tax_id);
                                                        ?>

                                                        <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php echo e(!empty($tax) ? $tax->name : ''); ?><br>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        -
                                                    <?php endif; ?>
                                                </h6>
                                                <p class="text-muted text-sm mb-0 text-center"><?php echo e(__('Tax')); ?></p>
                                            </div>

                                            <div class="col-4 text-end">
                                                <h6 class="mb-0"><?php echo e($productService->type); ?></h6>
                                                <p class="text-muted text-sm mb-0"><?php echo e(__('Type')); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-0 mt-3">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <h6 class="mb-0"><?php echo e(currency_format_with_sym($productService->sale_price)); ?></h6>
                                                <p class="text-muted text-sm mb-0"><?php echo e(__('Sale Price')); ?></p>
                                            </div>
                                            <div class="col-6 text-end">
                                                <h6 class="mb-0"><?php echo e(currency_format_with_sym($productService->purchase_price)); ?></h6>
                                                <p class="text-muted text-sm mb-0"><?php echo e(__('Purchase Price')); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>


            <?php if(auth()->guard('web')->check()): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product&service create')): ?>
                        <div class="col-md-3 All">
                            <a  class="btn-addnew-project " style="padding: 90px 10px;" data-ajax-popup="true"
                                data-size="lg" data-title="<?php echo e(__('Create New Product')); ?>"
                                data-url="<?php echo e(route('product-service.create')); ?>">
                                <div class="bg-primary proj-add-icon">
                                    <i class="ti ti-plus"></i>
                                </div>
                                <h6 class="mt-4 mb-2"><?php echo e(__('Add Product')); ?></h6>
                                <p class="text-muted text-center"><?php echo e(__('Click here to add New Product')); ?></p>
                            </a>
                        </div>
                <?php endif; ?>
            <?php endif; ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(Module::asset('Sales:Resources/assets/js/letter.avatar.js')); ?>"></script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dimensionsystems/webcrm.dimensionsystems.com/Modules/ProductService/Resources/views/grid.blade.php ENDPATH**/ ?>