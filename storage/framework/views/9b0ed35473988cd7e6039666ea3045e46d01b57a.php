<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Quote Edit')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Edit Quote')); ?> <?php echo e('('. $quote->name .')'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-action'); ?>
    <div class="btn-group" role="group">
        <?php if(!empty($previous)): ?>
        <div class="action-btn  ms-2">
            <a href="<?php echo e(route('quote.edit',$previous)); ?>" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" title="<?php echo e(__('Previous')); ?>">
                <i class="ti ti-chevron-left"></i>
            </a>
        </div>
        <?php else: ?>
        <div class="action-btn  ms-2">
            <a href="#" class="btn btn-sm btn-primary btn-icon m-1 disabled" data-bs-toggle="tooltip" title="<?php echo e(__('Previous')); ?>">
                <i class="ti ti-chevron-left"></i>
            </a>
        </div>
        <?php endif; ?>
        <?php if(!empty($next)): ?>
        <div class="action-btn  ms-2">
            <a href="<?php echo e(route('quote.edit',$next)); ?>" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" title="<?php echo e(__('Next')); ?>">
                <i class="ti ti-chevron-right"></i>
            </a>
        </div>
        <?php else: ?>
        <div class="action-btn  ms-2">
            <a href="#" class="btn btn-sm btn-primary btn-icon m-1 disabled" data-bs-toggle="tooltip" title="<?php echo e(__('Next')); ?>">
                <i class="ti ti-chevron-right"></i>
            </a>
        </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
   <?php echo e(__('Quote')); ?>,
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
                        <a href="#useradd-1" class="list-group-item list-group-item-action border-0"><?php echo e(__('Overview')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        <a href="#useradd-2" class="list-group-item list-group-item-action border-0"><?php echo e(__('Sales Orders')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        <a href="#useradd-3" class="list-group-item list-group-item-action border-0"><?php echo e(__('Sales Invoice')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-9">
                <div id="useradd-1" class="card">
                    <?php echo e(Form::model($quote,array('route' => array('quote.update', $quote->id), 'method' => 'PUT'))); ?>

                    <div class="card-header">
                        <div class="float-end">
                            <?php if(module_is_active('AIAssistant')): ?>
                                <?php echo $__env->make('aiassistant::ai.generate_ai_btn',['template_module' => 'quote','module'=>'Sales'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>
                        </div>
                        <h5><?php echo e(__('Overview')); ?></h5>
                        <small class="text-muted"><?php echo e(__('Edit about your quote information')); ?></small>
                    </div>

                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('name',__('Name'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))); ?>

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
                                        <?php echo e(Form::label('opportunity',__('Opportunity'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::select('opportunity',$opportunity, null , ['id' => 'opportunity','class'=>"form-control choices",'searchEnabled'=>'true','placeholder' => __('Select Opportunity')])); ?>


                                        <?php $__errorArgs = ['opportunity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-opportunity" role="alert">
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
                                        <?php echo e(Form::label('status',__('Status'),['class'=>'form-label'])); ?>

                                        <select name="status" id="status" class="form-control"  required>
                                            <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($k); ?>" <?php echo e(($quote->status == $k) ? 'selected' : ''); ?>><?php echo e(__($v)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-status" role="alert">
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
                                        <?php echo e(Form::label('account',__('Account'),['class'=>'form-label'])); ?>

                                        <?php echo Form::select('account', $account, null,array('class' => 'form-control')); ?>

                                        <?php $__errorArgs = ['account'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-account" role="alert">
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
                                        <?php echo e(Form::label('date_quoted',__('Date Quoted'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::date('date_quoted',null,array('class'=>'form-control','placeholder'=>__('Enter Date Quoted'),'required'=>'required'))); ?>

                                        <?php $__errorArgs = ['date_quoted'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-date_quoted" role="alert">
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
                                        <?php echo e(Form::label('quote_number',__('Quote Number'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::text('quote_number',null,array('class'=>'form-control','placeholder'=>__('Enter Quote Number'),'required'=>'required','readonly'))); ?>


                                        <?php $__errorArgs = ['quote_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-quote_number" role="alert">
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
                                        <?php echo e(Form::label('billing_address',__('Billing Address'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::text('billing_address',null,array('class'=>'form-control','placeholder'=>__('Enter Billing Address'),'required'=>'required'))); ?>

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
                                        <?php echo e(Form::label('shipping_address',__('Shipping Address'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::text('shipping_address',null,array('class'=>'form-control','placeholder'=>__('Enter Shipping Address'),'required'=>'required'))); ?>

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
                                        <?php echo e(Form::text('billing_city',null,array('class'=>'form-control','placeholder'=>__('Enter Billing City'),'required'=>'required'))); ?>

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
                                        <?php echo e(Form::text('billing_state',null,array('class'=>'form-control','placeholder'=>__('Enter Billing State'),'required'=>'required'))); ?>

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
                                        <?php echo e(Form::text('shipping_city',null,array('class'=>'form-control','placeholder'=>__('Enter Shipping City'),'required'=>'required'))); ?>

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
                                        <?php echo e(Form::text('shipping_state',null,array('class'=>'form-control','placeholder'=>__('Enter Shipping State'),'required'=>'required'))); ?>

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
                                        <?php echo e(Form::text('billing_country',null,array('class'=>'form-control','placeholder'=>__('Enter Billing country'),'required'=>'required'))); ?>

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
                                        <?php echo e(Form::text('billing_postalcode',null,array('class'=>'form-control','placeholder'=>__('Enter Billing Postal Code'),'required'=>'required'))); ?>

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
                                        <?php echo e(Form::text('shipping_country',null,array('class'=>'form-control','placeholder'=>__('Enter Shipping Country'),'required'=>'required'))); ?>

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
                                        <?php echo e(Form::text('shipping_postalcode',null,array('class'=>'form-control','placeholder'=>__('Enter Shipping Postal Code'),'required'=>'required'))); ?>

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
                                <div class="col-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('billing_contact',__('Billing Contact'),['class'=>'form-label'])); ?>

                                        <?php echo Form::select('billing_contact', $billing_contact, null,array('class' => 'form-control')); ?>

                                        <?php $__errorArgs = ['billing_contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-billing_contact" role="alert">
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
                                        <?php echo e(Form::label('shipping_contact',__('Shipping Contact'),['class'=>'form-label'])); ?>

                                        <?php echo Form::select('shipping_contact', $billing_contact, null,array('class' => 'form-control')); ?>

                                        <?php $__errorArgs = ['shipping_contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-shipping_contact" role="alert">
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
                                                <?php echo e(Form::label('tax', __('Tax'), ['class' => 'form-label'])); ?>

                                                <?php echo e(Form::select('tax[]',$tax,explode(',',$quote->tax), array('class' => 'form-control choices','id'=>'choices-multiple1','multiple'=>''))); ?>

                                        <?php $__errorArgs = ['tax'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-tax" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <p class="text-danger d-none" id="tax_validation"><?php echo e(__('Tax filed is required.')); ?></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('shipping_provider',__('Shipping Provider'),['class'=>'form-label'])); ?>

                                        <?php echo Form::select('shipping_provider', $shipping_provider, null,array('class' => 'form-control','required'=>'required')); ?>

                                        <?php $__errorArgs = ['shipping_provider'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-shipping_provider" role="alert">
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
                                        <?php echo e(Form::label('description',__('Description'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::textarea('description',null,array('class'=>'form-control','rows'=>2,'placeholder'=>__('Enter Name')))); ?>

                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="form-group">
                                    <?php echo e(Form::label('user',__('Assigned User'),['class'=>'form-label'])); ?>

                                    <?php echo Form::select('user', $user, $quote->user_id,array('class' => 'form-control')); ?>

                                    </div>
                                    <?php $__errorArgs = ['user'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-user" role="alert">
                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <?php if(module_is_active('CustomField') && !$customFields->isEmpty()): ?>
                                    <div class="col-md-12">
                                        <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                                            <?php echo $__env->make('customfield::formBuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="text-end">
                                    <?php echo e(Form::submit(__('Update'),array('class'=>'btn-submit btn btn-primary','id'=>'submit'))); ?>

                                </div>
                            </div>
                        </form>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>

                <div id="useradd-2" class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5><?php echo e(__('Sales Orders')); ?></h5>
                                <small class="text-muted"><?php echo e(__('Assign sales orders for this quote')); ?></small>
                            </div>
                            <div class="col">
                                <div class="float-end">
                                    <a data-size="lg" data-url="<?php echo e(route('salesorder.create',['quote',$quote->id])); ?>" data-bs-toggle="tooltip"data-ajax-popup="true" title="<?php echo e(__('Create')); ?>"data-title="<?php echo e(__('Create New Sales Orders')); ?>" class="btn btn-sm btn-primary btn-icon-only">
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
                                        <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Account')); ?></th>
                                        <th scope="col" class="sort" data-sort="status"><?php echo e(__('Status')); ?></th>
                                        <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Created At')); ?></th>
                                        <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Amount')); ?></th>
                                        <th scope="col" class="text-right"><?php echo e(__('Action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $salesorders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salesorder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <a href="<?php echo e(route('salesorder.show',$salesorder->id)); ?>" class="action-item text-primary" data-title="<?php echo e(__('SalesOrders Details')); ?>">
                                                    <?php echo e($salesorder->name); ?>

                                                </a>
                                            </td>
                                            <td>
                                                <?php echo e(!empty($salesorder->accounts->name)?$salesorder->accounts->name:'-'); ?>

                                            </td>
                                            <td>
                                                <?php if($salesorder->status == 0): ?>
                                                    <span class="badge bg-info p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\SalesOrder::$status[$salesorder->status])); ?></span>
                                                <?php elseif($salesorder->status == 1): ?>
                                                    <span class="badge bg-info p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\SalesOrder::$status[$salesorder->status])); ?></span>
                                                <?php elseif($salesorder->status == 2): ?>
                                                    <span class="badge bg-info p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\SalesOrder::$status[$salesorder->status])); ?></span>
                                                <?php elseif($salesorder->status == 3): ?>
                                                    <span class="badge bg-success p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\SalesOrder::$status[$salesorder->status])); ?></span>
                                                <?php elseif($salesorder->status == 4): ?>
                                                    <span class="badge bg-warning p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\SalesOrder::$status[$salesorder->status])); ?></span>
                                                <?php elseif($salesorder->status == 5): ?>
                                                    <span class="badge bg-danger p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\SalesOrder::$status[$salesorder->status])); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="budget"><?php echo e(company_date_formate($salesorder->created_at)); ?></span>
                                            </td>
                                            <td>
                                                <span class="budget"><?php echo e(currency_format_with_sym($salesorder->amount)); ?></span>
                                            </td>
                                            <td class="text-right">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesorder show')): ?>
                                                    <div class="action-btn bg-warning ms-2">
                                                        <a href="<?php echo e(route('salesorder.show',$salesorder->id)); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Details')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-title="<?php echo e(__('SalesOrders Details')); ?>">
                                                            <i class="ti ti-eye"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesorder edit')): ?>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="<?php echo e(route('salesorder.edit',$salesorder->id)); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-title="<?php echo e(__('Edit SalesOrders')); ?>"><i class="ti ti-pencil"></i></a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesorder delete')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['salesorder.destroy', $salesorder->id]]); ?>

                                                            <a href="#!" class="mx-3 btn btn-sm  align-items-center text-white show_confirm" data-bs-toggle="tooltip" title='Delete'>
                                                                <i class="ti ti-trash"></i>
                                                            </a>
                                                        <?php echo Form::close(); ?>

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

                <div id="useradd-3" class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5><?php echo e(__('Sales Invoice')); ?></h5>
                                <small class="text-muted"><?php echo e(__('Assign invoice for this quote')); ?></small>
                            </div>
                            <div class="col">
                                <div class="float-end">
                                    <a data-size="lg" data-url="<?php echo e(route('salesinvoice.create',['quote',$quote->id])); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="<?php echo e(__('Create New Invoice')); ?>" title="<?php echo e(__('Create')); ?>" class="btn btn-sm btn-primary btn-icon-only ">
                                        <i class="ti ti-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table datatable" id="datatable1">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                        <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Account')); ?></th>
                                        <th scope="col" class="sort" data-sort="status"><?php echo e(__('Status')); ?></th>
                                        <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Created At')); ?></th>
                                        <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Amount')); ?></th>
                                        <th scope="col"><?php echo e(__('Action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <a href="<?php echo e(route('salesinvoice.show',$invoice->id)); ?>" class="action-item text-primary" data-title="<?php echo e(__('Sales Invoice Details')); ?>">
                                                    <?php echo e($invoice->name); ?>

                                                </a>
                                            </td>
                                            <td>
                                                 <?php echo e(!empty( $invoice->accounts->name )? $invoice->accounts->name:'-'); ?>

                                            </td>
                                            <td>
                                                <?php if($invoice->status == 0): ?>
                                                    <span class="badge bg-info p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\SalesInvoice::$status[$invoice->status])); ?></span>
                                                <?php elseif($invoice->status == 1): ?>
                                                    <span class="badge bg-info p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\SalesInvoice::$status[$invoice->status])); ?></span>
                                                <?php elseif($invoice->status == 2): ?>
                                                    <span class="badge bg-info p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\SalesInvoice::$status[$invoice->status])); ?></span>
                                                <?php elseif($invoice->status == 3): ?>
                                                    <span class="badge bg-success p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\SalesInvoice::$status[$invoice->status])); ?></span>
                                                <?php elseif($invoice->status == 4): ?>
                                                    <span class="badge bg-warning p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\SalesInvoice::$status[$invoice->status])); ?></span>
                                                <?php elseif($invoice->status == 5): ?>
                                                    <span class="badge bg-danger p-2 px-3 roundedr"><?php echo e(__(Modules\Sales\Entities\SalesInvoice::$status[$invoice->status])); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="budget"><?php echo e(company_date_formate($invoice->created_at)); ?></span>
                                            </td>
                                            <td>
                                                <span class="budget"><?php echo e(currency_format_with_sym($invoice->amount)); ?></span>
                                            </td>
                                            <td class="text-right">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesinvoice show')): ?>
                                                    <div class="action-btn bg-warning ms-2">
                                                        <a href="<?php echo e(route('salesinvoice.show',$invoice->id)); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Details')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-title="<?php echo e(__('Invoice Details')); ?>">
                                                            <i class="ti ti-eye"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesinvoice edit')): ?>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="<?php echo e(route('salesinvoice.edit',$invoice->id)); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-title="<?php echo e(__('Edit Invoice')); ?>"><i class="ti ti-pencil"></i></a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesinvoice delete')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['salesinvoice.destroy', $invoice->id]]); ?>

                                                            <a href="#!" class="mx-3 btn btn-sm  align-items-center text-white show_confirm" data-bs-toggle="tooltip" title='Delete'>
                                                                <i class="ti ti-trash"></i>
                                                            </a>
                                                        <?php echo Form::close(); ?>

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
        $(document).on('click', '#billing_data', function () {
            $("[name='shipping_address']").val($("[name='billing_address']").val());
            $("[name='shipping_city']").val($("[name='billing_city']").val());
            $("[name='shipping_state']").val($("[name='billing_state']").val());
            $("[name='shipping_country']").val($("[name='billing_country']").val());
            $("[name='shipping_postalcode']").val($("[name='billing_postalcode']").val());
        })

        $(document).on('change', 'select[name=opportunity]', function () {

            var opportunities = $(this).val();
            getaccount(opportunities);
        });

        function getaccount(opportunities_id) {
            $.ajax({
                url: '<?php echo e(route('quote.getaccount')); ?>',
                type: 'POST',
                data: {
                    "opportunities_id": opportunities_id, "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function (data) {
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
    $(function(){
        $("#submit").click(function() {
            var tax =  $("#choices-multiple1 option:selected").length;
            if(tax == 0){
            $('#tax_validation').removeClass('d-none')
                return false;
            }else{
            $('#tax_validation').addClass('d-none')
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dimensionsystems/webcrm.dimensionsystems.com/Modules/Sales/Resources/views/quote/edit.blade.php ENDPATH**/ ?>