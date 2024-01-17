<?php if(module_is_active('Account') && !empty($customer)): ?>
    <div class="row">
        <?php if(isset($customer['billing_name'])): ?>
            <div class="col-md-5">
                <h6><?php echo e(__('Bill to')); ?></h6>
                <div class="bill-to">
                    <small>
                        <span><?php echo e($customer['billing_name']); ?></span><br>
                        <span><?php echo e($customer['billing_address']); ?></span><br>
                        <span><?php echo e($customer['billing_city'].' , '.$customer['billing_state'].' ,'. $customer['billing_zip']); ?></span><br>
                        <span><?php echo e($customer['billing_country']); ?></span><br>
                        <span><?php echo e($customer['billing_phone']); ?></span><br>
                    </small>
                </div>
            </div>
            <div class="col-md-5">
                <h6><?php echo e(__('Ship to')); ?></h6>
                <div class="bill-to">
                    <small>
                        <span><?php echo e($customer['shipping_name']); ?></span><br>
                        <span><?php echo e($customer['shipping_address']); ?></span><br>
                        <span><?php echo e($customer['shipping_city'].' , '.$customer['shipping_state'].' ,'. $customer['shipping_zip']); ?></span><br>
                        <span><?php echo e($customer['shipping_country']); ?></span><br>
                        <span><?php echo e($customer['shipping_phone']); ?></span><br>
                    </small>
                </div>
            </div>
        <?php else: ?>
        <div class="col-md-10">
                <div class="mt-3"><h6><?php echo e($customer['name']); ?></h6><h6><?php echo e($customer['email']); ?></h6></div>
            <h6 class=""><?php echo e(__('Please Set Customer Shipping And bBilling  Details !')); ?>

                <?php if(module_is_active('Account')): ?>
                    <a href="<?php echo e(route('customer.index')); ?>"><?php echo e(__('Click Here')); ?></a>
                <?php endif; ?>
            </h6>
        </div>
        <?php endif; ?>

        <div class="col-md-2">
            <a href="#" id="remove" class="text-sm"><?php echo e(__(' Remove')); ?></a>
        </div>
    </div>
<?php else: ?>
<div class="row">
    <div class="col-md-5">
        <h6 class="mt-5"><?php echo e(__('Please Set Customer Details !')); ?>

            <div class="mt-3"><h6><?php echo e($customer['name']); ?></h6><h6><?php echo e($customer['email']); ?></h6></div>
            <?php if(module_is_active('Account')): ?>
                <a href="<?php echo e(route('customer.index')); ?>"><?php echo e(__('Click Here')); ?></a>
            <?php endif; ?>
        </h6>
    </div>
    <div class="col-md-2 mt-5">
        <a href="#" id="remove" class="text-sm"><?php echo e(__(' Remove')); ?></a>
    </div>
</div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\DSI_Laravel\resources\views/invoice/customer_detail.blade.php ENDPATH**/ ?>