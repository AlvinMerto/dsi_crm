<form id="customitem">
<div class="modal-body">
    <div class="text-end">
        <?php if(module_is_active('AIAssistant')): ?>
            <?php echo $__env->make('aiassistant::ai.generate_ai_btn',['template_module' => 'product','module'=>'ProductService'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>
    <input type="hidden" name="data_id" value="">
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('description', __('Description'), ['class' => 'form-label'])); ?>

            <?php echo Form::textarea('description', null, ['class' => 'form-control', 'rows' => '2','id'=>'cdescription']); ?>

        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('purchase_price', __('Cost'), ['class' => 'form-label'])); ?><span
                        class="text-danger">*</span>
                <div class="form-icon-user">
                    <?php echo e(Form::number('purchase_price', '', ['class' => 'form-control', 'required' => 'required', 'step' => '0.01','id'=> 'ccost'])); ?>

                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('markup', __('MarkUp'), ['class' => 'form-label'])); ?>

            
            <?php echo e(Form::number('markup', null, ['class' => 'form-control', 'min'=>'0','id'=>'cmarkup'])); ?>

        </div>

        <div class="form-group col-md-6">
            <?php echo e(Form::label('quantity', __('Quantity'), ['class' => 'form-label'])); ?>

            
            <?php echo e(Form::number('quantity', null, ['class' => 'form-control', 'min'=>'0','id'=>'cquantity'])); ?>

        </div>

        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('sale_price', __('Price'), ['class' => 'form-label'])); ?><span
                        class="text-danger">*</span>
                <div class="form-icon-user">
                    <?php echo e(Form::number('sale_price', '', ['class' => 'form-control', 'required' => 'required', 'step' => '0.01','id' => 'cprice'])); ?>

                </div>
            </div>
        </div>







        <div class="form-group col-md-6 manufacturer_part_number">
            <?php echo e(Form::label('manufacturer_part_number', __('Manufacturer Part Number'), ['class' => 'form-label'])); ?>

            
            <?php echo e(Form::text('manufacturer_part_number', null, ['class' => 'form-control','required' => 'required','id'=>'cmanufacturer_part_number'])); ?>

        </div>
        <div class="form-group col-md-6 manufacturer_name">
            <?php echo e(Form::label('manufacturer_name', __('Manufacturer Name'), ['class' => 'form-label'])); ?>

            
            <?php echo e(Form::text('manufacturer_name', null, ['class' => 'form-control','required' => 'required','id'=>'cmanufacturer_name'])); ?>

        </div>
        <div class="form-group col-md-6 supplier_part_number">
            <?php echo e(Form::label('supplier_part_number', __('Supplier Part Number'), ['class' => 'form-label','required' => 'required'])); ?>

            
            <?php echo e(Form::text('supplier_part_number', null, ['class' => 'form-control','required' => 'required','id'=>'csupplier_part_number'])); ?>

        </div>
        <div class="form-group col-md-6 supplier_name">
            <?php echo e(Form::label('supplier_name', __('Supplier Name'), ['class' => 'form-label'])); ?>

            
            <?php echo e(Form::text('supplier_name', null, ['class' => 'form-control','required' => 'required','id'=>'csupplier_name'])); ?>

        </div>
        <input type="hidden" class="form-control dataid" name="dataId" value="">
        <input type="hidden" class="form-control datasubid" name="datasubid" value="">
        <input type="hidden" class="form-control type" name="type" value="">
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary btncutomitem">
</div>
</form>

<script>
    //hide & show quantity
    $(document).on('click', '.type', function ()
    {
        var type = $(this).val();
        if (type == 'product') {
            $('.cquantity').removeClass('d-none')
            $('.cquantity').addClass('d-block');
        } else {
            $('.cquantity').addClass('d-none')
            $('.cquantity').removeClass('d-block');
        }
    });


        $('#cmarkup, #ccost, #cquantity').on('input', function() {

            // Get the values from the input fields
            var markup = parseFloat($('#cmarkup').val());
            var cost = parseFloat($('#ccost').val());
            var quantity = parseInt($('#cquantity').val());

            // Check if the input values are valid numbers
            if (!isNaN(markup) && !isNaN(cost) && !isNaN(quantity)) {
                // Perform the calculation
                var markupprice= cost * markup/ 100;

                var price = (cost + markupprice) * quantity;
                // Update the price field with the calculated value
                $('#cprice').val(price.toFixed(2)); // You can adjust the number of decimal places as needed
            } else {
                // If any input is not a valid number, display an error or handle it as needed
                $('#cprice').val(''); // Clear the price field or handle the error as you see fit
            }
        });


</script>

<?php /**PATH /home/dimensionsystems/webcrm.dimensionsystems.com/Modules/Sales/Resources/views/salesquote/customitem.blade.php ENDPATH**/ ?>