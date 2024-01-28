    <tr class="subitem" data-rid="<?php echo $values['id']; ?>">
        <td style="text-align:center" id="<?php echo $values['id']; ?>_count"> <?php // echo $count; ?> </td>
        <td> &nbsp; </td>
        <td> &nbsp; </td>
        <td> &nbsp; </td>
        <td> &nbsp; </td>
        <td> &nbsp; </td>
        <td> &nbsp; </td>
        <td> &nbsp; </td> 
        <td> 
            <?php if ($type == "comment") { ?>
                <textarea  data-id="<?php echo $values['id']; ?>" data-fld="item" style="text-align:left; padding-left:5px;" class='edittext form-control bold_input' type='text'><?php echo $description; ?></textarea>
            <?php } else { ?>
                <span style="float:left; color:#999;padding: 10px 0px;font-style: italic; "> <?php echo $description; ?> </span>
            <?php } ?>
        </td>
        <td> &nbsp; </td>
        <td> &nbsp; </td> 
        <td> &nbsp; </td>
        <td> &nbsp; </td> 
        <td> &nbsp; </td>
        <td> &nbsp; </td>
    </tr>
<?php /**PATH C:\xampp\htdocs\dsi_crm\Modules/Sales\Resources/views/salesquote/novalueitem.blade.php ENDPATH**/ ?>