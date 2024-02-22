<form id="customitem">
<div class="modal-body">
    <div class="text-end">
        <?php if(module_is_active('AIAssistant')): ?>
            <?php echo $__env->make('aiassistant::ai.generate_ai_btn',['template_module' => 'product','module'=>'ProductService'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>
    <input type="hidden" name="data_id" value="">
    <div class="row">
        <!-- <div class="form-group col-md-12">
            <?php echo e(Form::label('ProductLine', __('Product Line'),['class'=>'form-label'])); ?>

            <select class="form-control" id="productlineid">
                <optgroup label="Product Line">
                    <option value="1"> 3CX </option>
                    <option value="2"> Prometheon </option>
                </optgroup>
                <optgroup label="Custom Input">
                    <option value="new"> Enter Custom Input </option>
                </optgroup>
            </select>
        </div> -->
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

            
            <select class="form-control" id="cmarkup">
                <optgroup label="Pre-inputted Mark up">
                    <option value="65"> 65% </option>
                    <option value="75"> 75% </option>
                </optgroup>
                <optgroup label="Custom Markup">
                    <option value='custom_mup_sel'> Enter New Markup </option>
                </optgroup>
            </select>
            <input type='number' id='customtext_m_up' class="form-control" style="display:none; margin-top: 1px;"/>
            <!--
            <?php echo e(Form::number('markup', null, ['class' => 'form-control', 'min'=>'0','id'=>'cmarkup'])); ?> 
            -->
        </div>

        <div class="form-group col-md-4">
            <?php echo e(Form::label('quantity', __('Quantity'), ['class' => 'form-label'])); ?>

            
            <?php echo e(Form::number('quantity', null, ['class' => 'form-control', 'min'=>'0','id'=>'cquantity'])); ?>

        </div>

        <div class="col-md-4">
            <div class="form-group">
                <?php echo e(Form::label('deliveryfee', __('Shipping Fee'), ['class' => 'form-label'])); ?>

                <input type='number' class="form-control" id="deliveryfee_text"/>
            </div>  
        </div>

        <div class="col-md-4">
            <div class="form-group">
               <?php echo e(Form::label('istaxable', __('Taxable'), ['class' => 'form-label'])); ?>

               <br/>
               <input type='checkbox' id="istaxable"/> <?php echo e(Form::label('istaxable', __('is Taxable'), ['class' => 'form-label'])); ?>

            </div>
        </div>

        <!-- <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('sale_price', __('Price'), ['class' => 'form-label'])); ?><span
                        class="text-danger">*</span>
                <div class="form-icon-user">
                    <?php echo e(Form::number('sale_price', '', ['class' => 'form-control', 'required' => 'required', 'step' => '0.01','id' => 'cprice'])); ?>

                </div>
            </div>
        </div> -->






        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('expiry', __('Expiry'), ['class' => 'form-label'])); ?>

                <br/>
                <input type='checkbox' id="expiry"/> <?php echo e(Form::label('expiry', __('Add Expiry Date'), ['class' => 'form-label'])); ?>

                <input type='date' class="form-control" id="expirydate_text" style="display:none;"/>
            </div>
        </div>

        <div id="addnewinformation" class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('additionalinformation', __('Additional Information'), ['class' => 'form-label'])); ?> 
                <div class="flex spantab">
                    <span id="tab_nav_info"> 
                        <span class="btn btn-sm btn-primary open_info" data-tab="manu_info"> Manufacturer </span>
                        <span class="btn btn-sm btn-primary open_info" data-tab="sup_info"> Supplier </span>
                    </span>
                    <span class="btn btn-sm btn-primary" id="addinformation_btn"> <i class="ti ti-circle-plus"></i> </span>
                </div>
            </div>

            <div class="row" style="display:none;" id="info_tab">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo e(Form::label('info_title', __('Title'), ['class' => 'form-label'])); ?> 
                        <input type="text" class="form-control" id="info_title"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo e(Form::label('info_label', __('Information Label'), ['class' => 'form-label','id'=>'infolabel'])); ?> 
                        <input type="text" class="form-control" id="info_label"/>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo e(Form::label('info_desc', __('Information Description'), ['class' => 'form-label','id'=>'infodesc'])); ?> 
                        <textarea class="form-control" id="info_desc"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <span class="btn btn-primary btn-sm" id="save_info_btn"> Save Information  </span>
                    <span class="btn btn-danger btn-sm" id="delete_info_btn" style='display:none;'> Remove Information  </span>
                </div>
            </div>
        </div> 
          <!--
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
            -->
        
        
        <input type="hidden" class="form-control dataid" name="dataId" value="">
        <input type="hidden" class="form-control datasubid" name="datasubid" value="">
        <input type="hidden" class="form-control type" name="type" value="">
    </div>
</div>
<div class="modal-footer">
    <!-- <a href="#" id="openaddinformation"><i class="ti ti-circle-plus"></i> Add Information </a> -->

    <span id='loading_div_ct' style='display:none; position: absolute;left: 20px;'>
        <div class='loader'></div>
    </span>
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <p class="btn  btn-primary btncutomitem_new"> Create </p>
    
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


        $('#ccost, #cquantity, #customtext_m_up, #cmarkup').on('input', function() {
            // #cmarkup,
            // Get the values from the input fields

            var val = $(document).find("#cmarkup").val();

            if (val == "custom_mup_sel") {
                $(document).find("#customtext_m_up").show();
                $(document).find("#customtext_m_up").focus();
            } else {
                $(document).find("#customtext_m_up").hide();
                $(document).find("#customtext_m_up").val( val );
            }
            
            var markup = parseFloat($('#customtext_m_up').val());
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

<?php /**PATH C:\xampp\htdocs\dsi_crm\Modules/Sales\Resources/views/salesquote/customitem.blade.php ENDPATH**/ ?>