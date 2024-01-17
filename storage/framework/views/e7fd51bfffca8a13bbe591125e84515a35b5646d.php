<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Sales Account Edit')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <div class="page-header-title">
        <h4 class="m-b-10"><?php echo e(__('Edit Account')); ?> <?php echo e('(' . $salesaccount->name . ')'); ?></h4>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(Module::asset('Sales:Resources/assets/css/custom.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-action'); ?>
    <div class="btn-group" role="group">
        <?php if(!empty($previous)): ?>
            <div class="action-btn  ms-2">
                <a href="<?php echo e(route('salesaccount.edit', $previous)); ?>" class="btn btn-sm btn-primary btn-icon m-1"
                    data-bs-toggle="tooltip" title="<?php echo e(__('Previous')); ?>">
                    <i class="ti ti-chevron-left"></i>
                </a>
            </div>
        <?php else: ?>
            <div class="action-btn ms-2">
                <a href="#" class="btn btn-sm btn-primary btn-icon m-1 disabled" data-bs-toggle="tooltip"
                    title="<?php echo e(__('Previous')); ?>">
                    <i class="ti ti-chevron-left"></i>
                </a>
            </div>
        <?php endif; ?>
        <?php if(!empty($next)): ?>
            <div class="action-btn ms-2">
                <a href="<?php echo e(route('salesaccount.edit', $next)); ?>" class="btn btn-sm btn-primary btn-icon m-1"
                    data-bs-toggle="tooltip" title="<?php echo e(__('Next')); ?>">
                    <i class="ti ti-chevron-right"></i>
                </a>
            </div>
        <?php else: ?>
            <div class="action-btn ms-2">
                <a href="#" class="btn btn-sm btn-primary btn-icon m-1 disabled" data-bs-toggle="tooltip"
                    title="<?php echo e(__('Next')); ?>">
                    <i class="ti ti-chevron-right"></i>
                </a>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Sales Account')); ?>,
    <?php echo e(__('Edit')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            <a href="#useradd-1"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Overview')); ?> <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-2"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Stream')); ?> <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-3"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Contacts')); ?> <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-4"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Opportunities')); ?> <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-5"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Cases')); ?> <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-6"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Sales Documents')); ?> <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-7"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Quotes')); ?> <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-8"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Sales Orders')); ?> <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-9"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Sales Invoices')); ?> <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-10"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Calls')); ?> <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-11"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Meetings')); ?> <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-12"
                               class="list-group-item list-group-item-action border-0"><?php echo e(__('Support Tickets')); ?> <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-13"
                               class="list-group-item list-group-item-action border-0"><?php echo e(__('Notes')); ?> <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                            <a href="#useradd-14"
                               class="list-group-item list-group-item-action border-0"><?php echo e(__('Projects')); ?> <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                            <a href="#useradd-15"
                               class="list-group-item list-group-item-action border-0"><?php echo e(__('Activity Log')); ?> <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div id="useradd-1" class="card">

                        <?php echo e(Form::model($salesaccount, ['route' => ['salesaccount.update', $salesaccount->id], 'method' => 'PUT'])); ?>

                            <div class="card-header">
                            <div class="float-end">
                                <?php if(module_is_active('AIAssistant')): ?>
                                    <?php echo $__env->make('aiassistant::ai.generate_ai_btn', [
                                        'template_module' => 'account',
                                        'module' => 'Sales',
                                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>
                            </div>
                            <h5><?php echo e(__('Overview')); ?></h5>
                            <small class="text-muted"><?php echo e(__('Edit details about your account information')); ?></small>
                        </div>

                            <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('name', __('Name'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Name'), 'required' => 'required'])); ?>

                                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-name" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('email', __('Email'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Enter email'), 'required' => 'required'])); ?>

                                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-email" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('phone', __('Phone'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('phone', null, ['class' => 'form-control', 'placeholder' => __('Enter phone'), 'required' => 'required'])); ?>

                                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-phone" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('website', __('Website'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('website', null, ['class' => 'form-control', 'placeholder' => __('Enter Website'), 'required' => 'required'])); ?>

                                            <?php $__errorArgs = ['website'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-website" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('billing_address', __('Billing Address')), ['class' => 'form-label']); ?>

                                            <div class="action-btn bg-primary ms-2 float-end">
                                                <a class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"
                                                    id="billing_data" data-bs-toggle="tooltip" data-placement="top"
                                                    title="Same As Billing Address"><i class="ti ti-copy"></i></a>
                                            </div>
                                            <span class="clearfix"></span>
                                            <?php echo e(Form::text('billing_address', null, ['class' => 'form-control', 'placeholder' => __('Enter Billing Address'), 'required' => 'required'])); ?>

                                            <?php $__errorArgs = ['billing_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-billing_address" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('shipping_address', __('Shipping Address'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('shipping_address', null, ['class' => 'form-control', 'placeholder' => __('Enter Shipping Address'), 'required' => 'required'])); ?>

                                            <?php $__errorArgs = ['shipping_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-shipping_address" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <?php echo e(Form::label('city', __('City'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('billing_city', null, ['class' => 'form-control', 'placeholder' => __('Enter Billing City'), 'required' => 'required'])); ?>

                                            <?php $__errorArgs = ['billing_city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-billing_city" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <?php echo e(Form::label('state', __('State'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('billing_state', null, ['class' => 'form-control', 'placeholder' => __('Enter Billing State'), 'required' => 'required'])); ?>

                                            <?php $__errorArgs = ['billing_state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-billing_state" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <?php echo e(Form::label('city', __('City'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('shipping_city', null, ['class' => 'form-control', 'placeholder' => __('Enter Shipping City'), 'required' => 'required'])); ?>

                                            <?php $__errorArgs = ['shipping_city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-shipping_city" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <?php echo e(Form::label('state', __('State'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('shipping_state', null, ['class' => 'form-control', 'placeholder' => __('Enter Shipping State'), 'required' => 'required'])); ?>

                                            <?php $__errorArgs = ['shipping_state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-shipping_state" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <?php echo e(Form::label('billing_country', __('Country'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('billing_country', null, ['class' => 'form-control', 'placeholder' => __('Enter Billing country'), 'required' => 'required'])); ?>

                                            <?php $__errorArgs = ['billing_country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-billing_country" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <?php echo e(Form::label('billing_country', __('Postal Code'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::number('billing_postalcode', null, ['class' => 'form-control', 'placeholder' => __('Enter Billing Postal Code'), 'required' => 'required'])); ?>

                                            <?php $__errorArgs = ['billing_postalcode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-billing_postalcode" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <?php echo e(Form::label('billing_country', __('Country'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('shipping_country', null, ['class' => 'form-control', 'placeholder' => __('Enter Shipping Country'), 'required' => 'required'])); ?>

                                            <?php $__errorArgs = ['shipping_country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-shipping_country" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <?php echo e(Form::label('shipping_postalcode', __('Postal Code'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::number('shipping_postalcode', null, ['class' => 'form-control', 'placeholder' => __('Enter Shipping Postal Code'), 'required' => 'required'])); ?>

                                            <?php $__errorArgs = ['shipping_postalcode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-shipping_postalcode" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr class="mt-1 mb-2">
                                        <h6><?php echo e(__('Detail')); ?></h6>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <?php echo e(Form::label('type', __('Type'), ['class' => 'form-label'])); ?>

                                            <?php echo Form::select('type', $accountype, null, ['class' => 'form-control']); ?>

                                            <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-name" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <?php echo e(Form::label('industry', __('Industry'), ['class' => 'form-label'])); ?>

                                            <?php echo Form::select('industry', $industry, null, ['class' => 'form-control']); ?>

                                            <?php $__errorArgs = ['industry'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-industry" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>











                                    <div class="col-12">
                                        <div class="form-group">
                                            <?php echo e(Form::label('description', __('Description'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::textarea('description', null, ['class' => 'form-control', 'rows' => 2, 'placeholder' => __('Enter Name'), 'required' => 'required'])); ?>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <b>Date Created: <?php echo e(company_date_formate($salesaccount->created_at)); ?> Created By: <?php echo e(isset($salesaccount->createuser)?$salesaccount->createuser->name:""); ?></b><br>
                                            <b>Date Updated: <?php echo e(company_date_formate($salesaccount->created_at)); ?> Updated By: <?php echo e(isset($salesaccount->updateuser)?$salesaccount->updateuser->name:""); ?></b>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <?php echo e(Form::submit(__('Save'), ['class' => 'btn-submit btn btn-primary'])); ?>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>

                    <div id="useradd-2" class="card">
                        <?php echo e(Form::open(['route' => ['streamstore', ['account', $salesaccount->name, $salesaccount->id]], 'method' => 'post', 'enctype' => 'multipart/form-data'])); ?>

                            <div class="card-header">
                            <h5><?php echo e(__('Stream')); ?></h5>
                            <small class="text-muted"><?php echo e(__('Add stream comment')); ?></small>
                        </div>
                            <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <?php echo e(Form::label('stream', __('Stream'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('stream_comment', null, ['class' => 'form-control', 'placeholder' => __('Enter Stream Comment'), 'required' => 'required'])); ?>

                                        </div>
                                    </div>
                                    <input type="hidden" name="log_type" value="account comment">
                                    <div class="col-12 field" data-name="attachments">
                                        <div class="form-group">
                                            <?php echo e(Form::label('attachment', __('Attachment'), ['class' => 'form-label'])); ?>

                                            <input type="file"name="attachment" class="form-control mb-2"
                                                onchange="document.getElementById('attachment').src = window.URL.createObjectURL(this.files[0])">
                                            <img id="attachment" width="20%" height="20%" />
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <?php echo e(Form::submit(__('Save'), ['class' => 'btn-submit btn btn-primary'])); ?>

                                    </div>
                                </div>
                            </form>
                        </div>
                            <div class="col-12">
                            <div class="card-header">
                                <h5><?php echo e(__('Latest comments')); ?></h5>
                            </div>
                            <?php $__currentLoopData = $streams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stream): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $remark = json_decode($stream->remark);
                                ?>
                                <?php if($remark->data_id == $salesaccount->id): ?>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <ul class="list-group">
                                                <li class="list-group-item border-0 d-flex align-items-start">
                                                    <div class="avatar col-1">
                                                        <a href="<?php echo e(!empty($stream->file_upload) ? get_file($stream->file_upload) : get_file('uploads/users-avatar/avatar.png')); ?>"
                                                            target="_blank">

                                                            <img src="<?php echo e(!empty($stream->file_upload) ? get_file($stream->file_upload) : get_file('uploads/users-avatar/avatar.png')); ?>"
                                                                class="user-image-hr-prj ui-w-30 rounded-circle"
                                                                width="50px" height="50px">
                                                        </a>

                                                    </div>
                                                    <div class="d-block d-sm-flex align-items-center right-side col-11">
                                                        <div
                                                            class="col-10 d-flex align-items-start flex-column justify-content-center mb-sm-0">
                                                            <div class="h6 mb-1"><?php echo e($remark->user_name); ?>

                                                            </div>
                                                            <span class="text-sm lh-140 mb-0">
                                                                posted to <a href="#"><?php echo e($remark->title); ?></a> ,
                                                                <?php echo e($stream->log_type); ?> <a
                                                                    href="#"><?php echo e($remark->stream_comment); ?></a>
                                                            </span>
                                                        </div>
                                                        <div class="col-2 ms-2  d-flex align-items-center ">
                                                            <small class="float-end "><?php echo e($stream->created_at); ?></small>
                                                        </div>
                                                    </div>

                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>

                    <div id="useradd-3" class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5><?php echo e(__('Contacts')); ?></h5>
                                    <small class="text-muted"><?php echo e(__('Assigned contacts for this account')); ?></small>
                                </div>
                                <div class="col">
                                    <div class="float-end">
                                        <a data-size="lg"
                                            data-url="<?php echo e(route('contact.create', ['account', $salesaccount->id])); ?>"
                                            data-ajax-popup="true" data-bs-toggle="tooltip"title="<?php echo e(__('Create')); ?>"
                                            data-title="<?php echo e(__('Create New Contact')); ?>" class="btn btn-sm btn-primary ">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datatable" id="datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                            <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Email')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('Phone')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                <?php echo e(__('City')); ?></th>
                                            <th scope="col" class="sort" data-sort="created_at">
                                                <?php echo e(__('Created At')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="updated_at">
                                                <?php echo e(__('Updated At')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="created_by">
                                                <?php echo e(__('Created By')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="created_by">
                                                <?php echo e(__('Updated By')); ?>

                                            </th>
                                            <?php if(Gate::check('contact show') || Gate::check('contact edit') || Gate::check('contact delete')): ?>
                                                <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $user=\App\Models\User::find($contact->created_by);
                                            ?>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo e(route('contact.edit', $contact->id)); ?>"
                                                        data-title="<?php echo e(__('Contact Details')); ?>" data-size="md"
                                                        class="action-item text-primary">
                                                        <?php echo e($contact->name); ?>

                                                    </a>
                                                </td>
                                                <td class="budget">
                                                    <?php echo e($contact->email); ?>

                                                </td>
                                                <td>
                                                    <span class="budget">
                                                        <?php echo e($contact->phone); ?>

                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="budget"><?php echo e($contact->contact_city); ?></span>
                                                </td>
                                                <td><?php echo e(company_date_formate($contact->created_at)); ?></td>
                                                <td><?php echo e(company_date_formate($contact->updated_at)); ?></td>
                                                <td><?php echo e($user->name); ?></td>
                                                <td><?php echo e(isset($contact->updateuser)?$contact->updateuser->name:""); ?></td>
                                                <?php if(Gate::check('contact show') || Gate::check('contact edit') || Gate::check('contact delete')): ?>
                                                    <td class="text-end">
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contact show')): ?>
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a data-size="md"
                                                                    data-url="<?php echo e(route('contact.show', $contact->id)); ?>"
                                                                    data-bs-toggle="tooltip" title="<?php echo e(__('Details')); ?>"
                                                                    data-ajax-popup="true"
                                                                    data-title="<?php echo e(__('Contact Details')); ?>"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                                    <i class="ti ti-eye"></i>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contact edit')): ?>
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="<?php echo e(route('contact.edit', $contact->id)); ?>"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"
                                                                    data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>"
                                                                    data-title="<?php echo e(__('Contact Edit')); ?>"><i
                                                                        class="ti ti-pencil"></i></a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contact delete')): ?>
                                                            <div class="action-btn bg-danger ms-2">
                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['contact.destroy', $contact->id]]); ?>

                                                                <a href="#!"
                                                                    class="mx-3 btn btn-sm  align-items-center text-white show_confirm"
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

                    <div id="useradd-4" class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5><?php echo e(__('Opportunities')); ?></h5>
                                    <small class="text-muted"><?php echo e(__('Assigned Opportunities for this account')); ?></small>
                                </div>
                                <div class="col">
                                    <div class="float-end">
                                        <a data-size="lg"
                                            data-url="<?php echo e(route('opportunities.create', ['account', $salesaccount->id])); ?>"
                                            data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"
                                            data-title="<?php echo e(__('Create New Opportunities')); ?>"
                                            class="btn btn-sm btn-primary btn-icon-only ">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive ">
                                <table class="table datatable" id="datatable1">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                            <th scope="col" class="sort" data-sort="status">
                                                <?php echo e(__('Opportunities Stage')); ?></th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                <?php echo e(__('Amount')); ?></th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                <?php echo e(__('Assigned User')); ?></th>
                                            <th scope="col" class="sort" data-sort="created_at">
                                                <?php echo e(__('Created At')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="updated_at">
                                                <?php echo e(__('Updated At')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="created_by">
                                                <?php echo e(__('Created By')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="created_by">
                                                <?php echo e(__('Updated By')); ?>

                                            </th>
                                            <?php if(Gate::check('opportunities show') || Gate::check('opportunities edit') || Gate::check('opportunities delete')): ?>
                                                <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $opportunitiess; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opportunities): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $user=\App\Models\User::find($opportunities->created_by);
                                            ?>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo e(route('opportunities.edit', $opportunities->id)); ?>"
                                                        data-size="md" data-title="<?php echo e(__('Opportunities Details')); ?>"
                                                        class="action-item text-primary">
                                                        <?php echo e($opportunities->name); ?>

                                                    </a>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge bg-success p-2 px-3 rounded"><?php echo e(!empty($opportunities->stages) ? $opportunities->stages->name : '-'); ?></span>
                                                </td>

                                                <td>
                                                    <span
                                                        class="budget"><?php echo e(currency_format_with_sym($opportunities->amount)); ?></span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="budget"><?php echo e(!empty($opportunities->assign_user) ? $opportunities->assign_user->name : '-'); ?></span>
                                                </td>
                                                <td><?php echo e(company_date_formate($opportunities->created_at)); ?></td>
                                                <td><?php echo e(company_date_formate($opportunities->updated_at)); ?></td>
                                                <td><?php echo e($user->name); ?></td>
                                                <td><?php echo e(isset($opportunities->updateuser)?$opportunities->updateuser->name:""); ?></td>
                                                <?php if(Gate::check('opportunities show') || Gate::check('opportunities edit') || Gate::check('opportunities delete')): ?>
                                                    <td class="text-end">

                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('opportunities show')): ?>
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a data-size="md"
                                                                    data-url="<?php echo e(route('opportunities.show', $opportunities->id)); ?>"
                                                                    data-bs-toggle="tooltip" data-ajax-popup="true"
                                                                    data-title="<?php echo e(__('Opportunities Details')); ?>"
                                                                    title="<?php echo e(__(' details')); ?>"class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                                    <i class="ti ti-eye"></i>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('opportunities edit')): ?>
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="<?php echo e(route('opportunities.edit', $opportunities->id)); ?>"
                                                                    data-bs-toggle="tooltip"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"
                                                                    data-title="<?php echo e(__('Opportunities Edit')); ?>"title="<?php echo e(__(' Edit')); ?>"><i
                                                                        class="ti ti-pencil"></i></a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('opportunities delete')): ?>
                                                            <div class="action-btn bg-danger ms-2">
                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['opportunities.destroy', $opportunities->id]]); ?>

                                                                <a href="#!"
                                                                    class="mx-3 btn btn-sm  align-items-center text-white show_confirm"
                                                                    data-bs-toggle="tooltip" title='Delete'>
                                                                    <i class="ti ti-trash"></i>
                                                                </a>
                                                                <?php echo Form::close(); ?>

                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <div id="useradd-5" class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5><?php echo e(__('Cases')); ?></h5>
                                    <small class="text-muted"><?php echo e(__('Assigned Cases for this account')); ?></small>
                                </div>
                                <div class="col">
                                    <div class="float-end">
                                        <a data-size="lg"
                                            data-url="<?php echo e(route('commoncases.create', ['account', $salesaccount->id])); ?>"
                                            data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"
                                            data-title="<?php echo e(__('Create New Common Case')); ?>"
                                            class="btn btn-sm btn-primary btn-icon-only ">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datatable" id="datatable2">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                            <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Number')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('Status')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                <?php echo e(__('Priority')); ?></th>
                                            <th scope="col" class="sort" data-sort="created_at">
                                                <?php echo e(__('Created At')); ?></th>
                                            <th scope="col" class="sort" data-sort="updated_at">
                                                <?php echo e(__('Updated At')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="created_by">
                                                <?php echo e(__('Created By')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="created_by">
                                                <?php echo e(__('Updated By')); ?>

                                            </th>
                                            <?php if(Gate::check('case show') || Gate::check('case edit') || Gate::check('case delete')): ?>
                                                <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $cases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $case): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $user=\App\Models\User::find($case->created_by);
                                            ?>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo e(route('commoncases.edit', $case->id)); ?>" data-size="md"
                                                        data-title="<?php echo e(__('Cases Details')); ?>"
                                                        class="action-item text-primary">
                                                        <?php echo e($case->name); ?>

                                                    </a>
                                                </td>
                                                <td class="budget">
                                                    <?php echo e($case->number); ?>

                                                </td>
                                                <td>
                                                    <?php if($case->status == 0): ?>
                                                        <span
                                                            class="badge bg-primary p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\CommonCase::$status[$case->status])); ?></span>
                                                    <?php elseif($case->status == 1): ?>
                                                        <span
                                                            class="badge bg-info p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\CommonCase::$status[$case->status])); ?></span>
                                                    <?php elseif($case->status == 2): ?>
                                                        <span
                                                            class="badge bg-warning p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\CommonCase::$status[$case->status])); ?></span>
                                                    <?php elseif($case->status == 3): ?>
                                                        <span
                                                            class="badge bg-danger p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\CommonCase::$status[$case->status])); ?></span>
                                                    <?php elseif($case->status == 4): ?>
                                                        <span
                                                            class="badge bg-danger p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\CommonCase::$status[$case->status])); ?></span>
                                                    <?php elseif($case->status == 5): ?>
                                                        <span
                                                            class="badge bg-warning p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\CommonCase::$status[$case->status])); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($case->priority == 0): ?>
                                                        <span
                                                            class="badge bg-primary p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\CommonCase::$priority[$case->priority])); ?></span>
                                                    <?php elseif($case->priority == 1): ?>
                                                        <span
                                                            class="badge bg-info p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\CommonCase::$priority[$case->priority])); ?></span>
                                                    <?php elseif($case->priority == 2): ?>
                                                        <span
                                                            class="badge bg-warning p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\CommonCase::$priority[$case->priority])); ?></span>
                                                    <?php elseif($case->priority == 3): ?>
                                                        <span
                                                            class="badge bg-danger p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\CommonCase::$priority[$case->priority])); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><span class="budget"><?php echo e(company_date_formate($case->created_at)); ?></span></td>
                                                <td><span class="budget"><?php echo e(company_date_formate($case->updated_at)); ?></span></td>
                                                <td><?php echo e($user->name); ?></td>
                                                <td><?php echo e(isset($case->updateuser)?$case->updateuser->name:""); ?></td>
                                                <?php if(Gate::check('case show') || Gate::check('case edit') || Gate::check('case delete')): ?>
                                                    <td class="text-end">

                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('case show')): ?>
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a data-size="md"
                                                                    data-url="<?php echo e(route('commoncases.show', $case->id)); ?>"
                                                                    data-ajax-popup="true" data-bs-toggle="tooltip"
                                                                    title="<?php echo e(__('Details')); ?>"
                                                                    data-title="<?php echo e(__('Cases Details')); ?>"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                                    <i class="ti ti-eye"></i>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('case edit')): ?>
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="<?php echo e(route('commoncases.edit', $case->id)); ?>"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"
                                                                    data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>"
                                                                    data-title="<?php echo e(__('Cases Edit')); ?>"><i
                                                                        class="ti ti-pencil"></i></a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('case delete')): ?>
                                                            <div class="action-btn bg-danger ms-2">
                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['commoncases.destroy', $case->id]]); ?>

                                                                <a href="#!"
                                                                    class="mx-3 btn btn-sm  align-items-center text-white show_confirm"
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

                    <div id="useradd-6" class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5><?php echo e(__('Sales Documents')); ?></h5>
                                    <small class="text-muted"><?php echo e(__('Assigned Documents for this account')); ?></small>
                                </div>
                                <div class="col">
                                    <div class="float-end">
                                        <a data-size="lg"
                                            data-url="<?php echo e(route('salesdocument.create', ['account', $salesaccount->id])); ?>"
                                            data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"
                                            data-title="<?php echo e(__('Create New Documents')); ?>"
                                            class="btn btn-sm btn-primary btn-icon-only">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datatable" id="datatable3">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                            <th scope="col" class="sort" data-sort="budget"><?php echo e(__('File')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('Status')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                <?php echo e(__('Created At')); ?></th>
                                            <th scope="col" class="sort" data-sort="updated_at">
                                                <?php echo e(__('Updated At')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="created_by">
                                                <?php echo e(__('Created By')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="created_by">
                                                <?php echo e(__('Updated By')); ?>

                                            </th>
                                            <?php if(Gate::check('salesdocument show') || Gate::check('salesdocument edit') || Gate::check('salesdocument delete')): ?>
                                                <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $user=\App\Models\User::find($document->created_by);
                                            ?>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo e(route('salesdocument.edit', $document->id)); ?>"
                                                        data-size="md" data-title="<?php echo e(__('Document Details')); ?>"
                                                        class="action-item text-primary">
                                                        <?php echo e($document->name); ?></a>
                                                </td>
                                                <td class="budget">
                                                    <?php if(!empty($document->attachment)): ?>
                                                        <a href="<?php echo e(get_file($document->attachment)); ?>"
                                                            download=""><i class="ti ti-download"></i></a>
                                                    <?php else: ?>
                                                        <span>
                                                            <?php echo e(__('No File')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($document->status == 0): ?>
                                                        <span
                                                            class="badge bg-success p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\SalesDocument::$status[$document->status])); ?></span>
                                                    <?php elseif($document->status == 1): ?>
                                                        <span
                                                            class="badge bg-warning p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\SalesDocument::$status[$document->status])); ?></span>
                                                    <?php elseif($document->status == 2): ?>
                                                        <span
                                                            class="badge bg-danger p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\SalesDocument::$status[$document->status])); ?></span>
                                                    <?php elseif($document->status == 3): ?>
                                                        <span
                                                            class="badge bg-danger p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\SalesDocument::$status[$document->status])); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <span class="budget"><?php echo e(company_date_formate($document->created_at)); ?></span>
                                                </td>
                                                <td><span class="budget"><?php echo e(company_date_formate($document->updated_at)); ?></span></td>
                                                <td><?php echo e($user->name); ?></td>
                                                <td><?php echo e(isset($document->updateuser)?$document->updateuser->name:""); ?></td>
                                                <?php if(Gate::check('salesdocument show') || Gate::check('salesdocument edit') || Gate::check('salesdocument delete')): ?>
                                                    <td class="text-end">

                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesdocument show')): ?>
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a data-size="lg"
                                                                    data-url="<?php echo e(route('salesdocument.show', $document->id)); ?>"
                                                                    data-ajax-popup="true" data-bs-toggle="tooltip"
                                                                    title="<?php echo e(__('Details')); ?>"
                                                                    data-title="<?php echo e(__('Document Details')); ?>"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                                    <i class="ti ti-eye"></i>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesdocument edit')): ?>
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="<?php echo e(route('salesdocument.edit', $document->id)); ?>"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"
                                                                    data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>"
                                                                    data-title="<?php echo e(__('Document Edit')); ?>"><i
                                                                        class="ti ti-pencil"></i></a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesdocument delete')): ?>
                                                            <div class="action-btn bg-danger ms-2">
                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['salesdocument.destroy', $document->id]]); ?>

                                                                <a href="#!"
                                                                    class="mx-3 btn btn-sm  align-items-center text-white show_confirm"
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

                    <div id="useradd-7" class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5><?php echo e(__('Quotes')); ?></h5>
                                    <small class="text-muted"><?php echo e(__('Assigned Quotes for this account')); ?></small>
                                </div>
                                <div class="col">
                                    <div class="float-end">
                                        <a data-url="<?php echo e(route('quote.create', ['account', $salesaccount->id])); ?>"
                                            data-size="lg" data-ajax-popup="true" data-bs-toggle="tooltip"
                                            data-title="<?php echo e(__('Create New Quote')); ?>"
                                            title="<?php echo e(__('Create')); ?>"class="btn btn-sm btn-primary btn-icon">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datatable" id="datatable3">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('Status')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                <?php echo e(__('Created At')); ?></th>
                                            <th scope="col" class="sort" data-sort="updated_at">
                                                <?php echo e(__('Updated At')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="created_by">
                                                <?php echo e(__('Created By')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="created_by">
                                                <?php echo e(__('Updated By')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                <?php echo e(__('Amount')); ?></th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                <?php echo e(__('Assign User')); ?></th>

                                            <?php if(Gate::check('quote show') || Gate::check('quote edit') || Gate::check('quote delete')): ?>
                                                <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $quotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $user=\App\Models\User::find($quote->created_by);
                                            ?>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo e(route('quote.edit', $quote->id)); ?>" data-size="md"
                                                        data-title="<?php echo e(__('Quote')); ?>"
                                                        class="action-item text-primary">
                                                        <?php echo e($quote->name); ?></a>
                                                </td>
                                                <td>
                                                    <?php if($quote->status == 0): ?>
                                                        <span class="badge bg-secondary p-2 px-3 rounded"
                                                            style="width: 79px;"><?php echo e(__(Modules\Sales\Entities\Quote::$status[$quote->status])); ?></span>
                                                    <?php elseif($quote->status == 1): ?>
                                                        <span class="badge bg-info p-2 px-3 rounded"
                                                            style="width: 79px;"><?php echo e(__(Modules\Sales\Entities\Quote::$status[$quote->status])); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><span class="budget"><?php echo e(company_date_formate($quote->created_at)); ?></span></td>
                                                <td><span class="budget"><?php echo e(company_date_formate($quote->updated_at)); ?></span></td>
                                                <td><?php echo e($user->name); ?></td>
                                                <td><?php echo e(isset($quote->updateuser)?$quote->updateuser->name:""); ?></td>
                                                <td>
                                                    <span
                                                        class="budget"><?php echo e(currency_format_with_sym($quote->getTotal())); ?></span>
                                                </td>
                                                <td>
                                                    <span class="col-sm-12"><span
                                                            class="text-m"><?php echo e(ucfirst(!empty($quote->assign_user) ? $quote->assign_user->name : '-')); ?></span></span>
                                                </td>
                                                <?php if(Gate::check('quote show') || Gate::check('quote edit') || Gate::check('quote delete')): ?>
                                                    <td class="text-end">

                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('quote show')): ?>
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a href="<?php echo e(route('quote.show', $quote->id)); ?>"
                                                                    data-size="md"class="mx-3 btn btn-sm align-items-center text-white "
                                                                    data-bs-toggle="tooltip" title="<?php echo e(__('Quick View')); ?>"
                                                                    data-title="<?php echo e(__('Quote Details')); ?>">
                                                                    <i class="ti ti-eye"></i>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('quote edit')): ?>
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="<?php echo e(route('quote.edit', $quote->id)); ?>"
                                                                    class="mx-3 btn btn-sm align-items-center text-white"
                                                                    data-bs-toggle="tooltip" title="<?php echo e(__('Details')); ?>"
                                                                    data-title="<?php echo e(__('Edit Quote')); ?>"><i
                                                                        class="ti ti-pencil"></i></a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('quote delete')): ?>
                                                            <div class="action-btn bg-danger ms-2">
                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['quote.destroy', $quote->id]]); ?>

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

                    <div id="useradd-8" class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5><?php echo e(__('Sales Orders')); ?></h5>
                                    <small class="text-muted"><?php echo e(__('Assigned SalesOrder for this account')); ?></small>
                                </div>
                                <div class="col">
                                    <div class="float-end">
                                        <a data-size="lg"
                                            data-url="<?php echo e(route('salesorder.create', ['account', $salesaccount->id])); ?>"
                                            data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"
                                            data-title="<?php echo e(__('Create New SalesOrder')); ?>"
                                            class="btn btn-sm btn-primary btn-icon-only">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datatable" id="datatable3">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('Status')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                <?php echo e(__('Created At')); ?> </th>
                                            <th scope="col" class="sort" data-sort="updated_at">
                                                <?php echo e(__('Updated At')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="created_by">
                                                <?php echo e(__('Created By')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="created_by">
                                                <?php echo e(__('Updated By')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                <?php echo e(__('Amount')); ?></th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                <?php echo e(__('Assigned User')); ?></th>
                                            <?php if(Gate::check('salesorder show') || Gate::check('salesorder edit') || Gate::check('salesorder delete')): ?>
                                                <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $salesorders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salesorder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $user=\App\Models\User::find($salesorder->created_by);
                                            ?>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo e(route('salesorder.edit', $salesorder->id)); ?>"
                                                        data-size="md" data-title="<?php echo e(__('SalesOrder')); ?>"
                                                        class="action-item text-primary">
                                                        <?php echo e($salesorder->name); ?></a>
                                                </td>
                                                <td>
                                                    <?php if($salesorder->status == 0): ?>
                                                        <span class="badge bg-secondary p-2 px-3 rounded"
                                                            style="width: 79px;"><?php echo e(__(Modules\Sales\Entities\SalesOrder::$status[$salesorder->status])); ?></span>
                                                    <?php elseif($salesorder->status == 1): ?>
                                                        <span class="badge bg-info p-2 px-3 rounded"
                                                            style="width: 79px;"><?php echo e(__(Modules\Sales\Entities\SalesOrder::$status[$salesorder->status])); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><span class="budget"><?php echo e(company_date_formate($salesorder->created_at)); ?></span></td>
                                                <td><span class="budget"><?php echo e(company_date_formate($salesorder->updated_at)); ?></span></td>
                                                <td><?php echo e($user->name); ?></td>
                                                <td><?php echo e(isset($salesorder->updateuser)?$salesorder->updateuser->name:""); ?></td>
                                                <td>
                                                    <span
                                                        class="budget"><?php echo e(currency_format_with_sym($salesorder->getTotal())); ?></span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="budget"><?php echo e(ucfirst(!empty($salesorder->assign_user) ? $salesorder->assign_user->name : '-')); ?></span>
                                                </td>
                                                <?php if(Gate::check('salesorder show') || Gate::check('salesorder edit') || Gate::check('salesorder delete')): ?>
                                                    <td class="text-end">
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesorder show')): ?>
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a href="<?php echo e(route('salesorder.show', $salesorder->id)); ?>"
                                                                    data-size="md"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"
                                                                    data-bs-toggle="tooltip" title="<?php echo e(__('Quick View')); ?>"
                                                                    data-title="<?php echo e(__('SalesOrders Details')); ?>">
                                                                    <i class="ti ti-eye"></i>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesorder edit')): ?>
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="<?php echo e(route('salesorder.edit', $salesorder->id)); ?>"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"
                                                                    data-bs-toggle="tooltip" title="<?php echo e(__('Details')); ?>"
                                                                    data-title="<?php echo e(__('Edit SalesOrders')); ?>"><i
                                                                        class="ti ti-pencil"></i></a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesorder delete')): ?>
                                                            <div class="action-btn bg-danger ms-2">
                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['salesorder.destroy', $salesorder->id]]); ?>

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

                    <div id="useradd-9" class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5><?php echo e(__('Sales Invoices')); ?></h5>
                                    <small class="text-muted"><?php echo e(__('Assigned SalesInvoice for this account')); ?></small>
                                </div>
                                <div class="col">
                                    <div class="float-end">
                                        <a data-size="lg"
                                            data-url="<?php echo e(route('salesinvoice.create', ['account', $salesaccount->id])); ?>"
                                            data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"
                                            data-title="<?php echo e(__('Create New SalesInvoice')); ?>"
                                            class="btn btn-sm btn-primary btn-icon-only">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datatable" id="datatable3">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('Status')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                <?php echo e(__('Created At')); ?> </th>
                                            <th scope="col" class="sort" data-sort="updated_at">
                                                <?php echo e(__('Updated At')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="created_by">
                                                <?php echo e(__('Created By')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="created_by">
                                                <?php echo e(__('Updated By')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                <?php echo e(__('Amount')); ?></th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                <?php echo e(__('Assigned User')); ?></th>
                                            <?php if(Gate::check('salesinvoice show') || Gate::check('salesinvoice edit') || Gate::check('salesinvoice delete')): ?>
                                                <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $salesinvoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salesinvoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $user=\App\Models\User::find($salesinvoice->created_by);
                                            ?>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo e(route('salesinvoice.edit', $salesinvoice->id)); ?>"
                                                        data-size="md" data-title="<?php echo e(__('SalesInvoice')); ?>"
                                                        class="action-item text-primary">
                                                        <?php echo e($salesinvoice->name); ?></a>
                                                </td>
                                                <td>
                                                    <?php if($salesinvoice->status == 0): ?>
                                                        <span class="badge bg-secondary p-2 px-3 rounded"
                                                            style="width: 91px;"><?php echo e(__(Modules\Sales\Entities\SalesInvoice::$status[$salesinvoice->status])); ?></span>
                                                    <?php elseif($salesinvoice->status == 1): ?>
                                                        <span class="badge bg-danger p-2 px-3 rounded"
                                                            style="width: 91px;"><?php echo e(__(Modules\Sales\Entities\SalesInvoice::$status[$salesinvoice->status])); ?></span>
                                                    <?php elseif($salesinvoice->status == 2): ?>
                                                        <span class="badge bg-warning p-2 px-3 rounded"
                                                            style="width: 91px;"><?php echo e(__(Modules\Sales\Entities\SalesInvoice::$status[$salesinvoice->status])); ?></span>
                                                    <?php elseif($salesinvoice->status == 3): ?>
                                                        <span class="badge bg-success p-2 px-3 rounded"
                                                            style="width: 91px;"><?php echo e(__(Modules\Sales\Entities\SalesInvoice::$status[$salesinvoice->status])); ?></span>
                                                    <?php elseif($salesinvoice->status == 4): ?>
                                                        <span class="badge bg-info p-2 px-3 rounded"
                                                            style="width: 91px;"><?php echo e(__(Modules\Sales\Entities\SalesInvoice::$status[$salesinvoice->status])); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><span class="budget"><?php echo e(company_date_formate($salesinvoice->created_at)); ?></span></td>
                                                <td><span class="budget"><?php echo e(company_date_formate($salesinvoice->updated_at)); ?></span></td>
                                                <td><?php echo e($user->name); ?></td>
                                                <td><?php echo e(isset($salesinvoice->updateuser)?$salesinvoice->updateuser->name:""); ?></td>
                                                <td>
                                                    <span
                                                        class="budget"><?php echo e(currency_format_with_sym($salesinvoice->getTotal())); ?></span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="budget"><?php echo e(ucfirst(!empty($salesinvoice->assign_user) ? $salesinvoice->assign_user->name : '-')); ?></span>
                                                </td>
                                                <?php if(Gate::check('salesinvoice show') || Gate::check('salesinvoice edit') || Gate::check('salesinvoice delete')): ?>
                                                    <td class="text-end">
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesinvoice show')): ?>
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a href="<?php echo e(route('salesinvoice.show', $salesinvoice->id)); ?>"
                                                                    data-bs-toggle="tooltip" title="<?php echo e(__('Quick View')); ?>"
                                                                    class="mx-3 btn btn-sm align-items-center text-white "
                                                                    data-title="<?php echo e(__('Invoice Details')); ?>">
                                                                    <i class="ti ti-eye"></i>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesinvoice edit')): ?>
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="<?php echo e(route('salesinvoice.edit', $salesinvoice->id)); ?>"
                                                                    data-bs-toggle="tooltip" title="<?php echo e(__('Details')); ?>"
                                                                    class="mx-3 btn btn-sm align-items-center text-white "
                                                                    data-title="<?php echo e(__('Edit Invoice')); ?>"><i
                                                                        class="ti ti-pencil"></i></a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesinvoice delete')): ?>
                                                            <div class="action-btn bg-danger ms-2">
                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['salesinvoice.destroy', $salesinvoice->id]]); ?>

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

                    <div id="useradd-10" class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col">
                                        <h5><?php echo e(__('Calls')); ?></h5>
                                        <small class="text-muted"><?php echo e(__('Assigned Call for this account')); ?></small>
                                    </div>
                                    <div class="col">
                                        <div class="float-end">
                                            <a data-size="lg" data-url="<?php echo e(route('call.create', ['call', 0])); ?>"
                                                data-ajax-popup="true" data-bs-toggle="tooltip"
                                                data-title="<?php echo e(__('Create New Call')); ?>"
                                                title="<?php echo e(__('Create')); ?>"class="btn btn-sm btn-primary btn-icon">
                                                <i class="ti ti-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table datatable" id="datatable3">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Status')); ?>

                                                </th>
                                                <th scope="col" class="sort" data-sort="completion">
                                                    <?php echo e(__('Date Start')); ?></th>
                                                <th scope="col" class="sort" data-sort="completion">
                                                    <?php echo e(__('Assigned User')); ?></th>
                                                <th scope="col" class="sort" data-sort="completion">
                                                    <?php echo e(__('Created At')); ?> </th>
                                                <th scope="col" class="sort" data-sort="updated_at">
                                                    <?php echo e(__('Updated At')); ?>

                                                </th>
                                                <th scope="col" class="sort" data-sort="created_by">
                                                    <?php echo e(__('Created By')); ?>

                                                </th>
                                                <th scope="col" class="sort" data-sort="created_by">
                                                    <?php echo e(__('Updated By')); ?>

                                                </th>
                                                <?php if(Gate::check('call show') || Gate::check('call edit') || Gate::check('call delete')): ?>
                                                    <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $calls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $call): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $user=\App\Models\User::find($call->created_by);
                                                ?>
                                                <tr>
                                                    <td>
                                                        <a href="<?php echo e(route('call.edit', $call->id)); ?>" data-size="md"
                                                            data-title="<?php echo e(__('Call')); ?>"
                                                            class="action-item text-primary">
                                                            <?php echo e($call->name); ?></a>
                                                    </td>
                                                    <td>
                                                        <?php if($call->status == 0): ?>
                                                            <span class="badge bg-success p-2 px-3 rounded"
                                                                style="width: 73px;"><?php echo e(__(Modules\Sales\Entities\Call::$status[$call->status])); ?></span>
                                                        <?php elseif($call->status == 1): ?>
                                                            <span class="badge bg-warning p-2 px-3 rounded"
                                                                style="width: 73px;"><?php echo e(__(Modules\Sales\Entities\Call::$status[$call->status])); ?></span>
                                                        <?php elseif($call->status == 2): ?>
                                                            <span class="badge bg-danger p-2 px-3 rounded"
                                                                style="width: 73px;"><?php echo e(__(Modules\Sales\Entities\Call::$status[$call->status])); ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="budget"><?php echo e(company_date_formate($call->start_date)); ?></span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="budget"><?php echo e(ucfirst(!empty($call->assign_user) ? $call->assign_user->name : '')); ?></span>
                                                    </td>
                                                    <td><span class="budget"><?php echo e(company_date_formate($call->created_at)); ?></span></td>
                                                    <td><span class="budget"><?php echo e(company_date_formate($call->updated_at)); ?></span></td>
                                                    <td><?php echo e($user->name); ?></td>
                                                    <td><?php echo e(isset($call->updateuser)?$call->updateuser->name:""); ?></td>

                                                    <?php if(Gate::check('call show') || Gate::check('call edit') || Gate::check('call delete')): ?>
                                                        <td class="text-end">
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('call show')): ?>
                                                                <div class="action-btn bg-warning ms-2">
                                                                    <a data-size="md"
                                                                        data-url="<?php echo e(route('call.show', $call->id)); ?>"
                                                                        data-ajax-popup="true" data-bs-toggle="tooltip"
                                                                        data-title="<?php echo e(__('Call Details')); ?>"
                                                                        title="<?php echo e(__('Quick View')); ?>"class="mx-3 btn btn-sm d-inline-flex align-items-center text-white  ">
                                                                        <i class="ti ti-eye"></i>
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('call edit')): ?>
                                                                <div class="action-btn bg-info ms-2">
                                                                    <a href="<?php echo e(route('call.edit', $call->id)); ?>"
                                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center text-white "
                                                                        data-bs-toggle="tooltip"
                                                                        data-title="<?php echo e(__('Edit Call')); ?>"title="<?php echo e(__('Details')); ?>"><i
                                                                            class="ti ti-pencil"></i></a>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('call delete')): ?>
                                                                <div class="action-btn bg-danger ms-2">
                                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['call.destroy', $call->id]]); ?>

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

                    <div id="useradd-11" class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5><?php echo e(__('Meetings')); ?></h5>
                                    <small class="text-muted"><?php echo e(__('Assigned Meeting for this account')); ?></small>
                                </div>
                                <div class="col">
                                    <div class="float-end">
                                        <a data-size="lg" data-url="<?php echo e(route('meeting.create', ['meeting', 0])); ?>"
                                            data-ajax-popup="true" data-bs-toggle="tooltip"
                                            data-title="<?php echo e(__('Create New Meeting')); ?>" title="<?php echo e(__('Create')); ?>"
                                            class="btn btn-sm btn-primary btn-icon">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datatable" id="datatable3">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('Status')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                <?php echo e(__('Date Start')); ?></th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                <?php echo e(__('Assigned User')); ?></th>
                                            <th scope="col" class="sort" data-sort="completion">
                                                <?php echo e(__('Created At')); ?> </th>
                                            <th scope="col" class="sort" data-sort="updated_at">
                                                <?php echo e(__('Updated At')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="created_by">
                                                <?php echo e(__('Created By')); ?>

                                            </th>
                                            <th scope="col" class="sort" data-sort="created_by">
                                                <?php echo e(__('Updated By')); ?>

                                            </th>
                                            <?php if(Gate::check('meeting show') || Gate::check('meeting edit') || Gate::check('meeting delete')): ?>
                                                <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $meetings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $user=\App\Models\User::find($meeting->created_by);
                                            ?>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo e(route('meeting.edit', $meeting->id)); ?>" data-size="md"
                                                        data-title="<?php echo e(__('Meeting')); ?>"
                                                        class="action-item text-primary">
                                                        <?php echo e($meeting->name); ?></a>
                                                </td>
                                                <td>
                                                    <?php if($meeting->status == 0): ?>
                                                        <span class="badge bg-success p-2 px-3 rounded"
                                                            style="width: 73px;"><?php echo e(__(Modules\Sales\Entities\Meeting::$status[$meeting->status])); ?></span>
                                                    <?php elseif($meeting->status == 1): ?>
                                                        <span class="badge bg-warning p-2 px-3 rounded"
                                                            style="width: 73px;"><?php echo e(__(Modules\Sales\Entities\Meeting::$status[$meeting->status])); ?></span>
                                                    <?php elseif($meeting->status == 2): ?>
                                                        <span class="badge bg-danger p-2 px-3 rounded"
                                                            style="width: 73px;"><?php echo e(__(Modules\Sales\Entities\Meeting::$status[$meeting->status])); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <span
                                                        class="budget"><?php echo e(company_date_formate($meeting->start_date)); ?></span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="budget"><?php echo e(ucfirst(!empty($meeting->assign_user) ? $meeting->assign_user->name : '')); ?></span>
                                                </td>
                                                <td><span class="budget"><?php echo e(company_date_formate($meeting->created_at)); ?></span></td>
                                                <td><span class="budget"><?php echo e(company_date_formate($meeting->updated_at)); ?></span></td>
                                                <td><?php echo e($user->name); ?></td>
                                                <td><?php echo e(isset($meeting->updateuser)?$meeting->updateuser->name:""); ?></td>
                                                <?php if(Gate::check('meeting show') || Gate::check('meeting edit') || Gate::check('meeting delete')): ?>
                                                    <td class="text-end">
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('meeting show')): ?>
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a data-size="md"
                                                                    data-url="<?php echo e(route('meeting.show', $meeting->id)); ?>"
                                                                    data-ajax-popup="true" data-bs-toggle="tooltip"
                                                                    data-title="<?php echo e(__('Meeting Details')); ?>"title="<?php echo e(__('Quick View')); ?>"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                                    <i class="ti ti-eye"></i>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('meeting edit')): ?>
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="<?php echo e(route('meeting.edit', $meeting->id)); ?>"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"
                                                                    data-bs-toggle="tooltip"
                                                                    data-title="<?php echo e(__('Edit Meeting')); ?>"
                                                                    title="<?php echo e(__('Details')); ?>"><i
                                                                        class="ti ti-pencil"></i></a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('meeting delete')): ?>
                                                            <div class="action-btn bg-danger ms-2">
                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['meeting.destroy', $meeting->id]]); ?>

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

                    <div id="useradd-12" class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5><?php echo e(__('Support Tickets')); ?></h5>
                                    <small class="text-muted"><?php echo e(__('Assigned Support Tickets for this account')); ?></small>
                                </div>
                                <div class="col">
                                    <div class="float-end">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ticket create')): ?>
                                            <a href="<?php echo e(route('support-tickets.create', ['account', $salesaccount->id])); ?>" title="<?php echo e(__('Create')); ?>" class="btn btn-sm btn-primary btn-icon">
                                                <i class="ti ti-plus"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datatable" id="datatable3">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th scope="col" class="sort" data-sort="ticket_id"><?php echo e(__('Ticket ID')); ?></th>
                                        <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                        <th scope="col" class="sort" data-sort="email"><?php echo e(__('Email')); ?></th>
                                        <th scope="col" class="sort" data-sort="subject"><?php echo e(__('Subject')); ?></th>
                                        <th scope="col" class="sort" data-sort="status"><?php echo e(__('Status')); ?></th>
                                        <th scope="col" class="sort" data-sort="completion">
                                            <?php echo e(__('Created At')); ?> </th>
                                        <th scope="col" class="sort" data-sort="updated_at">
                                            <?php echo e(__('Updated At')); ?>

                                        </th>
                                        <th scope="col" class="sort" data-sort="created_by">
                                            <?php echo e(__('Created By')); ?>

                                        </th>
                                        <th scope="col" class="sort" data-sort="created_by">
                                            <?php echo e(__('Updated By')); ?>

                                        </th>
                                        <?php if(Gate::check('meeting show') || Gate::check('meeting edit') || Gate::check('meeting delete')): ?>
                                            <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                        <?php endif; ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $supporttickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $user=\App\Models\User::find($ticket->created_by);
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo e(++$index); ?></th>
                                            <td class="Id sorting_1">
                                                <a class="btn btn-outline-primary" <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ticket show')): ?>href="<?php echo e(route('support-tickets.edit',$ticket->id)); ?>" <?php else: ?> href="#" <?php endif; ?>>
                                                    <?php echo e($ticket->ticket_id); ?>

                                                </a>
                                            </td>
                                            <td><span class="white-space"><?php echo e($ticket->name); ?></span></td>
                                            <td><?php echo e($ticket->email); ?></td>
                                            <td><span class="white-space"><?php echo e($ticket->subject); ?></span></td>
                                            <td><span class="badge fix_badge <?php if($ticket->status == 'In Progress'): ?>bg-warning <?php elseif($ticket->status == 'On Hold'): ?> bg-danger <?php else: ?> bg-success <?php endif; ?>  p-2 px-3 rounded"><?php echo e(__($ticket->status)); ?></span></td>
                                            <td><span class="budget"><?php echo e(company_date_formate($ticket->created_at)); ?></span></td>
                                            <td><span class="budget"><?php echo e(company_date_formate($ticket->updated_at)); ?></span></td>
                                            <td><?php echo e($user->name); ?></td>
                                            <td><?php echo e(isset($ticket->updateuser)?$ticket->updateuser->name:""); ?></td>
                                            <td class="text-end">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ticket show')): ?>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="<?php echo e(route('support-tickets.edit', $ticket->id)); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Edit & Reply')); ?>"> <span class="text-white"> <i class="ti ti-corner-up-left"></i></span></a>
                                                    </div>
                                                    <div class="action-btn bg-warning ms-2">
                                                        <a href="<?php echo e(route('ticket.view', [$ticket->workspace->slug,\Illuminate\Support\Facades\Crypt::encrypt($ticket->ticket_id)])); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Details')); ?>"> <span class="text-white"> <i class="ti ti-eye"></i></span></a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ticket delete')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <form method="POST" action="<?php echo e(route('support-tickets.destroy',$ticket->id)); ?>" id="user-form-<?php echo e($ticket->id); ?>">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            <button type="button" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm" data-bs-toggle="tooltip"
                                                                    title='Delete'>
                                                                <span class="text-white"> <i class="ti ti-trash"></i></span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="useradd-13" class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5><?php echo e(__('Notes')); ?></h5>
                                    <small class="text-muted"><?php echo e(__('Assigned Notes for this account')); ?></small>
                                </div>
                                <div class="col">
                                    <div class="float-end">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('note create')): ?>
                                            <a data-size="lg" data-url="<?php echo e(route('notes.create',['account', $salesaccount->id])); ?>"
                                               data-ajax-popup="true" data-bs-toggle="tooltip"
                                               data-title="<?php echo e(__('Create New Notes')); ?>" title="<?php echo e(__('Create')); ?>"
                                               class="btn btn-sm btn-primary btn-icon">
                                                <i class="ti ti-plus"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datatable" id="datatable3">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="ticket_id"><?php echo e(__('Title')); ?></th>
                                        <th scope="col" class="sort" data-sort="name"><?php echo e(__('Type')); ?></th>
                                        <th scope="col" class="sort" data-sort="completion">
                                            <?php echo e(__('Created At')); ?> </th>
                                        <th scope="col" class="sort" data-sort="updated_at">
                                            <?php echo e(__('Updated At')); ?>

                                        </th>
                                        <th scope="col" class="sort" data-sort="created_by">
                                            <?php echo e(__('Created By')); ?>

                                        </th>
                                        <th scope="col" class="sort" data-sort="created_by">
                                            <?php echo e(__('Updated By')); ?>

                                        </th>
                                        <?php if(Gate::check('note edit') || Gate::check('note delete')): ?>
                                            <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                        <?php endif; ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $user=\App\Models\User::find($note->created_by);
                                        ?>
                                        <tr>
                                            <td><span class="badge fix_badge <?php echo e($note->color); ?>  p-2 px-3 rounded"><?php echo e(__($note->title)); ?></span></td>
                                            <td><?php echo e($note->type); ?></td>
                                            <td><span class="budget"><?php echo e(company_date_formate($note->created_at)); ?></span></td>
                                            <td><span class="budget"><?php echo e(company_date_formate($note->updated_at)); ?></span></td>
                                            <td><?php echo e($user->name); ?></td>
                                            <td><?php echo e(isset($note->updateuser)?$note->updateuser->name:""); ?></td>
                                            <td class="text-end">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('note edit')): ?>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a data-size="lg" data-url="<?php echo e(route('notes.edit', [$note->id])); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Notes')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Edit Note')); ?>"> <span class="text-white"> <i class="ti ti-pencil"></i></span></a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('note delete')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <form method="POST" action="<?php echo e(route('notes.destroy',$note->id)); ?>" id="user-form-<?php echo e($note->id); ?>">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            <button type="button" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm" data-bs-toggle="tooltip"
                                                                    title='Delete'>
                                                                <span class="text-white"> <i class="ti ti-trash"></i></span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="useradd-14" class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5><?php echo e(__('Projects')); ?></h5>
                                    <small class="text-muted"><?php echo e(__('Assigned Projects for this account')); ?></small>
                                </div>
                                <div class="col">
                                    <div class="float-end">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('project create')): ?>
                                            <a data-size="lg" data-url="<?php echo e(route('projects.create',['account', $salesaccount->id])); ?>"
                                               data-ajax-popup="true" data-bs-toggle="tooltip"
                                               data-title="<?php echo e(__('Create New Project')); ?>" title="<?php echo e(__('Create')); ?>"
                                               class="btn btn-sm btn-primary btn-icon">
                                                <i class="ti ti-plus"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datatable" id="datatable3">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Name')); ?></th>
                                            <th><?php echo e(__('Stage')); ?></th>
                                            <th><?php echo e(__('Assigned User')); ?></th>
                                            <th><?php echo e(__('Created At')); ?> </th>
                                            <th><?php echo e(__('Updated At')); ?></th>
                                            <th><?php echo e(__('Created By')); ?></th>
                                            <th><?php echo e(__('Updated By')); ?></th>
                                            <?php if(Gate::check('project show') || Gate::check('project edit') || Gate::check('project delete')): ?>
                                                <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $user=\App\Models\User::find($project->created_by);
                                            ?>
                                        <tr>
                                            <td>
                                                <h5 class="mb-0">
                                                    <?php if($project->is_active): ?>
                                                        <a href="<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('project manage')): ?> <?php echo e(route('projects.show', [$project->id])); ?> <?php endif; ?>"
                                                           title="<?php echo e($project->name); ?>" class=""><?php echo e($project->name); ?></a>
                                                    <?php else: ?>
                                                        <a href="#" title="<?php echo e(__('Locked')); ?>"
                                                           class=""><?php echo e($project->name); ?></a>
                                                    <?php endif; ?>
                                                </h5>
                                            </td>
                                            <td><?php echo e($project->status); ?></td>
                                            <td>
                                                <?php $__currentLoopData = $project->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($user->pivot->is_active): ?>
                                                        <img alt="image" data-bs-toggle="tooltip" data-bs-placement="top"
                                                             title="<?php echo e($user->name); ?>"
                                                             <?php if($user->avatar): ?> src="<?php echo e(get_file($user->avatar)); ?>" <?php else: ?> src="<?php echo e(get_file('avatar.png')); ?>" <?php endif; ?>
                                                             class="rounded-circle " width="25" height="25">
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </td>
                                            <td><span class="budget"><?php echo e(company_date_formate($project->created_at)); ?></span></td>
                                            <td><span class="budget"><?php echo e(company_date_formate($project->updated_at)); ?></span></td>
                                            <td><?php echo e($user->name); ?></td>
                                            <td><?php echo e(isset($project->updateuser)?$project->updateuser->name:""); ?></td>
                                            <?php if(Gate::check('project show') || Gate::check('project edit') || Gate::check('project delete')): ?>
                                                <td class="text-end">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('project edit')): ?>
                                                        <div class="action-btn bg-info ms-2">
                                                            <a data-size="md" data-url="<?php echo e(route('projects.edit',$project->id)); ?>"  class="btn btn-sm d-inline-flex align-items-center text-white " data-ajax-popup="true" data-bs-toggle="tooltip" data-title="<?php echo e(__('Project Edit')); ?>" title="<?php echo e(__('Edit')); ?>"><i class="ti ti-pencil"></i></a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('project delete')): ?>
                                                        <div class="action-btn bg-danger ms-2">
                                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['projects.destroy', $project->id]]); ?>

                                                            <a href="#!" class="btn btn-sm   align-items-center text-white show_confirm" data-bs-toggle="tooltip" title='Delete'>
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

                    <div id="useradd-15" class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5><?php echo e(__('Activity Log')); ?></h5>
                                    <small class="text-muted"><?php echo e(__('Assigned Activity Log for this account')); ?></small>
                                </div>
                                <div class="col">

                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datatable" id="datatable3">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('Description')); ?></th>
                                            <th><?php echo e(__('Created At')); ?> </th>
                                            <th><?php echo e(__('Updated At')); ?></th>
                                            <th><?php echo e(__('Created By')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $allactivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allactivity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $user=\App\Models\User::find($allactivity->created_by);
                                            ?>
                                            <tr>
                                                <td><?php echo e($allactivity->description); ?></td>
                                                <td><span class="budget"><?php echo e(company_date_formate($allactivity->created_at)); ?></span></td>
                                                <td><span class="budget"><?php echo e(company_date_formate($allactivity->updated_at)); ?></span></td>
                                                <td><?php echo e($user->name); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>

        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })
    </script>
    <script>
        $(document).on('click', '#billing_data', function() {
            $("[name='shipping_address']").val($("[name='billing_address']").val());
            $("[name='shipping_city']").val($("[name='billing_city']").val());
            $("[name='shipping_state']").val($("[name='billing_state']").val());
            $("[name='shipping_country']").val($("[name='billing_country']").val());
            $("[name='shipping_postalcode']").val($("[name='billing_postalcode']").val());
        })
    </script>
    <script>
        $(document).on('change', 'select[name=opportunity]', function() {
            var opportunities = $(this).val();
            getaccount(opportunities);
        });

        function getaccount(opportunities_id) {
            $.ajax({
                url: '<?php echo e(route('quote.getaccount')); ?>',
                type: 'POST',
                data: {
                    "opportunities_id": opportunities_id,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {
                    $('#amount').val(data.opportunitie.amount);
                    $('#name').val(data.opportunitie.name);
                    $('#account_name').val(data.account.name);
                    $('#account_id').val(data.account.id);
                    $('#billing_address').val(data.account.billing_address);
                    $('#shipping_address').val(data.account.shipping_address);
                    $('#billing_city').val(data.account.billing_city);
                    $('#billing_state').val(data.account.billing_state);
                    $('#shipping_city').val(data.account.shipping_city);
                    $('#shipping_state').val(data.account.shipping_state);
                    $('#billing_country').val(data.account.billing_country);
                    $('#billing_postalcode').val(data.account.billing_postalcode);
                    $('#shipping_country').val(data.account.shipping_country);
                    $('#shipping_postalcode').val(data.account.shipping_postalcode);

                }
            });
        }
    </script>

    <script>
        $(document).on('change', 'select[name=parent]', function() {
            var parent = $(this).val();

            getparent(parent);
        });

        function getparent(bid) {
            $.ajax({
                url: '<?php echo e(route('call.getparent')); ?>',
                type: 'POST',
                data: {
                    "parent": bid,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {
                    $('#parent_id').empty();
                    

                    $.each(data, function(key, value) {
                        $('#parent_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                    if (data == '') {
                        $('#parent_id').empty();
                    }
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dimensionsystems/webcrm.dimensionsystems.com/Modules/Sales/Resources/views/salesaccount/edit.blade.php ENDPATH**/ ?>