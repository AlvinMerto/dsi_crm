<?php echo e(Form::open(array('url'=>'salesquote/setting/store','method'=>'post'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <small>When you checked that value is hide in printing time on user type is client </small>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="supplier_part_number" value="on" <?php if(isset($setting['supplier_part_number']) && ($setting['supplier_part_number']=="on")): ?> checked="" <?php endif; ?>  id="supplier_part_number">
                <label class="form-check-label" for="supplier_part_number">
                    Supplier Part Number
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="manufacturer_part_number" value="on" id="manufacturer_part_number" <?php if(isset($setting['manufacturer_part_number']) && ($setting['manufacturer_part_number']=="on")): ?> checked="" <?php endif; ?> >
                <label class="form-check-label" for="manufacturer_part_number">
                    Manufacturer Part Number
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="subtotal" value="on" id="subtotal" <?php if(isset($setting['subtotal']) && ($setting['subtotal']=="on")): ?> checked="" <?php endif; ?>>
                <label class="form-check-label" for="subtotal">
                    Itemized Prices within SubTotal
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="text_within_groups" value="on" id="text_within_groups" <?php if(isset($setting['text_within_groups']) && ($setting['text_within_groups']=="on")): ?> checked="" <?php endif; ?>>
                <label class="form-check-label" for="text_within_groups">
                    Text Within Groups
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="labor_total" value="on" id="labor_total" <?php if(isset($setting['labor_total']) && ($setting['labor_total']=="on")): ?> checked="" <?php endif; ?>>
                <label class="form-check-label" for="labor_total">
                    Labor Total
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="shipping_total" value="on" id="shipping_total" <?php if(isset($setting['shipping_total']) && ($setting['shipping_total']=="on")): ?> checked="" <?php endif; ?> >
                <label class="form-check-label" for="shipping_total">
                    Shipping Total
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="grand_total" value="on" id="grand_total" <?php if(isset($setting['grand_total']) && ($setting['grand_total']=="on")): ?> checked="" <?php endif; ?>>
                <label class="form-check-label" for="grand_total">
                    Grand Total
                </label>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
    <?php echo e(Form::submit(__('Create'),array('class'=>'btn  btn-primary'))); ?>

</div>
<?php echo e(Form::close()); ?><?php /**PATH /var/www/html/client/dimensionsystem/main-file/Modules/Sales/Resources/views/salesquote/setting.blade.php ENDPATH**/ ?>