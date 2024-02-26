<style>
    .loader {
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 20px !important;
        height: 20px !important;
        -webkit-animation: spin 2s linear infinite; /* Safari */
        animation: spin 2s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .with_as a:hover {
        cursor:pointer;
        box-shadow: 0px 2px 3px #d1c9c9;
        position: relative;
        background: #fff;
    }

    .with_as a span {
        display:none;
    }

    .with_as a:first-child{
        border-radius: 8px 0px 0px 8px;
    }

    .with_as a:last-child {
        border-radius: 0px 8px 8px 0px;
    }
</style>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th colspan='2'> Quotation View </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <table style="width: 100%;">
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
                                            $desc_chk = null;
                                            
                                            if (isset($data['description'])) {
                                                $desc_chk = "checked";
                                            }
                                        ?>
                                        <input type='checkbox' class='settings_chk' value='description' id='desc_chk' <?php echo $desc_chk; ?>/> 
                                    </td>
                                    <td> <label for='desc_chk'> Description <label></td>
                                </tr>
                                <!-- <tr>
                                    <td style="text-align:center;">
                                        <?php
                                            // $profit_chkd = null;
                                            
                                            // if (isset($data['profit'])) {
                                            //     $profit_chkd = "checked";
                                            // }
                                        ?>
                                        <input type='checkbox' class='settings_chk' value='profit' id='profit_chk' name='profit_chk' <?php // echo $profit_chkd; ?>/> 
                                    </td>
                                    <td> <label for='profit_chk'> Profit </label> </td>
                                </tr> -->
                                <!-- <tr>
                                    <td style="text-align:center;"> 
                                        <?php
                                            // $markup_chk = null;
                                            
                                            // if (isset($data['markup'])) {
                                            //     $markup_chk = "checked";
                                            // }
                                        ?>
                                        <input type='checkbox' class='settings_chk' value='markup' id='markup_chk' <?php // echo $markup_chk; ?>/> 
                                    </td>
                                    <td> <label for='markup_chk'> Markup <label> </td>
                                </tr> -->
                                <!-- <tr>
                                    <td style="text-align:center;"> 
                                        <?php
                                            // $cost_chk = null;
                                            
                                            // if (isset($data['cost'])) {
                                            //     $cost_chk = "checked";
                                            // }
                                        ?>
                                        <input type='checkbox' class='settings_chk' value='cost' id='cost_chk' <?php // echo $cost_chk; ?>/> 
                                    </td>
                                    <td> <label for='cost_chk'> Cost <label></td>
                                </tr> -->
                                <!-- <tr>
                                    <td style="text-align:center;"> 
                                        <?php
                                            // $sup_chk = null;
                                            
                                            // if (isset($data['supplier'])) {
                                            //     $sup_chk = "checked";
                                            // }
                                        ?>
                                        <input type='checkbox' class='settings_chk' value='supplier' id='sup_chk' <?php //echo $sup_chk; ?>/> 
                                    </td>
                                    <td> <label for='sup_chk'> Supplier <label></td>
                                </tr> -->
                                <!-- <tr>
                                    <td style="text-align:center;"> 
                                        <?php
                                            // $supnum_chk = null;
                                            
                                            // if (isset($data['supplier_num'])) {
                                            //     $supnum_chk = "checked";
                                            // }
                                        ?>
                                        <input type='checkbox' class='settings_chk' value='supplier_num' id='supnum_chk' <?php // echo $supnum_chk; ?>/> 
                                    </td>
                                    <td> <label for='supnum_chk'> Supplier Part # <label></td>
                                </tr> -->
                                <!-- <tr>
                                    <td style="text-align:center;"> 
                                        <?php
                                            // $manu_chk = null;
                                            
                                            // if (isset($data['manu'])) {
                                            //     $manu_chk = "checked";
                                            // }
                                        ?>
                                        <input type='checkbox' class='settings_chk' value='manu' id='manu_chk' <?php //echo $manu_chk; ?>/>
                                    </td>
                                    <td> <label for='manu_chk'> Manufacturer <label></td>
                                </tr> -->
                                <!-- <tr>
                                    <td style="text-align:center;"> 
                                        <?php
                                            // $manu_num_chk = null;
                                            
                                            // if (isset($data['manu_num'])) {
                                            //     $manu_num_chk = "checked";
                                            // }
                                        ?>
                                        <input type='checkbox' class='settings_chk' value='manu_num' id='manu_num_chk' <?php //echo $manu_num_chk; ?>/>
                                    </td>
                                    <td> <label for='manu_num_chk'> Manufacturer Part # <label></td>
                                </tr> -->

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
                            </table>
                        </td>
                        <td>
                            <table>
                                
                                <!-- <tr>
                                    <td style="text-align:center;"> 
                                        <?php
                                            // $price_chk = null;
                                            
                                            // if (isset($data['price'])) {
                                            //     $price_chk = "checked";
                                            // }
                                        ?>
                                        <input type='checkbox' class='settings_chk' value='price' id='price_chk' <?php // echo $price_chk; ?>/> 
                                    </td>
                                    <td> <label for='price_chk'> Price <label></td>
                                </tr> -->
                                <tr>
                                    <td style="text-align:center;"> 
                                        <?php
                                            $ext_chk = null;
                                            
                                            if (isset($data['extended'])) {
                                                $ext_chk = "checked";
                                            }
                                        ?>
                                        <input type='checkbox' class='settings_chk' value='extended' id='ext_chk' <?php echo $ext_chk; ?>/> 
                                    </td>
                                    <td> <label for='ext_chk'> Extended Price <label></td>
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
                                    <td> <label for='sub_chk'> Text Within Groups <label></td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;"> 
                                        &nbsp;
                                    </td>
                                    <td> &nbsp; </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='0' style='padding-left:0px;'> 
                            <button class='btn btn-primary' id='saveqt_setts'> Save Quotation View </button>
                        </td>
                        <td class='with_as' style='padding-left:0px;text-align: right;'>
                            <a class="border-right" id="email_quote" title="Send Quotation" data-size="md" data-toggle="tooltip" title="{{ __('Comment') }}"> 
                                <i class="ti ti-send"></i> <span> Send Quotation </span> 
                            </a>
                            <a class="border-right" href="{{route('quote.pdf', [$qid])}}" target='_blank' title="Download Quotation" data-toggle="tooltip" title="{{ __('Comment') }}"> 
                                <i class="ti ti-download"></i> <span> Download Quotation </span> 
                            </a>
                            <a class="border-right" href="{{route('quote.displayquote', [$qid])}}" target='_blank' title="Preview Quotation" data-toggle="tooltip" title="{{ __('Comment') }}"> 
                                <i class="ti ti-presentation"></i> <span> Preview Quotation </span> 
                            </a>
                        </td>
                    </tr>
                    <tr id='loading_div' style='display:none;'>
                        <td colspan='2'> <div class='loader'></div> </td>
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
        $(document).find("#loading_div").show();

        var qid = $(document).find("#qid").val();

        postAjax("{{route('salesquote.saveview_sets')}}", { data : settings , qid : qid}, function(response){
            if (response) {
                alert("Settings Saved");
                $(document).find("#loading_div").hide();
            }
        });
    });
</script>