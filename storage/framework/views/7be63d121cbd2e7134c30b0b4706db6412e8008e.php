
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Sales Order')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Sales Order')); ?> <?php echo e('('. $salesOrder->name .')'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Sales Order')); ?>,
    <?php echo e(__('Details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-action'); ?>
<div>
    <a href="<?php echo e(route('salesorder.pdf', \Crypt::encrypt($salesOrder->id))); ?>" target="_blank"
        class="btn btn-sm btn-primary btn-icon"  data-bs-toggle="tooltip" title="<?php echo e(__('Print')); ?>">
        <span class="btn-inner--icon text-white"><i class="ti ti-printer"></i></span>
    </a>
    <a href="#" class="btn btn-sm btn-warning btn-icon cp_link" data-link="<?php echo e(route('pay.salesorder',\Illuminate\Support\Facades\Crypt::encrypt($salesOrder->id))); ?>" data-bs-toggle="tooltip" data-title="<?php echo e(__('Click to copy SalesOrder link')); ?>"title="<?php echo e(__('copy link')); ?>"><span class="btn-inner--icon text-white"><i class="ti ti-file"></i></span></a>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesorder edit')): ?>
        <a href="<?php echo e(route('salesorder.edit',$salesOrder->id)); ?>" class="btn btn-sm btn-info btn-icon" data-bs-toggle="tooltip" data-title="<?php echo e(__('Sales order Edit')); ?>" title="<?php echo e(__('Edit')); ?>"><i class="ti ti-pencil"></i>
            </a>
    <?php endif; ?>
    <?php if(module_is_active('ProductService')): ?>
        <a href="#" data-size="md" data-url="<?php echo e(route('salesorder.salesorderitem',$salesOrder->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="<?php echo e(__('Create New SalesOrder')); ?>" title="<?php echo e(__('Create')); ?>" class="btn btn-sm btn-primary btn-icon">
            <i class="ti ti-plus"></i>
        </a>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-lg-10">
    <!-- [ Invoice ] start -->
        <div class="container">
            <div>
                <div class="card" id="printTable">
                    <div class="card-body">
                        <div class="row align-items-center mb-4">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <div class="col-lg-6 col-md-8">
                                <h6 class="d-inline-block m-0 d-print-none"><?php echo e(__('SalesOrder ID')); ?></h6>
                                <span class="col-sm-8"><span class="text-sm"><?php echo e(Modules\Sales\Entities\SalesOrder::salesorderNumberFormat($salesOrder->salesorder_id)); ?></span></span>
                            </div>
                            <div class="col-lg-6 col-md-8 mt-3">
                                <h6 class="d-inline-block m-0 d-print-none"><?php echo e(__('SalesOrder Date')); ?></h6>
                                <span class="col-sm-8"><span class="text-sm"><?php echo e(company_date_formate($salesOrder->created_at)); ?></span></span>
                            </div>
                            <h6 class="d-inline-block m-0 d-print-none mt-3"><?php echo e(__('SalesOrder ')); ?></h6>
                                <?php if($salesOrder->status == 0): ?>
                                    <span class="badge bg-primary p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\SalesOrder::$status[$salesOrder->status])); ?></span>
                                <?php elseif($salesOrder->status == 1): ?>
                                    <span class="badge bg-danger p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\SalesOrder::$status[$salesOrder->status])); ?></span>
                                <?php elseif($salesOrder->status == 2): ?>
                                    <span class="badge bg-warning p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\SalesOrder::$status[$salesOrder->status])); ?></span>
                                <?php elseif($salesOrder->status == 3): ?>
                                    <span class="badge bg-success p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\SalesOrder::$status[$salesOrder->status])); ?></span>
                                <?php elseif($salesOrder->status == 4): ?>
                                    <span class="badge bg-info p-2 px-3 rounded"><?php echo e(__(Modules\Sales\Entities\SalesOrder::$status[$salesOrder->status])); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-6 text-sm-end">

                                <div>
                                    <div class="float-end mt-3">
                                        <?php echo DNS2D::getBarcodeHTML(route('pay.salesorder',\Illuminate\Support\Facades\Crypt::encrypt($salesOrder->id)), "QRCODE",2,2); ?>

                                    </div>

                                </div>
                            </div>
                            <?php if(!empty($customFields) && count($salesOrder->customField)>0): ?>
                                <?php $__currentLoopData = $customFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col text-md-end">
                                        <small>
                                        <strong><?php echo e($field->name); ?> :</strong><br>
                                            <?php echo e(!empty($salesOrder->customField[$field->id])?$salesOrder->customField[$field->id]:'-'); ?>

                                            <br><br>
                                        </small>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 ">
                                <h5 class="px-2 py-2"><b><?php echo e(__('Item List')); ?></b></h5>
                                <div class="table-responsive mt-4">
                                    <table class="table invoice-detail-table">
                                        <thead>
                                            <tr class="thead-default">
                                                <th><?php echo e(__('Item')); ?></th>
                                                <th><?php echo e(__('Quantity')); ?></th>
                                                <th><?php echo e(__('Price')); ?></th>
                                                <th><?php echo e(__('Discount')); ?></th>
                                                <th><?php echo e(__('Tax')); ?></th>
                                                <th><?php echo e(__('Description')); ?></th>
                                                <th><?php echo e(__('Price')); ?></th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $totalQuantity=0;
                                            $totalRate=0;
                                            $totalAmount=0;
                                            $totalTaxPrice=0;
                                            $totalDiscount=0;
                                            $TaxPrice_array = [];
                                            $taxesData=[];
                                        ?>
                                        <?php $__currentLoopData = $salesOrder->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $salesOrderitem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $taxes=Modules\Sales\Entities\SalesUtility::tax($salesOrderitem->tax);
                                                $totalQuantity+=$salesOrderitem->quantity;
                                                $totalRate+=$salesOrderitem->price;
                                                $totalDiscount+=$salesOrderitem->discount;

                                                if(!empty($taxes[0]))
                                                {
                                                    foreach($taxes as $taxe)
                                                    {
                                                        $taxDataPrice=Modules\Sales\Entities\SalesUtility::taxRate($taxe->rate,$salesOrderitem->price,$salesOrderitem->quantity,$salesOrderitem->discount);
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
                                                <td><?php echo e((!empty($salesOrderitem->items())?$salesOrderitem->items()->name:'')); ?> </td>
                                                <td><?php echo e($salesOrderitem->quantity); ?> </td>
                                                <td><?php echo e(currency_format_with_sym($salesOrderitem->price)); ?> </td>
                                                <td><?php echo e(currency_format_with_sym($salesOrderitem->discount)); ?> </td>
                                                <td>
                                                    <div class="col">
                                                        <?php
                                                            $totalTaxPrice = 0;
                                                            $data = 0;
                                                            $taxPrice = 0;
                                                        ?>
                                                        <?php if(module_is_active('ProductService')): ?>
                                                        <?php if(!empty($salesOrderitem->tax)): ?>
                                                        <?php $totalTaxRate = 0;?>
                                                            <?php $__currentLoopData = $salesOrderitem->tax($salesOrderitem->tax); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php
                                                                    $taxPrice=Modules\Sales\Entities\SalesUtility::taxRate($tax->rate,$salesOrderitem->price,$salesOrderitem->quantity,$salesOrderitem->discount);
                                                                    $totalTaxPrice+=$taxPrice;
                                                                    $data+=$taxPrice;
                                                                ?>
                                                                <a href="#!" class="d-block text-sm text-muted"><?php echo e($tax->name .' ('.$tax->rate .'%)'); ?> &nbsp;&nbsp;<?php echo e(currency_format_with_sym($taxPrice)); ?></a>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php
                                                                array_push($TaxPrice_array,$data);
                                                            ?>
                                                        <?php else: ?>
                                                            <a href="#!" class="d-block text-sm text-muted"><?php echo e(__('No Tax')); ?></a>
                                                        <?php endif; ?>
                                                        <?php else: ?>
                                                            <a href=""></a>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td style="white-space: break-spaces;"><?php echo e(!empty($salesOrderitem->description)?$salesOrderitem->description:'--'); ?> </td>
                                                <?php
                                                    $tr_tex = (array_key_exists($key,$TaxPrice_array) == true) ? $TaxPrice_array[$key] : 0;
                                                ?>
                                                <td class="text-right"> <?php echo e(currency_format_with_sym(($salesOrderitem->price*$salesOrderitem->quantity)-$salesOrderitem->discount+$tr_tex)); ?></td>
                                                <td class="text-right">
                                                    <?php if(module_is_active('ProductService')): ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesorder edit')): ?>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="#" data-url="<?php echo e(route('salesorder.item.edit',$salesOrderitem->id)); ?>" data-ajax-popup="true" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-bs-toggle="tooltip"  data-title="<?php echo e(__('Edit Item')); ?>" data-original-title="<?php echo e(__('Edit')); ?>" title="<?php echo e(__('Edit Item')); ?>"><i class="ti ti-pencil"></i></a>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('salesorder delete')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['salesorder.items.delete', $salesOrderitem->id]]); ?>

                                                    <a href="#!" class="mx-3 btn btn-sm  align-items-center text-white show_confirm" data-bs-toggle="tooltip" title='Delete'>
                                                        <i class="ti ti-trash"></i>
                                                    </a>
                                                    <?php echo Form::close(); ?>

                                                </div>
                                                    <?php endif; ?>
                                                </td>
                                                <?php
                                                    $totalQuantity+=$salesOrderitem->quantity;
                                                    $totalRate+=$salesOrderitem->price;
                                                    $totalDiscount+=$salesOrderitem->discount;
                                                    $totalAmount+=($salesOrderitem->price*$salesOrderitem->quantity);
                                                ?>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-12">
                                <div class="invoice-total">
                                    <table class="table invoice-table ">
                                        <tbody>
                                            <tr>
                                                <th><?php echo e(('Sub Total')); ?> :</th>
                                                <td><?php echo e(currency_format_with_sym($salesOrder->getSubTotal())); ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo e(__('Discount')); ?> :</th>
                                                <td><?php echo e(currency_format_with_sym($salesOrder->getTotalDiscount())); ?></td>
                                            </tr>
                                            <?php if(!empty($taxesData)): ?>
                                                <?php $__currentLoopData = $taxesData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxName => $taxPrice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($taxName != 'No Tax'): ?>
                                                        <tr>
                                                            <th><?php echo e($taxName); ?> :</th>
                                                            <td><?php echo e(currency_format_with_sym($taxPrice)); ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                            <tr>
                                                <td>
                                                    <hr />
                                                    <h5 class="text-primary m-r-10"><?php echo e(__('Total')); ?> :</h5>
                                                </td>

                                                <td>
                                                    <hr />
                                                    <h5 class="text-primary subTotal"> <?php echo e(currency_format_with_sym($salesOrder->getTotal())); ?></h5>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <h5><?php echo e(__('From')); ?></h5>
                                <dl class="row mt-4 align-items-center">
                                    <dt class="col-sm-6"><span class="h6 text-sm mb-0"><?php echo e(__('Company Address')); ?></span></dt>
                                    <dd class="col-sm-6"><span class="text-sm"><?php echo e($company_setting['company_address']); ?></span></dd>

                                    <dt class="col-sm-6"><span class="h6 text-sm mb-0"><?php echo e(__('Company City')); ?></span></dt>
                                    <dd class="col-sm-6"><span class="text-sm"><?php echo e($company_setting['company_city']); ?></span></dd>

                                    <dt class="col-sm-6"><span class="h6 text-sm mb-0"><?php echo e(__('Zip Code')); ?></span></dt>
                                    <dd class="col-sm-6"><span class="text-sm"><?php echo e($company_setting['company_zipcode']); ?></span></dd>

                                    <dt class="col-sm-6"><span class="h6 text-sm mb-0"><?php echo e(__('Company Country')); ?></span></dt>
                                    <dd class="col-sm-6"><span class="text-sm"><?php echo e($company_setting['company_country']); ?></span></dd>
                                </dl>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5><?php echo e(__('Billing Address')); ?></h5>
                                <dl class="row mt-4 align-items-center">
                                    <dt class="col-sm-6"><span class="h6 text-sm mb-0"><?php echo e(__('Billing Address')); ?></span></dt>
                                    <dd class="col-sm-6"><span class="text-sm"><?php echo e($salesOrder->billing_address); ?></span></dd>

                                    <dt class="col-sm-6"><span class="h6 text-sm mb-0"><?php echo e(__('Billing City')); ?></span></dt>
                                    <dd class="col-sm-6"><span class="text-sm"><?php echo e($salesOrder->billing_city); ?></span></dd>

                                    <dt class="col-sm-6"><span class="h6 text-sm mb-0"><?php echo e(__('Zip Code')); ?></span></dt>
                                    <dd class="col-sm-6"><span class="text-sm"><?php echo e($salesOrder->billing_postalcode); ?></span></dd>

                                    <dt class="col-sm-6"><span class="h6 text-sm mb-0"><?php echo e(__('Billing Country')); ?></span></dt>
                                    <dd class="col-sm-6"><span class="text-sm"><?php echo e($salesOrder->billing_country); ?></span></dd>

                                    <dt class="col-sm-6"><span class="h6 text-sm mb-0"><?php echo e(__('Billing Contact')); ?></span></dt>
                                    <dd class="col-sm-6"><span class="text-sm"><?php echo e(!empty($salesOrder->contacts->name)?$salesOrder->contacts->name:'--'); ?></span></dd>
                                </dl>
                            </div>
                            <?php if(company_setting('salesorder_shipping_display') == 'on'): ?>
                                <div class="col-12 col-md-4">
                                    <h5><?php echo e(__('Shipping Address')); ?></h5>
                                    <dl class="row mt-4 align-items-center">
                                        <dt class="col-sm-6"><span class="h6 text-sm mb-0"><?php echo e(__('Shipping Address')); ?></span></dt>
                                        <dd class="col-sm-6"><span class="text-sm"><?php echo e($salesOrder->shipping_address); ?></span></dd>

                                        <dt class="col-sm-6"><span class="h6 text-sm mb-0"><?php echo e(__('Shipping City')); ?></span></dt>
                                        <dd class="col-sm-6"><span class="text-sm"><?php echo e($salesOrder->shipping_city); ?></span></dd>

                                        <dt class="col-sm-6"><span class="h6 text-sm mb-0"><?php echo e(__('Zip Code')); ?></span></dt>
                                        <dd class="col-sm-6"><span class="text-sm"><?php echo e($salesOrder->shipping_postalcode); ?></span></dd>

                                        <dt class="col-sm-6"><span class="h6 text-sm mb-0"><?php echo e(__('Shipping Country')); ?></span></dt>
                                        <dd class="col-sm-6"><span class="text-sm"><?php echo e($salesOrder->shipping_country); ?></span></dd>

                                        <dt class="col-sm-6"><span class="h6 text-sm mb-0"><?php echo e(__('Shipping Contact')); ?></span></dt>
                                        <dd class="col-sm-6"><span class="text-sm"><?php echo e(!empty($salesOrder->contacts->name)?$salesOrder->contacts->name:'--'); ?></span></dd>
                                    </dl>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="card">
            <div class="card-footer py-0">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0">
                        <div class="row align-items-center">
                            <dt class="col-sm-12"><span class="h6 text-sm mb-0"><?php echo e(__('Assigned User')); ?></span></dt>
                            <dd class="col-sm-12"><span class="text-sm"><?php echo e(!empty($salesOrder->assign_user)?$salesOrder->assign_user->name:''); ?></span></dd>

                            <dt class="col-sm-12"><span class="h6 text-sm mb-0"><?php echo e(__('Created')); ?></span></dt>
                            <dd class="col-sm-12"><span class="text-sm"><?php echo e(company_date_formate($salesOrder->created_at)); ?></span></dd>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- [ Invoice ] end -->
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
    $(document).on('change', 'select[name=item]', function () {
        var item_id = $(this).val();
        $.ajax({
            url: '<?php echo e(route('quote.items')); ?>',
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': jQuery('#token').val()
            },
            data: {
                'item_id': item_id,
            },
            cache: false,
            success: function (data) {
                var invoiceItems = JSON.parse(data);
                $('.taxId').val('');
                $('.tax').html('');

                $('.price').val(invoiceItems.sale_price);
                $('.quantity').val(1);
                $('.discount').val(0);
                var taxes = '';
                var tax = [];

                for (var i = 0; i < invoiceItems.taxes.length; i++) {
                    taxes += '<span class="badge bg-primary p-2 rounded">' + invoiceItems.taxes[i].name + ' ' + '(' + invoiceItems.taxes[i].rate + '%)' + '</span>';
                }
                $('.taxId').val(invoiceItems.tax_id);
                $('.tax').html(taxes);
            }
        });
    });
     $('.cp_link').on('click', function () {
         var value = $(this).attr('data-link');
         var $temp = $("<input>");
         $("body").append($temp);
         $temp.val(value).select();
         document.execCommand("copy");
         $temp.remove();
         toastrs('success', '<?php echo e(__('Link Copy on Clipboard')); ?>', 'success')
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\dsi_crm\Modules/Sales\Resources/views/salesorder/view.blade.php ENDPATH**/ ?>