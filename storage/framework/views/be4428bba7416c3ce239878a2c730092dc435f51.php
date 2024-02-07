<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th colspan='2'> Quotation View </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:center;">
                            <?php
                                $profit_chkd = null;
                                
                                if (isset($data['profit'])) {
                                    $profit_chkd = "checked";
                                }
                            ?>
                            <input type='checkbox' class='settings_chk' value='profit' id='profit_chk' name='profit_chk' <?php echo $profit_chkd; ?>/> 
                        </td>
                        <td> <label for='profit_chk'> Profit </label> </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;"> 
                            <?php
                                $markup_chk = null;
                                
                                if (isset($data['markup'])) {
                                    $markup_chk = "checked";
                                }
                            ?>
                            <input type='checkbox' class='settings_chk' value='markup' id='markup_chk' <?php echo $markup_chk; ?>/> 
                        </td>
                        <td> <label for='markup_chk'> Markup <label> </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;"> 
                            <?php
                                $cost_chk = null;
                                
                                if (isset($data['cost'])) {
                                    $cost_chk = "checked";
                                }
                            ?>
                            <input type='checkbox' class='settings_chk' value='cost' id='cost_chk' <?php echo $cost_chk; ?>/> 
                        </td>
                        <td> <label for='cost_chk'> Cost <label></td>
                    </tr>
                    <tr>
                        <td style="text-align:center;"> 
                            <?php
                                $sup_chk = null;
                                
                                if (isset($data['supplier'])) {
                                    $sup_chk = "checked";
                                }
                            ?>
                            <input type='checkbox' class='settings_chk' value='supplier' id='sup_chk' <?php echo $sup_chk; ?>/> 
                        </td>
                        <td> <label for='sup_chk'> Supplier <label></td>
                    </tr>
                    <tr>
                        <td style="text-align:center;"> 
                            <?php
                                $supnum_chk = null;
                                
                                if (isset($data['supplier_num'])) {
                                    $supnum_chk = "checked";
                                }
                            ?>
                            <input type='checkbox' class='settings_chk' value='supplier_num' id='supnum_chk' <?php echo $supnum_chk; ?>/> 
                        </td>
                        <td> <label for='supnum_chk'> Supplier Number <label></td>
                    </tr>
                    <tr>
                        <td style="text-align:center;"> 
                            <?php
                                $manu_chk = null;
                                
                                if (isset($data['manu'])) {
                                    $manu_chk = "checked";
                                }
                            ?>
                            <input type='checkbox' class='settings_chk' value='manu' id='manu_chk' <?php echo $manu_chk; ?>/>
                        </td>
                        <td> <label for='manu_chk'> Manufacturer <label></td>
                    </tr>
                    <tr>
                        <td style="text-align:center;"> 
                            <?php
                                $manu_num_chk = null;
                                
                                if (isset($data['manu_num'])) {
                                    $manu_num_chk = "checked";
                                }
                            ?>
                            <input type='checkbox' class='settings_chk' value='manu_num' id='manu_num_chk' <?php echo $manu_num_chk; ?>/>
                        </td>
                        <td> <label for='manu_num_chk'> Manufacturer Number <label></td>
                    </tr>
                    <tr>
                        <td style="text-align:center;"> 
                            <?php
                                $desc_chk = null;
                                
                                if (isset($data['description'])) {
                                    $desc_chk = "checked";
                                }
                            ?>
                            <input type='checkbox' class='settings_chk' value='description' id='desc_chk' <?php echo $desc_chk; ?>/> 
                        </td>
                        <td> <label for='desc_chk'> Description <label></td>
                    </tr>
                    <tr>
                        <td style="text-align:center;"> 
                            <?php
                                $qty_chk = null;
                                
                                if (isset($data['qty'])) {
                                    $qty_chk = "checked";
                                }
                            ?>
                            <input type='checkbox' class='settings_chk' value='qty' id='qty_chk' <?php echo $qty_chk; ?>/> 
                        </td>
                        <td> <label for='qty_chk'> Quantity <label></td>
                    </tr>
                    <tr>
                        <td style="text-align:center;"> 
                            <?php
                                $ship_chk = null;
                                
                                if (isset($data['shipping'])) {
                                    $ship_chk = "checked";
                                }
                            ?>
                            <input type='checkbox' class='settings_chk' value='shipping' id='ship_chk' <?php echo $ship_chk; ?>/>
                        </td>
                        <td> <label for='ship_chk'> Shipping <label></td>
                    </tr>
                    <tr>
                        <td style="text-align:center;"> 
                            <?php
                                $price_chk = null;
                                
                                if (isset($data['price'])) {
                                    $price_chk = "checked";
                                }
                            ?>
                            <input type='checkbox' class='settings_chk' value='price' id='price_chk' <?php echo $price_chk; ?>/> 
                        </td>
                        <td> <label for='price_chk'> Price <label></td>
                    </tr>
                    <tr>
                        <td style="text-align:center;"> 
                            <?php
                                $ext_chk = null;
                                
                                if (isset($data['price'])) {
                                    $ext_chk = "checked";
                                }
                            ?>
                            <input type='checkbox' class='settings_chk' value='extended' id='ext_chk' <?php echo $ext_chk; ?>/> 
                        </td>
                        <td> <label for='ext_chk'> Extended <label></td>
                    </tr>  
                    <tr>
                        <td style="text-align:center;"> 
                            <?php
                                $tax_chk = null;
                                
                                if (isset($data['tax'])) {
                                    $tax_chk = "checked";
                                }
                            ?>
                            <input type='checkbox' class='settings_chk' value='tax' id='tax_chk' <?php echo $tax_chk; ?>/> 
                        </td>
                        <td> <label for='tax_chk'> Tax <label></td>
                    </tr>  
                    <tr>
                        <td style="text-align:center;">
                            <?php
                                $subgrp_chk = null;
                                
                                if (isset($data['sub'])) {
                                    $subgrp_chk = "checked";
                                }
                            ?>
                            <input type='checkbox' class='settings_chk' value='sub' id='subgrp_chk' <?php echo $subgrp_chk; ?>/> 
                        </td>
                        <td> <label for='subgrp_chk'> Sub Group <label></td>
                    </tr>  
                    <tr>
                        <td style="text-align:center;"> 
                            <?php
                                $sub_chk = null;
                                
                                if (isset($data['subitem'])) {
                                    $sub_chk = "checked";
                                }
                            ?>
                            <input type='checkbox' class='settings_chk' value='subitem' id='sub_chk' <?php echo $sub_chk; ?>/> 
                        </td>
                        <td> <label for='sub_chk'> Sub Items <label></td>
                    </tr>
                    <tr>
                        <td colspan='2'> <button class='btn btn-primary' id='saveqt_setts'> Save Quotation View </button> </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    var settings = [];
                                
    $(document).ready(function(){
        var chks = $(document).find(".settings_chk");
        var len  = chks.length;

        // console.log(chks.eq(1).prop("checked"));
        // console.log(chks.eq(2).prop("checked"));

        for(var i=0;i<=len-1;++i) {
            if ( chks.eq(i).prop("checked") ) {
                settings.push( chks.eq(i).val() );
            }
        }

       // console.log(settings);
    });

    $('.settings_chk').change(function () {
        var theval = $(this).val();

        if ($(this).prop("checked")) {
            settings.push(theval);
        } else {
            let indx  = settings.indexOf( theval );
                settings.splice(indx,1);
        }

        // console.log(settings);
    });

    $(document).on("click","#saveqt_setts", function(e){
        e.preventDefault();
        
        var qid = $(document).find("#qid").val();

        postAjax("<?php echo e(route('salesquote.saveview_sets')); ?>", { data : settings , qid : qid}, function(response){
            alert(response);
        });
    });
</script><?php /**PATH C:\xampp\htdocs\dsi_crm\Modules/Sales\Resources/views/salesquote/settings.blade.php ENDPATH**/ ?>