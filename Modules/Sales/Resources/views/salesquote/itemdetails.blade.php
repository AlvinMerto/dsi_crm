<style>
    .table_cust {
        width:100%;
    }

    .table_cust tr:nth-child(2n+2) {
        background:#eaeaea;
    }

    .table_cust tr th {
        vertical-align:top;
    }

    .table_cust tr td,.table_cust tr th {
        padding: 6px;
    }

</style>
<div class="modal-body pt-0">
    <div class="row">
        <div class="col-md-12">
            <table class="table_cust">
                <!-- <thead>
                    <th colspan='2'> <h4 class="card-title">Information</h4> </th>
                </thead>  -->
                <tbody> 
                    <tr>
                        <th> Description </th>
                        <td> <?php echo $quoteitems[0]->item; ?> </td>
                    </tr>
                    <tr>
                        <th> Cost </th>
                        <td> <?php echo number_format($quoteitems[0]->purchase_price,2); ?> </td>
                    </tr>
                    <tr>
                        <th> Mark up </th>
                        <td> <?php echo $quoteitems[0]->markup; ?>% </td>
                    </tr>
                    <tr>
                        <th> Quantity </th>
                        <td> <?php echo $quoteitems[0]->quantity; ?> </td>
                    </tr>
                    <tr>
                        <th> Shipping Fee </th>
                        <td> <?php echo number_format($quoteitems[0]->shippingfee,2); ?> </td>
                    </tr>
                    <tr>
                        <th> Tax </th>
                        <td> <?php echo $quoteitems[0]->itemtaxprice; ?> </td>
                    </tr>
                    <tr>
                        <th> Price </th>
                        <td> <?php echo number_format($quoteitems[0]->price,2); ?> </td>
                    </tr>
                    <tr>
                        <th> Expiry Date </th>
                        <td>
                            <?php
                                // if ( $quoteitems[0]->endoflife == null) {
                                    echo "<input  type='date' id='theexpirydate' class='form-control' value='{$quoteitems[0]->endoflife}' data-r='{$itemid}'/>";
                                //} 
                            ?> 
                        </td>
                    </tr>
                    <tr>
                        <th colspan='2'> Additional Information </th>
                    </tr>
                    <tbody id='additional_info_tbody'>
                        <?php echo $additionalinfo;  ?>
                    </tbody>
                    <tr>
                        <th colspan='2'> Add new Information </th>
                    </tr>
                    <tr> 
                        <td> 
                            <input type='text' class="form-control" list='thetitles' id='texttitle' placeholder='Title' hint="Title of the information"/> 
                            <datalist id='thetitles'>
                                <option value='Manufacturer'>
                                <option value='Supplier'>
                            </datalist>
                        </td>
                         <td> 
                            <input type='text' class="form-control" id='textlabel' placeholder='Label' hint='Label you want to use'/> 
                        </td>
                    <tr>
                    <tr>
                        <td colspan='2'> 
                            <textarea class="form-control" id="textdesc" placeholder='Description'></textarea>
                            <!-- <input type='text' class="form-control" id="textdesc" placeholder='Description' hint='Description of the product'/>  -->
                        </td>
                    </tr>
                    <tr> 
                        <td> 
                            <input type='button' class='btn btn-primary' value="Add Information" id="addnewinformation" data-r="<?php echo $itemid; ?>"/> 
                        </td>
                        <!-- <td> 
                            <input type='button' class='btn btn-danger' value='Delete this item' id='deletethis'/>
                        </td> -->
                    </tr>
                </tbody>
                <tbody id='loading_tbody' style='display:none; position: absolute;left: 20px;'>
                    <tr>
                        <td>
                            <span>
                                <div class='loader'></div>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $(document).find("#exampleModalLongTitle").html("Item Details")
    })
</script>