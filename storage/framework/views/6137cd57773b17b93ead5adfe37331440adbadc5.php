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
                <input data-id="<?php echo $values['id']; ?>" data-fld="item" style="text-align:left;" class='edittext form-control bold_input' type='text' value="<?php echo $description; ?>"/> 
            <?php } else { ?>
                <span style="float:left; color:#999;padding: 2px 0px;font-style: italic;"> <?php echo $description; ?> </span>
            <?php } ?>
        </td>
        <td> &nbsp; </td>
        <td> &nbsp; </td> 
        <td> &nbsp; </td>
        <td> &nbsp; </td> 
        <td> &nbsp; </td>
    </tr>
<?php /**PATH C:\xampp\htdocs\DSI_Laravel\Modules/Sales\Resources/views/salesquote/novalueitem.blade.php ENDPATH**/ ?>