<?php echo e(Form::open(['route' => 'product-service.store', 'enctype' => 'multipart/form-data'])); ?>

<div class="modal-body">
    <div class="text-end">
        <?php if(module_is_active('AIAssistant')): ?>
            <?php echo $__env->make('aiassistant::ai.generate_ai_btn',['template_module' => 'product','module'=>'ProductService'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('name', __('Name'), ['class' => 'form-label'])); ?><span class="text-danger">*</span>
                <div class="form-icon-user">
                    <?php echo e(Form::text('name', '', ['class' => 'form-control', 'required' => 'required'])); ?>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('sku', __('SKU'), ['class' => 'form-label'])); ?><span class="text-danger">*</span>
                <div class="form-icon-user">
                    <?php echo e(Form::text('sku', '', ['class' => 'form-control', 'required' => 'required'])); ?>

                </div>
            </div>
        </div>

        <div class="form-group col-md-12">
            <?php echo e(Form::label('description', __('Description'), ['class' => 'form-label'])); ?>

            <?php echo Form::textarea('description', null, ['class' => 'form-control', 'rows' => '2']); ?>

        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('purchase_price', __('Cost'), ['class' => 'form-label'])); ?><span
                        class="text-danger">*</span>
                <div class="form-icon-user">
                    <?php echo e(Form::number('purchase_price', '', ['class' => 'form-control', 'required' => 'required', 'step' => '0.01','id'=> 'cost'])); ?>

                </div>
            </div>
        </div>
        <div class="form-group col-md-6 markup">
            <?php echo e(Form::label('markup', __('MarkUp'), ['class' => 'form-label'])); ?>

            <span class="text-danger">*</span>
            <?php echo e(Form::number('markup', null, ['class' => 'form-control', 'required' => 'required', 'min'=>'0','id'=>'markup'])); ?>

        </div>

        <div class="form-group col-md-6 quantity">
            <?php echo e(Form::label('quantity', __('Quantity'), ['class' => 'form-label'])); ?>

            <span class="text-danger">*</span>
            <?php echo e(Form::number('quantity', null, ['class' => 'form-control', 'min'=>'0', 'required' => 'required','id'=>'quantity'])); ?>

        </div>

        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('sale_price', __('Price'), ['class' => 'form-label'])); ?><span
                    class="text-danger">*</span>
                <div class="form-icon-user">
                    <?php echo e(Form::number('sale_price', '', ['class' => 'form-control', 'required' => 'required', 'step' => '0.01','id' => 'price'])); ?>

                </div>
            </div>
        </div>

        <div class="form-group col-md-6">
            <?php echo e(Form::label('tax_id', __('Tax'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::select('tax_id[]', $tax, null, ['class' => 'form-control choices', 'id' => 'choices-multiple1', 'multiple'])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('category_id', __('Category'), ['class' => 'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('category_id', $category, null, ['class' => 'form-control', 'required' => 'required'])); ?>


            <div class=" text-xs">
                <?php echo e(__('Please add constant category. ')); ?><a
                    href="<?php echo e(route('category.index')); ?>"><b><?php echo e(__('Add Category')); ?></b></a>
            </div>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('unit_id', __('Unit'), ['class' => 'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('unit_id', $unit, null, ['class' => 'form-control', 'required' => 'required'])); ?>

        </div>

        <div class="col-6 form-group">
            <?php echo e(Form::label('image', __('Image'), ['class' => 'col-form-label'])); ?>

            <div class="choose-files ">
                <label for="image">

                    <input type="file" class="form-control file" name="image" id="image"
                        data-filename="image_update"
                        onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">

                    <img id="blah" src="<?php echo e(asset('Modules/ProductService/Resources/assets/image/img01.jpg')); ?>"
                        alt="your image" width="100" height="100" />
                </label>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <div class="btn-box">
                    <label class="d-block form-label"><?php echo e(__('Type')); ?></label>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input type" id="customRadio5" name="type" value="product" checked="checked" >
                                <label class="custom-control-label form-label" for="customRadio5"><?php echo e(__('Product')); ?></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input type" id="customRadio6" name="type" value="service" >
                                <label class="custom-control-label form-label" for="customRadio6"><?php echo e(__('Service')); ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="form-group col-md-6 manufacturer_part_number">
            <?php echo e(Form::label('manufacturer_part_number', __('Manufacturer Part Number'), ['class' => 'form-label'])); ?>

            <span class="text-danger">*</span>
            <?php echo e(Form::text('manufacturer_part_number', null, ['class' => 'form-control','required' => 'required'])); ?>

        </div>
        <div class="form-group col-md-6 manufacturer_name">
            <?php echo e(Form::label('manufacturer_name', __('Manufacturer Name'), ['class' => 'form-label'])); ?>

                        <span class="text-danger">*</span>
            <?php echo e(Form::text('manufacturer_name', null, ['class' => 'form-control','required' => 'required'])); ?>

        </div>
        <div class="form-group col-md-6 supplier_part_number">
            <?php echo e(Form::label('supplier_part_number', __('Supplier Part Number'), ['class' => 'form-label','required' => 'required'])); ?>

                        <span class="text-danger">*</span>
            <?php echo e(Form::text('supplier_part_number', null, ['class' => 'form-control','required' => 'required'])); ?>

        </div>
        <div class="form-group col-md-6 supplier_name">
            <?php echo e(Form::label('supplier_name', __('Supplier Name'), ['class' => 'form-label'])); ?>

                        <span class="text-danger">*</span>
            <?php echo e(Form::text('supplier_name', null, ['class' => 'form-control','required' => 'required'])); ?>

        </div>

        <?php if(module_is_active('CustomField') && !$customFields->isEmpty()): ?>
            <div class="col-md-12">
                <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                    <?php echo $__env->make('customfield::formBuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>


<script>
    //hide & show quantity
    $(document).on('click', '.type', function ()
    {
        var type = $(this).val();
        if (type == 'product') {
            $('.quantity').removeClass('d-none')
            $('.quantity').addClass('d-block');
        } else {
            $('.quantity').addClass('d-none')
            $('.quantity').removeClass('d-block');
        }
    });

    $(document).ready(function() {
        $('#markup, #cost, #quantity').on('input', function() {

            // Get the values from the input fields
            var markup = parseFloat($('#markup').val());
            var cost = parseFloat($('#cost').val());
            var quantity = parseInt($('#quantity').val());

            // Check if the input values are valid numbers
            if (!isNaN(markup) && !isNaN(cost) && !isNaN(quantity)) {
                // Perform the calculation
                var markupprice= cost * markup/ 100;

                var price = (cost + markupprice) * quantity;
                // Update the price field with the calculated value
                $('#price').val(price.toFixed(2)); // You can adjust the number of decimal places as needed
            } else {
                // If any input is not a valid number, display an error or handle it as needed
                $('#price').val(''); // Clear the price field or handle the error as you see fit
            }
        });
    });

</script>

<?php /**PATH C:\xampp\htdocs\dsi_crm\Modules/ProductService\Resources/views/create.blade.php ENDPATH**/ ?>