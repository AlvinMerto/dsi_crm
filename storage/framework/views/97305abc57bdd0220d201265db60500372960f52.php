<?php if(!empty($customer)): ?>
    <?php echo e(Form::model($customer,array('route' => array('customer.update', $customer->id), 'method' => 'PUT'))); ?>

<?php else: ?>
    <?php echo e(Form::open(['route' => ['customer.store'], 'method' => 'post'])); ?>

<?php endif; ?>
<div class="modal-body">
    <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
    <h6 class="sub-title"><?php echo e(__('Basic Info')); ?></h6>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="form-group">
                <?php echo e(Form::label('name',__('Name'),array('class'=>'form-label'))); ?>

                <div class="form-icon-user">
                    <?php echo e(Form::text('name',!empty($user->name) ? $user->name : null,array('class'=>'form-control','required'=>'required','placeholder' => __('Enter Customer Name')))); ?>

                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="form-group">
                <?php echo e(Form::label('contact',__('Contact'),['class'=>'form-label'])); ?>

                <div class="form-icon-user">
                    <?php echo e(Form::text('contact',null,array('class'=>'form-control','required'=>'required','placeholder' => __('Enter Contact') ))); ?>

                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="form-group">
                <?php echo e(Form::label('tax_number',__('Tax Number'),['class'=>'form-label'])); ?>

                <div class="form-icon-user">
                    <?php echo e(Form::text('tax_number',null,array('class'=>'form-control','placeholder' => __('Enter Tax Number')))); ?>

                </div>
            </div>
        </div>
        <?php echo $__env->yieldPushContent('electronic_address'); ?>
        <?php if(module_is_active('CustomField') && !$customFields->isEmpty()): ?>
            <div class="col-md-12">
                <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                    <?php echo $__env->make('customfield::formBuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <h6 class="sub-title"><?php echo e(__('Billing Address')); ?></h6>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('billing_name',__('Name'),array('class'=>'','class'=>'form-label'))); ?>

                <div class="form-icon-user">
                    <?php echo e(Form::text('billing_name',null,array('class'=>'form-control','placeholder' => __('Enter Name'), 'required' => 'required'))); ?>

                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6  col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('billing_phone',__('Phone'),array('class'=>'form-label'))); ?>

                <div class="form-icon-user">
                    <?php echo e(Form::text('billing_phone',null,array('class'=>'form-control','placeholder' => __('Enter Phone'), 'required' => 'required'))); ?>

                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('billing_address',__('Address'),array('class'=>'form-label'))); ?>

                <div class="input-group">
                    <?php echo e(Form::textarea('billing_address',null,array('class'=>'form-control','rows'=>3,'placeholder' => __('Enter Address'), 'required' => 'required'))); ?>

                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('billing_city',__('City'),array('class'=>'form-label'))); ?>

                <div class="form-icon-user">
                    <?php echo e(Form::text('billing_city',null,array('class'=>'form-control','placeholder' => __('Enter City'), 'required' => 'required'))); ?>

                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('billing_state',__('State'),array('class'=>'form-label'))); ?>

                <div class="form-icon-user">
                    <?php echo e(Form::text('billing_state',null,array('class'=>'form-control','placeholder' => __('Enter State'), 'required' => 'required'))); ?>

                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('billing_country',__('Country'),array('class'=>'form-label'))); ?>

                <div class="form-icon-user">
                    <?php echo e(Form::text('billing_country',null,array('class'=>'form-control','placeholder' => __('Enter Country'), 'required' => 'required'))); ?>

                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('billing_zip',__('Zip Code'),array('class'=>'form-label'))); ?>

                <div class="form-icon-user">
                    <?php echo e(Form::text('billing_zip',null,array('class'=>'form-control','placeholder' => __('Enter Zip Code'), 'required' => 'required'))); ?>

                </div>
            </div>
        </div>
    </div>

    <?php if(company_setting('invoice_shipping_display') == 'on' || company_setting('proposal_shipping_display') == 'on' ): ?>
        <div class="col-md-12 text-end">
            <input type="button" id="billing_data" value="<?php echo e(__('Shipping Same As Billing')); ?>" class="btn btn-primary">
        </div>
        <h6 class="sub-title"><?php echo e(__('Shipping Address')); ?></h6>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    <?php echo e(Form::label('shipping_name',__('Name'),array('class'=>'form-label'))); ?>

                    <div class="form-icon-user">
                        <?php echo e(Form::text('shipping_name',null,array('class'=>'form-control','placeholder' => __('Enter Name')))); ?>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    <?php echo e(Form::label('shipping_phone',__('Phone'),array('class'=>'form-label'))); ?>

                    <div class="form-icon-user">
                        <?php echo e(Form::text('shipping_phone',null,array('class'=>'form-control','placeholder' => __('Enter Phone')))); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo e(Form::label('shipping_address',__('Address'),array('class'=>'form-label'))); ?>

                    <label class="form-label" for="example2cols1Input"></label>
                    <div class="input-group">
                        <?php echo e(Form::textarea('shipping_address',null,array('class'=>'form-control','rows'=>3,'placeholder' => __('Enter Address')))); ?>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    <?php echo e(Form::label('shipping_city',__('City'),array('class'=>'form-label'))); ?>

                    <div class="form-icon-user">
                        <?php echo e(Form::text('shipping_city',null,array('class'=>'form-control','placeholder' => __('Enter City')))); ?>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    <?php echo e(Form::label('shipping_state',__('State'),array('class'=>'form-label'))); ?>

                    <div class="form-icon-user">
                        <?php echo e(Form::text('shipping_state',null,array('class'=>'form-control','placeholder' => __('Enter State')))); ?>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    <?php echo e(Form::label('shipping_country',__('Country'),array('class'=>'form-label'))); ?>

                    <div class="form-icon-user">
                        <?php echo e(Form::text('shipping_country',null,array('class'=>'form-control','placeholder' => __('Enter Country')))); ?>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    <?php echo e(Form::label('shipping_zip',__('Zip Code'),array('class'=>'form-label'))); ?>

                    <div class="form-icon-user">
                        <?php echo e(Form::text('shipping_zip',null,array('class'=>'form-control','placeholder' => __('Enter Zip Code')))); ?>

                    </div>
                </div>
            </div>

        </div>
    <?php endif; ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
    <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn  btn-primary'])); ?>

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/dimensionsystems/webcrm.dimensionsystems.com/Modules/Account/Resources/views/customer/edit.blade.php ENDPATH**/ ?>