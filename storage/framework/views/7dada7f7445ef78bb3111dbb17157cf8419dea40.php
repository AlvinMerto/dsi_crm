<?php echo e(Form::open(['route' => 'category.store'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('name', __('Category Name'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('name', '', ['class' => 'form-control', 'required' => 'required'])); ?>

        </div>
        <div class="form-group col-md-12">
            <input type="hidden" value="<?php echo e($types); ?>" name="type">
        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('color', __('Category Color'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::color('color', '', ['class' => 'form-control jscolor', 'required' => 'required'])); ?>

            <small><?php echo e(__('For chart representation')); ?></small>
        </div>
    </div>
</div>
<div class="modal-footer">
        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
        <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/dimensionsystems/webcrm.dimensionsystems.com/Modules/ProductService/Resources/views/category/create.blade.php ENDPATH**/ ?>