<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Quote')); ?> <?php echo e('('. $quote->name .')'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
<a href="<?php echo e(route('quote.pdf',\Crypt::encrypt($quote->id))); ?>" target="_blank" class="btn btn-sm btn-primary btn-icon ">
    <span class="btn-inner--icon text-white"><i class="fa fa-print"></i></span>
    <span class="btn-inner--text text-white"><?php echo e(__('Print')); ?></span>
</a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <dl class="row">
                        <div class="col-12">
                            <div class="row align-items-center mb-2">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                </div>
                                <div class="col-sm-6 text-end">
                                    <h6 class="d-inline-block m-0 d-print-none"><?php echo e(__('Quote')); ?></h6>

                                    <?php if($quote->status == 0): ?>
                                        <span class="badge bg-primary p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\Quote::$status[$quote->status])); ?></span>
                                    <?php elseif($quote->status == 1): ?>
                                        <span class="badge bg-danger p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\Quote::$status[$quote->status])); ?></span>
                                    <?php elseif($quote->status == 2): ?>
                                        <span class="badge bg-warning p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\Quote::$status[$quote->status])); ?></span>
                                    <?php elseif($quote->status == 3): ?>
                                        <span class="badge bg-success p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\Quote::$status[$quote->status])); ?></span>
                                    <?php elseif($quote->status == 4): ?>
                                        <span class="badge bg-info p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\Quote::$status[$quote->status])); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-8">
                                    <h6 class="d-inline-block m-0 d-print-none"><?php echo e(__('Quote ID')); ?></h6>
                                    <span class="col-sm-8"><span class="text-sm"><?php echo e(Modules\Sales\Entities\Quote::quoteNumberFormat($quote->quote_id,$quote->created_by,$quote->workspace)); ?></span></span>
                                </div>

                                <div class="col-lg-6 text-end">
                                    <h6 class="d-inline-block m-0 d-print-none"><?php echo e(__('Assigned User :')); ?></h6>
                                    <span class="text-sm"><?php echo e(!empty($quote->assign_user)?$quote->assign_user->name:''); ?></span>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-lg-6 col-md-8">
                                    <h6 class="d-inline-block m-0 d-print-none"><?php echo e(__('Quote Date')); ?></h6>
                                    <span class="col-sm-8"><span class="text-sm"><?php echo e(company_date_formate($quote->date_quoted,$quote->created_by,$quote->workspace)); ?></span></span>
                                </div>
                                <div class="col-lg-6 text-end">
                                    <h6 class="d-inline-block m-0 d-print-none"><?php echo e(__('Created :')); ?></h6>
                                    <span class="text-sm"><?php echo e(company_date_formate($quote->created_at,$quote->created_by,$quote->workspace)); ?></span>
                                </div>
                            </div>
                            <?php if(!empty($customFields) && count($quote->customField)>0): ?>
                                <?php $__currentLoopData = $customFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col text-md-end">
                                        <small>
                                            <strong><?php echo e($field->name); ?> :</strong><br>
                                            <?php echo e(!empty($quote->customField[$field->id])?$quote->customField[$field->id]:'-'); ?>

                                            <br><br>
                                        </small>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <div class="row mb-3">
                                <div class="col-12 col-md-4">
                                    <h5><?php echo e(__('From')); ?></h5>
                                    <div class="row mt-4 align-items-center">
                                        <div class="col-sm-4 h6 text-m"><?php echo e(__('Company Address')); ?></div>
                                        <div class="col-sm-8 text-m"><?php echo e($company_setting['company_address']); ?></div>

                                        <div class="col-sm-4 h6 text-m"><?php echo e(__('Company City')); ?></div>
                                        <div class="col-sm-8 text-m"><?php echo e($company_setting['company_city']); ?></div>

                                        <div class="col-sm-4 h6 text-m"><?php echo e(__('Zip Code')); ?></div>
                                        <div class="col-sm-8 text-m"><?php echo e($company_setting['company_zipcode']); ?></div>

                                        <div class="col-sm-4 h6 text-m"><?php echo e(__('Company Country')); ?></div>
                                        <div class="col-sm-8 text-m"><?php echo e($company_setting['company_country']); ?></div>

                                        <div class="col-sm-4 h6 text-m"><?php echo e(__('Company Contact')); ?></div>
                                        <div class="col-sm-8 text-m"><?php echo e($company_setting['company_telephone']); ?></div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <h5><?php echo e(__('Billing Address')); ?></h5>
                                    <div class="row mt-4 align-items-center">
                                        <div class="col-sm-4 h6 text-m"><?php echo e(__('Billing Address')); ?></div>
                                        <div class="col-sm-8 text-m"><?php echo e($quote->billing_address); ?></div>

                                        <div class="col-sm-4 h6 text-m"><?php echo e(__('Billing City')); ?></div>
                                        <div class="col-sm-8 text-m"><?php echo e($quote->billing_city); ?></div>

                                        <div class="col-sm-4 h6 text-m"><?php echo e(__('Zip Code')); ?></div>
                                        <div class="col-sm-8 text-m"><?php echo e($quote->billing_postalcode); ?></div>

                                        <div class="col-sm-4 h6 text-m"><?php echo e(__('Billing Country')); ?></div>
                                        <div class="col-sm-8 text-m"><?php echo e($quote->billing_country); ?></div>

                                        <div class="col-sm-4 h6 text-m"><?php echo e(__('Billing Contact')); ?></div>
                                        <div class="col-sm-8 text-m"><?php echo e(!empty($quote->contacts->name)?$quote->contacts->name:'--'); ?></div>
                                    </div>
                                </div>
                                <?php if(company_setting('quote_shipping_display', $quote->created_by,$quote->workspace) == 'on'): ?>
                                <div class="col-12 col-md-4">
                                    <h5><?php echo e(__('Shipping Address')); ?></h5>
                                    <dl class="row mt-4 align-items-center">
                                        <div class="col-sm-4 h6 text-m"><?php echo e(__('Shipping Address')); ?></div>
                                        <div class="col-sm-8 text-m"><?php echo e($quote->shipping_address); ?></div>

                                        <div class="col-sm-4 h6 text-m"><?php echo e(__('Shipping City')); ?></div>
                                        <div class="col-sm-8 text-m"><?php echo e($quote->shipping_city); ?></div>

                                        <div class="col-sm-4 h6 text-m"><?php echo e(__('Zip Code')); ?></div>
                                        <div class="col-sm-8 text-m"><?php echo e($quote->shipping_postalcode); ?></div>

                                        <div class="col-sm-4 h6 text-m"><?php echo e(__('Shipping Country')); ?></div>
                                        <div class="col-sm-8 text-m"><?php echo e($quote->shipping_country); ?></div>

                                        <div class="col-sm-4 h6 text-m"><?php echo e(__('Shipping Contact')); ?></div>
                                        <div class="col-sm-8 text-m"><?php echo e(!empty($quote->contacts->name)?$quote->contacts->name:'--'); ?></div>
                                    </dl>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="px-2 py-2"><?php echo e(__('Item List')); ?></h5>
                                    <div class="table-responsive mt-2">
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th><?php echo e(__('Item')); ?></th>
                                                <th><?php echo e(__('Quantity')); ?></th>
                                                <th><?php echo e(__('Price')); ?></th>
                                                <th><?php echo e(__('Discount')); ?></th>
                                                <th><?php echo e(__('Tax')); ?></th>
                                                <th><?php echo e(__('Description')); ?></th>
                                                <th><?php echo e(__('Price')); ?></th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $totalQuantity=0;
                                                $totalRate=0;
                                                $totalAmount=0;
                                                $totalTaxPrice=0;
                                                $totalDiscount=0;
                                                $taxesData=[];
                                            ?>
                                            <?php $__currentLoopData = $quote->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quoteitem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $taxes=\Modules\Sales\Entities\SalesUtility::tax($quoteitem->tax);
                                                    $totalQuantity+=$quoteitem->quantity;
                                                    $totalRate+=$quoteitem->price;
                                                    $totalDiscount+=$quoteitem->discount;
                                                    if(!empty($taxes[0]))
                                                    {
                                                        foreach($taxes as $taxe)
                                                        {
                                                            $taxDataPrice=\Modules\Sales\Entities\SalesUtility::taxRate($taxe->rate,$quoteitem->price,$quoteitem->quantity,$quoteitem->discount);
                                                            if (array_key_exists($taxe->name,$taxesData))
                                                            {
                                                                $taxesData[$taxe->name] = $taxesData[$taxe->name]+$taxDataPrice;
                                                            }
                                                            else
                                                            {
                                                                $taxesData[$taxe->name] = $taxDataPrice;
                                                            }
                                                        }
                                                    }
                                                ?>
                                                <tr>
                                                    <td><?php echo e(!empty($quoteitem->items())?$quoteitem->items()->name:''); ?> </td>
                                                    <td><?php echo e($quoteitem->quantity); ?> </td>
                                                    <td><?php echo e(currency_format_with_sym($quoteitem->price,$quote->created_by,$quote->workspace)); ?> </td>
                                                    <td><?php echo e(currency_format_with_sym($quoteitem->discount,$quote->created_by,$quote->workspace)); ?> </td>
                                                    <td>
                                                        <div class="col">
                                                            <?php
                                                                $taxPrice = 0;
                                                            ?>
                                                            <?php if(module_is_active('ProductService')): ?>
                                                                <?php if(!empty($quoteitem->tax)): ?>
                                                                    <?php $__currentLoopData = $quoteitem->tax($quoteitem->tax); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php
                                                                            $taxPrice=\Modules\Sales\Entities\SalesUtility::taxRate($tax->rate,$quoteitem->price,$quoteitem->quantity,$quoteitem->discount);
                                                                            $totalTaxPrice+=$taxPrice;
                                                                        ?>
                                                                        <a href="#!" class="d-block text-sm text-muted"><?php echo e($tax->name .' ('.$tax->rate .'%)'); ?> &nbsp;&nbsp;<?php echo e(currency_format_with_sym($taxPrice,$quote->created_by,$quote->workspace)); ?></a>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php else: ?>
                                                                    <a href="#!" class="d-block text-sm text-muted"><?php echo e(__('No Tax')); ?></a>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                    <td style="white-space: break-spaces;"><?php echo e($quoteitem->description); ?> </td>
                                                    <td> <?php echo e(currency_format_with_sym(($quoteitem->price*$quoteitem->quantity)-$quoteitem->discount+$taxPrice,$quote->created_by,$quote->workspace)); ?></td>

                                                    <?php
                                                        $totalQuantity+=$quoteitem->quantity;
                                                        $totalRate+=$quoteitem->price;
                                                        $totalDiscount+=$quoteitem->discount;
                                                        $totalAmount+=($quoteitem->price*$quoteitem->quantity);
                                                    ?>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <tfoot>
                                            <tr>
                                                <td colspan="4">&nbsp;</td>
                                                <td></td>
                                                <td><strong><?php echo e(__('Sub Total')); ?></strong></td>
                                                <td class="text- subTotal"><?php echo e(currency_format_with_sym($quote->getSubTotal(),$quote->created_by,$quote->workspace)); ?></td>

                                            </tr>

                                            <tr>
                                                <td colspan="4">&nbsp;</td>
                                                <td></td>
                                                <td><strong><?php echo e(__('Discount')); ?></strong></td>
                                                <td class="text- subTotal"><?php echo e(currency_format_with_sym($quote->getTotalDiscount(),$quote->created_by,$quote->workspace)); ?></td>

                                            </tr>
                                            <?php if(!empty($taxesData)): ?>
                                                <?php $__currentLoopData = $taxesData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxName => $taxPrice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($taxName != 'No Tax'): ?>
                                                        <tr>
                                                            <td colspan="4"></td>
                                                            <td></td>
                                                            <td><b><?php echo e($taxName); ?></b></td>
                                                            <td><?php echo e(currency_format_with_sym($taxPrice,$quote->created_by,$quote->workspace)); ?></td>

                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                            <tr>
                                                <td colspan="4">&nbsp;</td>
                                                <td></td>
                                                <td><strong><?php echo e(__('Total')); ?></strong></td>
                                                <td class="text- subTotal"><?php echo e(currency_format_with_sym( $quote->thetotal(),$quote->created_by,$quote->workspace)); ?></td>
                                            </tr>
                                            </tfoot>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card my-5 bg-secondary">
                                        <div class="card-body">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-md-6 order-md-2 mb-4 mb-md-0">
                                                    <div class="d-flex align-items-center justify-content-md-end">
                                                        <span class="h6 text-muted d-inline-block mr-3 mb-0"><?php echo e(__('Total value')); ?>:</span>
                                                        <span class="h4 mb-0"><?php echo e(currency_format_with_sym($quote->thetotal(),$quote->created_by,$quote->workspace)); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 order-md-1">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('sales::layouts.invoicepayheader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DSI_Laravel\Modules/Sales\Resources/views/quote/quotepay.blade.php ENDPATH**/ ?>