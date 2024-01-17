<script>
    var selector = "body";
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
            $("#tblLocations").sortable({
                items: 'tr',
                cursor: 'pointer',
                axis: 'y',
                dropOnEmpty: false,
                start: function (e, ui) {
                    ui.item.addClass("selected");
                },
                stop: function (e, ui) {
                    // ui.item.removeClass("selected");
                    // $(this).find("tr").each(function (index) {
                        // if (index > 0) {
                        //     $(this).find("td").eq(2).html(index);
                        // }
                    // });
                    setTimeout(function () {
                        var data_id=parseInt(0);
                        var sub_id=parseInt(0);
                        $('.add-sublist').each(function () {
                            if($(this).data('id'))
                            {
                                data_id=$(this).data('id');
                                sub_id=parseInt(0);
                            }
                            $(this).attr('main-data',data_id);
                            if($(this).attr('sub-data-id'))
                            {
                                $(this).attr('sub-data-id',data_id);
                            }
                            $(this).attr('data-sub-id',sub_id);

                            $(this).find('*').each(function () {
                                var elementType = this.tagName.toLowerCase();

                                if (elementType == 'input') {
                                    var name=$(this).attr('name');
                                    var newName = replaceKeyAtIndexs(name,0,1,data_id,sub_id);
                                    $(this).attr('name', newName);
                                } else if (elementType === 'select') {
                                    var name=$(this).attr('name');
                                    var newName = replaceKeyAtIndexs(name,0,1,data_id,sub_id);
                                    $(this).attr('name', newName);
                                }
                            });
                            sub_id=sub_id+parseInt(1);
                        });
                        $(".item").trigger('change');
                    }, 0);
                }
            });
        });

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

        $(".subitem").on("click",function () {
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

        $(".subcomment").on("click",function () {
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

        $(".subblank").on("click",function () {
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
    })

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
</script>
<?php if($acction == 'edit'): ?>
    <script>
        $(document).ready(function() {
            $("#customer").trigger('change');

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
    <h5 class="h4 d-inline-block font-weight-400 mb-4"><?php echo e(__('Sales Quote')); ?></h5>
    <div class="card">
        <div class="card-body">

            <div class="col-md-12 d-flex align-items-center justify-content-md-end px-5 mb-5">
                <a href="#" class="btn btn-primary subtotal" style="margin-right: 5px;">
                    <i class="ti ti-plus"></i>Subtotal
                </a>
                <a href="#"class="btn btn-primary mr-5 substop" style="margin-right: 5px;">
                    <i class="ti ti-plus"></i>SubStop
                </a>
                <a href="#" class="btn btn-primary mr-5 subitem" style="margin-right: 5px;">
                    <i class="ti ti-plus"></i>Item
                </a>
                <a href="#" class="btn btn-primary mr-5 subcomment" style="margin-right: 5px;">
                    <i class="ti ti-plus"></i>Comment
                </a>
                <a href="#"  class="btn btn-primary mr-5 subblank" style="margin-right: 5px;">
                    <i class="ti ti-plus"></i>Blank Row
                </a>
                <a href="#" class="btn btn-primary mr-5 subcustomitem" data-ajax-popup="true" data-size="md" data-title="<?php echo e(__('Create New Custom Item')); ?>" data-url="<?php echo e(route('salesquote.customitem')); ?>" data-toggle="tooltip" title="<?php echo e(__('Create')); ?>" style="margin-right: 5px;">
                    <i class="ti ti-plus"></i>Custom Item
                </a>
            </div>

            <div class="table-responsive">
                <table class="table ui-sortable" id="tblLocations">
                    <thead>
                        <tr>
                            <th>*</th>
                            <th>Profit</th>
                            <th>Mark-Up</th>
                            <th>Cost</th>
                            <th>Supplier</th>
                            <th>Supplier #</th>
                            <th>MFG</th>
                            <th>MFG #</th>
                            <th width="13%">Description</th>
                            <th>QTY</th>
                            <th>Price</th>
                            <th>Extended</th>
                            <th>Tax</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="add-list">

                    </tbody>
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
                        <td class="text-end totalcost" width="10%">0.00</td>
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
<?php /**PATH /home/dimensionsystems/webcrm.dimensionsystems.com/resources/views/invoice/section.blade.php ENDPATH**/ ?>