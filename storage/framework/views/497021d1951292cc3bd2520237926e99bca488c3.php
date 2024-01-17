<!DOCTYPE html>
<html lang="en" dir="<?php echo e($settings['site_rtl'] == 'on'?'rtl':''); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(Modules\Sales\Entities\SalesQuote::quoteNumberFormat($salesquotes->quote_id,$salesquotes->created_by,$salesquotes->workspace)); ?> | <?php echo e(!empty(company_setting('title_text',$salesquotes->created_by,$salesquotes->workspace)) ? company_setting('title_text',$salesquotes->created_by,$salesquotes->workspace) : (!empty(admin_setting('title_text')) ? admin_setting('title_text') :'WorkDo')); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <style type="text/css">
        html[dir="rtl"]  {
            letter-spacing: 0.1px;
        }
        :root {
            --theme-color: <?php echo e($color); ?>;
            --white: #ffffff;
            --black: #000000;
        }
        body {
            font-family: 'Lato', sans-serif;
        }

        p,
        li,
        ul,
        ol {
            margin: 0;
            padding: 0;
            list-style: none;
            line-height: 1.5;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table tr th {
            padding: 0.75rem;
            text-align: left;
        }

        table tr td {
            padding: 0.50rem;
            text-align: left;
        }

        table th small {
            display: block;
            font-size: 12px;
        }

        .invoice-preview-main {
            max-width: 700px;
            width: 100%;
            margin: 0 auto;
            background: #ffff;
            box-shadow: 0 0 10px #ddd;
        }

        .invoice-logo {
            max-width: 200px;
            width: 100%;
        }

        .invoice-header table td {
            padding: 15px 30px;
        }

        .text-right {
            text-align: right;
        }

        .no-space tr td {
            padding: 0;
            white-space: nowrap;
        }

        .vertical-align-top td {
            vertical-align: top;
        }

        .view-qrcode {
            max-width: 139px;
            height: 139px;
            width: 100%;
            margin-left: auto;
            margin-top: 15px;
            background: var(--white);
            padding: 13px;
            border-radius: 10px;
        }

        .view-qrcode img{
            width: 100%;
            height: 100%;
        }

        .invoice-body {
            padding: 30px 15px 0;
        }

        table.add-border tr {
            border-top: 1px solid var(--theme-color);
        }

        tfoot tr:first-of-type {
            border-bottom: 1px solid var(--theme-color);
        }

        .total-table tr:first-of-type td {
            padding-top: 0;
        }

        .total-table tr:first-of-type {
            border-top: 0;
        }

        .sub-total {
            padding-right: 0;
            padding-left: 0;
        }

        .border-0 {
            border: none !important;
        }

        .invoice-summary td,
        .invoice-summary th {
            font-size: 12px;
            font-weight: 600;
        }

        .total-table td:last-of-type {
            width: 146px;
        }

        .invoice-footer {
            padding: 15px 20px;
        }

        .itm-description td {
            padding-top: 0;
        }
        html[dir="rtl"] table tr td,
        html[dir="rtl"] table tr th{
            text-align: right;
        }
        html[dir="rtl"]  .text-right{
            text-align: left;
        }
        html[dir="rtl"] .view-qrcode{
            margin-left: 0;
            margin-right: auto;
        }
        p:not(:last-of-type){
            margin-bottom: 15px;
        }
        .invoice-summary p{
            margin-bottom: 0;
        }
    </style>
</head>

<body>
<div class="invoice-preview-main" id="boxes">
    <div class="invoice-header" style="background-color: var(--theme-color); color: <?php echo e($font_color); ?>;">
        <table>
            <tbody>
            <tr>
                <td>
                    <img class="invoice-logo" src="<?php echo e($img); ?>" alt="">
                </td>
                <td class="text-right">
                    <h3 style="text-transform: uppercase; font-size: 40px; font-weight: bold; "><?php echo e(__('Quote')); ?></h3>
                </td>
            </tr>
            </tbody>
        </table>
        <table class="vertical-align-top">
            <tbody>
            <tr>
                <td>
                    <p>
                        <?php if(!empty($settings['company_name'])): ?><?php echo e($settings['company_name']); ?><?php endif; ?><br>
                        <?php if(!empty($settings['company_email'])): ?><?php echo e($settings['company_email']); ?><?php endif; ?><br>
                        <?php if(!empty($settings['company_telephone'])): ?><?php echo e($settings['company_telephone']); ?><?php endif; ?><br>
                        <?php if(!empty($settings['company_address'])): ?><?php echo e($settings['company_address']); ?><?php endif; ?>
                        <?php if(!empty($settings['company_city'])): ?> <br> <?php echo e($settings['company_city']); ?>, <?php endif; ?>
                        <?php if(!empty($settings['company_state'])): ?><?php echo e($settings['company_state']); ?><?php endif; ?><br>
                        <?php if(!empty($settings['company_country'])): ?> <?php echo e($settings['company_country']); ?><?php endif; ?>
                        <?php if(!empty($settings['company_zipcode'])): ?> - <?php echo e($settings['company_zipcode']); ?><?php endif; ?><br>
                        <?php if(!empty($settings['registration_number'])): ?><?php echo e(__('Registration Number')); ?> : <?php echo e($settings['registration_number']); ?> <?php endif; ?><br>
                        <?php if(!empty($settings['tax_type']) && !empty($settings['vat_number'])): ?><?php echo e($settings['tax_type'].' '. __('Number')); ?> : <?php echo e($settings['vat_number']); ?> <br><?php endif; ?>
                    </p>
                </td>
                <td style="width: 60%;">
                    <table class="no-space">
                        <tbody>
                        <tr>
                            <td><?php echo e(__('Number: ')); ?></td>
                            <td class="text-right"><?php echo e(Modules\Sales\Entities\SalesQuote::quoteNumberFormat($salesquotes->quote_id,$salesquotes->created_by,$salesquotes->workspace)); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo e(__('Issue Date:')); ?></td>
                            <td class="text-right"><?php echo e($salesquotes->issue_date,$salesquotes->created_by,$salesquotes->workspace); ?></td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="invoice-body">
        <table>
            <tbody>
            <tr>
                <td>
                    <strong style="margin-bottom: 10px; display:block;"><?php echo e(__('Bill To')); ?>:</strong>
                    <p>
                        <?php echo e(!empty($customer->name)?$customer->name:''); ?><br>
                        <?php echo e(!empty($customer->email)?$customer->email:''); ?><br>
                        <?php echo e(!empty($customer->mobile)?$customer->mobile:''); ?><br>
                        <?php echo e(!empty($customer->bill_address)?$customer->bill_address:''); ?><br>
                        <?php echo e(!empty($customer->bill_city)?$customer->bill_city:'' . ', '); ?> <?php echo e(!empty($customer->bill_state)?$customer->bill_state:''); ?>,<?php echo e(!empty($customer->bill_country)?$customer->bill_country:''); ?><br>
                        <?php echo e(!empty($customer->bill_zip)?$customer->bill_zip:''); ?>

                    </p>
                </td>

                    <td class="text-right">
                        <strong style="margin-bottom: 10px; display:block;"><?php echo e(__('Ship To')); ?>:</strong>
                        <p>
                            <?php echo e(!empty($customer->name)?$customer->name:''); ?><br>
                            <?php echo e(!empty($customer->email)?$customer->email:''); ?><br>
                            <?php echo e(!empty($customer->mobile)?$customer->mobile:''); ?><br>
                            <?php echo e(!empty($customer->address)?$customer->address:''); ?><br>
                            <?php echo e(!empty($customer->city)?$customer->city:'' . ', '); ?>,<?php echo e(!empty($customer->state)?$customer->state:''); ?>,<?php echo e(!empty($customer->country)?$customer->country:''); ?><br>
                            <?php echo e(!empty($customer->zip)?$customer->zip:''); ?>

                        </p>
                    </td>

            </tr>
            </tbody>
        </table>
        <table class="add-border invoice-summary" style="margin-top: 30px;align-items: center;">
            <thead style="background-color: var(--theme-color);color: black;">
                <tr>
                    <th><?php echo e(__('Profit')); ?></th>
                    <th><?php echo e(__('Markup')); ?></th>
                    <th><?php echo e(__('Cost')); ?></th>
                    <th><?php echo e(__('Supplier')); ?></th>
                    <?php if(\Auth::user()->type!="client" || $setting['supplier_part_number']=="on"): ?>
                        <th><?php echo e(__('Supplier #')); ?></th>
                    <?php endif; ?>
                    <th><?php echo e(__('MFG')); ?></th>
                    <?php if(\Auth::user()->type!="client" || $setting['manufacturer_part_number']=="on"): ?>
                        <th><?php echo e(__('MFG#')); ?></th>
                    <?php endif; ?>
                    <th><?php echo e(__('Description')); ?></th>
                    <th><?php echo e(__('QTY')); ?></th>
                    <th><?php echo e(__('Price')); ?></th>
                    <th><?php echo e(__('Extended')); ?></th>

                </tr>
            </thead>
            <tbody>

            <?php if(isset($salesquotes->itemData) && count($salesquotes->itemData) > 0): ?>
                <?php $__currentLoopData = $salesquotes->itemData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($item->type=="substart"): ?>
                        <tr>
                            <td><?php echo e($item->profit); ?></td>
                            <td><?php echo e($item->markup); ?></td>
                            <td><?php echo e($item->purchase_price); ?></td>
                            <td></td>
                            <?php if(\Auth::user()->type!="client" || $setting['supplier_part_number']=="on"): ?>
                                <td></td>
                            <?php endif; ?>
                            <td></td>
                            <?php if(\Auth::user()->type!="client" || $setting['manufacturer_part_number']=="on"): ?>
                                <td><?php echo e($item->supplier_name); ?></td>
                            <?php endif; ?>
                            <td><?php echo e($item->subtotal_description); ?></td>
                            <td><?php echo e($item->subtotal_quantity); ?></td>
                            <td><?php echo e($item->price); ?></td>
                            <td><?php echo e($item->extended); ?></td>

                        </tr>
                    <?php elseif($item->type=="subitem"): ?>
                        <?php if(\Auth::user()->type!="client" || $setting['text_within_groups']=="on"): ?>
                            <tr>
                                <td><?php echo e($item->profit); ?></td>
                                <td><?php echo e($item->markup); ?></td>
                                <td><?php echo e($item->purchase_price); ?></td>
                                <td><?php echo e($item->supplier_name); ?></td>
                                <?php if(\Auth::user()->type!="client" || $setting['supplier_part_number']=="on"): ?>
                                    <td><?php echo e($item->supplier_part_number); ?></td>
                                <?php endif; ?>
                                <td><?php echo e($item->manufacturer_name); ?></td>
                                <?php if(\Auth::user()->type!="client" || $setting['manufacturer_part_number']=="on"): ?>
                                    <td><?php echo e($item->manufacturer_part_number); ?></td>
                                <?php endif; ?>
                                <td><?php echo e($item->item); ?></td>
                                <td><?php echo e($item->quantity); ?></td>
                                <?php if(\Auth::user()->type!="client" || $setting['subtotal']=="on"): ?>
                                    <td><?php echo e($item->price); ?></td>
                                    <td><?php echo e($item->extended); ?></td>
                                <?php endif; ?>
                            </tr>
                        <?php endif; ?>
                    <?php elseif($item->type=="subcustomitem"): ?>

                        <?php if(\Auth::user()->type!="client" || $setting['text_within_groups']=="on"): ?>
                            <tr>
                                <td><?php echo e($item->profit); ?></td>
                                <td><?php echo e($item->markup); ?></td>
                                <td><?php echo e($item->purchase_price); ?></td>
                                <td><?php echo e($item->supplier_name); ?></td>
                                <?php if(\Auth::user()->type!="client" || $setting['supplier_part_number']=="on"): ?>
                                    <td><?php echo e($item->supplier_part_number); ?></td>
                                <?php endif; ?>
                                <td><?php echo e($item->manufacturer_name); ?></td>
                                <?php if(\Auth::user()->type!="client" || $setting['manufacturer_part_number']=="on"): ?>
                                    <td><?php echo e($item->manufacturer_part_number); ?></td>
                                <?php endif; ?>
                                <td><?php echo e($item->item); ?></td>
                                <td><?php echo e($item->quantity); ?></td>
                                <?php if(\Auth::user()->type!="client" || $setting['subtotal']=="on"): ?>
                                    <td><?php echo e($item->price); ?></td>
                                    <td><?php echo e($item->extended); ?></td>
                                <?php endif; ?>
                            </tr>
                        <?php endif; ?>

                    <?php elseif($item->type=="subcomment"): ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php if(\Auth::user()->type!="client" || $setting['supplier_part_number']=="on"): ?>
                                <td></td>
                            <?php endif; ?>
                            <td></td>
                            <?php if(\Auth::user()->type!="client" || $setting['manufacturer_part_number']=="on"): ?>
                                <td></td>
                            <?php endif; ?>
                            <td><?php echo e($item->sample_comment); ?></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                    <?php elseif($item->type=="subblank"): ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php if(\Auth::user()->type!="client" || $setting['supplier_part_number']=="on"): ?>
                                <td></td>
                            <?php endif; ?>
                            <td></td>

                            <?php if(\Auth::user()->type!="client" || $setting['manufacturer_part_number']=="on"): ?>
                                <td></td>
                            <?php endif; ?>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                    <?php elseif($item->type=="substop"): ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php if(\Auth::user()->type!="client" || $setting['supplier_part_number']=="on"): ?>
                                <td></td>
                            <?php endif; ?>
                            <td></td>
                            <?php if(\Auth::user()->type!="client" || $setting['manufacturer_part_number']=="on"): ?>
                                <td>"SubStop"</td>
                            <?php endif; ?>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>
                        <p>-</p>
                        <p>-</p>
                    </td>
                    <td>-</td>
                    <td>-</td>
                <tr class="border-0 itm-description ">
                    <td colspan="6">-</td>
                </tr>
                </tr>
            <?php endif; ?>
            </tbody>
            <tfoot>








            <tr>
                <?php
                    $colspan=9;
                    if(\Auth::user()->type=="client" && $setting['manufacturer_part_number']=="on")
                    {
                        $colspan=$colspan-1;
                    }
                    if(\Auth::user()->type=="client" && $setting['supplier_part_number']=="on")
                    {
                        $colspan=$colspan-1;
                    }
                ?>
                <?php if(\Auth::user()->type!="client" || $setting['grand_total']=="on"): ?>
                    <td colspan="<?php echo e($colspan); ?>"></td>
                    <td colspan="2" class="sub-total">
                        <table class="total-table">
                            <?php if($salesquotes->totalcost()): ?>
                                <tr>
                                    <td><?php echo e(__('Total Cost')); ?>:</td>
                                    <td><?php echo e(currency_format_with_sym($salesquotes->totalcost(),$salesquotes->created_by,$salesquotes->workspace)); ?></td>
                                </tr>
                            <?php endif; ?>
                            <?php if($salesquotes->totalcost()): ?>
                                <tr>
                                    <td><?php echo e(__('Product')); ?>:</td>
                                    <td><?php echo e(currency_format_with_sym($salesquotes->totalcost()- (!empty( $salesquotes->shipping_cost() ) ? $salesquotes->shipping_cost():0) -  (!empty( $salesquotes->labor_cost() ) ? $salesquotes->labor_cost():0),$salesquotes->created_by,$salesquotes->workspace)); ?></td>
                                </tr>
                            <?php endif; ?>
                            <?php if(\Auth::user()->type!="client" || $setting['shipping_total']=="on"): ?>
                                <?php if($salesquotes->shipping_cost()): ?>
                                    <tr>
                                        <td><?php echo e(__('Shipping')); ?>:</td>
                                        <td><?php echo e(currency_format_with_sym($salesquotes->shipping_cost(),$salesquotes->created_by,$salesquotes->workspace)); ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(\Auth::user()->type!="client" || $setting['labor_total']=="on"): ?>
                                <?php if($salesquotes->labor_cost()): ?>
                                    <tr>
                                        <td><?php echo e(__('Labor')); ?>:</td>
                                        <td><?php echo e(currency_format_with_sym($salesquotes->labor_cost(),$salesquotes->created_by,$salesquotes->workspace)); ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if($salesquotes->totalProfit()): ?>
                                <tr>
                                    <td><?php echo e(__('Total Profit')); ?>:</td>
                                    <td><?php echo e(currency_format_with_sym($salesquotes->totalProfit(),$salesquotes->created_by,$salesquotes->workspace)); ?></td>
                                </tr>
                            <?php endif; ?>
                            <?php if($salesquotes->totalgp()): ?>
                                <tr>
                                    <td><?php echo e(__('GP')); ?>:</td>
                                    <td><?php echo e(currency_format_with_sym($salesquotes->totalgp(),$salesquotes->created_by,$salesquotes->workspace)); ?></td>
                                </tr>
                            <?php endif; ?>
                            <?php if($salesquotes->totalextend()): ?>
                                <tr>
                                    <td><?php echo e(__('Sub Total')); ?>:</td>
                                    <td><?php echo e(currency_format_with_sym($salesquotes->totalextend(),$salesquotes->created_by,$salesquotes->workspace)); ?></td>
                                </tr>
                            <?php endif; ?>
                            <?php if($salesquotes->totalextend()): ?>
                                <tr>
                                    <td><?php echo e(__('Main Total')); ?>:</td>
                                    <td><?php echo e(currency_format_with_sym($salesquotes->totalextend(),$salesquotes->created_by,$salesquotes->workspace)); ?></td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </td>
                <?php endif; ?>
            </tr>
            </tfoot>
        </table>
        <div class="invoice-footer">
            <p> <?php echo e($settings['quote_footer_title']); ?> <br>
                <?php echo e($settings['quote_footer_notes']); ?> </p>
        </div>
    </div>
</div>
<?php if($type=="print"): ?>
<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.js"></script>

<script>
    // $( document ).ready(function() { // select print button with class "print," then on click run callback function
        document.title = "<?php echo e(Modules\Sales\Entities\SalesQuote::quoteNumberFormat($salesquotes->quote_id,$salesquotes->created_by)); ?>";
        $.print("#boxes");
    setTimeout(function () {
        window.history.back();
    }, 1000);
    // });
</script>
<?php endif; ?>
<?php if(!isset($preview)): ?>
    <?php echo $__env->make('sales::salesquote.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
<?php endif; ?>
</body>
</html>
<?php /**PATH /home/dimensionsystems/webcrm.dimensionsystems.com/Modules/Sales/Resources/views/salesquote/templates/template1.blade.php ENDPATH**/ ?>