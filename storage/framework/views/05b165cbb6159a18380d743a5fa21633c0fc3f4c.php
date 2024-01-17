<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Quote')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Sales Quote')); ?> <?php echo e('('. $salesquote->name .')'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Sales Quote')); ?>,
    <?php echo e(__('show')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-action'); ?>
    <div>
        <?php if(\Auth::user()->type!="client"): ?>
            <a data-url="<?php echo e(route('salesquote.setting')); ?>" data-size="lg" data-ajax-popup="true"
               data-bs-toggle="tooltip" data-title="<?php echo e(__('Manage Salesquote Setting')); ?>" title="<?php echo e(__('Manage Salesquote Setting')); ?>"
               class="btn btn-sm btn-primary btn-icon">
                <i class="ti ti-settings"></i>
            </a>
        <?php endif; ?>
            <a href="<?php echo e(route('salesquote.pdf',['id'=> \Crypt::encrypt($salesquote->id),'type'=>'pdf'])); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" target="_blank" data-title="<?php echo e(__('PDF')); ?>" title="<?php echo e(__('PDF')); ?>" id="download-buttons">
                <i class="ti ti-download"></i>
            </a>
            <a href="<?php echo e(route('salesquote.pdf',['id'=> \Crypt::encrypt($salesquote->id),'type'=>'print'])); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-title="<?php echo e(__('Print')); ?>" title="<?php echo e(__('Print')); ?>" id="download-buttons">
                <i class="ti ti-printer"></i>
            </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="invoice">
                    <div class="invoice-print">
                        <div class="row invoice-title mt-2">
                            <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12">
                                <h2><?php echo e(__('Sales Quote')); ?></h2>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12 text-end">
                                <h3 class="invoice-number">
                                    <?php echo e(Modules\Sales\Entities\SalesQuote::quoteNumberFormat($salesquote->quote_id)); ?></h3>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col text-end">
                                <div class="d-flex align-items-center justify-content-end">
                                    <div class="me-4">
                                        <small>
                                            <strong><?php echo e(__('Issue Date')); ?> :</strong><br>
                                            <?php echo e(company_date_formate($salesquote->issue_date)); ?><br><br>
                                        </small>
                                    </div>
                                </div>
                                <?php if(date('Y-m-d') > $salesquote->quote_validity): ?>
                                    <span class="badge fix_badges bg-danger p-2 px-3 rounded">Expired</span>
                                <?php else: ?>
                                    <span class="badge fix_badges bg-primary p-2 px-3 rounded">Active</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <?php if(!empty($customer->billing_name) && !empty($customer->billing_address) && !empty($customer->billing_zip)): ?>
                                <div class="col">
                                    <small class="font-style">
                                        <strong><?php echo e(__('Billed To')); ?> :</strong><br>
                                        <?php echo e(!empty($customer->billing_name) ? $customer->billing_name : ''); ?><br>
                                        <?php echo e(!empty($customer->billing_address) ? $customer->billing_address : ''); ?><br>
                                        <?php echo e(!empty($customer->billing_city) ? $customer->billing_city . ' ,' : ''); ?>

                                        <?php echo e(!empty($customer->billing_state) ? $customer->billing_state . ' ,' : ''); ?>

                                        <?php echo e(!empty($customer->billing_zip) ? $customer->billing_zip : ''); ?><br>
                                        <?php echo e(!empty($customer->billing_country) ? $customer->billing_country : ''); ?><br>
                                        <?php echo e(!empty($customer->billing_phone) ? $customer->billing_phone : ''); ?><br>
                                        <strong><?php echo e(__('Tax Number ')); ?> :
                                        </strong><?php echo e(!empty($customer->tax_number) ? $customer->tax_number : ''); ?>


                                    </small>
                                </div>
                            <?php endif; ?>
                            <?php if(company_setting('invoice_shipping_display') == 'on'): ?>
                                <?php if(!empty($customer->shipping_name) && !empty($customer->shipping_address) && !empty($customer->shipping_zip)): ?>
                                    <div class="col ">
                                        <small>
                                            <strong><?php echo e(__('Shipped To')); ?> :</strong><br>
                                            <?php echo e(!empty($customer->shipping_name) ? $customer->shipping_name : ''); ?><br>
                                            <?php echo e(!empty($customer->shipping_address) ? $customer->shipping_address : ''); ?><br>
                                            <?php echo e(!empty($customer->shipping_city) ? $customer->shipping_city . ' ,' : ''); ?>

                                            <?php echo e(!empty($customer->shipping_state) ? $customer->shipping_state . ' ,' : ''); ?>

                                            <?php echo e(!empty($customer->shipping_zip) ? $customer->shipping_zip : ''); ?><br>
                                            <?php echo e(!empty($customer->shipping_country) ? $customer->shipping_country : ''); ?><br>
                                            <?php echo e(!empty($customer->shipping_phone) ? $customer->shipping_phone : ''); ?><br>
                                            <strong><?php echo e(__('Tax Number ')); ?> :
                                            </strong><?php echo e(!empty($customer->tax_number) ? $customer->tax_number : ''); ?>

                                        </small>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="font-weight-bold"><?php echo e(__('Item Summary')); ?></div>
                                <small><?php echo e(__('All items here cannot be deleted.')); ?></small>
                                <div class="table-responsive mt-2">
                                    <table class="table mb-0 table-striped">
                                        <tr>
                                            <th data-width="40" class="text-dark">#</th>
                                            <th class="text-dark"><?php echo e(__('Profit')); ?></th>
                                            <th class="text-dark"><?php echo e(__('Markup')); ?></th>
                                            <th class="text-dark"><?php echo e(__('Cost')); ?></th>
                                            <th class="text-dark"><?php echo e(__('Supplier Name')); ?></th>
                                            <th class="text-dark"><?php echo e(__('Supplier Part Number')); ?></th>
                                            <th class="text-dark"><?php echo e(__('Manufacturer Name')); ?></th>
                                            <th class="text-dark"><?php echo e(__('Manufacturer Part Number')); ?></th>
                                            <th class="text-dark"><?php echo e(__('Description')); ?></th>
                                            <th class="text-dark"><?php echo e(__('Quantity')); ?></th>
                                            <th class="text-right text-dark" width="12%"><?php echo e(__('Price')); ?>

                                            </th>
                                            <th><?php echo e(__('Extended')); ?></th>
                                            <th><?php echo e(__('Tax')); ?></th>
                                            
                                        </tr>
                                        <?php
                                            $totalQuantity = 0;
                                            $totalRate = 0;
                                            $totalTaxPrice = 0;
                                            $totalDiscount = 0;
                                            $taxesData = [];
                                            $TaxPrice_array = [];
                                        ?>
                                        <?php $__currentLoopData = $salesquoteitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $iteam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(!empty($iteam->tax)): ?>
                                                <?php
                                                    $taxes = \App\Models\Invoice::tax($iteam->tax);
                                                    $totalQuantity += $iteam->quantity;
                                                    $totalRate += $iteam->price;
                                                    $totalDiscount += $iteam->discount;
                                                    foreach ($taxes as $taxe) {
                                                        $taxDataPrice = \App\Models\Invoice::taxRate($taxe->rate, $iteam->price, $iteam->quantity, $iteam->discount);
                                                        if (array_key_exists($taxe->name, $taxesData)) {
                                                            $taxesData[$taxe->name] = $taxesData[$taxe->name] + $taxDataPrice;
                                                        } else {
                                                            $taxesData[$taxe->name] = $taxDataPrice;
                                                        }
                                                    }
                                                ?>
                                            <?php endif; ?> 
                                            <?php if($iteam->type=="substart"): ?>
                                                <tr>
                                                    <td>
                                                        <?php echo e($key + 1); ?>

                                                    </td>
                                                    <td><?php echo e($iteam->profit); ?></td>
                                                    <td><?php echo e($iteam->markup); ?></td>
                                                    <td><?php echo e($iteam->purchase_price); ?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>"SubStart"</td>
                                                    <td><?php echo e($iteam->subtotal_description); ?></td>
                                                    <td><?php echo e($iteam->subtotal_quantity); ?></td>
                                                    <td><?php echo e($iteam->price); ?></td>
                                                    <td><?php echo e($iteam->extended); ?></td>
                                                    <td>
                                                        <?php if(!empty($iteam->tax)): ?>
                                                            <table>
                                                                <?php
                                                                    $totalTaxRate = 0;
                                                                    $data = 0;
                                                                ?>
                                                                <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php
                                                                        $taxPrice = \App\Models\Invoice::taxRate($tax->rate, $iteam->price, $iteam->quantity, $iteam->discount);
                                                                        $totalTaxPrice += $taxPrice;
                                                                        $data += $taxPrice;
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo e($tax->name . ' (' . $tax->rate . '%)'); ?></td>
                                                                        <td><?php echo e(currency_format_with_sym($taxPrice)); ?></td>
                                                                    </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php
                                                                    array_push($TaxPrice_array, $data);
                                                                ?>
                                                            </table>
                                                        <?php else: ?>
                                                            -
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php elseif($iteam->type=="subitem"): ?>
                                                <?php
                                                    $productservice=\Modules\ProductService\Entities\ProductService::where('id',$iteam->item)->first();
                                                ?>
                                                <tr>
                                                    <td><?php echo e($key + 1); ?></td>
                                                    <td><?php echo e($iteam->profit); ?></td>
                                                    <td><?php echo e($iteam->markup); ?></td>
                                                    <td><?php echo e($iteam->purchase_price); ?></td>
                                                    <td><?php echo e(isset($productservice->supplier_name)?$productservice->supplier_name:""); ?></td>
                                                    <td><?php echo e(isset($productservice->supplier_part_number)?$productservice->supplier_part_number:""); ?></td>
                                                    <td><?php echo e(isset($productservice->manufacturer_name)?$productservice->manufacturer_name:""); ?></td>
                                                    <td><?php echo e(isset($productservice->manufacturer_part_number)?$productservice->manufacturer_part_number:""); ?></td>
                                                    <td><?php echo e($productservice->name); ?></td>
                                                    <td><?php echo e($iteam->quantity); ?></td>
                                                    <td><?php echo e($iteam->price); ?></td>
                                                    <td><?php echo e($iteam->extended); ?></td>
                                                    <td>
                                                        <?php if(!empty($iteam->tax)): ?>
                                                            <table>
                                                                <?php
                                                                    $totalTaxRate = 0;
                                                                    $data = 0;
                                                                ?>
                                                                <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php
                                                                        $taxPrice = \App\Models\Invoice::taxRate($tax->rate, $iteam->price, $iteam->quantity, $iteam->discount);
                                                                        $totalTaxPrice += $taxPrice;
                                                                        $data += $taxPrice;
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo e($tax->name . ' (' . $tax->rate . '%)'); ?></td>
                                                                        <td><?php echo e(currency_format_with_sym($taxPrice)); ?></td>
                                                                    </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php
                                                                    array_push($TaxPrice_array, $data);
                                                                ?>
                                                            </table>
                                                        <?php else: ?>
                                                            -
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php elseif($iteam->type=="subcustomitem"): ?>
                                                <tr>
                                                    <td><?php echo e($key + 1); ?></td>
                                                    <td><?php echo e($iteam->profit); ?></td>
                                                    <td><?php echo e($iteam->markup); ?></td>
                                                    <td><?php echo e($iteam->purchase_price); ?></td>
                                                    <td><?php echo e(isset($iteam->supplier_name)?$iteam->supplier_name:""); ?></td>
                                                    <td><?php echo e(isset($iteam->supplier_part_number)?$iteam->supplier_part_number:""); ?></td>
                                                    <td><?php echo e(isset($iteam->manufacturer_name)?$iteam->manufacturer_name:""); ?></td>
                                                    <td><?php echo e(isset($iteam->manufacturer_part_number)?$iteam->manufacturer_part_number:""); ?></td>
                                                    <td><?php echo e($iteam->item); ?></td>
                                                    <td><?php echo e($iteam->quantity); ?></td>
                                                    <td><?php echo e($iteam->price); ?></td>
                                                    <td><?php echo e($iteam->extended); ?></td>
                                                    <td>
                                                        <?php if(!empty($iteam->tax)): ?>
                                                            <table>
                                                                <?php
                                                                    $totalTaxRate = 0;
                                                                    $data = 0;
                                                                ?>
                                                                <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php
                                                                        $taxPrice = \App\Models\Invoice::taxRate($tax->rate, $iteam->price, $iteam->quantity, $iteam->discount);
                                                                        $totalTaxPrice += $taxPrice;
                                                                        $data += $taxPrice;
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo e($tax->name . ' (' . $tax->rate . '%)'); ?></td>
                                                                        <td><?php echo e(currency_format_with_sym($taxPrice)); ?></td>
                                                                    </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php
                                                                    array_push($TaxPrice_array, $data);
                                                                ?>
                                                            </table>
                                                        <?php else: ?>
                                                            -
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php elseif($iteam->type=="subcomment"): ?>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><?php echo e($iteam->sample_comment); ?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            <?php elseif($iteam->type=="subblank"): ?>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            <?php elseif($iteam->type=="substop"): ?>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>"SubStop"</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                        <tfoot>
                                        <?php
                                            $colspan = 10;
                                        ?>
                                        <tr>
                                            <td colspan="<?php echo e($colspan); ?>"></td>
                                            <td class="text-right"><b><?php echo e(__('Total Cost')); ?></b></td>
                                            <td class="text-right">
                                            <td class="text-right">
                                                <?php echo e(currency_format_with_sym($salesquote->totalcost())); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="11"></td>
                                            <td class="text-right"><b><?php echo e(__('Product')); ?></b></td>
                                            <td class="text-right">
                                                <?php echo e(currency_format_with_sym($salesquote->totalcost()- (!empty( $salesquote->shipping_cost() ) ? $salesquote->shipping_cost():0) -  (!empty( $salesquote->labor_cost() ) ? $salesquote->labor_cost():0))); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="11"></td>
                                            <td class="text-right"><b><?php echo e(__('Shipping')); ?></b></td>
                                            <td class="text-right">
                                                <?php echo e(currency_format_with_sym($salesquote->shipping_cost())); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="11"></td>
                                            <td class="text-right"><b><?php echo e(__('Labor')); ?></b></td>
                                            <td class="text-right">
                                                <?php echo e(currency_format_with_sym($salesquote->labor_cost())); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="<?php echo e($colspan); ?>"></td>
                                            <td class="text-right"><b><?php echo e(__('Total Profit')); ?></b></td>
                                            <td class="text-right">
                                                <?php echo e(currency_format_with_sym($salesquote->totalProfit())); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="<?php echo e($colspan); ?>"></td>
                                            <td class="text-right"><b><?php echo e(__('GP')); ?></b></td>
                                            <td class="text-right">
                                                <?php echo e(currency_format_with_sym($salesquote->totalgp())); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="<?php echo e($colspan); ?>"></td>
                                            <td class="text-right"><b><?php echo e(__('Sub Total')); ?></b></td>
                                            <td class="text-right">
                                                <?php echo e(currency_format_with_sym($salesquote->totalextend())); ?></td>
                                        </tr>
                                        <?php if(!empty($taxesData)): ?>
                                            <?php $__currentLoopData = $taxesData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxName => $taxPrice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td colspan="<?php echo e($colspan); ?>"></td>
                                                    <td class="text-right"><b><?php echo e($taxName); ?></b></td>
                                                    <td class="text-right"><?php echo e(currency_format_with_sym($taxPrice)); ?>

                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <tr>
                                            <td colspan="<?php echo e($colspan); ?>"></td>
                                            <td class="text-right"><b><?php echo e(__('Total Amount')); ?></b></td>
                                            <?php if(!empty($taxesData)): ?>
                                                <td class="text-right">
                                                    <?php echo e(currency_format_with_sym($salesquote->totalextend() + $taxPrice)); ?></td>
                                            <?php else: ?>
                                                <td class="text-right">
                                                    <?php echo e(currency_format_with_sym($salesquote->totalextend())); ?></td>
                                            <?php endif; ?>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DSI_Laravel\Modules/Sales\Resources/views/salesquote/show.blade.php ENDPATH**/ ?>