<script>
    var selector = "body";
    var trs      = []; // array for the list of tr

    $.fn.isInViewport = function() {
        var elementTop = $(this).offset().top;
        var elementBottom = elementTop + $(this).outerHeight();

        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();

        return elementBottom > viewportTop && elementTop < viewportBottom;
    };

    if ($(selector + " .repeater").length) {
        var $dragAndDrop = $("body .repeater tbody").sortable({
            handle: '.sort-handler'
        });
        var $repeater = $(selector + ' .repeater').repeater({
            initEmpty: false,
            defaultValues: {
                'status': 1
            },
            show: function() {
                $(this).slideDown();
                var file_uploads = $(this).find('input.multi');
                if (file_uploads.length) {
                    $(this).find('input.multi').MultiFile({
                        max: 3,
                        accept: 'png|jpg|jpeg',
                        max_size: 2048
                    });
                }
                // for item SearchBox ( this function is  custom Js )
                JsSearchBox();
            },
            hide: function(deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                    $(this).remove();

                    var inputs = $(".amount");
                    var subTotal = 0;
                    for (var i = 0; i < inputs.length; i++) {
                        subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                    }
                    $('.subTotal').html(subTotal.toFixed(2));
                    $('.totalAmount').html(subTotal.toFixed(2));
                }
            },
            ready: function(setIndexes) {
                $dragAndDrop.on('drop', setIndexes);
            },
            isFirstItemUndeletable: true
        });
        var value = $(selector + " .repeater").attr('data-value');
        if (typeof value != 'undefined' && value.length != 0) {
            value = JSON.parse(value);
            $repeater.setList(value);
        }
    }

    if ($(selector + " .quote-repeater").length) {

        var $dragAndDrop = $("body .quote-repeater tbody").sortable({
            handle: '.sort-handler'
        });

        var $repeater = $(selector + ' .quote-repeater').repeater({
            repeaters: [{
                selector: '.inner-repeater',
            }],

            initEmpty: false,
            defaultValues: {
                'status': 1
            },

            show: function() {
                $(this).slideDown();
                var file_uploads = $(this).find('input.multi');
                if (file_uploads.length) {
                    $(this).find('input.multi').MultiFile({
                        max: 3,
                        accept: 'png|jpg|jpeg',
                        max_size: 2048
                    });
                }
                // for item SearchBox ( this function is  custom Js )
                JsSearchBox();
            },
            hide: function(deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                    $(this).remove();

                    var inputs = $(".amount");
                    var subTotal = 0;
                    for (var i = 0; i < inputs.length; i++) {
                        subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                    }
                    $('.subTotal').html(subTotal.toFixed(2));
                    $('.totalAmount').html(subTotal.toFixed(2));
                }
            },
            ready: function(setIndexes) {
                $dragAndDrop.on('drop', setIndexes);
            },
            isFirstItemUndeletable: true
        });

        var value = $(selector + " .quote-repeater").attr('data-value');

        if (typeof value != 'undefined' && value.length != 0) {
            value = JSON.parse(value);
            $repeater.setList(value);
        }

    }

</script>
<?php if($type=="salesquote"): ?>



<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" />

<style>
    #tblLocations tbody tr td {
        border:1px solid #ccc;
        padding-left:3px !important;
        padding-right:3px !important;
    }

    #tblLocations tbody tr td select {
        padding: 0px;
        font-size:12px;
        text-align:center;
    }

    #tblLocations tbody tr td textarea {
        resize:none;
    }

    #tblLocations tbody tr td,
    #tblLocations tbody tr td input,
    #tblLocations tbody tr td textarea {
        padding: 0px;
        font-size:12px;
        text-align:right;
        background:transparent;
    }

    #tblLocations tbody tr td input, 
    #tblLocations tbody tr td select {
        padding:4px;
        background:transparent;
    }

    td.number {
        text-align:right;
    }

    td p {
        padding-right:10px;    
    }

    .expired_item {
        border:2px solid red;
        color:red;
    }

    .textsubtotal, .markupchange {
        border:0px;
        outline:none;
    }

    .bold_input {
        font-weight:bold;
    }
    
    .border-right {
        border: 1px solid #e0e0e0;
        color: #767575;
        padding: 7px 15px;
        margin-right: -5px;
        background: #fff;
    }

    .border-right i {
        font-size: 18px;
        position: relative;
        top: 2px;
        margin-right: 5px;
    }

    .selectedTr {
        background:#eee !important;
    }

    .with_as a:hover {
        cursor:pointer;
        box-shadow: 0px 2px 3px #d1c9c9;
        position: relative;
        background: #fff;
    }

    .with_as a:first-child{
        border-radius: 8px 0px 0px 8px;
    }

    .with_as a:last-child {
        border-radius: 0px 8px 8px 0px;
    }

    .floatit_nav{
        position: fixed;
        top: 10px;
        width: 77%;
        background: #ebebeb;
        padding: 10px 5px;
        z-index: 1000;
        border-radius: 7px;
        box-shadow: 0px 3px 6px #00000057;
        border: 1px solid #d2cfcf;
    }

</style>
    <script>
        function replaceKeyAtIndex(originalName, newPosition, newKey) {
            var parts = originalName.split('][');
            if (newPosition < 0 || newPosition >= parts.length) {
                return originalName;
            }
            parts[newPosition] = newKey;
            var newName = parts.join('][');
            return newName;
        }

        function replaceKeyAtIndexs(originalName, position1, position2, newKey1, newKey2) {
            var parts = originalName.split('][');
            if (position1 < 0 || position1 >= parts.length || position2 < 0 || position2 >= parts.length) {
                return originalName;
            }
            parts[position1] = newKey1.toString();
            parts[position2] = newKey2.toString();
            var newName = "[" + parts.join("][");
            return "quote"+newName;
        }

        $(document).on('click','.duplicate-item',function () {
            var clickedRow = $(this).parent().parent();
            var data_id=$(this).parent().parent().attr('main-data');
            var clonedRow = clickedRow.clone();
            clonedRow.insertAfter(clickedRow);
            var sub_id=parseInt(0);
            $( ".data_"+data_id ).each(function( index ,value) {
                $(this).attr('data-sub-id',sub_id);
                $(this).find('*').each(function () {
                    var elementType = this.tagName.toLowerCase();
                    if (elementType == 'input') {
                        var name=$(this).attr('name');
                        var newName = replaceKeyAtIndex(name, 1, sub_id);
                        $(this).attr('name', newName);
                    } else if (elementType === 'select') {
                        var name=$(this).attr('name');
                        var newName = replaceKeyAtIndex(name, 1, sub_id);
                        $(this).attr('name', newName);
                    }
                });
                sub_id=sub_id+parseInt(1);
            });
            $(".item").trigger('change');
        });
        
        $(function () {
            var qid = $(document).find("#qid").val();

            $(document).on("click","#tblLocations tbody tr.subitem", function(){

                var id = $(this).data("rid");

                var state = $(this).hasClass("selectedTr");

                if (state == true || state == "true") {
                    let indx  = trs.indexOf( id );
                    trs.splice(indx,1);

                    $(this).removeClass("selectedTr");
                    $(document).find(".viewdetails").hide();
                    $(document).find(".copythis").hide();
                    $(document).find(".deletethis").hide();
                } else if (state == false || state == "false") {
                    
                    trs.push( id );
                     
                    $(this).addClass("selectedTr");
                    $(document).find(".viewdetails").show();
                    $(document).find(".deletethis").show();
                    $(document).find(".copythis").show();
                }

                if (trs.length > 1 || trs.length == 0) {
                    $(document).find(".viewdetails").hide();
                    $(document).find(".copythis").hide();
                } else if (trs.length == 1 ) {
                    $(document).find(".viewdetails").show();
                    $(document).find(".copythis").show();
                }
                
                if (trs.length > 0) {
                    $(document).find(".deletethis").show();
                } else if (trs.length == 0) {
                    $(document).find(".deletethis").hide();
                }
            });

            var d_id    = null; // item ID
            var t_id    = null; // group id :: under the field 'type'
            var orig_id = null;
            var orig_order = null;
            
            $("#tblLocations").sortable({
                items : 'tbody.sub_tbody',
                cursor: "pointer",
                axis: "y",
                dropOnEmpty: false,
                placeholder: "ui-state-highlight",
                start: function (e, ui) {
                    ui.item.addClass("selected");
                },
                stop : function(e,ui) {

                }
            });

            $("#tblLocations").sortable({
                items: 'tbody tr.subitem',
                cursor: 'pointer',
                axis: 'y',
                dropOnEmpty: false,
                placeholder: "ui-state-highlight",
                start: function (e, ui) {
                    ui.item.addClass("selected");
                    d_id    = ui.item.data("rid");
                    
                    orig_id = ui.item.parent().data('tid');

                    var data   = {
                        "fld"     : "grp_id",
                        "id"      : d_id,
                        "theval"  : null,
                        "table"   : "sales_quotes_items"
                    };

                    postAjax("<?php echo e(route('salesquote.update_fld')); ?>", data, function(response){
                        compute_subs(orig_id);
                    });
                },
                stop: function (e, ui) {
                    var order_to_use = ui.item.eq().prevObject[0].rowIndex;

                    var updateorder = {
                        "quote_id"      : qid,
                        "order_to_use"  : order_to_use,
                        "item_id"       : d_id 
                    };

                    console.log(order_to_use);

                    postAjax("<?php echo e(route('salesquote.set_order')); ?>", updateorder, function(response){
                        console.log(response);
                    });

                    var disitem = ui.item.parent().index();

                    t_id       = ui.item.parent().data('tid');

                    if (t_id == null) {
                        t_id = orig_id;
                    }

                    var data   = {
                        "fld"     : "grp_id",
                        "id"      : d_id,
                        "theval"  : t_id,
                        "table"   : "sales_quotes_items"
                    };

                    //  console.log(data);
                    
                    postAjax("<?php echo e(route('salesquote.update_fld')); ?>", data, function(response){
                        // console.log(response);
                        compute_subs(t_id);
                    });

                    // console.log(d_id);
                    // console.log(ui.item.parent().data("tid"));

                    // ui.item.removeClass("selected");
                    // $(this).find("tr").each(function (index) {
                        // if (index > 0) {
                        //     $(this).find("td").eq(2).html(index);
                        // }
                    // });
                    // setTimeout(function () {
                    //     var data_id=parseInt(0);
                    //     var sub_id=parseInt(0);
                    //     $('.add-sublist').each(function () {
                    //         if($(this).data('id'))
                    //         {
                    //             data_id=$(this).data('id');
                    //             sub_id=parseInt(0);
                    //         }
                    //         $(this).attr('main-data',data_id);
                    //         if($(this).attr('sub-data-id'))
                    //         {
                    //             $(this).attr('sub-data-id',data_id);
                    //         }
                    //         $(this).attr('data-sub-id',sub_id);

                    //         $(this).find('*').each(function () {
                    //             var elementType = this.tagName.toLowerCase();

                    //             if (elementType == 'input') {
                    //                 var name=$(this).attr('name');
                    //                 var newName = replaceKeyAtIndexs(name,0,1,data_id,sub_id);
                    //                 $(this).attr('name', newName);
                    //             } else if (elementType === 'select') {
                    //                 var name=$(this).attr('name');
                    //                 var newName = replaceKeyAtIndexs(name,0,1,data_id,sub_id);
                    //                 $(this).attr('name', newName);
                    //             }
                    //         });
                    //         sub_id=sub_id+parseInt(1);
                    //     });
                    //     $(".item").trigger('change');
                    // }, 0);
                }
            });
        });

        function compute_subs(grp_id) {
            postAjax("<?php echo e(route('salesquote.compute_subtotal')); ?>", {grp_id:grp_id}, function(response){

                $(document).find("#"+grp_id+"_profit").html( numberWithCommas( response['subs'][0].profit) );
                $(document).find("#"+grp_id+"_cost").html( numberWithCommas( response['subs'][0].cost) );
                $(document).find("#"+grp_id+"_gp").html( numberWithCommas( response['subs'][0].gp)+"%" );
                $(document).find("#"+grp_id+"_qty").val( numberWithCommas( response['subs'][0].qty) );

                $(document).find("#"+grp_id+"_price").val( numberWithCommas( response['sales'][0].price) );
                $(document).find("#"+grp_id+"_shippingfee").val( numberWithCommas( response['sales'][0].shippingfee) );
                $(document).find("#"+grp_id+"_amount").val( numberWithCommas( response['sales'][0].extended) );
            });
        }

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
        }

        $(".subtotal").on("click",function () {
            var lastRow = $(".add-sublist").last();

            var dataId = parseFloat($('.add-sublist[data-id]:last').attr('data-id'));
            var substop= $('.subtotal_description:last').hasClass('substop');
            var substart= $('.subtotal_description:last').hasClass('substart');
            if(substop==true || isNaN(dataId))
            {
                var type="substart";
                var data={'id':dataId,'type':type};
                postAjax("<?php echo e(route('salesquote.getsubtotal')); ?>", data, function(response){

                    if(response.success==true)
                    {
                        $('.add-list').append(response.data);
                    }
                });
            }
        });

        $(".substart_click").on("click", function(){
            // $(this).addClass("selectedTr");
           
        });

        $(".subtotal_").on("click", function(){
           // addthis_subitem
            var qid            = $(document).find("#qid").val();

            if (trs.length == 0) {
                alert("Item selection is empty. Please select one or two items."); 
                return;
            }

            postAjax("<?php echo e(route('salesquote.create_subtotal')); ?>", {ids : trs}, function(response){
               
                 $("#tblLocations").children().remove();
                 showquote_items(qid);

                 trs = [];
            });
        });

        $(document).on("click",".taxcheck", function(){
            var tr_id = $(this).data("id");
            var qt    = $(document).find("#qid").val();

            var data = {
                "table"      : "sales_quotes_items",
                "id"         : tr_id,
                "istaxable"  : null
            };

            if ( $(this).is(":checked") ){
                data['istaxable'] = true;
            } else {
                data['istaxable'] = false;
            }

           // console.log(data); return;

            postAjax("<?php echo e(route('quote.updatetax')); ?>", data, function(response){
                $(document).find("#"+tr_id+"_tax_value").html(response);
                get_computetotal( qt );
            });
        });

        function load_quote(qid) {
            postAjax("<?php echo e(route('salesquote.getquote_items')); ?>",{qid:qid}, function(response) {
                appendTolist(response);
            });
        }

        $(".substop").on("click",function () {
            var lastRow = $(".add-sublist").last();

            var dataId = $('.add-sublist[data-id]:last').attr('data-id');
            var datasubid=lastRow.attr("data-sub-id");

            var substop= $('.subtotal_description:last').hasClass('substop');
            var substart= $('.subtotal_description:last').hasClass('substart');
            if(substop==false && substart==true)
            {
                var type="substop";
                var data={'id':dataId,'type':type,'datasubid':datasubid};
                postAjax("<?php echo e(route('salesquote.getsubtotal')); ?>", data, function(response){

                    if(response.success==true)
                    {
                        $('.add-list').append(response.data);
                    }
                });
            }
        });

        $(".subitem_").on("click",function () {
            var lastRow = $(".add-sublist").last();

            var dataId = $('.add-sublist[data-id]:last').attr('data-id');
            var datasubid=$('.add-sublist[data-sub-id]:last').attr("data-sub-id");

            var substart= $('.subtotal_description:last').hasClass('substart');
            if(substart==true)
            {
                var type="subitem";
                var data={'id':dataId,'type':type,'datasubid':datasubid};
                postAjax("<?php echo e(route('salesquote.getsubtotal')); ?>", data, function(response){

                    if(response.success==true)
                    {
                        $('.add-list').append(response.data);
                    }
                });
            }
        });

        $(".subcomment_").on("click",function () {
            var dataId = $('.add-sublist[data-id]:last').attr('data-id');
            var datasubid=$('.add-sublist[data-sub-id]:last').attr("data-sub-id");
            // var substart= $('.subtotal_description:last').hasClass('substart');
            // if(substart==true)
            // {
                var type="subcomment";
                var data={'id':dataId,'type':type,'datasubid':datasubid};
                postAjax("<?php echo e(route('salesquote.getsubtotal')); ?>", data, function(response){

                    if(response.success==true)
                    {
                        $('.add-list').append(response.data);
                    }
                });
            // }
        });

        function get_no_value(id, somefunc = false) {
            postAjax("<?php echo e(route('quote.getnovalue')); ?>", {item_id:id}, function(response){
                appendTolist(response);
                
                if (somefunc != false) {
                    somefunc();
                }
            });
        }

        $(document).on("click","#savecomment",function(){
            var comment = $(document).find("#commenttxt").val();

            savethis({
                "type"              : "comment",
                "ccost"             : 0,
                "quote_id"          : $(document).find("#qid").val(),
                "item"              : comment,
                "markup"            : 0,
                "quantity"          : 0,
                "taxable"           : false
            },"sales_quotes_items", function(id){
                savethis({
                    "itemid"                 : id,
                    "product_services_id"    : 1,
                    "shippingfee"            : 0,
                    "endoflife"              : null,
                    "markupstatus"           : "approved"
                },"sales_quotes_item_info_more_flds");

                get_no_value(id, function(){
                    $('#commonModal').modal('hide');
                });
            });
        });

         $(document).on("click","#savelabor", function(){
            var laborval = $(document).find("#labortxt").val();
            var qid      = $(document).find("#qid").val();
            var markup   = $(document).find("#markupvalue_labor").val();
            var qty      = $(document).find("#qtytxt_labor").val();
            var price    = 0;
            
            var istaxable = null;

            if ( $(document).find("#istaxable").is(":checked") ) {
                istaxable = true;
            } else {
                istaxable = false;
            }

            var data = {
                'qid'             : qid,
                "productlineid"   : 1,
                "type"            : "labor",
                "description"     : "labor",
                "cost"            : laborval,
                "markup"          : markup,
                "quantity"        : qty,
                "shippingfee"     : 0,
                "istaxable"       : istaxable,
                "price"           : price,
                "expiry"          : null,
                "customerid"      : 0,
                "cont_person"     : 0,
                "issue_date"      : 0,
                "quote_validity"  : 0,
                "additional_info" : []
            };

            // $("#commonModal").modal("hide"); return;
            // console.log(data);
            postAjax("<?php echo e(route('salesquote.addcustomitem')); ?>",data, function(response) {
                appendTolist(response, function(){
                    get_computetotal( qid );
                    $('#commonModal').modal('hide');
                });
            });
            // savethis({
            //         "type"              : "labor",
            //         "ccost"             : laborval,
            //         "quote_id"          : qid,
            //         "item"              : "labor",
            //         "markup"            : markup,
            //         "quantity"          : qty,
            //         "taxable"           : istaxable
            //     },"sales_quotes_items", function(id){
            //         savethis({
            //             "itemid"                 : id,
            //             "product_services_id"    : 1,
            //             "shippingfee"            : 0,
            //             "endoflife"              : null,
            //             "markupstatus"           : "approved"
            //         },"sales_quotes_item_info_more_flds");

            //         get_no_value(id, function(){
            //             $('#commonModal').modal('hide');
            //         });

            //     });
        });

        $(".subblank_-").on("click",function () {
            var lastRow = $(".add-sublist").last();

            var dataId = $('.add-sublist[data-id]:last').attr('data-id');
            var datasubid=$('.add-sublist[data-sub-id]:last').attr("data-sub-id");

            // var substart= $('.subtotal_description:last').hasClass('substart');
            // if(substart==true)
            // {
            var type="subblank";
            var data={'id':dataId,'type':type,'datasubid':datasubid};
            postAjax("<?php echo e(route('salesquote.getsubtotal')); ?>", data, function(response){

                if(response.success==true)
                {
                    $('.add-list').append(response.data);
                }
            });
            // }
        });

        $(document).on("click",".subblank", function(){
            savethis({
                "type"              : "blank",
                "ccost"             : 0,
                "quote_id"          : $(document).find("#qid").val(),
                "item"              : "--- blank ---",
                "markup"            : 0,
                "quantity"          : 0,
                "taxable"           : false
            },"sales_quotes_items", function(id){
                savethis({
                    "itemid"                 : id,
                    "product_services_id"    : 1,
                    "shippingfee"            : 0,
                    "endoflife"              : null,
                    "markupstatus"           : "approved"
                },"sales_quotes_item_info_more_flds");

                get_no_value(id, function(){
                    $('#commonModal').modal('hide');
                });
            });
        });

    </script>
<?php endif; ?>
<script>
    $(document).on('change', '.product_type', function()
    {
        ProductType($(this));
    });
    function ProductType(data,id= null,type=null){
        var product_type = data.val();
        var selector = data;
        var itemSelect = selector.parent().parent().find('.product_id.item').attr('name');
        $.ajax({
            url: '<?php echo e(route('get.item')); ?>',
            type: 'POST',
            data: {
                "product_type": product_type,
                "_token": "<?php echo e(csrf_token()); ?>",
            },
            success: function(data) {
                selector.parent().parent().find('.product_id').empty();
                var product_select = `<select class="form-control product_id item js-searchBox" name="${itemSelect}"
                                        placeholder="Select Item" data-url="<?php echo e(route('invoice.product')); ?>" required = 'required'>
                                        </select>`;
                selector.parent().parent().find('.product_div').html(product_select);

                selector.parent().parent().find('.product_id').append('<option value="0"> <?php echo e(__('Select Item')); ?> </option>');
                $.each(data, function(key, value) {
                    var selected = (key == id) ? 'selected' : '';
                    selector.parent().parent().find('.product_id').append('<option value="' + key + '" ' + selected + '>' + value + '</option>');
                });
                if(type == 'edit')
                {
                    changeItem(selector.parent().parent().find('.product_id'));
                }
                else
                {
                    items(selector.parent().parent().find('.product_id'));
                }
                // Initialize your searchBox here if needed
                // selector.parent().parent().find(".js-searchBox").searchBox({ elementWidth: '250' });
                // selector.parent().parent().find('.unit.input-group-text').text("");
            }
        });
    }

    $('body').on('click','.subcustomitem',function(){
        var dataId = $('.add-sublist[data-id]:last').attr('data-id');
        var datasubid=$('.add-sublist[data-sub-id]:last').attr("data-sub-id");
        if(isNaN(dataId))
        {
            dataId=0;
        }
        if(isNaN(dataId))
        {
            datasubid=0;
        }
        var type="subcustomitem";

        var clickedButton = $(this);
        $('#commonModal').on('show.bs.modal', function () {
            $('#commonModal form').find('.dataid').val(dataId);
            $('#commonModal form').find('.datasubid').val(datasubid);
            $('#commonModal form').find('.type').val(type);
        });
    });

    $(document).on("click","#addnewinformation", function(){
        var itemid = $(this).data("r");
        var data = {
            title  : $(document).find("#texttitle").val(),
            lbl    : $(document).find("#textlabel").val(),
            desc   : $(document).find("#textdesc").val(),
            itemid : itemid
        };

        postAjax("<?php echo e(route('salesquote.add_newinfo')); ?>", data, function(){
            get_additional_info(itemid);
        });

    });

    function get_additional_info(id) {
        postAjax("<?php echo e(route('salesquote.get_add_info_ajax')); ?>", {itemid : id}, function(html){
            $(document).find("#additional_info_tbody").html(html);
        });
    }

    $(document).on("click",".viewdetails",function(){
        var id = trs[0];
        
        $("#commonModal .body").children().remove();
        $("#commonModal").modal("show");

        postAjax("<?php echo e(route('salesquote.viewitemdetails')); ?>", {id : id}, function(response){
            $(response).appendTo("#commonModal .body");
        });

    });

    $(document).on("click",".deletethis", function(){

        if (!confirm("Are you sure you want to delete this?")) {
            return;
        }

        var data = {
            "id"     : trs,
            "tbl"    : "sales_quotes_items",
            "idfld"  : "id"
        };

        var qid            = $(document).find("#qid").val();
        var tblloc         = $(document).find("#tblLocations");
        var doc            = $(this);

        postAjax("<?php echo e(route('salesquote.deletethis')); ?>", data , function(response){
            if (response) {
                alert("Items are deleted");

                tblloc.children().remove();
                showquote_items(qid);
                trs                = [];

                doc.hide();
            }
        });
    }); 

    $(document).on('click','.btncutomitem',function (event) {
        event.preventDefault();
        var formData = $("#customitem").serialize();

        // $('#commonModal').modal('hide');

        var sdesc=$('#commonModal form').find('#cdescription').val();
        var ccost=$('#commonModal form').find('#ccost').val();
        var cmarkup=$('#commonModal form').find('#cmarkup').val();
        var cquantity=$('#commonModal form').find('#cquantity').val();
        var cprice=$('#commonModal form').find('#cprice').val();
        // var ctax=$('#commonModal form').find('.choices').val();
        var cmanufacturer_part_number=$('#commonModal form').find('#cmanufacturer_part_number').val();
        var cmanufacturer_name=$('#commonModal form').find('#cmanufacturer_name').val();
        var csupplier_part_number=$('#commonModal form').find('#csupplier_part_number').val();
        var csupplier_name=$('#commonModal form').find('#csupplier_name').val();
        var dataid=$('#commonModal form').find('.dataid').val();
        var datasubid=$('#commonModal form').find('.datasubid').val();
        var type=$('#commonModal form').find('.type').val();

        var data={'desc':sdesc,'cost':ccost,'markup':cmarkup,'quantity':cquantity,'price':cprice,'manufacturer_part_number':cmanufacturer_part_number,'manufacturer_name':cmanufacturer_name,'supplier_part_number':csupplier_part_number,'supplier_name':csupplier_name,'id':dataid,'datasubid':datasubid,'type':type};
        postAjax("<?php echo e(route('salesquote.getsubtotal')); ?>", data, function(response)
        {
            if(response.success==true)
            {
                $('.add-list').append(response.data);
                $('#commonModal').modal('hide');
                $(".cost").trigger("keyup");
            }
        });
    });

        $(window).on('resize scroll', function() {
            if (!$(document).find('#thesmallbtn').isInViewport()) {
                if ( $(document).find("#thesmallbtn").hasClass("floatit_nav") ) {

                } else {
                    $(document).find('#thesmallbtn').addClass("floatit_nav");
                }
            }

            if ($(document).find('#bigbtn_div').isInViewport()) {
                $(document).find('#thesmallbtn').removeClass("floatit_nav");
            }
         });

    $(document).ready(function(){
        var qid            = $(document).find("#qid").val();
        showquote_items(qid);    
    });

    $(document).on("blur",".edittext", function(){
        edittext($(this), "sales_quotes_items");

        var grpid = $(this).data("grpid");
        
        if (grpid.length !== 0) {
            compute_subs(grpid);
        }

        get_computetotal( $(document).find("#qid").val() );
    });

    $(document).on("blur",".edittext_ship", function(){
        edittext($(this), "sales_quotes_items","sales_quotes_item_info_more_flds","itemid");

        var grpid = $(this).data("grpid");
        
        if (grpid.length !== 0) {
            compute_subs(grpid);
        }

        get_computetotal( $(document).find("#qid").val() );
    })

    $(document).on("blur",".textsubtotal", function(){
        // update_fld
        // edittext($(this), "sales_quotes_item_info_more_flds");
        var fld     = $(this).data('fld');
        var id      = $(this).data("id");
        var theval  = $(this).val();

        var removecomma = $(this).data("removecomma");

        if (id.length == 0) {
            id = null;
        }

        var data   = {
           "fld"         : fld,
           "id"          : id,
           "theval"      : theval,
           "table"       : "salessubs",
           "fk_fld"      : "grpid",
           "removecomma" : removecomma
        };

        // console.log(data);  
        var dis = $(this);
    
        postAjax("<?php echo e(route('salesquote.update_fld')); ?>", data, function(response){
            get_computetotal( $(document).find("#qid").val() );
            // $(document).find("#"+theid+"_amount").val(response[0].extended);
        });

        // get_computetotal( $(document).find("#qid").val() );
    });

    $(document).on("blur","#theexpirydate", function(){
        var qid = $(document).find("#qid").val();
        
        var data   = {
           "fld"         : "endoflife",
           "id"          : $(this).data('r'),
           "theval"      : $(this).val(),
           "id_fld"      : "itemid",
           "table"       : "sales_quotes_item_info_more_flds",
           "fk_fld"      : "grpid",
           "removecomma" : false
        };

        postAjax("<?php echo e(route('salesquote.update_this')); ?>", data, function(response){
            trs = [];
            showquote_items(qid);
        });
    });

    $(document).on("click",".removethis", function(){
        var qid = $(document).find("#qid").val();
        var tid = $(this).data('tid');

        if (!confirm("Are you sure what to delete this?")) {
            return;
        }

        var data = {
            id    : $(this).data("r"),
            idfld : "id",
            tbl   : "sales_quotes_item_add_info"
        }

        postAjax("<?php echo e(route('salesquote.removethis')); ?>", data, function(){
            // trs = [];
            // showquote_items(qid);
            $(document).find("#additional_info_tbody").children().remove();
            get_additional_info(tid);
        });
    })

    $(document).on("change",".markupchange_subtotal", function(){
        var fld     = $(this).data('fld');
        var id      = $(this).data("id");
        var theval  = $(this).val();

        if (id.length == 0) {
            id = null;
        }

        var data   = {
           "fld"     : fld,
           "id"      : id,
           "theval"  : theval,
           "table"   : "salessubs",
           "fk_fld"  : "grpid"
        };

        // console.log(data);  
        var dis   = $(this);
        var theid = dis.data("id");
    
        postAjax("<?php echo e(route('salesquote.update_fld')); ?>", data, function(response){
            // get_computetotal( $(document).find("#qid").val() );
            // $(document).find("#"+theid+"_amount").val(response[0].extended);
        });

    });

    function compute_subs_notinuse(qty, dis) {
        var id    = dis.data("id");
        var price = $(document).find("#"+id+"_price").val();

        var total = (price*qty);

        $(document).find("#"+id+"_price").val(total);
    }

    $(document).on("change",".markupchange", function(){
        edittext($(this), "sales_quotes_items");

        var grpid = $(this).data("grpid");
        
        if (grpid.length !== 0) {
            compute_subs(grpid);
        }

        get_computetotal( $(document).find("#qid").val() );
    });


    $(document).on("click","#saveshipping", function(){
        var istaxable = false;

        if ( $("#commonModal form").find("#istaxable").is(":checked") ){
            istaxable = true;
        } else {
            istaxable = false;
        }

        savethis({
            "type"              : "shipping",
            "ccost"             : $(document).find("#shippingtext").val(),
            "quote_id"          : $(document).find("#qid").val(),
            "item"              : "shipping",
            "markup"            : $(document).find("#markup").val(),
            "quantity"          : $(document).find("#qtytxt").val(),
            "taxable"           : istaxable
        },"sales_quotes_items", function(id) {
            savethis({
                    "itemid"                 : id,
                    "product_services_id"    : 1,
                    "shippingfee"            : 0,
                    "endoflife"              : null,
                    "markupstatus"           : "approved"
                },"sales_quotes_item_info_more_flds");
        });
    });

    $(document).on("blur",".otherinfo_text", function(){
        var id  = $(this).data("id");
        var fld = $(this).data("fld");
        var tbl = "sales_quotes_item_add_info";


        var data = {
            "theval" : $(this).val(),
            "fld"    : fld,
            "id"     : id,
            "table"  : tbl
        };

        postAjax("<?php echo e(route('salesquote.update_fld')); ?>", data, function(response){
            
        });
    });

    function savethis(values, table, somefunction = false) {
        postAjax("<?php echo e(route('salesquote.savethis')); ?>",{data:values, table:table}, function(response){
            if (somefunction != false) {
                somefunction(response);
            }
        });
    }

    function edittext(dis, table,update_tbl = false, itemkey = "id") {
        // id_profit
        // id_price
        // id_tax_value

        var data = {
            "theval"    : dis.val(),
            "fld"       : dis.data("fld"),
            "id"        : dis.data("id"),
            "table"     : table,
            "itemkey"   : itemkey,
            "updatetbl" : update_tbl
        };

        var disid = dis.data('id');

        postAjax("<?php echo e(route('salesquote.blursave')); ?>", data, function(response){
            if (table == "sales_quotes_items") {
                $(document).find("#"+disid+"_profit").html(response['profit']);
                $(document).find("#"+disid+"_price").html(response['price']);
                // $(document).find("#"+disid+"_amount").html(response['amount']);
                $(document).find("#"+disid+"_extended").html(response['extended']);
                $(document).find("#"+disid+"_tax_value").html(response['itemTaxRate']);
            }

            // if (table == "salessubs") {
            //     $(document).find("#"+disid+"_amount").html(response['amount']);
            // }
        });
    }

    function showquote_items(qid) {
        postAjax("<?php echo e(route('salesquote.getquote_items')); ?>",{qid:qid}, function(response) {
            appendTolist(response);
            get_computetotal(qid);
           // $(response).appendTo('.add-list');
        });
    };

    function get_computetotal(quote_id) {
        var data = {
            "quote_id" : quote_id
        };

        postAjax("<?php echo e(route('salesquote.get_total')); ?>",data, function(response) {
            // console.log(response);
            $(document).find(".totalcost").html("");
            $(document).find(".totalproduct").html( response['product'] );
            $(document).find(".totalshipping").html( response['shipping'] );
            $(document).find(".totallabor").html( response['labor'] );
            $(document).find(".totalprofit").html( response['profit'] );
            $(document).find(".totalgp").html("");
            $(document).find(".maintotal").html( response['subtotal'] );
            $(document).find(".totalTax").html( response['tax'] );
            $(document).find(".totalAmount").html( response['totalamount'] );
        });
    }

    function appendTolist(html, somefunc = false) {
    //  $("<tbody class='add-list'> </tbody>").appendTo("#tblLocations");
        $(html).prependTo("#tblLocations");

        if (somefunc != false) {
            somefunc();
        }
    }

    var additional_info = {};

    // $(document).on("change","#cmarkup", function(){

       

    // });

    $(document).on("click",".btncutomitem_new", function(){
        var qid            = $(document).find("#qid").val();

        var productline_id = $("#commonModal form").find("#productlineid").val();
        var description    = $('#commonModal form').find('#cdescription').val();
        var ccost          = $('#commonModal form').find('#ccost').val();
        var cmarkup        = $('#commonModal form').find("#customtext_m_up").val(); //$('#commonModal form').find('#cmarkup').val();
        var cquantity      = $('#commonModal form').find('#cquantity').val();
        var shippingfee    = $('#commonModal form').find('#deliveryfee_text').val();
        var istaxable      = false;

        var customer_id    = $(document).find("#customer").val();
        var contact_person = $(document).find("#contact_person").val();
        var issue_date     = $(document).find("#issue_date").val();
        var quote_validity = $(document).find("#quote_validity").val();

        if (cquantity.length == 0) {
            alert("Quantity cannot be empty");
            return;
        }

        if ( cmarkup.length == 0 ) {
            alert("Markup cannot be empty");
            return;
        }

        if ( shippingfee.length == 0 ) {
            alert("Shipping fee cannot be empty");
            return;
        }

        if ( $("#commonModal form").find("#istaxable").is(":checked") ){
            istaxable = true;
        } else {
            istaxable = false;
        }

        var price          = $("#commonModal form").find("#cprice").val();

        var expiry         = null; // expiry

        if ( $("commonModal form").find("#expiry").is(":checked") ) {
            expiry         = $("#commonModal form").find("#expirydate_text").val();
        }

        var data = {
            'qid'             : qid,
            "productlineid"   : productline_id,
            "type"            : "subcustomitem",
            "description"     : description,
            "cost"            : ccost,
            "markup"          : cmarkup,
            "quantity"        : cquantity,
            "shippingfee"     : shippingfee,
            "istaxable"       : istaxable,
            "price"           : price,
            "expiry"          : expiry,
            "customerid"      : customer_id,
            "cont_person"     : contact_person,
            "issue_date"      : issue_date,
            "quote_validity"  : quote_validity,
            "additional_info" : additional_info
        };

        // $("#commonModal").modal("hide"); return;
        // console.log(data); 
        postAjax("<?php echo e(route('salesquote.addcustomitem')); ?>",data, function(response) {
            // $(response).appendTo('.add-list');
            
                console.log(response);
            appendTolist(response, function(){
                $("#commonModal").modal("hide");
            });
        });
    });
</script>
<?php if($acction == 'edit'): ?>
    <script>
        $(document).ready(function() {
            // $("#customer").trigger('change');
            triggerchange( $("#customer")  );

            var value = $(selector + " .repeater").attr('data-value');
            var type = '<?php echo e($type); ?>';
            if (typeof value != 'undefined' && value.length != 0) {
                value = JSON.parse(value);
                $repeater.setList(value);
                for (var i = 0; i < value.length; i++) {
                    var tr = $('#sortable-table .id[value="' + value[i].id + '"]').parent();
                    tr.find('.item').val(value[i].product_id);
                    if (type == 'product') {
                        var element = tr.find('.product_type');
                        var product_id = value[i].product_id;
                        ProductType(element,product_id,'edit');
                        changeItem(tr.find('.item'));
                    }
                }
            }
        });

       
    </script>
    <?php if($type == 'product'): ?>
        <script>
            var invoice_id = '<?php echo e($invoice->id); ?>';

            function changeItem(element) {

                var iteams_id = element.val();

                var url = element.data('url');
                var el = element;
                $.ajax({
                    url: url,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': jQuery('#token').val()
                    },
                    data: {
                        'product_id': iteams_id
                    },
                    cache: false,
                    success: function(data) {
                        var item = JSON.parse(data);

                        $.ajax({
                            url: '<?php echo e(route('invoice.items')); ?>',
                            type: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': jQuery('#token').val()
                            },
                            data: {
                                'invoice_id': invoice_id,
                                'product_id': iteams_id,
                            },

                            cache: false,
                            success: function(data) {
                                var invoiceItems = JSON.parse(data);

                                if (invoiceItems != null) {
                                    var amount = (invoiceItems.price * invoiceItems.quantity);

                                    $(el.parent().parent().find('.quantity')).val(invoiceItems
                                    .quantity);
                                    $(el.parent().parent().find('.price')).val(invoiceItems.price);
                                    $(el.parent().parent().find('.discount')).val(invoiceItems
                                    .discount);
                                } else {
                                    $(el.parent().parent().find('.quantity')).val(1);
                                    $(el.parent().parent().find('.price')).val(item.product.sale_price);
                                    $(el.parent().parent().find('.discount')).val(0);
                                }


                                var taxes = '';
                                var tax = [];

                                var totalItemTaxRate = 0;
                                for (var i = 0; i < item.taxes.length; i++) {
                                    taxes +=
                                        '<span class="badge bg-primary p-2 px-3 rounded mt-1 mr-1">' +
                                        item.taxes[i].name + ' ' + '(' + item.taxes[i].rate + '%)' +
                                        '</span>';
                                    tax.push(item.taxes[i].id);
                                    totalItemTaxRate += parseFloat(item.taxes[i].rate);
                                }

                                if (invoiceItems != null) {
                                    var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (
                                        invoiceItems.price * invoiceItems.quantity));
                                } else {
                                    var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (item
                                        .product.sale_price * 1));
                                }

                                $(el.parent().parent().find('.itemTaxPrice')).val(itemTaxPrice.toFixed(
                                    2));
                                $(el.parent().parent().find('.itemTaxRate')).val(totalItemTaxRate
                                    .toFixed(2));
                                $(el.parent().parent().find('.taxes')).html(taxes);
                                $(el.parent().parent().find('.tax')).val(tax);
                                $(el.parent().parent().find('.unit')).html(item.unit);

                                $(".discount").trigger('change');
                            }
                        });
                    },
                });
            }
            $(document).on('click', '[data-repeater-create]', function() {
                $('.item :selected').each(function() {
                    var id = $(this).val();
                    $(".item option[value=" + id + "]").addClass("d-none");
                });
            })
        </script>
    <?php elseif($type == 'project'): ?>
        <script>
            $(document).ready(function() {
                $(".price").trigger("keyup");
                $("#tax_project").trigger('change');
            });
        </script>
    <?php elseif($type == "salesquote"): ?>
        <script>

            var invoice_id = '<?php echo e($invoice->id); ?>';

            function changeItem(element) {
                var iteams_id = element.val();

                var url = element.data('url');
                var el = element;
                $.ajax({
                    url: url,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': jQuery('#token').val()
                    },
                    data: {
                        'product_id': iteams_id
                    },
                    cache: false,
                    success: function(data) {

                        var item = JSON.parse(data);

                        $.ajax({
                            url: '<?php echo e(route('invoice.items')); ?>',
                            type: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': jQuery('#token').val()
                            },
                            data: {
                                'invoice_id': invoice_id,
                                'product_id': iteams_id,
                            },

                            cache: false,
                            success: function(data) {
                                var invoiceItems = JSON.parse(data);

                                if (invoiceItems != null) {
                                    var amount = (invoiceItems.price * invoiceItems.quantity);

                                    $(el.parent().parent().find('.quantity')).val(invoiceItems
                                        .quantity);
                                    $(el.parent().parent().find('.price')).val(invoiceItems.price);
                                    $(el.parent().parent().find('.discount')).val(invoiceItems
                                        .discount);
                                } else {
                                    $(el.parent().parent().find('.quantity')).val(1);
                                    $(el.parent().parent().find('.price')).val(item.product.sale_price);
                                    $(el.parent().parent().find('.discount')).val(0);
                                }


                                var taxes = '';
                                var tax = [];

                                var totalItemTaxRate = 0;
                                for (var i = 0; i < item.taxes.length; i++) {
                                    taxes +=
                                        '<span class="badge bg-primary p-2 px-3 rounded mt-1 mr-1">' +
                                        item.taxes[i].name + ' ' + '(' + item.taxes[i].rate + '%)' +
                                        '</span>';
                                    tax.push(item.taxes[i].id);
                                    totalItemTaxRate += parseFloat(item.taxes[i].rate);
                                }

                                if (invoiceItems != null) {
                                    var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (
                                        invoiceItems.price * invoiceItems.quantity));
                                } else {
                                    var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (item
                                        .product.sale_price * 1));
                                }

                                $(el.parent().parent().find('.itemTaxPrice')).val(itemTaxPrice.toFixed(
                                    2));
                                $(el.parent().parent().find('.itemTaxRate')).val(totalItemTaxRate
                                    .toFixed(2));
                                $(el.parent().parent().find('.taxes')).html(taxes);
                                $(el.parent().parent().find('.tax')).val(tax);
                                $(el.parent().parent().find('.unit')).html(item.unit);
                            }
                        });
                    },
                });
            }
            $(document).on('click', '[data-repeater-create]', function() {
                $('.item :selected').each(function() {
                    var id = $(this).val();
                    $(".item option[value=" + id + "]").addClass("d-none");
                });
            })

            $(document).ready(function() {
                var acction = "<?php echo e($acction); ?>";

                var data={'acction':acction,'invoice_id':invoice_id};

                postAjax("<?php echo e(route('salesquote.getsubtotal')); ?>", data, function(response){
                    if(response.success==true)
                    {
                        $('.add-list').append(response.data);
                        $(".item").trigger("change");
                    }
                });

                var $repeater = $('.quote-repeater').repeater({
                    initEmpty: true,
                    repeaters: [{
                        selector: '.inner-repeater',
                        initEmpty: true,
                        show: function() {
                            $(this).find('.time-picker').datetimepicker({
                                icons: {
                                    time: "fa fa-clock",
                                    date: "fa fa-calendar-day",
                                    up: "fa fa-chevron-up",
                                    down: "fa fa-chevron-down",
                                    previous: 'fa fa-chevron-left',
                                    next: 'fa fa-chevron-right',
                                    today: 'fa fa-screenshot',
                                    clear: 'fa fa-trash',
                                    close: 'fa fa-remove'
                                },
                                format:"HH:mm"
                            });
                            $(this).slideDown();
                        },
                    }],
                    show: function() {
                        $(this).find('select').select2();
                        $(this).slideDown();
                    },
                });

            });
        </script>
    <?php endif; ?>
<?php endif; ?>
<script>
     $(document).on('click', '[data-repeater-create]', function() {
        $('.item :selected').each(function() {
            var id = $(this).val();
            if(id != '')
            {
                $(".item option[value=" + id + "]").addClass("d-none");
            }
        });
    })

    $(".tax_get").click(function() {
        myFunction();

    });
    $(".get_tax").change(function() {
        myFunction();
    });

    function myFunction() {
        var tax_id = $('.get_tax').val();

        if (tax_id != "") {
            $.ajax({
                url: '<?php echo e(route('get.taxes')); ?>',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': jQuery('#token').val()
                },
                data: {
                    'tax_id': tax_id,
                },
                cache: false,
                success: function(data) {
                    var obj = jQuery.parseJSON(data);


                    var taxes = '';
                    var tax = [];
                    $.each(obj, function() {

                        taxes += '<span class="badge bg-primary p-2 px-3 rounded mt-1 mr-1">' +
                            this.name + ' ' + '(' + this.rate + '%)' +
                            '</span>';
                        tax.push(this.id);

                    });

                    $('.taxes').html(taxes);
                },
            });
        } else {
            $('.taxes').html("");
        }
    }
</script>
<?php if($type == 'product'): ?>
    <h5 class="h4 d-inline-block font-weight-400 mb-4"><?php echo e(__('Items')); ?></h5>
    <div class="card repeater" <?php if($acction == 'edit'): ?> data-value='<?php echo json_encode($invoice->items); ?>' <?php endif; ?>>
        <div class="item-section py-4">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-12 d-flex align-items-center justify-content-md-end px-5">
                    <a href="#" data-repeater-create="" class="btn btn-primary mr-2" data-toggle="modal"
                        data-target="#add-bank">
                        <i class="ti ti-plus"></i> <?php echo e(__('Add item')); ?>

                    </a>
                </div>
            </div>
        </div>
        <div class="card-body table-border-style mt-2">
            <div class="table-responsive">
                <table class="table  mb-0 table-custom-style" data-repeater-list="items" id="sortable-table">
                    <thead>
                        <tr>
                            <th><?php echo e(__('Item Type')); ?></th>
                            <th><?php echo e(__('Items')); ?></th>
                            <th><?php echo e(__('Quantity')); ?></th>
                            <th><?php echo e(__('Price')); ?> </th>
                            <th><?php echo e(__('Discount')); ?></th>
                            <th><?php echo e(__('Tax')); ?> (%)</th>
                            <th class="text-end"><?php echo e(__('Amount')); ?> <br><small
                                    class="text-danger font-weight-bold"><?php echo e(__('After discount & tax')); ?></small></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody class="ui-sortable" data-repeater-item>
                        <tr>
                            <?php echo e(Form::hidden('id', null, ['class' => 'form-control id'])); ?>

                            <td  class="form-group pt-0">
                                <?php echo e(Form::select('product_type', $product_type, null, ['class' => 'form-control product_type ', 'required' => 'required', 'placeholder' => '--'])); ?>

                            </td>
                            <td width="25%" class="form-group pt-0 product_div">
                                    <select name="item" class="form-control product_id item  js-searchBox" data-url="<?php echo e(route('invoice.product')); ?>" required>
                                        <option value="0"><?php echo e('--'); ?></option>
                                        <?php $__currentLoopData = $product_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$product_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($product_service); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                <?php if(empty($product_services_count)): ?>
                                    <div class=" text-xs"><?php echo e(__('Please create Product first.')); ?><a
                                            href="<?php echo e(route('product-service.index')); ?>"><b><?php echo e(__('Add Product')); ?></b></a>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="form-group price-input input-group search-form">
                                    <?php echo e(Form::text('quantity', '', ['class' => 'form-control quantity', 'required' => 'required', 'placeholder' => __('Qty'), 'required' => 'required'])); ?>

                                    <span class="unit input-group-text bg-transparent"></span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group price-input input-group search-form">
                                    <?php echo e(Form::text('price', '', ['class' => 'form-control price', 'required' => 'required', 'placeholder' => __('Price'), 'required' => 'required'])); ?>

                                    <span class="input-group-text bg-transparent"><?php echo e(company_setting('defult_currancy_symbol')); ?></span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group price-input input-group search-form">
                                    <?php echo e(Form::text('discount', '', ['class' => 'form-control discount', 'required' => 'required', 'placeholder' => __('Discount')])); ?>

                                    <span
                                        class="input-group-text bg-transparent"><?php echo e(company_setting('defult_currancy_symbol')); ?></span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group colorpickerinput">
                                        <div class="taxes"></div>
                                        <?php echo e(Form::hidden('tax', '', ['class' => 'form-control tax text-dark'])); ?>

                                        <?php echo e(Form::hidden('itemTaxPrice', '', ['class' => 'form-control itemTaxPrice'])); ?>

                                        <?php echo e(Form::hidden('itemTaxRate', '', ['class' => 'form-control itemTaxRate'])); ?>

                                    </div>
                                </div>
                            </td>

                            <td class="text-end amount">0.00</td>
                            <td>
                                <a href="#" class="bs-pass-para repeater-action-btn" data-repeater-delete>
                                    <div class="repeater-action-btn action-btn bg-danger ms-2">
                                        <i class="ti ti-trash text-white text-white"></i>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="form-group">
                                    <?php echo e(Form::textarea('description', null, ['class' => 'form-control pro_description', 'rows' => '2', 'placeholder' => __('Description')])); ?>

                                </div>
                            </td>
                            <td colspan="5"></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td></td>
                            <td><strong><?php echo e(__('Sub Total')); ?>

                                    (<?php echo e(company_setting('defult_currancy_symbol')); ?>)</strong>
                            </td>
                            <td class="text-end subTotal">0.00</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td></td>
                            <td><strong><?php echo e(__('Discount')); ?>

                                    (<?php echo e(company_setting('defult_currancy_symbol')); ?>)</strong>
                            </td>
                            <td class="text-end totalDiscount">0.00</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td></td>
                            <td><strong><?php echo e(__('Tax')); ?> (<?php echo e(company_setting('defult_currancy_symbol')); ?>)</strong>
                            </td>
                            <td class="text-end totalTax">0.00</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td class="blue-text"><strong><?php echo e(__('Total Amount')); ?>

                                    (<?php echo e(company_setting('defult_currancy_symbol')); ?>)</strong></td>
                            <td class="text-end totalAmount blue-text">0.00</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
<?php elseif($type == 'project'): ?>
    <h5 class="h4 d-inline-block font-weight-400 mb-4 pro_name"><?php echo e(__('Project')); ?></h5>
            <?php echo e(Form::hidden('itemTaxRate', null, ['class' => 'form-control itemTaxRate'])); ?>

            <div class="card repeater" <?php if($acction == 'edit'): ?> data-value='<?php echo json_encode($invoice->items); ?>' <?php endif; ?>>
                <div class="item-section py-4">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-12 d-flex align-items-center justify-content-md-end px-5">
                            <a href="#" data-repeater-create="" class="btn btn-primary tax_get mr-2" data-toggle="modal"
                                data-target="#add-bank">
                                <i class="ti ti-plus"></i> <?php echo e(__('Add item')); ?>

                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-border-style mt-2">
                    <div class="table-responsive">
                        <table class="table  mb-0 table-custom-style" data-repeater-list="items" id="sortable-table">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Items')); ?></th>
                                    <th><?php echo e(__('Price')); ?> </th>
                                    <th><?php echo e(__('Discount')); ?></th>
                                    <th width="200px"><?php echo e(__('Tax')); ?> (%)</th>
                                    <th class="text-end"><?php echo e(__('Amount')); ?> <br><small
                                            class="text-danger font-weight-bold"><?php echo e(__('After discount & tax')); ?></small></th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody class="ui-sortable" data-repeater-item>
                                <tr>
                                    <td width="25%" class="form-group pt-0">
                                        <?php echo e(Form::hidden('id', null, ['class' => 'form-control id'])); ?>

                                        <?php echo e(Form::select('item', $tasks, null, ['class' => 'form-control item js-searchBox', 'required' => 'required'])); ?>

                                    </td>
                                    <td>
                                        <div class="form-group price-input input-group search-form">
                                            <?php echo e(Form::text('price', '', ['class' => 'form-control price', 'required' => 'required', 'placeholder' => __('Price'), 'required' => 'required'])); ?>

                                            <span
                                                class="input-group-text bg-transparent"><?php echo e(company_setting('defult_currancy_symbol')); ?></span>
                                        </div>
                                    </td>
                                    <?php echo e(Form::hidden('quantity',1, ['class' => 'form-control quantity', 'required' => 'required', 'placeholder' => __('Qty'), 'required' => 'required'])); ?>

                                    <td>
                                        <div class="form-group price-input input-group search-form">
                                            <?php echo e(Form::text('discount', '', ['class' => 'form-control discount', 'placeholder' => __('Discount')])); ?>

                                            <span
                                                class="input-group-text bg-transparent"><?php echo e(company_setting('defult_currancy_symbol')); ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="taxes"></div>
                                                <?php echo e(Form::hidden('tax', null, ['class' => 'form-control tax'])); ?>

                                                <?php echo e(Form::hidden('itemTaxPrice', '', ['class' => 'form-control itemTaxPrice'])); ?>

                                                <?php echo e(Form::hidden('itemTaxRate', '', ['class' => 'form-control itemTaxRate'])); ?>

                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end amount">0.00</td>
                                    <td>
                                        <a href="#" class="bs-pass-para repeater-action-btn" data-repeater-delete>
                                            <div class="repeater-action-btn action-btn bg-danger ms-2">
                                                <i class="ti ti-trash text-white text-white"></i>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-group">
                                            <?php echo e(Form::textarea('description', null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => __('Description')])); ?>

                                        </div>
                                    </td>
                                    <td colspan="5"></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td></td>
                                    <td><strong><?php echo e(__('Sub Total')); ?>

                                            (<?php echo e(company_setting('defult_currancy_symbol')); ?>)</strong>
                                    </td>
                                    <td class="text-end subTotal">0.00</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td></td>
                                    <td><strong><?php echo e(__('Discount')); ?>

                                            (<?php echo e(company_setting('defult_currancy_symbol')); ?>)</strong>
                                    </td>
                                    <td class="text-end totalDiscount">0.00</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td></td>
                                    <td><strong><?php echo e(__('Tax')); ?> (<?php echo e(company_setting('defult_currancy_symbol')); ?>)</strong>
                                    </td>
                                    <td class="text-end totalTax">0.00</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td class="blue-text"><strong><?php echo e(__('Total Amount')); ?>

                                            (<?php echo e(company_setting('defult_currancy_symbol')); ?>)</strong></td>
                                    <td class="text-end totalAmount blue-text">0.00</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
<?php elseif($type == 'salesquote'): ?>
    <!-- <h5 class="h4 d-inline-block font-weight-400 mb-4"><?php echo e(__('Sales Quote')); ?></h5> -->
    <div class="card">
        <div class="card-header p-3" style="background: #eee;">
            <!-- <div class="col-md-12 d-flex p-2"> -->
            <div class="card-tools">
                <div class="with_as" id="thesmallbtn">
                    <!-- <a href="#" class="btn btn-primary subtotal" style="margin-right: 5px;">
                        <i class="ti ti-circle-plus"></i> <span class="hide-mob"> Subtotal </span>
                    </a> -->
                    <a class="border-right subtotal_" title="<?php echo e(__('Create Subtotal two')); ?>" data-toggle="tooltip">
                        <i class="ti ti-subtask"></i> 
                    </a>

                    <!-- <a href="#"class="btn btn-primary mr-5 substop" style="margin-right: 5px;">
                        <i class="ti ti-circle-plus"></i> <span class="hide-mob"> Sub Stop </span>
                    </a> -->
                    <a class="border-right mr-5 labor" data-ajax-popup="true" data-size="md" data-title="<?php echo e(__('Labor')); ?>" data-url="<?php echo e(route('salesquote.getlaborwindow')); ?>" data-toggle="tooltip" title="<?php echo e(__('Labor')); ?>" >
                        <i class="ti ti-hammer"></i> 
                    </a>
                    <!-- <a href="#"class="border-right mr-5 shipping" data-ajax-popup="true" data-size="md" data-title="<?php echo e(__('Shipping')); ?>" data-url="<?php echo e(route('salesquote.addshippingfee')); ?>" data-toggle="tooltip" title="<?php echo e(__('Shipping Fee')); ?>" >
                        <i class="ti ti-truck"></i> <span class="hide-mob"> Shipping </span>
                    </a> -->
                    <a class="border-right mr-5 subitem_add">
                        <i class="ti ti-brand-producthunt"></i>
                    </a>
                    <a class="border-right mr-5 subcomment" data-ajax-popup="true" data-size="md" data-title="<?php echo e(__('Add Comment')); ?>" data-url="<?php echo e(route('salesquote.addcomment')); ?>" data-toggle="tooltip" title="<?php echo e(__('Comment')); ?>">
                        <i class="ti ti-message-dots"></i> 
                    </a>
                    <a class="border-right mr-5 subblank" title="<?php echo e(__('Create a blank row')); ?>" data-toggle="tooltip">
                        <i class="ti ti-space"></i> 
                    </a>
                    <!-- <a style="display:none;" class="border-right mr-5 viewdetails" data-ajax-popup="true" data-size="md" data-title="<?php echo e(__('View Item Details')); ?>" data-url="<?php echo e(route('salesquote.viewitemdetails')); ?>" data-toggle="tooltip" title="<?php echo e(__('View Item Details')); ?>">
                        <i class="ti ti-eye"></i> <span class="hide-mob"> View Item Details </span>
                    </a> -->
                    <a style="display:none;" class="border-right mr-5 viewdetails" data-title="<?php echo e(__('View Item Details')); ?>" title="<?php echo e(__('View Item Details')); ?>">
                        <i class="ti ti-eye"></i> <span class="hide-mob"> View Item Details </span>
                    </a>
                    <a style="display:none;" class="border-right mr-5 deletethis" data-title="<?php echo e(__('Delete')); ?>" title="<?php echo e(__('Delete')); ?>">
                        <i class="ti ti-trash"></i> <span class="hide-mob"> Delete </span>
                    </a>
                    <a style="display:none;" class="border-right mr-5 copythis" data-title="<?php echo e(__('Delete')); ?>" title="<?php echo e(__('Delete')); ?>">
                        <i class="ti ti-copy"></i> <span class="hide-mob"> Copy </span>
                    </a>
                    <a class="border-right mr-5 subcustomitem" data-ajax-popup="true" data-size="md" data-title="<?php echo e(__('Create New Custom Item')); ?>" data-url="<?php echo e(route('salesquote.customitem')); ?>" data-toggle="tooltip" title="<?php echo e(__('Create Custom Item')); ?>">
                        <i class="ti ti-adjustments-plus"></i>
                    </a>
                    <!-- <a href="#" class="btn btn-primary mr-5 subcustomitem" data-ajax-popup="true" data-size="md" data-title="<?php echo e(__('Create New Custom Item')); ?>" data-url="<?php echo e(route('salesquote.customitem')); ?>" data-toggle="tooltip" title="<?php echo e(__('Create')); ?>" style="margin-right: 5px;">
                        <i class="ti ti-plus"></i>alvin Item
                    </a> -->
                </div>
                <!-- <div class="with_as">
                    <a class="border-right"> Send Quotation </a>
                    <a class="border-right"> Save Quotation </a>
                </div> -->
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table ui-sortable" id="tblLocations">
                   
                </table>
            </div>

            <div class="table-responsive mt-5">
                <table class="table mb-0 table-custom-style footer-table">
                    <tfoot>
                    <tr>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                    </tr>
                    <tr>
                        <td colspan="11"></td>
                        <td class="text-end" width="10%"><strong><?php echo e(__('Total Cost')); ?> (<?php echo e(company_setting('defult_currancy_symbol')); ?>)</strong></td>
                        <td width="10%"></td>
                        <td class="text-end totalcost" width="10%"> &nbsp; </td>
                    </tr>
                    <tr>
                        <td colspan="12"></td>
                        <td class="text-end" width="10%"><strong><?php echo e(__('Product')); ?> (<?php echo e(company_setting('defult_currancy_symbol')); ?>)</strong></td>
                        <td class="text-end totalproduct" width="10%">0.00</td>
                    </tr>
                    <tr>
                        <td colspan="12"></td>
                        <td class="text-end" width="10%"><strong><?php echo e(__('Shipping')); ?> (<?php echo e(company_setting('defult_currancy_symbol')); ?>)</strong></td>
                        <td class="text-end totalshipping" width="10%">0.00</td>
                    </tr>
                    <tr>
                        <td colspan="12"></td>
                        <td class="text-end" width="10%"><strong><?php echo e(__('Labor')); ?> (<?php echo e(company_setting('defult_currancy_symbol')); ?>)</strong></td>
                        <td class="text-end totallabor" width="10%">0.00</td>
                    </tr>
                    <tr>
                        <td colspan="11"></td>
                        <td class="text-end" width="10%"><strong><?php echo e(__('Total Profit')); ?> (<?php echo e(company_setting('defult_currancy_symbol')); ?>)</strong></td>
                        <td width="10%"></td>
                        <td class="text-end totalprofit" width="10%">0.00</td>
                    </tr>
                    <tr>
                        <td colspan="11"></td>
                        <td class="text-end" width="10%"><strong><?php echo e(__('GP%')); ?></strong></td>
                        <td width="10%"></td>
                        <td class="text-end totalgp" width="10%">0.00</td>
                    </tr>
                    <tr>
                        <td colspan="11"></td>
                        <td class="text-end" width="10%"><strong><?php echo e(__('Sub Total')); ?> (<?php echo e(company_setting('defult_currancy_symbol')); ?>)</strong></td>
                        <td width="10%"></td>
                        <td class="text-end maintotal" width="10%">0.00</td>
                    </tr>
                    <tr>
                        <td colspan="11"></td>
                        <td class="text-end" width="10%"><strong><?php echo e(__('Tax')); ?> (<?php echo e(company_setting('defult_currancy_symbol')); ?>)</strong></td>
                        <td width="10%"></td>
                        <td class="text-end totalTax" width="10%">0.00</td>
                    </tr>
                    <tr>
                        <td colspan="11"></td>
                        <td class="blue-text text-end" width="10%"><strong><?php echo e(__('Total Amount')); ?> (<?php echo e(company_setting('defult_currancy_symbol')); ?>)</strong></td>
                        <td width="10%"></td>
                        <td class="text-end totalAmount blue-text" width="10%">0.00</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\dsi_crm\resources\views/invoice/section.blade.php ENDPATH**/ ?>