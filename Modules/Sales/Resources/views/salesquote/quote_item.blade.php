    <?php 
        $exp    = null;
        $status = null;

        if (isset($values['expiry'])) {
            if ($values['expiry'] != null) {
                if ($values['expiry'] < $datetoday) {
                    $exp = "expired_item";
                }
            }
        }

        if (isset($values['status'])) {
            if ($values['status'] == "for approval") {
                $status = "fapproval";
            } else if ($values['status'] == "declined") {
                $status = "declined";
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

                if ($status == "fapproval") {
                    echo "<i class='ti ti-loader-2' style='color:red; font-size: 25px;'></i>";
                } else if ($status == "declined") {
                    echo "<i class='ti ti-thumb-down' style='color:red; font-size: 25px;'></i>";
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
                    <select data-grpid="<?php echo $values['subtotal_gpr']; ?>" data-id="<?php echo $values['id']; ?>" data-fld="markup" class='markupchange form-control'>
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
                            data-grpid="<?php echo $values['subtotal_gpr']; ?>"
                            value="<?php echo number_format($values['ccost'],2); ?>"/> 
                <?php } else { ?>
                    <?php echo number_format($values['ccost'],2); ?>
                <?php } ?>
            </td>
        <?php } ?>

        <?php 
            if (count($values['otherinfo']) > 0) {
                if ($values['otherinfo'][0]->title =="Supplier") {
                    echo "<td>";
                        echo "<textarea data-id='{$values['otherinfo'][0]->id}' data-fld = 'description' class='otherinfo_text form-control left-it'>{$values['otherinfo'][0]->description}</textarea>";
                    echo "</td>";
                    echo "<td>";
                        echo "<textarea data-id='{$values['otherinfo'][0]->id}' data-fld = 'label' class='otherinfo_text form-control left-it'>{$values['otherinfo'][0]->label}</textarea>";
                    echo "</td>";

                    if (isset($values['otherinfo'][1])) {
                        if ($values['otherinfo'][1]->title == "Manufacturer") {
                            echo "<td>";
                                echo "<textarea data-id='{$values['otherinfo'][1]->id}' data-fld = 'description' class='otherinfo_text form-control left-it'>{$values['otherinfo'][1]->description}</textarea>";
                            echo "</td>";
                            echo "<td>";
                                echo "<textarea data-id='{$values['otherinfo'][1]->id}' data-fld = 'label' class='otherinfo_text form-control left-it'>{$values['otherinfo'][1]->label}</textarea>";
                            echo "</td>";
                        }
                    } else {
                        echo "<td> &nbsp; </td>";
                        echo "<td> &nbsp; </td>";
                    }
                } else if ($values['otherinfo'][0]->title == "Manufacturer") {
                    if (isset($values['otherinfo'][1])) {
                        if ($values['otherinfo'][1]->title == "Supplier") {
                            echo "<td>";
                                echo "<textarea data-id='{$values['otherinfo'][1]->id}' data-fld = 'description' class='otherinfo_text form-control left-it'>{$values['otherinfo'][1]->description}</textarea>";
                            echo "</td>";
                            echo "<td>";
                                echo "<textarea data-id='{$values['otherinfo'][1]->id}' data-fld = 'label' class='otherinfo_text form-control left-it'>{$values['otherinfo'][1]->label}</textarea>";
                            echo "</td>";
                        }
                    } else {
                        echo "<td> &nbsp; </td>";
                        echo "<td> &nbsp; </td>";
                    }

                    echo "<td>";
                        echo "<textarea data-id='{$values['otherinfo'][0]->id}' data-fld = 'description' class='otherinfo_text form-control left-it'>{$values['otherinfo'][0]->description}</textarea>";
                    echo "</td>";
                    echo "<td>";
                        echo "<textarea data-id='{$values['otherinfo'][0]->id}' data-fld = 'label' class='otherinfo_text form-control left-it'>{$values['otherinfo'][0]->label}</textarea>";
                    echo "</td>";
                }

               
            } else {
                if (isset($showsettings['supplier'])) {
                    echo "<td> &nbsp; </td>";
                }

                if (isset($showsettings['supplier_num'])) { 
                    echo "<td> &nbsp; </td>";
                }

                if (isset($showsettings['manu'])) {
                    echo "<td> &nbsp; </td>";
                }

                if (isset($showsettings['manu_num'])) {
                    echo "<td> &nbsp; </td>";
                }
            }
        ?>

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
                    <input data-id="<?php echo $values['id']; ?>" 
                           data-grpid="<?php echo $values['subtotal_gpr']; ?>"
                           data-fld="quantity" style="text-align:center;" class='edittext form-control' type='text' value="<?php echo $qty; ?>"/>
                <?php } else { ?>
                    <?php echo $qty; ?>
                <?php } ?> 
            </td>
        <?php } ?>

        <?php if (isset($showsettings['shipping'])) { ?>
            <td class="number"> 
                <?php if (!$intextbox) {?>
                    <input data-id="<?php echo $values['id']; ?>" 
                           data-grpid="<?php echo $values['subtotal_gpr']; ?>"
                           data-fld="shippingfee" style="text-align:center;" class='edittext_ship form-control' type='text' value="<?php echo $values['shippingfee']; ?>"/>
                <?php } else { ?>
                    <?php 
                        echo $values['shippingfee'];
                        // echo number_format( $values['shippingfee'],2);
                    ?>
                <?php } ?> 
                <?php // echo number_format($values['shippingfee'],2); ?> 
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
                <?php
                    $ischecked = "checked";

                    if ($values['tax_value'] == 0) {
                        $ischecked = null;
                    }
                ?>
                <input type='checkbox' 
                       data-id="<?php echo $values['id']; ?>"
                       class='taxcheck' <?php echo $ischecked; ?>/>
            </td>
        <?php } ?>

    </tr>
