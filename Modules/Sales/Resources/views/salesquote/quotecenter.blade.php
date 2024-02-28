<style>
    #table_quotecenter tr:hover {
        background:#ccc;
        cursor:pointer;
    }
</style>

<div class='row'>
    <div class='col-md-12'>
        <table id='table_quotecenter' class="table pc-dt-simple">
            <thead>
                <th> # </th>
                <th> Name </th>
            </thead>
            <?php

            //  var productline_id = res[0].category_id;
            //  var description    = res[0].description;
            //  var ccost          = res[0].purchase_price;
            //  var cmarkup        = res[0].markup;
            //  var cquantity      = 1;
            //  var shippingfee    = 0;
            //  var istaxable      = false;

                $count = 1;
                foreach($collection as $c) {
                    echo "<tr class='savetoitem' 
                              data-itemid          = '{$c->id}' 
                              data-catid           = '{$c->category_id}'
                              data-desc            = '{$c->description}'
                              data-cost            = '{$c->purchase_price}'
                              data-cmarkup         = '{$c->markup}'
                              data-istax           = '".strtolower($c->the_tax->name)."'
                              data-supply_title    = 'Supplier' 
                              data-supply_label    = '{$c->supplier_name}' 
                              data-supply_descs    = '{$c->supplier_part_number}' 
                              data-manu_title      = 'Manufacturer' 
                              data-manu_label      = '{$c->manufacturer_name}' 
                              data-manu_descs      = '{$c->manufacturer_part_number}'
                              >";
                        echo "<td>".$count++."</td>";
                        echo "<td> {$c->description} </td>";
                    echo "</tr>";
                }
            ?>
            <tr id='loading_div_ct' style='display:none;'>
                <td colspan='2'>
                    <span style='position: absolute;left: 20px;'>
                        <div class='loader'></div>
                    </span>
                </td>
            </tr>
        </table>
    </div>
</div>
<script>
    $(document).ready(function(){
        const dataTable = new simpleDatatables.DataTable("#table_quotecenter");
    });
</script>