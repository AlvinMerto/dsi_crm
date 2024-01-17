<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Landing Page')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Landing Page')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <?php echo $__env->make('landingpage::marketplace.modules', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="row">
                    <div class="col-xl-3">
                        <div class="card sticky-top" style="top:30px">
                            <div class="list-group list-group-flush" id="useradd-sidenav">
                                <?php echo $__env->make('landingpage::marketplace.tab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9">
                    
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col">
                                        <h5><?php echo e(__('Dedicated Theme Head Details')); ?></h5>
                                    </div>
                                    <div id="p1" class="col-auto text-end text-primary h3">
                                        <a image-url="<?php echo e(get_file('Modules/LandingPage/Resources/assets/infoimages/dedicated.png')); ?>"
                                           data-url="<?php echo e(route('info.image.view',['marketplace','dedicated'])); ?>" class="view-images">
                                            <i class="ti ti-info-circle pointer"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php echo e(Form::open(array('route' => array('dedicated_theme_header_store',$slug), 'method'=>'post', 'enctype' => "multipart/form-data"))); ?>

                                <?php echo csrf_field(); ?>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <?php echo e(Form::label('Heading', __('Heading'), ['class' => 'form-label'])); ?>

                                                <?php echo e(Form::text('dedicated_theme_heading',$settings['dedicated_theme_heading'], ['class' => 'form-control ', 'placeholder' => __('Enter Heading')])); ?>

                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <?php echo e(Form::label('Description', __('Description'), ['class' => 'form-label'])); ?>

                                                <?php echo e(Form::textarea('dedicated_theme_description', $settings['dedicated_theme_description'], ['class' => 'ckdescription form-control', 'placeholder' => __('Enter Description'), 'id'=>'','required'=>'required'])); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <input class="btn btn-print-invoice btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                                </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5><?php echo e(__('Dedicated Theme Sections')); ?></h5>
                                    </div>
                                    <div id="p1" class="col-auto text-end text-primary h3">
                                        <a image-url="<?php echo e(get_file('Modules/LandingPage/Resources/assets/infoimages/dedicated.png')); ?>" data-id="1"
                                           data-url="<?php echo e(route('info.image.view',['marketplace','dedicated'])); ?>" class="view-images pt-2">
                                            <i class="ti ti-info-circle pointer"></i>
                                        </a>
                                    </div>
                                    <div class="col-auto justify-content-end d-flex">
                                        <a data-size="lg" data-url="<?php echo e(route('dedicated_theme_section_create',$slug)); ?>" data-ajax-popup="true"  data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create New Section')); ?>"  class="btn btn-sm btn-primary">
                                            <i class="ti ti-plus text-light"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><?php echo e(__('No')); ?></th>
                                                <th><?php echo e(__('Name')); ?></th>
                                                <th><?php echo e(__('Action')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(is_array($dedicated_theme_sections) || is_object($dedicated_theme_sections)): ?>
                                            <?php
                                                $of_no = 1
                                            ?>
                                                <?php $__currentLoopData = ($dedicated_theme_sections); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($of_no++); ?></td>
                                                        <td><?php echo e($value['dedicated_theme_section_heading']); ?></td>
                                                        <td>
                                                            <span>
                                                                <div class="action-btn bg-info ms-2">
                                                                        <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="<?php echo e(route('dedicated_theme_section_edit',[$slug,$key])); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Page')); ?>" data-size="lg" data-bs-toggle="tooltip"  title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                                                        <i class="ti ti-pencil text-white"></i>
                                                                    </a>
                                                                </div>

                                                                    <div class="action-btn bg-danger ms-2">
                                                                    <?php echo Form::open(['method' => 'GET', 'route' => ['dedicated_theme_section_delete',[$slug, $key]],'id'=>'delete-form-'.$key]); ?>


                                                                        <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para show_confirm" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm-yes="<?php echo e('delete-form-'.$key); ?>">
                                                                        <i class="ti ti-trash text-white"></i>
                                                                    </a>
                                                                        <?php echo Form::close(); ?>

                                                                    </div>
                                                                </span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="//cdn.ckeditor.com/4.12.1/basic/ckeditor.js"></script>
    <script src="<?php echo e(asset('Modules/LandingPage/Resources/assets/js/editorplaceholder.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            $.each($('.ckdescription'), function(i, editor) {
                CKEDITOR.replace(editor, {
                    // contentsLangDirection: 'rtl',
                    extraPlugins: 'editorplaceholder',
                    editorplaceholder: editor.placeholder
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DSI_Laravel\Modules/LandingPage\Resources/views/marketplace/dedicated/index.blade.php ENDPATH**/ ?>