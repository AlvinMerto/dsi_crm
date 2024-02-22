<style>
    #company_table tr:hover {
        background:#e5e5e5;
        cursor:pointer;
    }

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
                    <span id='loading_div_ct' style='display:none;'>
                        <div class='loader'></div>
                    </span>
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
        $(document).find("#load").remove();

        $("<tr id='load'> <td colspan=2> Loading .. </td> </tr>").insertAfter(dis);

        postAjax("{{route('show.contact')}}", { data : theid }, function(response){
            $(document).find("#load").remove();
            
            $(response).insertAfter(dis);
        }); 
    });

    $(document).on("click",".copynow", function(){
        var contid = $(this).data("contid");
        var qtid   = $(document).find("#qt_text").val();

        $(document).find("#loading_div_ct").show();

        postAjax("{{route('quotecontroller.savetonewcustomer')}}",{comp_id : theid, contid : contid, qtid : qtid}, function(response) {
            alert("Successfully copied to new customer");
            window.location.href = "{{route('salesquote.showquote')}}/"+response;
        });
    });

</script>