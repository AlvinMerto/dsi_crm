<?php echo e(Form::open(array('url'=>'contact','method'=>'post','enctype'=>'multipart/form-data'))); ?>

<div class="modal-body">
    <div class="text-end">
        <?php if(module_is_active('AIAssistant')): ?>
            <?php echo $__env->make('aiassistant::ai.generate_ai_btn',['template_module' => 'contact','module'=>'Sales'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('name',__('Name'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))); ?>

            </div>
        </div>
        <?php if($type == 'account'): ?>
            <div class="col-6">
                <div class="form-group">
                    <?php echo e(Form::label('account',__('Account'),['class'=>'form-label'])); ?>

                    <?php echo Form::select('account', $account, $id,array('class' => 'form-control select_account')); ?>

                </div>
            </div>

        <?php else: ?>
            <div class="col-6">
                <div class="form-group">
                    <?php echo e(Form::label('account',__('Account'),['class'=>'form-label'])); ?>

                    <?php echo Form::select('account', $account, null,array('class' => 'form-control select_account')); ?>

                </div>
            </div>
        <?php endif; ?>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('email',__('Email'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('phone',__('Phone'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('phone',null,array('class'=>'form-control','placeholder'=>__('Enter Phone'),'required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('contactaddress',__('Address'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('contact_address',null,array('class'=>'form-control contact_address','placeholder'=>__('Address'),'required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('contactaddress',__('City'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('contact_city',null,array('class'=>'form-control contact_city','placeholder'=>__('City'),'required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('contactaddress',__('State'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('contact_state',null,array('class'=>'form-control contact_state','placeholder'=>__('State'),'required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('contact_postalcode',__('Postal Code'),['class'=>'form-label'])); ?>

                <?php echo e(Form::number('contact_postalcode',null,array('class'=>'form-control contact_postalcode','placeholder'=>__('Postal Code'),'required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('contact_country',__('Country'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('contact_country',null,array('class'=>'form-control contact_country','placeholder'=>__('Country'),'required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('description',__('Description'),['class'=>'form-label'])); ?>

                <?php echo e(Form::textarea('description',null,array('class'=>'form-control','rows'=>2,'placeholder'=>__('Enter Description')))); ?>

            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light"
        data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
        <?php echo e(Form::submit(__('Save'),array('class'=>'btn btn-primary '))); ?>

</div>
<?php echo e(Form::close()); ?>






<?php /**PATH C:\xampp\htdocs\DSI_Laravel\Modules/Sales\Resources/views/contact/create.blade.php ENDPATH**/ ?>