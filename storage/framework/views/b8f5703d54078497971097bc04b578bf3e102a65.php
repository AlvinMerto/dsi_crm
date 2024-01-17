<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Manage Product & Services')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
<?php echo e(__('Product And Services')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-action'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product&service create')): ?>
<div>
        <?php echo $__env->yieldPushContent('addButtonHook'); ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product&service import')): ?>
            <a href="#"  class="btn btn-sm btn-primary" data-ajax-popup="true" data-title="<?php echo e(__('Product & Service Import')); ?>" data-url="<?php echo e(route('product-service.file.import')); ?>"  data-toggle="tooltip" title="<?php echo e(__('Import')); ?>"><i class="ti ti-file-import"></i>
            </a>
        <?php endif; ?>
        <a href="<?php echo e(route('product-service.grid')); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-title="<?php echo e(__('Grid View')); ?>" title="<?php echo e(__('Grid View')); ?>"><i class="ti ti-layout-grid text-white"></i></a>

        <a href="<?php echo e(route('category.index')); ?>"data-size="md"  class="btn btn-sm btn-primary" data-bs-toggle="tooltip"data-title="<?php echo e(__('Setup')); ?>" title="<?php echo e(__('Setup')); ?>"><i class="ti ti-settings"></i></a>

        <a href="<?php echo e(route('productstock.index')); ?>"data-size="md"  class="btn btn-sm btn-primary" data-bs-toggle="tooltip"data-title="<?php echo e(__(' Product Stock')); ?>" title="<?php echo e(__('Product Stock')); ?>"><i class="ti ti-shopping-cart"></i></a>

        <a  class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Create New Product')); ?>" data-url="<?php echo e(route('product-service.create')); ?>">
            <i class="ti ti-plus"></i>
        </a>

    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class=" multi-collapse mt-2" id="multiCollapseExample1">
            <div class="card">
                <div class="card-body">
                    <?php echo e(Form::open(['route' => ['product-service.index'], 'method' => 'GET', 'id' => 'product_service'])); ?>

                    <div class="d-flex align-items-center justify-content-end">
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="btn-box">
                                <?php echo e(Form::label('category', __('Category'), ['class' => 'text-type form-label d-none'])); ?>

                                <?php echo e(Form::select('category',$category,!empty($_GET['category'])? $_GET['category']:null, ['class' => 'form-control ','required' => 'required','placeholder'=>'Select Category'])); ?>

                            </div>
                        </div>
                        <div class="col-auto float-end ms-2">
                            <a  class="btn btn-sm btn-primary"
                               onclick="document.getElementById('product_service').submit(); return false;"
                               data-bs-toggle="tooltip" title="<?php echo e(__('apply')); ?>">
                                <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                            </a>
                            <a href="<?php echo e(route('product-service.index')); ?>" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                               title="<?php echo e(__('Reset')); ?>">
                                <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off"></i></span>
                            </a>
                        </div>

                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body table-border-style">
                <h5></h5>
                <div class="table-responsive">
                    <table class="table mb-0 pc-dt-simple" id="products">
                        <thead>
                        <tr>
                            <th ><?php echo e(__('Image')); ?></th>
                            <th ><?php echo e(__('Name')); ?></th>
                            <th ><?php echo e(__('Sku')); ?></th>
                            <th><?php echo e(__('Sale Price')); ?></th>
                            <th><?php echo e(__('Purchase Price')); ?></th>
                            <th><?php echo e(__('Tax')); ?></th>
                            <th><?php echo e(__('Category')); ?></th>
                            <th><?php echo e(__('Unit')); ?></th>
                            <th><?php echo e(__('Quantity')); ?></th>
                            <th><?php echo e(__('Type')); ?></th>
                            <?php if(Gate::check('product&service delete') || Gate::check('product&service edit')): ?>
                                <th><?php echo e(__('Action')); ?></th>
                            <?php endif; ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $productServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                if(check_file($productService->image) == false){
                                    $path = asset('Modules/ProductService/Resources/assets/image/img01.jpg');
                                }else{
                                    $path = get_file($productService->image);
                                }
                            ?>
                            <tr class="font-style">
                                <td>
                                    <a href="<?php echo e($path); ?>" target="_blank">
                                        <img src=" <?php echo e($path); ?> " class="wid-75 rounded me-3">
                                    </a>
                                </td>
                                <td class="text-center"><?php echo e($productService->name); ?></td>
                                <td class="text-center"><?php echo e($productService->sku); ?></td>
                                <td><?php echo e(currency_format_with_sym($productService->sale_price)); ?></td>
                                <td><?php echo e(currency_format_with_sym($productService->purchase_price )); ?></td>
                                <td>
                                    <?php if(!empty($productService->tax_id)): ?>
                                        <?php
                                            $taxes=Modules\ProductService\Entities\Tax::tax($productService->tax_id);
                                        ?>

                                        <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e(!empty($tax)?$tax->name:''); ?><br>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e(!empty($productService->category)?$productService->category->name:''); ?></td>
                                <td><?php echo e(!empty($productService->unit())?$productService->unit()->name:''); ?></td>
                                <?php if($productService->type == 'product'): ?>
                                        <td><?php echo e($productService->quantity); ?></td>
                                    <?php else: ?>
                                        <td>-</td>
                                    <?php endif; ?>
                                <td><?php echo e($productService->type); ?></td>
                                <?php if(Gate::check('product&service delete') || Gate::check('product&service edit')): ?>
                                   <td class="Action">
                                    <?php if(module_is_active('Pos')): ?>
                                        <div class="action-btn bg-warning ms-2">
                                            <a  class="mx-3 btn btn-sm align-items-center" data-url="<?php echo e(route('productservice.detail',$productService->id)); ?>"
                                            data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Warehouse Details')); ?>" data-title="<?php echo e(__('Warehouse Details')); ?>">
                                                <i class="ti ti-eye text-white"></i>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product&service edit')): ?>
                                            <div class="action-btn bg-info ms-2">
                                                <a  class="mx-3 btn btn-sm align-items-center" data-url="<?php echo e(route('product-service.edit',$productService->id)); ?>" data-ajax-popup="true" data-size="lg" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Edit Product')); ?>">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product&service delete')): ?>
                                            <div class="action-btn bg-danger ms-2">
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['product-service.destroy', $productService->id],'id'=>'delete-form-'.$productService->id]); ?>

                                                <a  class="mx-3 btn btn-sm  align-items-center bs-pass-para show_confirm" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i class="ti ti-trash text-white text-white"></i></a>
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

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DSI_Laravel\Modules/ProductService\Resources/views/index.blade.php ENDPATH**/ ?>