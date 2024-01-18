    <?php 
        $exp = null;

        if (isset($values['expiry'])) {
            if ($values['expiry'] != null) {
                if ($values['expiry'] < $datetoday) {
                    $exp = "expired_item";
                }
            }
        }
    
    ?>

    <tr class="subitem" data-rid="<?php echo $values['id']; ?>" data-itemorder="<?php echo $values['itemorderid']; ?>">
        <td id="<?php echo $values['id']; ?>_count" style="text-align:center"> 
           
            <?php 
                // echo $count; 
                if ($exp == "expired_item") {
                    echo " <i class='expired_item ti ti-timeline-event-x'></i>";
                }
            ?> 
        </td>
        <?php if (isset($showsettings['profit'])) { ?>
            <td id="<?php echo $values['id']."_profit"; ?>" class="number"> 
                <?php echo number_format($values['profit'],2); ?>
            </td>
        <?php } ?>
        <?php if (isset($showsettings['markup'])) { ?>
            <td> 
                <?php if (!$intextbox) { ?>
                    <select data-id="<?php echo $values['id']; ?>" data-fld="markup" class='markupchange form-control'>
                        <?php 
                            foreach($markups as $m) {
                                $the_mup  = $values['markupvalue'];
                                $selected = null;
                                
                                if ($the_mup == $m) {
                                    $selected = "selected";
                                } else {
                                    $selected = null;
                                }
                                echo "<option value='{$m}' {$selected}>{$m}</option>";
                            }
                        ?>
                    </select>
                <?php } else { ?>
                    <?php echo $values['markupvalue']; ?>
                <?php } ?>
            </td>
        <?php } ?>
        <?php if (isset($showsettings['cost'])) { ?>
            <td class="number"> 
                <?php if (!$intextbox) {?>
                    <input data-id="<?php echo $values['id']; ?>" 
                            data-fld="purchase_price" 
                            class='edittext form-control' 
                            type='text' 
                            value="<?php echo number_format($values['ccost'],2); ?>"/> 
                <?php } else { ?>
                    <?php echo number_format($values['ccost'],2); ?>
                <?php } ?>
            </td>
        <?php } ?>
        <?php if (isset($showsettings['supplier'])) { ?>
            <td> &nbsp; </td>
        <?php } ?>

        <?php if (isset($showsettings['supplier_num'])) { ?>
            <td> &nbsp; </td>
        <?php } ?>

        <?php if (isset($showsettings['manu'])) { ?>
            <td> &nbsp; </td>
        <?php } ?>

        <?php if (isset($showsettings['manu_num'])) { ?>
            <td> &nbsp; </td> 
        <?php } ?>

        <?php if (isset($showsettings['description'])) { ?>
            <td style='text-align:left;'>
                <?php if (!$intextbox) {?>
                    <textarea data-id="<?php echo $values['id']; ?>" data-fld="item" class='edittext form-control bold_input' style="text-align:left;padding-left: 5px;" type='text'><?php echo $description; ?></textarea> 
                <?php } else { ?>
                    <?php echo $description; ?>
                <?php } ?>
            </td>
        <?php } ?>

        <?php if (isset($showsettings['qty'])) { ?>
            <td style='text-align:center;'>
                <?php if (!$intextbox) {?>
                    <input data-id="<?php echo $values['id']; ?>" data-fld="quantity" style="text-align:center;" class='edittext form-control' type='text' value="<?php echo $qty; ?>"/>
                <?php } else { ?>
                    <?php echo $qty; ?>
                <?php } ?> 
            </td>
        <?php } ?>

        <?php if (isset($showsettings['shipping'])) { ?>
            <td class="number"> 
                <?php echo number_format($values['shippingfee'],2); ?> 
            </td> 
        <?php } ?>

        <?php if (isset($showsettings['price'])) { ?>
            <td class="number" id="<?php echo $values['id']."_price"; ?>"> 
                <?php echo number_format($values['price'],2); ?> 
            </td>
        <?php } ?>

        <?php if (isset($showsettings['extended'])) { ?>
            <td class="number" id="<?php echo $values['id']."_extended"; ?>"> 
                <?php echo number_format($values['extended'],2); ?> 
            </td> 
        <?php } ?>

        <?php if (isset($showsettings['tax'])) { ?>
            <td id="<?php echo $values['id']."_tax_value"; ?>" class="number"> 
                <?php echo number_format($values['tax_value'],2); ?> 
            </td>
            <td style="text-align:center;">
                <input type='checkbox' 
                       data-id="<?php echo $values['id']; ?>"
                       class='taxcheck'/>
            </td>
        <?php } ?>

    </tr>
<?php /**PATH C:\xampp\htdocs\DSI_crm\Modules/Sales\Resources/views/salesquote/quote_item.blade.php ENDPATH**/ ?>