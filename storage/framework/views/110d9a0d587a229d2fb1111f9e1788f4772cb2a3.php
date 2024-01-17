<?php echo e(Form::open(array('url'=>'opportunities','method'=>'post','enctype'=>'multipart/form-data'))); ?>

    <div class="modal-body">
        <div class="text-end">
            <?php if(module_is_active('AIAssistant')): ?>
                <?php echo $__env->make('aiassistant::ai.generate_ai_btn',['template_module' => 'opportunities','module'=>'Sales'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                        <?php echo e(Form::label('account',__('Account Name'),['class'=>'form-label'])); ?>

                        <?php echo Form::select('account', $account_name, $id,array('class' => 'form-control select_data_account','required'=>'required','placeholder'=>'Select Account')); ?>

                    </div>
                </div>
            <?php else: ?>
                <div class="col-6">
                    <div class="form-group">
                        <?php echo e(Form::label('account',__('Account'),['class'=>'form-label'])); ?>

                        <?php echo Form::select('account', $account_name, null,array('class' => 'form-control select_data_account','required'=>'required','placeholder'=>'Select Account')); ?>

                    </div>
                </div>
            <?php endif; ?>
            <?php if($type == 'contact'): ?>
                <div class="col-6">
                    <div class="form-group">
                        <?php echo e(Form::label('contact',__('Contacts'),['class'=>'form-label'])); ?>

                        <?php echo Form::select('contact', $contact, $id,array('class' => 'form-control')); ?>

                    </div>
                </div>
            <?php else: ?>
                <div class="form-group col-md-6">
                    <label class="require form-label"><?php echo e(__('Contact')); ?></label>
                    <select class="form-control <?php echo e(!empty($errors->first('contact')) ? 'is-invalid' : ''); ?> contact_data"
                            name="contact" id="contact">
                    </select>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('contact')); ?>

                    </div>
                </div>
            <?php endif; ?>
            <div class="col-6">
                <div class="form-group">
                    <?php echo e(Form::label('stage',__('Opportunities Stage'),['class'=>'form-label'])); ?>

                    <?php echo Form::select('stage', $opportunities_stage, null,array('class' => 'form-control','required'=>'required','placeholder'=>'select Opportunities Stage')); ?>

                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <?php echo e(Form::label('amount',__('Amount'),['class'=>'form-label'])); ?>

                    <?php echo Form::number('amount', null,array('class' => 'form-control ','placeholder'=>__('Enter Amount'),'required'=>'required')); ?>

                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <?php echo e(Form::label('probability',__('Probability'),['class'=>'form-label'])); ?>

                    <?php echo e(Form::number('probability',null,array('class'=>'form-control','placeholder'=>__('Enter Probability'),'required'=>'required'))); ?>

                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <?php echo e(Form::label('close_date',__('Close Date'),['class'=>'form-label'])); ?>

                    <?php echo e(Form::date('close_date',date('Y-m-d'),array('class'=>'form-control','placeholder'=>__('Enter close date'),'required'=>'required'))); ?>

                </div>
            </div>
            <?php if(module_is_active('Lead')): ?>
            <div class="col-6">
                <div class="form-group">
                    <?php echo e(Form::label('lead_source',__('Lead Source'),['class'=>'form-label'])); ?>

                    <?php echo Form::select('lead_source', $leadsource, null,array('class' => 'form-control','placeholder'=>__('Select Lead Source'),'required'=>'required')); ?>

                </div>
            </div>
            <?php endif; ?>
            <div class="col-6">
                <div class="form-group">
                    <?php echo e(Form::label('user',__('Assign User'))); ?>

                    <?php echo Form::select('user', $user, null,array('class' => 'form-control')); ?>

                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <?php echo e(Form::label('Description',__('Description'),['class'=>'form-label'])); ?>

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

<script>
    $(document).on('change', '.select_data_account', function() {
        var id= $(this).val();
        $('.contact_data').empty();
        $.ajax({
            url: '<?php echo e(route('contact.get.detail')); ?>',
            type: 'POST',
            data: {
                "account_id": id,
                "_token": "<?php echo e(csrf_token()); ?>",
            },
            success: function(data) {
                $('.contact_data').html(data);
            }
        });
    });
</script>
<?php /**PATH /home/dimensionsystems/webcrm.dimensionsystems.com/Modules/Sales/Resources/views/opportunities/create.blade.php ENDPATH**/ ?>