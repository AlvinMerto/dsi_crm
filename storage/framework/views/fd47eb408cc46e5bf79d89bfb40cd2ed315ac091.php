<?php if(isset($acction) && $acction=="edit"): ?>
    <?php $__currentLoopData = $salesquoteitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $salesquoteitem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $type=$salesquoteitem->type;
        ?>
        <?php if($type=="substart"): ?>
            <?php
                $subid=0;
                if(!isset($id))
                {
                    $id=0;
                }
                else
                {
                    $id=$id+1;
                }
            ?>
            <tr class="add-sublist data_id data_<?php echo e($id); ?>" main-data="<?php echo e($id); ?>" data-id="<?php echo e($id); ?>" data-name="substart" data-sub-id="0">
                <td>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move me-3"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
                </td>
                <input type="hidden" name="quote[<?php echo e($id); ?>][0][id]" class="main-id" value="<?php echo e($salesquoteitem->id); ?>">
                <input type="hidden" name="quote[<?php echo e($id); ?>][0][type]" value="substart">
                <td width="7%">
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.'][0][profit]', $salesquoteitem->profit, ['class' => 'form-control main_profit'])); ?>

                    </div>
                </td>
                <td width="7%">
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.'][0][markup]', $salesquoteitem->markup, ['class' => 'form-control main_markup'])); ?>

                    </div>
                </td>
                <td width="7%">
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.'][0][purchase_price]', $salesquoteitem->purchase_price, ['class' => 'form-control main_cost'])); ?>

                        <input type="hidden" name="shipping_charge" class="shipping_charge" value="">
                        <input type="hidden" name="labor_charge" value="" class="labor_charge">
                    </div>
                </td>
                <td>
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.'][0][supplier_name]', '', ['class' => 'form-control' ])); ?>

                    </div>
                </td>
                <td >
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.'][0][supplier_part_number]', '', ['class' => 'form-control'])); ?>

                    </div>
                </td>
                <td>
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.'][0][manufacturer_name]', '', ['class' => 'form-control'])); ?>

                    </div>
                </td>
                <input type="hidden" class="totalmaincost" value="<?php echo e($salesquoteitem->totalmaincost); ?>" name="<?php echo e('quote['.$id.'][0][totalmaincost]'); ?>">
                <input type="hidden" class="totalshippingcost" value="" name="<?php echo e('quote['.$id.'][0][totalshippingcost]'); ?>">
                <input type="hidden" class="totallaborcharge" value="" name="<?php echo e('quote['.$id.'][0][totallaborcharge]'); ?>">
                <td>
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.'][0][manufacturer_part_number]','"SubStart"', ['class' => 'form-control main_manufacturer_part_number', 'required' => 'required'])); ?>

                    </div>
                </td>
                <td width="10%">
                    <div class="form-group">
                        <?php echo e(Form::text('quote['.$id.'][0][subtotal_description]', $salesquoteitem->subtotal_description, ['class' => 'form-control subtotal_description substart', 'rows' => '2', 'placeholder' => __('Subtotal Description')])); ?>

                    </div>
                </td>
                <td>
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.'][0][subtotal_quantity]', $salesquoteitem->subtotal_quantity, ['class' => 'form-control main_quantity', 'required' => 'required', 'placeholder' => __('Qty'), 'required' => 'required'])); ?>

                        
                    </div>
                </td>

                <td width="7%">
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.'][0][price]', $salesquoteitem->price, ['class' => 'form-control main_price'])); ?>


                    </div>
                </td>
                <td width="7%">
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.'][0][extended]', $salesquoteitem->extended, ['class' => 'form-control main_extended'])); ?>


                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <div class="input-group colorpickerinput">
                            <div class="taxes"></div>
                            <?php echo e(Form::hidden('quote['.$id.'][0][tax]', $salesquoteitem->tax, ['class' => 'form-control text-dark'])); ?>

                            <?php echo e(Form::hidden('quote['.$id.'][0][itemTaxPrice]',  $salesquoteitem->itemTaxPrice, ['class' => 'form-control'])); ?>

                            <?php echo e(Form::hidden('quote['.$id.'][0][itemTaxRate]', $salesquoteitem->itemTaxRate, ['class' => 'form-control'])); ?>

                        </div>
                    </div>
                </td>
                <td  width="5%">
                    <a href="#" class="bs-pass-para repeater-action-btn delete-item" data-repeater-delete>
                        <div class="repeater-action-btn action-btn bg-danger ms-2">
                            <i class="ti ti-trash text-white text-white"></i>
                        </div>
                    </a>
                </td>
            </tr>
        <?php elseif($type=="substop"): ?>
            <?php
                $subid=$subid+1;
            ?>
            <tr class="add-sublist data_<?php echo e($id); ?>" data-name="substop" data-sub-id="<?php echo e($subid); ?>" >
                <input type="hidden" name="quote[<?php echo e($id); ?>][<?php echo e($subid); ?>][id]" class="main-id" value="<?php echo e($salesquoteitem->id); ?>">
                <input type="hidden" name="quote[<?php echo e($id); ?>][<?php echo e($subid); ?>][type]" value="substop">
                <td>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move me-3"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
                </td>
                <td width="7%">
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('', '', ['class' => 'form-control'])); ?>

                    </div>
                </td>
                <td width="7%">
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('', '', ['class' => 'form-control'])); ?>

                    </div>
                </td>
                <td width="7%">
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('', '', ['class' => 'form-control'])); ?>

                    </div>
                </td>
                <td>
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('', '', ['class' => 'form-control' ])); ?>

                    </div>
                </td>
                <td >
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('', '', ['class' => 'form-control'])); ?>

                    </div>
                </td>
                <td>
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('', '', ['class' => 'form-control'])); ?>

                    </div>
                </td>
                <td>
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('','"SubStop"', ['class' => 'form-control manufacturer_part_number ', 'required' => 'required','readonly'])); ?>

                    </div>
                </td>
                <td width="10%">
                    <div class="form-group">
                        <?php echo e(Form::text('', null, ['class' => 'form-control subtotal_description substop', 'rows' => '2'])); ?>

                    </div>
                </td>
                <td>
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('', '', ['class' => 'form-control '])); ?>

                        
                    </div>
                </td>


                <td width="7%">
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('', '', ['class' => 'form-control'])); ?>


                    </div>
                </td>
                <td width="7%">
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('', '', ['class' => 'form-control'])); ?>


                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <div class="input-group colorpickerinput">
                            <div class="taxes"></div>
                            <?php echo e(Form::hidden('quote['.$id.']['.$subid.'][tax]', '', ['class' => 'form-control text-dark'])); ?>

                            <?php echo e(Form::hidden('quote['.$id.']['.$subid.'][itemTaxPrice]', 0, ['class' => 'form-control'])); ?>

                            <?php echo e(Form::hidden('quote['.$id.']['.$subid.'][itemTaxRate]', 0, ['class' => 'form-control'])); ?>

                        </div>
                    </div>
                </td>
                <td  width="5%">
                    <a href="#" class="bs-pass-para repeater-action-btn delete-item" data-repeater-delete>
                        <div class="repeater-action-btn action-btn bg-danger ms-2">
                            <i class="ti ti-trash text-white text-white"></i>
                        </div>
                    </a>
                </td>
            </tr>
        <?php elseif($type=="subitem"): ?>
            <?php
                $subid=$subid+1;
            ?>

            <?php
                $product_services = \Modules\ProductService\Entities\ProductService::where('workspace_id', getActiveWorkSpace())->where('type','product')->get()->pluck('name', 'id');
                $item=\Modules\ProductService\Entities\ProductService::where('workspace_id', getActiveWorkSpace())->where('id',$salesquoteitem->item)->first();
            ?>
            <tr class="add-sublist data_<?php echo e($id); ?>" main-data="<?php echo e($id); ?>" data-name="item" data-sub-id="<?php echo e($subid); ?>" sub-data-id="<?php echo e($id); ?>">
                <input type="hidden" name="quote[<?php echo e($id); ?>][<?php echo e($subid); ?>][id]"  class="main-id" value="<?php echo e($salesquoteitem->id); ?>">
                <input type="hidden" name="quote[<?php echo e($id); ?>][<?php echo e($subid); ?>][type]" value="subitem">
                <td>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move me-3"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
                </td>
                <td width="7%">
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.']['.$subid.'][profit]',$salesquoteitem->profit, ['class' => 'form-control profit','placeholder' => __('Profit'), 'required' => 'required'])); ?>

                    </div>
                </td>
                <td width="7%">
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.']['.$subid.'][markup]', $salesquoteitem->markup, ['class' => 'form-control markup', 'required' => 'required', 'placeholder' => __('Mark-Up'), 'required' => 'required'])); ?>

                    </div>
                </td>
                <td width="7%">
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.']['.$subid.'][purchase_price]', $salesquoteitem->purchase_price, ['class' => 'form-control cost', 'required' => 'required', 'placeholder' => __('Cost'), 'required' => 'required'])); ?>

                    </div>
                </td>
                <td >
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.']['.$subid.'][supplier_name]', isset($item->supplier_name)?$item->supplier_name:"", ['class' => 'form-control supplier_name', 'required' => 'required', 'placeholder' => __('Supplier Name')])); ?>

                    </div>
                </td>
                <td >
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.']['.$subid.'][supplier_part_number]', isset($item->supplier_part_number)?$item->supplier_part_number:"", ['class' => 'form-control supplier_part_number', 'required' => 'required', 'placeholder' => __('Supplier Part Number')])); ?>

                    </div>
                </td>
                <td>
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.']['.$subid.'][manufacturer_name]', isset($item->manufacturer_name)?$item->manufacturer_name:"", ['class' => 'form-control manufacturer_name', 'required' => 'required', 'placeholder' => __('Manufacturer Name')])); ?>

                    </div>
                </td>
                <td>
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.']['.$subid.'][manufacturer_part_number]',isset($item->manufacturer_part_number)?$item->manufacturer_part_number:"", ['class' => 'form-control manufacturer_part_number', 'required' => 'required', 'placeholder' => __('Manufacturer Part Number')])); ?>

                    </div>
                </td>
                <td width="10%">
                    <div class="form-group" data-item-id=<?php echo e($id); ?>>
                        <?php echo e(Form::select('quote['.$id.']['.$subid.'][item]', $product_services, $salesquoteitem->item, ['class' => 'form-control item js-searchBox', 'required' => 'required','data-url'=>route('invoice.product')])); ?>

                    </div>
                </td>
                <td>
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.']['.$subid.'][quantity]', $salesquoteitem->quantity, ['class' => 'form-control quantity', 'required' => 'required', 'placeholder' => __('Qty'), 'required' => 'required'])); ?>

                        
                    </div>
                </td>
                <td width="7%">
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.']['.$subid.'][price]', $salesquoteitem->price, ['class' => 'form-control price', 'required' => 'required', 'placeholder' => __('Price'), 'required' => 'required'])); ?>


                    </div>
                </td>
                <td width="7%">
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.']['.$subid.'][extended]', $salesquoteitem->extended, ['class' => 'form-control extended', 'required' => 'required', 'placeholder' => __('Extended'), 'required' => 'required'])); ?>


                    </div>
                </td>
                <input type="hidden" name="quote[<?php echo e($id); ?>][<?php echo e($subid); ?>][amount]" class="amount" >
                <td>
                    <div class="form-group">
                        <div class="input-group colorpickerinput">
                            <div class="taxes"></div>
                            <?php echo e(Form::hidden('quote['.$id.']['.$subid.'][tax]', $salesquoteitem->tax, ['class' => 'form-control tax text-dark'])); ?>

                            <?php echo e(Form::hidden('quote['.$id.']['.$subid.'][itemTaxPrice]', $salesquoteitem->itemTaxPrice, ['class' => 'form-control itemTaxPrice'])); ?>

                            <?php echo e(Form::hidden('quote['.$id.']['.$subid.'][itemTaxRate]', $salesquoteitem->itemTaxRate, ['class' => 'form-control itemTaxRate'])); ?>

                        </div>
                    </div>
                </td>
                <td  width="5%">
                    <a href="#" class="bs-pass-para repeater-action-btn duplicate-item" data-bs-toggle="tooltip" title="<?php echo e(__('Duplicate item')); ?>" >
                        <div class="repeater-action-btn action-btn bg-secondary ms-2">
                            <i class="ti ti-copy  text-white"></i>
                        </div>
                    </a>
                    <a href="#" class="bs-pass-para repeater-action-btn delete-item" data-repeater-delete>
                        <div class="repeater-action-btn action-btn bg-danger ms-2">
                            <i class="ti ti-trash text-white text-white"></i>
                        </div>
                    </a>
                </td>
            </tr>

        <?php elseif($type=="subcomment"): ?>
            <?php
                $subid=$subid+1;
            ?>
            <tr class="add-sublist data_<?php echo e($id); ?>" main-data="<?php echo e($id); ?>" data-name="subcomment" data-sub-id="<?php echo e($subid); ?>">
                <input type="hidden" name="quote[<?php echo e($id); ?>][<?php echo e($subid); ?>][id]" class="main-id" value="<?php echo e($salesquoteitem->id); ?>">
                <input type="hidden" name="quote[<?php echo e($id); ?>][<?php echo e($subid); ?>][type]" value="subcomment">
                <td>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move me-3"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
                </td>
                <td width="7%">
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('', '', ['class' => 'form-control','readonly'])); ?>

                    </div>
                </td>
                <td width="7%">
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('', '', ['class' => 'form-control ','readonly'])); ?>

                    </div>
                </td>
                <td width="7%">
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('', '', ['class' => 'form-control ','readonly'])); ?>

                    </div>
                </td>
                <td>
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('', '', ['class' => 'form-control',  'readonly'])); ?>

                    </div>
                </td>
                <td >
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('', '', ['class' => 'form-control',  'readonly'])); ?>

                    </div>
                </td>
                <td>
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('', '', ['class' => 'form-control','readonly'])); ?>

                    </div>
                </td>
                <td>
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('','', ['class' => 'form-control', 'readonly'])); ?>

                    </div>
                </td>
                <td width="10%">
                    <div class="form-group" >
                        <?php echo e(Form::text('quote['.$id.']['.$subid.'][sample_comment]', $salesquoteitem->sample_comment, ['class' => 'form-control sample_comment', 'rows' => '2', 'placeholder' => __('Sample Comment')])); ?>

                    </div>
                </td>
                <td>
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('', '', ['class' => 'form-control', 'readonly'])); ?>

                        
                    </div>
                </td>


                <td>
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('', '', ['class' => 'form-control ', 'readonly'])); ?>


                    </div>
                </td>
                <td>
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('', '', ['class' => 'form-control','readonly'])); ?>


                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <div class="input-group colorpickerinput">
                            <div class="taxes"></div>
                        </div>
                    </div>
                </td>
                <td  width="5%">
                    <a href="#" class="bs-pass-para repeater-action-btn duplicate-item" data-bs-toggle="tooltip" title="<?php echo e(__('Duplicate item')); ?>" >
                        <div class="repeater-action-btn action-btn bg-secondary ms-2">
                            <i class="ti ti-copy  text-white"></i>
                        </div>
                    </a>
                    <a href="#" class="bs-pass-para repeater-action-btn delete-item" data-repeater-delete>
                        <div class="repeater-action-btn action-btn bg-danger ms-2">
                            <i class="ti ti-trash text-white text-white"></i>
                        </div>
                    </a>
                </td>
            </tr>

        <?php elseif($type=="subblank"): ?>
            <?php
                $subid=$subid+1;
            ?>
            <tr class="add-sublist data_<?php echo e($id); ?>" main-data="<?php echo e($id); ?>" data-name="subblank" data-sub-id="<?php echo e($subid); ?>">
                <input type="hidden" name="quote[<?php echo e($id); ?>][<?php echo e($subid); ?>][id]" class="main-id" value="<?php echo e($salesquoteitem->id); ?>">
                <input type="hidden" name="quote[<?php echo e($id); ?>][<?php echo e($subid); ?>][type]" value="subblank">
                <td>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move me-3"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
                </td>
                <td width="7%">
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('', '', ['class' => 'form-control','readonly'])); ?>

                    </div>
                </td>
                <td width="7%">
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('', '', ['class' => 'form-control ', 'readonly'])); ?>

                    </div>
                </td>
                <td width="7%">
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('', '', ['class' => 'form-control ','readonly'])); ?>

                    </div>
                </td>
                <td>
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('', '', ['class' => 'form-control','readonly'])); ?>

                    </div>
                </td>
                <td >
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('', '', ['class' => 'form-control', 'readonly'])); ?>

                    </div>
                </td>
                <td>
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('', '', ['class' => 'form-control', 'readonly'])); ?>

                    </div>
                </td>
                <td>
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('','', ['class' => 'form-control', 'readonly'])); ?>

                    </div>
                </td>
                <td width="10%">
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('','', ['class' => 'form-control','readonly'])); ?>

                    </div>
                </td>
                <td>
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('', '', ['class' => 'form-control','readonly'])); ?>

                    </div>
                </td>


                <td>
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('', '', ['class' => 'form-control ', 'readonly'])); ?>


                    </div>
                </td>
                <td>
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('', '', ['class' => 'form-control','readonly'])); ?>


                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <div class="input-group colorpickerinput">
                            <div class="taxes"></div>
                        </div>
                    </div>
                </td>
                <td  width="5%">
                    <a href="#" class="bs-pass-para repeater-action-btn delete-item" data-repeater-delete>
                        <div class="repeater-action-btn action-btn bg-danger ms-2">
                            <i class="ti ti-trash text-white text-white"></i>
                        </div>
                    </a>
                </td>
            </tr>
        <?php elseif($type=="subcustomitem"): ?>
            <?php
                $subid=$subid+1;
            ?>
            <tr class="add-sublist data_<?php echo e($id); ?>" main-data="<?php echo e($id); ?>" data-name="subcustomitem" data-sub-id="<?php echo e($subid); ?>" sub-data-id="<?php echo e($id); ?>">
                <input type="hidden" name="quote[<?php echo e($id); ?>][<?php echo e($subid); ?>][id]" class="main-id" value="<?php echo e($salesquoteitem->id); ?>">
                <input type="hidden" name="quote[<?php echo e($id); ?>][<?php echo e($subid); ?>][type]" value="subcustomitem">
                <td>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move me-3"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
                </td>
                <td width="7%">
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.']['.$subid.'][profit]',isset($salesquoteitem->profit)?$salesquoteitem->profit:"", ['class' => 'form-control profit','placeholder' => __('Profit'), 'required' => 'required'])); ?>

                    </div>
                </td>
                <td width="7%">
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.']['.$subid.'][markup]', isset($salesquoteitem->markup)?$salesquoteitem->markup:"", ['class' => 'form-control markup', 'required' => 'required', 'placeholder' => __('Mark-Up'), 'required' => 'required'])); ?>

                    </div>
                </td>
                <td width="7%">
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.']['.$subid.'][purchase_price]', $salesquoteitem->purchase_price, ['class' => 'form-control cost', 'required' => 'required', 'placeholder' => __('Cost'), 'required' => 'required'])); ?>

                    </div>
                </td>
                <td >
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.']['.$subid.'][supplier_name]', $salesquoteitem->supplier_name, ['class' => 'form-control supplier_name', 'required' => 'required', 'placeholder' => __('Supplier Name')])); ?>

                    </div>
                </td>
                <td >
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.']['.$subid.'][supplier_part_number]',$salesquoteitem->supplier_part_number, ['class' => 'form-control supplier_part_number', 'required' => 'required', 'placeholder' => __('Supplier Part Number')])); ?>

                    </div>
                </td>
                <td>
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.']['.$subid.'][manufacturer_name]', $salesquoteitem->manufacturer_name, ['class' => 'form-control manufacturer_name', 'required' => 'required', 'placeholder' => __('Manufacturer Name')])); ?>

                    </div>
                </td>
                <td>
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.']['.$subid.'][manufacturer_part_number]', $salesquoteitem->manufacturer_part_number, ['class' => 'form-control manufacturer_part_number', 'required' => 'required', 'placeholder' => __('Manufacturer Part Number')])); ?>

                    </div>
                </td>
                <td width="10%">
                    <div class="form-group">
                        <?php echo e(Form::text('quote['.$id.']['.$subid.'][item]', $salesquoteitem->item, ['class' => 'form-control item', 'required' => 'required', 'placeholder' => __('Description')])); ?>

                    </div>
                </td>
                <td>
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.']['.$subid.'][quantity]', $salesquoteitem->quantity, ['class' => 'form-control quantity', 'required' => 'required', 'placeholder' => __('Qty'), 'required' => 'required'])); ?>

                        
                    </div>
                </td>
                <td width="7%">
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.']['.$subid.'][price]', $salesquoteitem->price, ['class' => 'form-control price', 'required' => 'required', 'placeholder' => __('Price'), 'required' => 'required'])); ?>


                    </div>
                </td>
                <td width="7%">
                    <div class="form-group price-input input-group search-form">
                        <?php echo e(Form::text('quote['.$id.']['.$subid.'][extended]', isset($salesquoteitem->extended)?$salesquoteitem->extended:"", ['class' => 'form-control extended', 'required' => 'required', 'placeholder' => __('Extended'), 'required' => 'required'])); ?>

                    </div>
                </td>
                <input type="hidden" name="quote[<?php echo e($id); ?>][<?php echo e($subid); ?>][amount]" class="amount" >
                <td>
                    <div class="form-group">
                        <div class="input-group colorpickerinput">
                            <div class="taxes"></div>
                            <?php echo e(Form::hidden('quote['.$id.']['.$subid.'][tax]', $salesquoteitem->tax, ['class' => 'form-control tax text-dark'])); ?>

                            <?php echo e(Form::hidden('quote['.$id.']['.$subid.'][itemTaxPrice]', 0, ['class' => 'form-control itemTaxPrice'])); ?>

                            <?php echo e(Form::hidden('quote['.$id.']['.$subid.'][itemTaxRate]', 0, ['class' => 'form-control itemTaxRate'])); ?>

                        </div>
                    </div>
                </td>
                <td  width="5%">
                    <a href="#" class="bs-pass-para repeater-action-btn duplicate-item" data-bs-toggle="tooltip" title="<?php echo e(__('Duplicate item')); ?>" >
                        <div class="repeater-action-btn action-btn bg-secondary ms-2">
                            <i class="ti ti-copy  text-white"></i>
                        </div>
                    </a>
                    <a href="#" class="bs-pass-para repeater-action-btn delete-item" data-repeater-delete>
                        <div class="repeater-action-btn action-btn bg-danger ms-2">
                            <i class="ti ti-trash text-white text-white"></i>
                        </div>
                    </a>
                </td>
            </tr>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <?php if($type=="substart"): ?>
        <tr class="add-sublist data_id data_<?php echo e($id); ?>" main-data="<?php echo e($id); ?>" data-id="<?php echo e($id); ?>" data-name="substart" data-sub-id="0">
            <input type="hidden" name="quote[<?php echo e($id); ?>][0][type]" value="substart">
            <td>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move me-3"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
            </td>
            <td width="7%">
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.'][0][profit]', '', ['class' => 'form-control main_profit'])); ?>

                </div>
            </td>
            <td width="7%">
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.'][0][markup]', '', ['class' => 'form-control main_markup'])); ?>

                </div>
            </td>
            <td width="7%">
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.'][0][purchase_price]', '', ['class' => 'form-control main_cost'])); ?>

                    <input type="hidden" name="shipping_charge" class="shipping_charge" value="">
                    <input type="hidden" name="labor_charge" value="" class="labor_charge">
                </div>
            </td>
            <td>
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.'][0][supplier_name]', '', ['class' => 'form-control' ])); ?>

                </div>
            </td>
            <td >
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.'][0][supplier_part_number]', '', ['class' => 'form-control'])); ?>

                </div>
            </td>
            <td>
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.'][0][manufacturer_name]', '', ['class' => 'form-control'])); ?>

                </div>
            </td>
            <input type="hidden" class="totalmaincost" value="" name="<?php echo e('quote['.$id.'][0][totalmaincost]'); ?>" />
             <input type="hidden" class="totalshippingcost" value="" name="<?php echo e('quote['.$id.'][0][totalshippingcost]'); ?>">
            <input type="hidden" class="totallaborcharge" value="" name="<?php echo e('quote['.$id.'][0][totallaborcharge]'); ?>">

            <td>
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.'][0][manufacturer_part_number]','"SubStart"', ['class' => 'form-control main_manufacturer_part_number', 'required' => 'required'])); ?>

                </div>
            </td>
            <td width="10%">
                <div class="form-group">
                    <?php echo e(Form::text('quote['.$id.'][0][subtotal_description]', null, ['class' => 'form-control subtotal_description substart', 'rows' => '2', 'placeholder' => __('Subtotal Description')])); ?>

                </div>
            </td>
            <td>
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.'][0][subtotal_quantity]', '', ['class' => 'form-control main_quantity', 'required' => 'required', 'placeholder' => __('Qty'), 'required' => 'required'])); ?>

                    
                </div>
            </td>
            <td width="7%">
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.'][0][price]', '', ['class' => 'form-control main_price',])); ?>


                </div>
            </td>
            <td width="7%">
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.'][0][extended]', '', ['class' => 'form-control main_extended'])); ?>


                </div>
            </td>
            <td>
                <div class="form-group">
                    <div class="input-group colorpickerinput">
                        <div class="taxes"></div>
                        <?php echo e(Form::hidden('quote['.$id.'][0][tax]', '', ['class' => 'form-control text-dark'])); ?>

                        <?php echo e(Form::hidden('quote['.$id.'][0][itemTaxPrice]', '', ['class' => 'form-control'])); ?>

                        <?php echo e(Form::hidden('quote['.$id.'][0][itemTaxRate]', '', ['class' => 'form-control'])); ?>

                    </div>
                </div>
            </td>
            <td  width="5%">
                <a href="#" class="bs-pass-para repeater-action-btn delete-item" data-repeater-delete>
                    <div class="repeater-action-btn action-btn bg-danger ms-2">
                        <i class="ti ti-trash text-white text-white"></i>
                    </div>
                </a>
            </td>
        </tr>

    <?php elseif($type=="substop"): ?>
        <tr class="add-sublist data_<?php echo e($id); ?>" main-data="<?php echo e($id); ?>" data-name="substop" data-sub-id="<?php echo e($subid); ?>">
            <input type="hidden" name="quote[<?php echo e($id); ?>][<?php echo e($subid); ?>][type]" value="substop">
            <td>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move me-3"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
            </td>
            <td width="7%">
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('', '', ['class' => 'form-control','readonly'])); ?>

                </div>
            </td>
            <td width="7%">
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('', '', ['class' => 'form-control'],'readonly')); ?>

                </div>
            </td>
            <td width="7%">
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('', '', ['class' => 'form-control'],'readonly')); ?>

                </div>
            </td>
            <td>
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('', '', ['class' => 'form-control'],'readonly')); ?>

                </div>
            </td>
            <td >
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('', '', ['class' => 'form-control'],'readonly')); ?>

                </div>
            </td>
            <td>
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('', '', ['class' => 'form-control'],'readonly')); ?>

                </div>
            </td>
            <td>
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('','"SubStop"', ['class' => 'form-control manufacturer_part_number ', 'required' => 'required', 'readonly'],'readonly')); ?>

                </div>
            </td>
            <td width="10%">
                <div class="form-group">
                    <?php echo e(Form::text('', null, ['class' => 'form-control subtotal_description substop', 'rows' => '2','readonly'])); ?>

                </div>
            </td>
            <td>
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('', '', ['class' => 'form-control','readonly'])); ?>

                    
                </div>
            </td>


            <td width="7%">
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('', '', ['class' => 'form-control','readonly'])); ?>


                </div>
            </td>
            <td width="7%">
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('', '', ['class' => 'form-control','readonly'])); ?>


                </div>
            </td>
            <td>
                <div class="form-group">
                    <div class="input-group colorpickerinput">
                        <div class="taxes"></div>
                        <?php echo e(Form::hidden('quote['.$id.']['.$subid.'][tax]', '', ['class' => 'form-control text-dark'])); ?>

                        <?php echo e(Form::hidden('quote['.$id.']['.$subid.'][itemTaxPrice]', 0, ['class' => 'form-control'])); ?>

                        <?php echo e(Form::hidden('quote['.$id.']['.$subid.'][itemTaxRate]', 0, ['class' => 'form-control'])); ?>

                    </div>
                </div>
            </td>
            <td  width="5%">
                <a href="#" class="bs-pass-para repeater-action-btn delete-item" data-repeater-delete>
                    <div class="repeater-action-btn action-btn bg-danger ms-2">
                        <i class="ti ti-trash text-white text-white"></i>
                    </div>
                </a>
            </td>
        </tr>
    <?php elseif($type=="subitem"): ?>
        <?php
            $product_services = \Modules\ProductService\Entities\ProductService::where('workspace_id', getActiveWorkSpace())->where('type','product')->get()->pluck('name', 'id');
        ?>
        <tr class="add-sublist data_<?php echo e($id); ?>" main-data="<?php echo e($id); ?>" data-name="item" data-sub-id="<?php echo e($subid); ?>" sub-data-id="<?php echo e($id); ?>">
            <td>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move me-3"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
            </td>
            <input type="hidden" name="quote[<?php echo e($id); ?>][<?php echo e($subid); ?>][type]" value="subitem">
            <td width="7%">
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.']['.$subid.'][profit]', '', ['class' => 'form-control profit','placeholder' => __('Profit'), 'required' => 'required'])); ?>

                </div>
            </td>
            <td width="7%">
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.']['.$subid.'][markup]', '', ['class' => 'form-control markup', 'required' => 'required', 'placeholder' => __('Mark-Up'), 'required' => 'required'])); ?>

                </div>
            </td>
            <td width="7%">
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.']['.$subid.'][purchase_price]', '', ['class' => 'form-control cost', 'required' => 'required', 'placeholder' => __('Cost'), 'required' => 'required'])); ?>

                </div>
            </td>
            <td >
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.']['.$subid.'][supplier_name]', '', ['class' => 'form-control supplier_name', 'required' => 'required', 'placeholder' => __('Supplier Name')])); ?>

                </div>
            </td>
            <td >
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.']['.$subid.'][supplier_part_number]', '', ['class' => 'form-control supplier_part_number', 'required' => 'required', 'placeholder' => __('Supplier Part Number')])); ?>

                </div>
            </td>
            <td>
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.']['.$subid.'][manufacturer_name]', '', ['class' => 'form-control manufacturer_name', 'required' => 'required', 'placeholder' => __('Manufacturer Name')])); ?>

                </div>
            </td>
            <td>
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.']['.$subid.'][manufacturer_part_number]','', ['class' => 'form-control manufacturer_part_number', 'required' => 'required', 'placeholder' => __('Manufacturer Part Number')])); ?>

                </div>
            </td>
            <td width="10%">
                <div class="form-group" data-item-id=<?php echo e($id); ?>>
                    <?php echo e(Form::select('quote['.$id.']['.$subid.'][item]', $product_services, null, ['class' => 'form-control item js-searchBox', 'required' => 'required','data-url'=>route('invoice.product')])); ?>

                </div>
            </td>
            <td>
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.']['.$subid.'][quantity]', '', ['class' => 'form-control quantity', 'required' => 'required', 'placeholder' => __('Qty'), 'required' => 'required'])); ?>

                    
                </div>
            </td>
            <td width="7%">
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.']['.$subid.'][price]', '', ['class' => 'form-control price', 'required' => 'required', 'placeholder' => __('Price'), 'required' => 'required'])); ?>

                </div>
            </td>
            <td width="7%">
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.']['.$subid.'][extended]', '', ['class' => 'form-control extended', 'required' => 'required', 'placeholder' => __('Extended'), 'required' => 'required'])); ?>


                </div>
            </td>
                <input type="hidden" name="quote[<?php echo e($id); ?>][<?php echo e($subid); ?>][amount]" class="amount" >
            <td>
                <div class="form-group">
                    <div class="input-group colorpickerinput">
                        <div class="taxes"></div>
                        <?php echo e(Form::hidden('quote['.$id.']['.$subid.'][tax]', '', ['class' => 'form-control tax text-dark'])); ?>

                        <?php echo e(Form::hidden('quote['.$id.']['.$subid.'][itemTaxPrice]', '', ['class' => 'form-control itemTaxPrice'])); ?>

                        <?php echo e(Form::hidden('quote['.$id.']['.$subid.'][itemTaxRate]', '', ['class' => 'form-control itemTaxRate'])); ?>

                    </div>
                </div>
            </td>
            <td  width="5%">
                <a href="#" class="bs-pass-para repeater-action-btn duplicate-item" data-bs-toggle="tooltip" title="<?php echo e(__('Duplicate item')); ?>">
                    <div class="repeater-action-btn action-btn bg-secondary ms-2">
                        <i class="ti ti-copy  text-white"></i>
                    </div>
                </a>

                <a href="#" class="bs-pass-para repeater-action-btn delete-item" data-repeater-delete>
                    <div class="repeater-action-btn action-btn bg-danger ms-2">
                        <i class="ti ti-trash text-white text-white"></i>
                    </div>
                </a>
            </td>
        </tr>
    <?php elseif($type=="subcomment"): ?>
        <tr class="add-sublist data_<?php echo e($id); ?>" main-data="<?php echo e($id); ?>" data-name="subcomment" data-sub-id="<?php echo e($subid); ?>" sub-data-id="<?php echo e($id); ?>">
            <td>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move me-3"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
            </td>
            <input type="hidden" name="quote[<?php echo e($id); ?>][<?php echo e($subid); ?>][type]" value="subcomment">
            <td width="7%">
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('', '', ['class' => 'form-control','readonly'])); ?>

                </div>
            </td>
            <td width="7%">
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('', '', ['class' => 'form-control ','readonly'])); ?>

                </div>
            </td>
            <td width="7%">
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('', '', ['class' => 'form-control ','readonly'])); ?>

                </div>
            </td>
            <td>
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('', '', ['class' => 'form-control',  'readonly'])); ?>

                </div>
            </td>
            <td >
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('', '', ['class' => 'form-control',  'readonly'])); ?>

                </div>
            </td>
            <td>
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('', '', ['class' => 'form-control','readonly'])); ?>

                </div>
            </td>
            <td>
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('','', ['class' => 'form-control', 'readonly'])); ?>

                </div>
            </td>
            <td width="10%">
                <div class="form-group" >
                    <?php echo e(Form::text('quote['.$id.']['.$subid.'][sample_comment]', 'Sample Comment', ['class' => 'form-control sample_comment', 'rows' => '2', 'placeholder' => __('Sample Comment')])); ?>

                </div>
            </td>
            <td>
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('', '', ['class' => 'form-control', 'readonly'])); ?>

                    
                </div>
            </td>


            <td>
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('', '', ['class' => 'form-control ', 'readonly'])); ?>


                </div>
            </td>
            <td>
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('', '', ['class' => 'form-control','readonly'])); ?>

                </div>
            </td>
            <td>
                <div class="form-group">
                    <div class="input-group colorpickerinput">
                        <div class="taxes"></div>
                    </div>
                </div>
            </td>
            <td  width="5%">
                <a href="#" class="bs-pass-para repeater-action-btn duplicate-item" data-bs-toggle="tooltip" title="<?php echo e(__('Duplicate item')); ?>" >
                    <div class="repeater-action-btn action-btn bg-secondary ms-2">
                        <i class="ti ti-copy  text-white"></i>
                    </div>
                </a>

                <a href="#" class="bs-pass-para repeater-action-btn delete-item" data-repeater-delete>
                    <div class="repeater-action-btn action-btn bg-danger ms-2">
                        <i class="ti ti-trash text-white text-white"></i>
                    </div>
                </a>
            </td>
        </tr>
    <?php elseif($type=="subcustomitem"): ?>

        <tr class="add-sublist data_<?php echo e($id); ?>" main-data="<?php echo e($id); ?>" data-name="subcustomitem" data-sub-id="<?php echo e($subid); ?>" sub-data-id="<?php echo e($id); ?>">
            <td>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move me-3"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
            </td>
            <input type="hidden" name="quote[<?php echo e($id); ?>][<?php echo e($subid); ?>][type]" value="subcustomitem">

            <td width="7%">
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.']['.$subid.'][profit]', '', ['class' => 'form-control profit','placeholder' => __('Profit'), 'required' => 'required'])); ?>

                </div>
            </td>
            <td width="7%">
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.']['.$subid.'][markup]', isset($data['markup'])?$data['markup']:"", ['class' => 'form-control markup', 'required' => 'required', 'placeholder' => __('Mark-Up'), 'required' => 'required'])); ?>

                </div>
            </td>
            <td width="7%">
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.']['.$subid.'][purchase_price]', isset($data['cost'])?$data['cost']:"", ['class' => 'form-control cost', 'required' => 'required', 'placeholder' => __('Cost'), 'required' => 'required'])); ?>

                </div>
            </td>
            <td >
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.']['.$subid.'][supplier_name]', isset($data['supplier_name'])?$data['supplier_name']:"", ['class' => 'form-control supplier_name', 'required' => 'required', 'placeholder' => __('Supplier Name')])); ?>

                </div>
            </td>
            <td >
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.']['.$subid.'][supplier_part_number]', isset($data['supplier_part_number'])?$data['supplier_part_number']:"", ['class' => 'form-control supplier_part_number', 'required' => 'required', 'placeholder' => __('Supplier Part Number')])); ?>

                </div>
            </td>
            <td>
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.']['.$subid.'][manufacturer_name]', isset($data['manufacturer_name'])?$data['manufacturer_name']:"", ['class' => 'form-control manufacturer_name', 'required' => 'required', 'placeholder' => __('Manufacturer Name')])); ?>

                </div>
            </td>
            <td>
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.']['.$subid.'][manufacturer_part_number]',isset($data['manufacturer_part_number'])?$data['manufacturer_part_number']:"", ['class' => 'form-control manufacturer_part_number', 'required' => 'required', 'placeholder' => __('Manufacturer Part Number')])); ?>

                </div>
            </td>
            <td width="10%">
                <div class="form-group" data-item-id=<?php echo e($id); ?>>
                    <?php echo e(Form::text('quote['.$id.']['.$subid.'][item]',isset($data['desc'])?$data['desc']:"", ['class' => 'form-control item', 'required' => 'required', 'placeholder' => __('Description')])); ?>

                </div>
            </td>
            <td>
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.']['.$subid.'][quantity]', isset($data['quantity'])?$data['quantity']:"", ['class' => 'form-control quantity', 'required' => 'required', 'placeholder' => __('Qty'), 'required' => 'required'])); ?>

                    
                </div>
            </td>
            <td width="7%">
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.']['.$subid.'][price]', isset($data['price'])?$data['price']:"", ['class' => 'form-control price', 'required' => 'required', 'placeholder' => __('Price'), 'required' => 'required'])); ?>

                </div>
            </td>
            <td width="7%">
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('quote['.$id.']['.$subid.'][extended]', '', ['class' => 'form-control extended', 'required' => 'required', 'placeholder' => __('Extended'), 'required' => 'required'])); ?>


                </div>
            </td>
            <input type="hidden" name="quote[<?php echo e($id); ?>][<?php echo e($subid); ?>][amount]" class="amount" >
            <td>
                <div class="form-group">
                    <div class="input-group colorpickerinput">
                        <div class="taxes"></div>
                        <?php echo e(Form::hidden('quote['.$id.']['.$subid.'][tax]',isset($data['tax'])?$data['tax']:"", ['class' => 'form-control tax text-dark'])); ?>

                        <?php echo e(Form::hidden('quote['.$id.']['.$subid.'][itemTaxPrice]', 0, ['class' => 'form-control itemTaxPrice'])); ?>

                        <?php echo e(Form::hidden('quote['.$id.']['.$subid.'][itemTaxRate]', 0, ['class' => 'form-control itemTaxRate'])); ?>

                    </div>
                </div>
            </td>
            <td  width="5%">
                <a href="#" class="bs-pass-para repeater-action-btn duplicate-item" data-bs-toggle="tooltip" title="<?php echo e(__('Duplicate item')); ?>">
                    <div class="repeater-action-btn action-btn bg-secondary ms-2">
                        <i class="ti ti-copy  text-white"></i>
                    </div>
                </a>

                <a href="#" class="bs-pass-para repeater-action-btn delete-item" data-repeater-delete>
                    <div class="repeater-action-btn action-btn bg-danger ms-2">
                        <i class="ti ti-trash text-white text-white"></i>
                    </div>
                </a>
            </td>
        </tr>

    <?php elseif($type=="subblank"): ?>
        <tr class="add-sublist data_<?php echo e($id); ?>" main-data="<?php echo e($id); ?>" data-name="subblank" data-sub-id="<?php echo e($subid); ?>">
            <td>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move me-3"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
            </td>
            <input type="hidden" name="quote[<?php echo e($id); ?>][<?php echo e($subid); ?>][type]" value="subblank">
            <td width="7%">
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('', '', ['class' => 'form-control','readonly'])); ?>

                </div>
            </td>
            <td width="7%">
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('', '', ['class' => 'form-control ', 'readonly'])); ?>

                </div>
            </td>
            <td width="7%">
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('', '', ['class' => 'form-control ','readonly'])); ?>

                </div>
            </td>
            <td>
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('', '', ['class' => 'form-control','readonly'])); ?>

                </div>
            </td>
            <td >
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('', '', ['class' => 'form-control', 'readonly'])); ?>

                </div>
            </td>
            <td>
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('', '', ['class' => 'form-control', 'readonly'])); ?>

                </div>
            </td>
            <td>
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('','', ['class' => 'form-control', 'readonly'])); ?>

                </div>
            </td>
            <td width="10%">
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('','', ['class' => 'form-control','readonly'])); ?>

                </div>
            </td>
            <td>
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('', '', ['class' => 'form-control','readonly'])); ?>

                </div>
            </td>


            <td>
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('', '', ['class' => 'form-control ', 'readonly'])); ?>


                </div>
            </td>
            <td>
                <div class="form-group price-input input-group search-form">
                    <?php echo e(Form::text('', '', ['class' => 'form-control','readonly'])); ?>


                </div>
            </td>
            <td>
                <div class="form-group">
                    <div class="input-group colorpickerinput">
                        <div class="taxes"></div>
                    </div>
                </div>
            </td>
            <td  width="5%">
                <a href="#" class="bs-pass-para repeater-action-btn delete-item" data-repeater-delete>
                    <div class="repeater-action-btn action-btn bg-danger ms-2">
                        <i class="ti ti-trash text-white text-white"></i>
                    </div>
                </a>
            </td>
        </tr>
    <?php endif; ?>
<?php endif; ?>


<?php /**PATH C:\xampp\htdocs\DSI_Laravel\Modules/Sales\Resources/views/salesquote/getsubtotal.blade.php ENDPATH**/ ?>