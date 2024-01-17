<?php echo e(Form::model($workSpace,array('route' => array('workspace.update', $workSpace->id), 'method' => 'PUT'))); ?>

<div class="modal-body">
    <div class="form-group">
        <?php echo e(Form::label('name', __('Name'), ['class' => 'col-form-label'])); ?>

        <?php echo e(Form::text('name', null, ['class' => 'form-control','required'=>'required','placeholder' => __('Enter Workspace Name')])); ?>

    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
    <?php echo e(Form::submit(__('Update'),array('class'=>'btn  btn-primary'))); ?>

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\DSI_Laravel\resources\views/workspace/edit.blade.php ENDPATH**/ ?>