    <tr class="subitem" data-rid="<?php echo $values['id']; ?>">
        <td style="text-align:center" id="<?php echo $values['id']; ?>_count"> <?php // echo $count; ?> </td>
        <?php if (isset($showsettings['profit'])) { ?>
            <td> &nbsp; </td>
        <?php } ?>
        <?php if (isset($showsettings['markup'])) { ?>
            <td> &nbsp; </td>
        <?php } ?>

        <?php if (isset($showsettings['cost'])) { ?>
            <td> &nbsp; </td>
        <?php } ?>

        <?php if (isset($showsettings['shipping'])) { ?>
            <td> &nbsp; </td>
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
        <td colspan='0'> 
            <?php if ($type == "comment") { ?>
                <?php if ($intextbox) { ?>
                    <textarea  data-id="<?php echo $values['id']; ?>" data-fld="item" style="text-align:left; padding-left:5px;" class='edittext form-control bold_input' type='text'><?php echo $description; ?></textarea>
                <?php } else { ?>
                    <span style="float:left; color:#999;padding: 4px 0px;font-style: italic; "> <?php echo $description; ?> </span>
                <?php } ?>
            <?php } else { ?>
                <?php if ($intextbox) { ?>
                    <span style="float:left; color:#999;padding: 4px 0px;font-style: italic; "> <?php echo $description; ?> </span>
                <?php } else { ?>
                    <span> &nbsp; </span>
                <?php } ?>
            <?php } ?>
        </td>
        <?php if (isset($showsettings['qty'])) { ?>
            <td> &nbsp; </td>
        <?php } ?>
        
        <?php if (isset($showsettings['price'])) { ?>
            <td> &nbsp; </td>
        <?php } ?>
        <?php if (isset($showsettings['extended'])) { ?>
            <td> &nbsp; </td>
        <?php } ?>
        <?php if (isset($showsettings['tax'])) { ?>
            <!-- <td> &nbsp; </td> -->
        <?php } ?>
        <?php if (isset($showsettings['tax'])) { ?>
            <!-- <td> &nbsp; </td> -->
        <?php } ?>
    </tr>
<?php /**PATH C:\xampp\htdocs\dsi_crm\Modules/Sales\Resources/views/salesquote/novalueitem.blade.php ENDPATH**/ ?>