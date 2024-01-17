<?php echo e(Form::model($bankAccount, ['route' => ['bank-account.update', $bankAccount->id], 'method' => 'PUT'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('holder_name', __('Bank Holder Name'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('holder_name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Enter Bank Holder Name')])); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('bank_name', __('Bank Name'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('bank_name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Enter Bank Name')])); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('account_number', __('Account Number'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('account_number', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Enter Account Number')])); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('opening_balance', __('Opening Balance'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::number('opening_balance', null, ['class' => 'form-control', 'required' => 'required', 'min' => '0', 'placeholder' => __('Enter Opening Balance')])); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('contact_number', __('Contact Number'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::number('contact_number', null, ['class' => 'form-control', 'required' => 'required', 'min' => '0', 'placeholder' => __('Enter Contact Number')])); ?>

            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('bank_address', __('Bank Address'), ['class' => 'form-label '])); ?>

                <?php echo e(Form::textarea('bank_address', null, ['class' => 'form-control', 'placeholder' => __('Enter Bank Address'), 'rows' => '3', 'required' => 'required'])); ?>

            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
    <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn  btn-primary'])); ?>

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\DSI_Laravel\Modules/Account\Resources/views/bankAccount/edit.blade.php ENDPATH**/ ?>