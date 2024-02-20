<style>
    #company_table tr:hover {
        background:#e5e5e5;
        cursor:pointer;
    }
</style>
<div class="modal-body" style='padding-left:0px; padding-right:0px; padding-top:0px;'>
    <div class="row">
        <div class="col-md-12">
            <input type='hidden' value='<?Php echo $qt_id; ?>' id='qt_text'/>
            <table class='table pc-dt-simple' id='company_table'>
                <thead>
                    <th style='text-align:center;'> # </th>
                    <th> Company Name </th>
                </thead>
                <tbody>
                    <?php
                        $count = 1;
                        foreach($salesacc as $ac) {
                            echo "<tr data-sid='{$ac->id}' class='showcontacts'>";
                                echo "<td style='text-align:center;'>";
                                    echo $count++;
                                echo "</td>";
                                echo "<td>";
                                    echo $ac->name;
                                echo "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        const dataTable = new simpleDatatables.DataTable("#company_table");
    });

    var theid = null;

    $(document).on("click",".showcontacts", function(){
        theid = $(this).data("sid");
        var dis   = $(this);

        $(document).find(".hrow").remove();
        $("<tr id='load'> <td colspan=2> Loading .. </td> </tr>").insertAfter(dis);

        postAjax("<?php echo e(route('show.contact')); ?>", { data : theid }, function(response){
            $(document).find("#load").remove();
            
            $(response).insertAfter(dis);
        }); 
    });

    $(document).on("click",".copynow", function(){
        var contid = $(this).data("contid");
        var qtid   = $(document).find("#qt_text").val();

        postAjax("<?php echo e(route('quotecontroller.savetonewcustomer')); ?>",{comp_id : theid, contid : contid, qtid : qtid}, function(response) {
            console.log(response);
        });
    });
</script><?php /**PATH C:\xampp\htdocs\dsi_crm\Modules/Sales\Resources/views/quote/copytonewcust.blade.php ENDPATH**/ ?>