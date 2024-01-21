<?php echo e(Form::open(['method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'upload_form'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="col-md-12 mb-6">
            <?php echo e(Form::label('file', __('Download Sample Product & Service CSV File'), ['class' => 'col-form-label text-danger mx-1'])); ?>

            <?php if(check_file('uploads/sample/sample_product.csv')): ?>
                <a href="<?php echo e(asset('uploads/sample/sample_product.csv')); ?>"
                    class="btn btn-sm btn-primary btn-icon-only">
                    <i class="fa fa-download"></i>
                </a>
            <?php endif; ?>
        </div>
        <div class="col-md-12 mt-1">
            <?php echo e(Form::label('file', __('Select CSV File'), ['class' => 'col-form-label'])); ?>

            <div class="choose-file form-group">
                <label for="file" class="col-form-label">
                    <input type="file" class="form-control" name="file" id="file" data-filename="upload_file"
                        required>
                </label>
                <p class="upload_file"></p>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-secondary btn-light" data-bs-dismiss="modal">
    <button type="submit" value="<?php echo e(__('Upload')); ?>" class="btn btn-primary ms-2">
        <?php echo e(__('Upload')); ?>

    </button>
    <a href="" data-url="<?php echo e(route('product-service.import.modal')); ?>" data-ajax-popup-over="true" title="<?php echo e(__('Create')); ?>" data-size="xl" data-title="<?php echo e(__('Import Product & Service CSV Data')); ?>"  class="d-none import_modal_show"></a>
</div>
<?php echo e(Form::close()); ?>


<script>
    $('#upload_form').on('submit', function(event) {

        event.preventDefault();
        let data = new FormData(this);
        data.append('_token', "<?php echo e(csrf_token()); ?>");
        $.ajax({
            url: "<?php echo e(route('product-service.import')); ?>",
            method: "POST",
            data: data,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data.error != '')
                {
                    toastrs('Error',data.error, 'error');
                } else {
                    $('#commonModal').modal('hide');
                    $(".import_modal_show").trigger( "click");
                    setTimeout(function() {
                        SetData(data.output);
                    }, 700);
                }
            }
        });

    });
    
</script>
<?php /**PATH /home/dimensionsystems/webcrm.dimensionsystems.com/Modules/ProductService/Resources/views/import.blade.php ENDPATH**/ ?>