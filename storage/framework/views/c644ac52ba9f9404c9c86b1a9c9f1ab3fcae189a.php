<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Create Sales Quote')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Sales Quote')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-breadcrumb'); ?>
    <?php echo e(__('Sales Quote')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php if(module_is_active('Sales')): ?>
        <script>
            $(document).on('click','.delete-item',function () {
                var id = $(this).parent().parent().attr('data-sub-id');
                $(this).parent().parent().remove();
                $(".item").trigger("change");
            });

            $(document).on('click','.duplicate-item',function () {
                var duplicate_item=$(this).parent().parent().html();
                console.log(duplicate_item);
            });

            $(document).on('change', '.item', function() {
                items($(this));
            });
            function items(data)
            {
                var in_type = $('#invoice_type').val();
                if (in_type == 'salesquote') {

                    var iteams_id = data.val();
                    var url = data.data('url');
                    var el = data;
                    var quntity=data.closest().find('.quantity');
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
                            $(el.parent().parent().parent().find('.quantity')).val(1);

                            if(item.product != null)
                            {
                                if(isNaN(parseFloat(item.purchase_price)))
                                {
                                    var cost = parseFloat(0);
                                }
                                else
                                {
                                    var cost = parseFloat(item.purchase_price);
                                }

                                if(isNaN(parseFloat(item.markup)))
                                {
                                    var markup = parseFloat(0);
                                }
                                else
                                {
                                    var markup = parseFloat(item.markup);
                                }

                                var sales_price=parseFloat((cost+(cost*parseFloat(markup)/100))* 1).toFixed(2);
                                // alert(sales_price);
                                $(el.parent().parent().parent().find('.price')).val(sales_price);
                                $(el.parent().parent().parent().find('.pro_description')).val(item.product.description);
                                $(el.parent().parent().parent().find('.markup')).val(item.markup);
                                $(el.parent().parent().parent().find('.cost')).val(item.purchase_price);
                                $(el.parent().parent().parent().find('.manufacturer_part_number')).val(item.manufacturer_part_number);
                                $(el.parent().parent().parent().find('.manufacturer_name')).val(item.manufacturer_name);
                                $(el.parent().parent().parent().find('.supplier_part_number')).val(item.supplier_part_number);
                                $(el.parent().parent().parent().find('.supplier_name')).val(item.supplier_name);
                                var profit=parseFloat(sales_price)-parseFloat(item.purchase_price);

                                $(el.parent().parent().parent().find('.profit')).val(parseFloat(profit));

                                var quantiye=el.parent().parent().parent().find('.quantity').val();

                                var extended=parseFloat(sales_price)*parseFloat(quantiye);
                                $(el.parent().parent().parent().find('.extended')).val(extended);

                                // var main_cost=parseFloat($("body").find("tr[data-id]").last().find(".main_cost").val());
                                // var main_quantity=parseFloat($("body").find("tr[data-id]").last().find(".main_quantity").val());

                                var sub_data_id=el.parent().parent().parent().attr('sub-data-id');
                                var elements = document.querySelectorAll('[sub-data-id="'+sub_data_id+'"]');
                                var  maindiv= document.querySelector('tr[data-id="' + sub_data_id + '"]');

                                // var main_quantity=parseFloat(0);
                                // $( ".quantity").each(function( index,element ) {
                                //     main_quantity=main_quantity+ parseFloat($(element).val());
                                //
                                //     $("body").find("tr[data-id]").last().find(".main_quantity").val(main_quantity);
                                // });

                                //main quantity
                                var main_quantity=parseFloat(0);
                                for (var i = 0; i < elements.length; i++) {
                                    var element = elements[i];
                                    var quantityInput = element.querySelector('.quantity');
                                    var quantityValue = quantityInput.value;
                                    if(quantityValue.length == 0)
                                    {
                                        quantityValue = 0;
                                    }
                                    main_quantity=main_quantity+ parseFloat(quantityValue);
                                }
                                if (maindiv) {
                                    var mainCostInput = maindiv.querySelector('input.main_quantity');
                                    mainCostInput.value = main_quantity;
                                }

                                //main cost
                                var main_cost=parseFloat(0);
                                var shipping_charge=parseFloat(0);
                                var labor_charge=parseFloat(0);

                                for (var i = 0; i < elements.length; i++) {
                                    var element = elements[i];
                                    var costInput = element.querySelector('.cost');
                                    var costValue = costInput.value;
                                    if(costValue.length==0)
                                    {
                                        costValue=0;
                                    }
                                    if(element.querySelector('.item').value == "Shipping" || element.querySelector('.item').value == "shipping")
                                    {
                                        shipping_charge=shipping_charge + parseFloat(costValue);
                                    }
                                    if(element.querySelector('.item').value == "Labor" || element.querySelector('.item').value == "labor")
                                    {
                                        labor_charge=labor_charge + parseFloat(costValue);
                                    }

                                    main_cost=main_cost+ parseFloat(costValue);
                                }
                                if (maindiv) {
                                    var mainCostInput = maindiv.querySelector('input.main_cost');
                                    mainCostInput.value = main_cost.toFixed(2);

                                    if(shipping_charge!=0)
                                    {
                                        var mainshippingInput = maindiv.querySelector('input.shipping_charge');
                                        mainshippingInput.value = parseFloat(shipping_charge).toFixed(2);
                                    }

                                    if(labor_charge!=0)
                                    {
                                        var mainlaborInput = maindiv.querySelector('input.labor_charge');
                                        mainlaborInput.value = parseFloat(labor_charge).toFixed(2);
                                    }
                                }

                                var main_profit=parseFloat(0);
                                for (var i = 0; i < elements.length; i++) {
                                    var element = elements[i];
                                    var profitInput = element.querySelector('.profit');
                                    var profitValue = profitInput.value;
                                    if(profitValue.length==0)
                                    {
                                        profitValue=0;
                                    }
                                    main_profit=main_profit+ parseFloat(profitValue);
                                }

                                if (maindiv) {
                                    var mainProfitInput = maindiv.querySelector('input.main_profit');
                                    mainProfitInput.value = main_profit;
                                }

                                //total mainprofit
                                var totalprofit=parseFloat(0);
                                $(".main_profit").each(function (index,element) {
                                    totalprofit=parseFloat(totalprofit)+ parseFloat($(element).val());
                                    $(".totalprofit").html(totalprofit.toFixed(2));
                                });

                                //total maincost
                                var maincost=parseFloat(0);
                                var mainquantity=parseFloat(0);
                                $(".main_cost").each(function (index,element) {
                                    var quntity=parseFloat($(element).closest("tr").find(".main_quantity").val());
                                    var cost = parseFloat($(element).val());
                                    maincost=maincost+parseFloat($(element).val());
                                    mainquantity=mainquantity+parseFloat(quntity);
                                    var totalmaincost=parseFloat(cost*quntity);
                                    $(element).closest("tr[data-id]").find(".totalmaincost").val(totalmaincost)
                                });

                                var totalcost=parseFloat(0);
                                $( ".totalmaincost" ).each(function( index ,element) {
                                    totalcost=totalcost+parseFloat($(element).val());
                                    if(!isNaN(totalcost))
                                    {
                                        $(".totalcost").html(totalcost.toFixed(2));
                                    }
                                    else
                                    {
                                        totalcost=0;
                                    }
                                });

                                //total mainshipping
                                var mainshipping=parseFloat(0);
                                var mainquantity=parseFloat(0);
                                $(".shipping_charge").each(function (index,element) {
                                    var quntity=parseFloat($(element).closest("tr").find(".main_quantity").val());
                                    var shipping_charge = parseFloat($(element).val());
                                    mainshipping=mainshipping+shipping_charge;
                                    mainquantity=mainquantity+parseFloat(quntity);
                                    var totalshipping=parseFloat(shipping_charge*quntity);
                                    $(element).closest("tr[data-id]").find(".totalshippingcost").val(totalshipping)
                                });

                                var totalshippingcharge=parseFloat(0);
                                $( ".totalshippingcost" ).each(function( index ,element) {
                                    totalshippingcharge=totalshippingcharge+parseFloat($(element).val());
                                    if(!isNaN(totalshippingcharge)) {
                                        $(".totalshipping").html(totalshippingcharge.toFixed(2));
                                    }
                                    else
                                    {
                                        totalshippingcharge=0;
                                    }
                                });

                                //total mainlabor
                                var mainlabor=parseFloat(0);
                                var mainquantity=parseFloat(0);
                                $(".labor_charge").each(function (index,element) {
                                    var quntity=parseFloat($(element).closest("tr").find(".main_quantity").val());
                                    var labor_charge = parseFloat($(element).val());
                                    mainlabor=mainlabor+labor_charge;
                                    mainquantity=mainquantity+parseFloat(quntity);
                                    var totallabor=parseFloat(labor_charge*quntity);
                                    $(element).closest("tr[data-id]").find(".totallaborcharge").val(totallabor)
                                });

                                var totallaborcharge=parseFloat(0);
                                $( ".totallaborcharge" ).each(function( index ,element) {
                                    totallaborcharge=totallaborcharge+parseFloat($(element).val());
                                    if(!isNaN(totallaborcharge))
                                    {
                                        $(".totallabor").html(totallaborcharge.toFixed(2));
                                    }
                                    else
                                    {
                                        totallaborcharge=0;
                                    }
                                });

                                var totalproduct=totalcost-totalshippingcharge-totallaborcharge;

                                if(totalproduct!=0)
                                {
                                    $(".totalproduct").html(totalproduct.toFixed(2));
                                }
                                else
                                {
                                    $(".totalproduct").html(totalcost);
                                }

                                var main_price=parseFloat(0);
                                for (var i = 0; i < elements.length; i++) {
                                    var element = elements[i];
                                    var priceInput = element.querySelector('.price');
                                    var priceValue = priceInput.value;
                                    if(priceValue.length==0)
                                    {
                                        priceValue=0;
                                    }
                                    main_price=main_price+ parseFloat(priceValue);

                                   var mainextend= parseFloat(main_price)*main_quantity;

                                }

                                if (maindiv) {
                                    var mainmainpriceInput = maindiv.querySelector('input.main_price');
                                    mainmainpriceInput.value = parseFloat(main_price).toFixed(2);

                                    var mainextendedInput = maindiv.querySelector('input.main_extended');
                                    mainextendedInput.value = parseFloat(mainextend).toFixed(2);
                                }

                                var totalprice=parseFloat(0);
                                $( ".main_price" ).each(function( index ,element) {
                                    totalprice=totalprice+parseFloat($(element).val());
                                });

                                var gp=((totalprice.toFixed(2)-maincost.toFixed(2))/totalprice.toFixed(2))*100;
                                $(".totalgp").html(gp.toFixed(2));

                                var totalextended=parseFloat(0);
                                $( ".main_extended" ).each(function( index ,element) {
                                    totalextended=totalextended+parseFloat($(element).val());
                                });

                                var total=totalextended;
                                $(".maintotal").html(total.toFixed(2));
                            }
                            else
                            {
                                $(el.parent().parent().parent().find('.price')).val(0);
                                $(el.parent().parent().parent().find('.pro_description')).val('');
                            }


                            var taxes = '';
                            var tax = [];

                            var totalItemTaxRate = 0;

                            if (item.taxes == 0) {
                                taxes += '-';
                            } else {
                                for (var i = 0; i < item.taxes.length; i++) {
                                    taxes += '<span class="badge bg-primary p-2 px-3 rounded mt-1 mr-1">' +
                                        item.taxes[i].name + ' ' + '(' + item.taxes[i].rate + '%)' +
                                        '</span>';
                                    tax.push(item.taxes[i].id);
                                    totalItemTaxRate += parseFloat(item.taxes[i].rate);
                                }
                            }
                            var itemTaxPrice = 0;
                            if(item.product != null)
                            {
                                var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (sales_price * 1));
                            }
                            $(el.parent().parent().parent().find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));
                            $(el.parent().parent().parent().find('.itemTaxRate')).val(totalItemTaxRate.toFixed(2));
                            $(el.parent().parent().parent().find('.taxes')).html(taxes);
                            $(el.parent().parent().parent().find('.tax')).val(tax);
                            $(el.parent().parent().find('.unit')).html(item.unit);
                            $(el.parent().parent().find('.discount')).val(0);
                            // $(el.parent().parent().find('.amount')).html(sales_price);

                            var inputs=$(".main_cost");
                            var subcost=0;
                            for (var i = 0; i < inputs.length; i++) {
                                subcost=parseFloat(subTotal) + parseFloat($(inputs[i]).val());
                            }


                            var inputs = $(".amount");
                            var subTotal = 0;
                            for (var i = 0; i < inputs.length; i++) {

                                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).val());
                            }

                            var totalItemPrice = 0;
                            var priceInput = $('.price');
                            for (var j = 0; j < priceInput.length; j++) {
                                totalItemPrice += parseFloat(priceInput[j].value);
                            }

                            var totalItemTaxPrice = 0;
                            var itemTaxPriceInput = $('.itemTaxPrice');

                            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
                                if(item.product != null)
                                {
                                    // console.log(parseFloat(itemTaxPriceInput[j].value),'sdsf');
                                    $(el.parent().parent().parent().find('.amount')).val(parseFloat(sales_price)+parseFloat(itemTaxPriceInput[j].value));
                                }
                            }

                            var totalItemDiscountPrice = 0;
                            var itemDiscountPriceInput = $('.discount');

                            for (var k = 0; k < itemDiscountPriceInput.length; k++) {

                                totalItemDiscountPrice += parseFloat(itemDiscountPriceInput[k].value);
                            }

                            $('.subTotal').html(totalItemPrice.toFixed(2));
                            $('.totalTax').html(totalItemTaxPrice.toFixed(2));
                            $('.totalAmount').html((parseFloat(total)+ parseFloat(totalItemTaxPrice)).toFixed(2));
                        },
                    });
                }
            }
        </script>
    <?php endif; ?>
    <script src="<?php echo e(asset('js/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.repeater.min.js')); ?>"></script>

    <script>
        $(document).on('keyup','.markup',function () {
            var el = $(this).parent().parent().parent();
            var markup=parseFloat($(this).val());

            var cost= $(el.find('.cost')).val();
            if(!isNaN(markup))
            {
                var pr=cost*parseFloat(markup)/100;
                var price=parseFloat(cost)+parseFloat(pr);
                $(el.find('.price')).val(price.toFixed(2));
            }
            $(".quantity").trigger("keyup");
        });
        $(document).on('keyup','.cost',function () {
            var el = $(this).parent().parent().parent();
            var markup=$(el.find('.markup')).val();
            var cost= $(this).val();
            var pr=cost*parseFloat(markup)/100;
            var price=parseFloat(cost)+parseFloat(pr);
            if(isNaN(price))
            {
                $(el.find('.price')).val(0);
            }
            else
            {
                $(el.find('.price')).val(price.toFixed(2));
            }
            $(".quantity").trigger("keyup");
        });

        $(document).on('keyup','.main_quantity',function () {
            var quntity=$(this).val();
            var el=$(this).parent().parent().parent();
            var mainprice=$(el.find('.main_price')).val();
            var extendeds=parseFloat(mainprice)*parseFloat(quntity);
            if(isNaN(extendeds))
            {
                $(el.find('.main_extended')).val(0);
            }
            else
            {
                $(el.find('.main_extended')).val(extendeds.toFixed(2));
            }

            var sub_data_id=el.attr('sub-data-id');
            var elements = document.querySelectorAll('[sub-data-id="'+sub_data_id+'"]');
            var  maindiv= document.querySelector('tr[data-id="' + sub_data_id + '"]');

            var main_price=parseFloat(0);

            for (var i = 0; i < elements.length; i++) {
                var element = elements[i];

                var priceInput = element.querySelector('.price');
                var priceValue = priceInput.value;

                if(priceValue.length==0)
                {
                    priceValue=0;
                }
                main_price=parseFloat(main_price)+ parseFloat(priceValue);
                var mainextend= parseFloat(main_price)*main_quantity;
            }
            // alert(main_price);

            if (maindiv) {
                var mainProfitInput = maindiv.querySelector('input.main_price');
                mainProfitInput.value = parseFloat(main_price).toFixed(2);


                var mainextendedInput = maindiv.querySelector('input.main_extended');
                mainextendedInput.value = parseFloat(mainextend).toFixed(2);
            }
            var totalextended=parseFloat(0);
            $( ".main_extended" ).each(function( index ,element) {
                totalextended=totalextended+parseFloat($(element).val());
            });

            var total=totalextended;
            $(".maintotal").html(total.toFixed(2));
          if($('.totalTax').html(""))
          {
              var  tax=0;
          }
          else
          {
              var tax = $('.totalTax').html();
          }

            $('.totalAmount').html((parseFloat(total)+ parseFloat(tax)).toFixed(2));

            //main cost
            var main_cost=parseFloat(0);
            var shipping_charge=parseFloat(0);
            var labor_charge=parseFloat(0);

            for (var i = 0; i < elements.length; i++) {
                var element = elements[i];
                var costInput = element.querySelector('.cost');
                var costValue = costInput.value;
                if(costValue.length==0)
                {
                    costValue=0;
                }
                if(element.querySelector('.item').value == "Shipping" || element.querySelector('.item').value == "shipping")
                {
                    shipping_charge=shipping_charge + parseFloat(costValue);
                }
                if(element.querySelector('.item').value == "Labor" || element.querySelector('.item').value == "labor")
                {
                    labor_charge=labor_charge + parseFloat(costValue);
                }

                main_cost=main_cost+ parseFloat(costValue);
            }
            if (maindiv) {
                var mainCostInput = maindiv.querySelector('input.main_cost');
                mainCostInput.value = main_cost.toFixed(2);

                if(shipping_charge!=0)
                {
                    var mainshippingInput = maindiv.querySelector('input.shipping_charge');
                    mainshippingInput.value = parseFloat(shipping_charge).toFixed(2);
                }

                if(labor_charge!=0)
                {
                    var mainlaborInput = maindiv.querySelector('input.labor_charge');
                    mainlaborInput.value = parseFloat(labor_charge).toFixed(2);
                }
            }

            //total maincost
            var maincost=parseFloat(0);
            var mainquantity=parseFloat(0);
            $(".main_cost").each(function (index,element) {
                var quntity=parseFloat($(element).closest("tr").find(".main_quantity").val());
                var cost = parseFloat($(element).val());
                maincost=maincost+parseFloat($(element).val());
                mainquantity=mainquantity+parseFloat(quntity);
                var totalmaincost=parseFloat(cost*quntity);
                $(element).closest("tr[data-id]").find(".totalmaincost").val(totalmaincost)
            });

            var totalcost=parseFloat(0);
            $( ".totalmaincost" ).each(function( index ,element) {
                totalcost=totalcost+parseFloat($(element).val());
                if(!isNaN(totalcost))
                {
                    $(".totalcost").html(totalcost.toFixed(2));
                }
                else
                {
                    totalcost=0;
                }
            });

            //total mainshipping
            var mainshipping=parseFloat(0);
            var mainquantity=parseFloat(0);
            $(".shipping_charge").each(function (index,element) {
                var quntity=parseFloat($(element).closest("tr").find(".main_quantity").val());
                var shipping_charge = parseFloat($(element).val());
                mainshipping=mainshipping+shipping_charge;
                mainquantity=mainquantity+parseFloat(quntity);
                var totalshipping=parseFloat(shipping_charge*quntity);
                $(element).closest("tr[data-id]").find(".totalshippingcost").val(totalshipping)
            });

            var totalshippingcharge=parseFloat(0);
            $( ".totalshippingcost" ).each(function( index ,element) {
                totalshippingcharge=totalshippingcharge+parseFloat($(element).val());
                if(!isNaN(totalshippingcharge)) {
                    $(".totalshipping").html(totalshippingcharge.toFixed(2));
                }
                else
                {
                    totalshippingcharge=0;
                }
            });

            //total mainlabor
            var mainlabor=parseFloat(0);
            var mainquantity=parseFloat(0);
            $(".labor_charge").each(function (index,element) {
                var quntity=parseFloat($(element).closest("tr").find(".main_quantity").val());
                var labor_charge = parseFloat($(element).val());
                mainlabor=mainlabor+labor_charge;
                mainquantity=mainquantity+parseFloat(quntity);
                var totallabor=parseFloat(labor_charge*quntity);
                $(element).closest("tr[data-id]").find(".totallaborcharge").val(totallabor)
            });

            var totallaborcharge=parseFloat(0);
            $( ".totallaborcharge" ).each(function( index ,element) {
                totallaborcharge=totallaborcharge+parseFloat($(element).val());
                if(!isNaN(totallaborcharge))
                {
                    $(".totallabor").html(totallaborcharge.toFixed(2));
                }
                else
                {
                    totallaborcharge=0;
                }
            });

            var totalproduct=totalcost-totalshippingcharge-totallaborcharge;

            if(totalproduct!=0)
            {
                $(".totalproduct").html(totalproduct.toFixed(2));
            }
            else
            {
                $(".totalproduct").html(totalcost);
            }
        });

        $(document).on('keyup', '.quantity', function () {
            var quntityTotalTaxPrice = 0;

            var el = $(this).parent().parent().parent();

            var quantity = $(this).val();
            var price = $(el.find('.price')).val();
            // var discount = $(el.find('.discount')).val();
            // if(discount.length <= 0)
            // {
            //     discount = 0 ;
            // }
            // - discount
            var totalItemPrice = (quantity * price);

            var amount = (totalItemPrice);


            var totalItemTaxRate = $(el.find('.itemTaxRate')).val();
            var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
            $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));

            $(el.find('.amount')).val(parseFloat(itemTaxPrice)+parseFloat(amount));

            var totalItemTaxPrice = 0;
            var itemTaxPriceInput = $('.itemTaxPrice');
            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
            }


            var totalItemPrice = 0;
            var inputs_quantity = $(".quantity");

            var priceInput = $('.price');
            for (var j = 0; j < priceInput.length; j++) {
                totalItemPrice += (parseFloat(priceInput[j].value) * parseFloat(inputs_quantity[j].value));
            }

            var inputs = $(".amount");

            var subTotal = 0;
            for (var i = 0; i < inputs.length; i++) {
                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).val());
            }

            $('.subTotal').html(totalItemPrice.toFixed(2));
            $('.totalTax').html(totalItemTaxPrice.toFixed(2));
            $('.totalAmount').html((parseFloat(subTotal)).toFixed(2));

            var sales_price=$(this).parent().parent().parent().find('.price').val();
            var purchase_price=$(this).parent().parent().parent().find('.cost').val();
            var profit=parseFloat(sales_price)-parseFloat(purchase_price);
            if(isNaN(profit))
            {
                el.find('.profit').val(0);
            }
            else
            {
                el.find('.profit').val(parseFloat(profit).toFixed(2));
            }

            var quantiye=el.parent().parent().parent().find('.quantity').val();
            var extended=parseFloat(sales_price)*parseFloat(quantiye);
            if(isNaN(extended))
            {
                el.find('.extended').val(0);
            }
            else
            {
                el.find('.extended').val(extended);
            }

            //

            var sub_data_id=el.attr('sub-data-id');
            var elements = document.querySelectorAll('[sub-data-id="'+sub_data_id+'"]');
            var  maindiv= document.querySelector('tr[data-id="' + sub_data_id + '"]');

            var main_quantity=parseFloat(0);
            $( ".quantity").each(function( index,element ) {
                main_quantity=main_quantity+ parseFloat($(element).val());
                maindiv.querySelector('input.main_quantity').value=main_quantity;
            });
            //main quantity
            var main_quantity=parseFloat(0);
            for (var i = 0; i < elements.length; i++) {
                var element = elements[i];
                var quantityInput = element.querySelector('.quantity');
                var quantityValue = quantityInput.value;

                if(quantityValue.length == 0)
                {
                    quantityValue = 0;
                }
                main_quantity=main_quantity+ parseFloat(quantityValue);
            }
            if (maindiv) {
                var mainCostInput = maindiv.querySelector('input.main_quantity');
                mainCostInput.value = main_quantity;
            }

            var main_price=parseFloat(0);

            for (var i = 0; i < elements.length; i++) {
                var element = elements[i];

                var priceInput = element.querySelector('.price');
                var priceValue = priceInput.value;

                if(priceValue.length==0)
                {
                    priceValue=0;
                }
                main_price=parseFloat(main_price)+ parseFloat(priceValue);
                var mainextend= parseFloat(main_price)*main_quantity;
            }
            // alert(main_price);

            if (maindiv) {
                var mainProfitInput = maindiv.querySelector('input.main_price');
                mainProfitInput.value = parseFloat(main_price).toFixed(2);


                var mainextendedInput = maindiv.querySelector('input.main_extended');
                mainextendedInput.value = parseFloat(mainextend).toFixed(2);
            }


            //main cost
            var main_cost=parseFloat(0);
            var shipping_charge=parseFloat(0);
            var labor_charge=parseFloat(0);

            for (var i = 0; i < elements.length; i++) {
                var element = elements[i];
                var costInput = element.querySelector('.cost');
                var costValue = costInput.value;
                if(costValue.length==0)
                {
                    costValue=0;
                }
                if(element.querySelector('.item').value == "Shipping" || element.querySelector('.item').value == "shipping")
                {
                    shipping_charge=shipping_charge + parseFloat(costValue);
                }
                if(element.querySelector('.item').value == "Labor" || element.querySelector('.item').value == "labor")
                {
                    labor_charge=labor_charge + parseFloat(costValue);
                }

                main_cost=main_cost+ parseFloat(costValue);
            }
            if (maindiv) {
                var mainCostInput = maindiv.querySelector('input.main_cost');
                mainCostInput.value = main_cost.toFixed(2);

                if(shipping_charge!=0)
                {
                    var mainshippingInput = maindiv.querySelector('input.shipping_charge');
                    mainshippingInput.value = parseFloat(shipping_charge).toFixed(2);
                }

                if(labor_charge!=0)
                {
                    var mainlaborInput = maindiv.querySelector('input.labor_charge');
                    mainlaborInput.value = parseFloat(labor_charge).toFixed(2);
                }
            }

            var main_profit=parseFloat(0);
            for (var i = 0; i < elements.length; i++) {
                var element = elements[i];
                var profitInput = element.querySelector('.profit');
                var profitValue = profitInput.value;
                if(profitValue.length==0)
                {
                    profitValue=0;
                }
                main_profit=main_profit+ parseFloat(profitValue);
            }

            if (maindiv) {
                var mainProfitInput = maindiv.querySelector('input.main_profit');
                mainProfitInput.value = main_profit;
            }



            //total mainprofit
            var totalprofit=parseFloat(0);
            $(".main_profit").each(function (index,element) {
                totalprofit=parseFloat(totalprofit)+ parseFloat($(element).val());
                $(".totalprofit").html(totalprofit.toFixed(2));
            });

            //total maincost
            var maincost=parseFloat(0);
            var mainquantity=parseFloat(0);
            $(".main_cost").each(function (index,element) {
                var quntity=parseFloat($(element).closest("tr").find(".main_quantity").val());
                var cost = parseFloat($(element).val());
                maincost=maincost+parseFloat($(element).val());
                mainquantity=mainquantity+parseFloat(quntity);
                var totalmaincost=parseFloat(cost*quntity);
                $(element).closest("tr[data-id]").find(".totalmaincost").val(totalmaincost)
            });

            var totalcost=parseFloat(0);
            $( ".totalmaincost" ).each(function( index ,element) {
                totalcost=totalcost+parseFloat($(element).val());
                if(!isNaN(totalcost))
                {
                    $(".totalcost").html(totalcost.toFixed(2));
                }
                else
                {
                    totalcost=0;
                }
            });

            //total mainshipping
            var mainshipping=parseFloat(0);
            var mainquantity=parseFloat(0);
            $(".shipping_charge").each(function (index,element) {
                var quntity=parseFloat($(element).closest("tr").find(".main_quantity").val());
                var shipping_charge = parseFloat($(element).val());
                mainshipping=mainshipping+shipping_charge;
                mainquantity=mainquantity+parseFloat(quntity);
                var totalshipping=parseFloat(shipping_charge*quntity);
                $(element).closest("tr[data-id]").find(".totalshippingcost").val(totalshipping)
            });

            var totalshippingcharge=parseFloat(0);
            $( ".totalshippingcost" ).each(function( index ,element) {
                totalshippingcharge=totalshippingcharge+parseFloat($(element).val());
                if(!isNaN(totalshippingcharge)) {
                    $(".totalshipping").html(totalshippingcharge.toFixed(2));
                }
                else
                {
                    totalshippingcharge=0;
                }
            });

            //total mainlabor
            var mainlabor=parseFloat(0);
            var mainquantity=parseFloat(0);
            $(".labor_charge").each(function (index,element) {
                var quntity=parseFloat($(element).closest("tr").find(".main_quantity").val());
                var labor_charge = parseFloat($(element).val());
                mainlabor=mainlabor+labor_charge;
                mainquantity=mainquantity+parseFloat(quntity);
                var totallabor=parseFloat(labor_charge*quntity);
                $(element).closest("tr[data-id]").find(".totallaborcharge").val(totallabor)
            });

            var totallaborcharge=parseFloat(0);
            $( ".totallaborcharge" ).each(function( index ,element) {
                totallaborcharge=totallaborcharge+parseFloat($(element).val());
                if(!isNaN(totallaborcharge))
                {
                    $(".totallabor").html(totallaborcharge.toFixed(2));
                }
                else
                {
                    totallaborcharge=0;
                }
            });

            var totalproduct=totalcost-totalshippingcharge-totallaborcharge;

            if(totalproduct!=0)
            {
                $(".totalproduct").html(totalproduct.toFixed(2));
            }
            else
            {
                $(".totalproduct").html(totalcost);
            }




            var totalprice=parseFloat(0);
            $( ".main_price" ).each(function( index ,element) {
                totalprice=totalprice+parseFloat($(element).val());
            });


            var totalextended=parseFloat(0);
            $( ".main_extended" ).each(function( index ,element) {
                totalextended=totalextended+parseFloat($(element).val());
            });

            var gp=((totalprice.toFixed(2)-maincost.toFixed(2))/totalprice.toFixed(2))*100;
            $(".totalgp").html(gp.toFixed(2));

            var total=totalextended;
            $(".maintotal").html(total.toFixed(2));
            if(isNaN(parseFloat(totalItemTaxPrice)))
            {
                totalItemTaxPrice=0;
            }

            $('.totalAmount').html((parseFloat(total)+ parseFloat(totalItemTaxPrice)).toFixed(2));
        })

        $(document).on('keyup change', '.price', function () {
            var el = $(this).parent().parent().parent().parent();
            var price = $(this).val();
            var quantity = $(el.find('.quantity')).val();
            if(quantity.length <= 0)
            {
                quantity = 1 ;
            }
            var discount = $(el.find('.discount')).val();
            if(discount.length <= 0)
            {
                discount = 0 ;
            }
            var totalItemPrice = (quantity * price)-discount;

            var amount = (totalItemPrice);

            var totalItemTaxRate = $(el.find('.itemTaxRate')).val();
            var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
            $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));

            $(el.find('.amount')).html(parseFloat(itemTaxPrice)+parseFloat(amount));

            var totalItemTaxPrice = 0;
            var itemTaxPriceInput = $('.itemTaxPrice');
            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
            }


            var totalItemPrice = 0;
            var inputs_quantity = $(".quantity");
            var priceInput = $('.price');
            for (var j = 0; j < priceInput.length; j++) {
                if(inputs_quantity[j].value <= 0)
                {
                    inputs_quantity[j].value = 1 ;
                }
                totalItemPrice += (parseFloat(priceInput[j].value) * parseFloat(inputs_quantity[j].value));
            }

            var inputs = $(".amount");

            var subTotal = 0;
            for (var i = 0; i < inputs.length; i++) {
                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
            }

            $('.subTotal').html(totalItemPrice.toFixed(2));
            $('.totalTax').html(totalItemTaxPrice.toFixed(2));

            $('.totalAmount').html((parseFloat(subTotal)).toFixed(2));
        })

        $(document).on('keyup change', '.discount', function () {
            var el = $(this).parent().parent().parent();
            var discount = $(this).val();
            if(discount.length <= 0)
            {
                discount = 0 ;
            }

            var price = $(el.find('.price')).val();
            var quantity = $(el.find('.quantity')).val();
            var totalItemPrice = (quantity * price) - discount;


            var amount = (totalItemPrice);


            var totalItemTaxRate = $(el.find('.itemTaxRate')).val();
            var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
            $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));

            $(el.find('.amount')).html(parseFloat(itemTaxPrice)+parseFloat(amount));

            var totalItemTaxPrice = 0;
            var itemTaxPriceInput = $('.itemTaxPrice');
            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
            }


            var totalItemPrice = 0;
            var inputs_quantity = $(".quantity");

            var priceInput = $('.price');
            for (var j = 0; j < priceInput.length; j++) {
                totalItemPrice += (parseFloat(priceInput[j].value) * parseFloat(inputs_quantity[j].value));
            }

            var inputs = $(".amount");

            var subTotal = 0;
            for (var i = 0; i < inputs.length; i++) {
                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
            }


            var totalItemDiscountPrice = 0;
            var itemDiscountPriceInput = $('.discount');

            for (var k = 0; k < itemDiscountPriceInput.length; k++) {
                if (itemDiscountPriceInput[k].value == '') {
                    itemDiscountPriceInput[k].value = parseFloat(0);
                }
                totalItemDiscountPrice += parseFloat(itemDiscountPriceInput[k].value);
            }


            $('.subTotal').html(totalItemPrice.toFixed(2));
            $('.totalTax').html(totalItemTaxPrice.toFixed(2));

            $('.totalAmount').html((parseFloat(subTotal)).toFixed(2));
            $('.totalDiscount').html(totalItemDiscountPrice.toFixed(2));
        })
    </script>

    <script>


        
        
        
        
        
        
        $(document).on('change', '#customer', function() {
            $('#customer_detail').removeClass('d-none');
            $('#customer_detail').addClass('d-block');
            $('#customer-box').removeClass('d-block');
            $('#customer-box').addClass('d-none');
            var id = $(this).val();
            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': jQuery('#token').val()
                },
                data: {
                    'id': id
                },
                cache: false,
                success: function(data) {

                    if (data != '') {
                        $('#customer_detail').html(data);
                    } else {
                        $('#customer-box').removeClass('d-none');
                        $('#customer-box').addClass('d-block');
                        $('#customer_detail').removeClass('d-block');
                        $('#customer_detail').addClass('d-none');
                    }

                },

            });
        });

        $(document).on('click', '#remove', function() {
            $('#customer-box').removeClass('d-none');
            $('#customer-box').addClass('d-block');
            $('#customer_detail').removeClass('d-block');
            $('#customer_detail').addClass('d-none');
        })
    </script>
    <script>
        $(document).ready(function() {
            SectionGet('salesquote');
        });
    </script>
    <script>
        $(document).on('change', '#tax_project', function() {
            var tax_id = $(this).val();
            if (tax_id.length != 0) {
                $.ajax({
                    type: 'post',
                    url: "<?php echo e(route('get.taxes')); ?>",
                    data: {
                        _token: "<?php echo e(csrf_token()); ?>",
                        tax_id: tax_id,
                    },
                    beforeSend: function() {
                        $("#loader").removeClass('d-none');
                    },
                    success: function(response) {
                        var response = jQuery.parseJSON(response);
                        if (response != null) {
                            $("#loader").addClass('d-none');
                            var TaxRate = 0;
                            if (response.length > 0) {
                                $.each(response, function(i) {
                                    TaxRate = parseInt(response[i]['rate']) + TaxRate;
                                });
                            }
                            $(".itemTaxRate").val(TaxRate);
                            $(".price").change();
                        } else {
                            $(".itemTaxRate").val(0);
                            $(".price").change();
                            $('.section_div').html('');
                            toastrs('Error', 'Something went wrong please try again !', 'error');
                        }
                    },
                });
            }
            else
            {
                $(".itemTaxRate").val(0);
                $('.taxes').html("");
                $(".price").change();
                $("#loader").addClass('d-none');
            }
        });

        function SectionGet(type = 'salesquote', project_id = "0",title = 'SalesQuote') {
            $.ajax({
                type: 'post',
                url: "<?php echo e(route('invoice.section.type')); ?>",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    type: type,
                    project_id: project_id,
                    acction: 'create',
                },
                beforeSend: function() {
                    $("#loader").removeClass('d-none');
                },
                success: function(response) {
                    console.log(response);
                    if (response != false) {
                        $('.section_div').html(response.html);
                        $("#loader").addClass('d-none');
                        $('.pro_name').text(title)
                        // for item SearchBox ( this function is  custom Js )
                        JsSearchBox();
                    } else {
                        $('.section_div').html('');
                        toastrs('Error', 'Something went wrong please try again !', 'error');
                    }
                },
            });
        }

    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">

    <form method="POST" action="<?php echo e(route('salesquote.store')); ?>" class="w-100">
       
        <input type="hidden" name="_token" id="token" value="<?php echo e(csrf_token()); ?>">
        <?php if(module_is_active('Taskly')): ?>
            <input type="hidden" name="invoice_type" id="invoice_type" value="salesquote">
       <?php endif; ?>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group" id="customer-box">
                                <?php echo e(Form::label('customer_id', __('Customer'), ['class' => 'form-label'])); ?>

                                  <span class="text-danger">*</span>
                                <select name="customer_id" class="form-control" id="customer" data-url="<?php echo e(route('invoice.customer')); ?>" required="required">
                                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if(empty($customers->count())): ?>
                                    <div class=" text-xs">
                                        <?php echo e(__('Please create Customer/Client first.')); ?><a
                                                <?php if(module_is_active('Account')): ?> href="<?php echo e(route('customer.index')); ?>"  <?php else: ?> href="<?php echo e(route('users.index')); ?>" <?php endif; ?>><b><?php echo e(__('Create Customer/Client')); ?></b></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div id="customer_detail" class="d-none">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group" id="customer-box">
                                <?php echo e(Form::label('contact_person', __('Contact Person'), ['class' => 'form-label'])); ?>

                                  <span class="text-danger">*</span>
                                <select name="contact_person" class="form-control" id="contact_person" required="required">
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if(empty($users->count())): ?>
                                    <div class=" text-xs">
                                        <?php echo e(__('Please create Customer/Client first.')); ?><a
                                                <?php if(module_is_active('Account')): ?> href="<?php echo e(route('customer.index')); ?>"  <?php else: ?> href="<?php echo e(route('users.index')); ?>" <?php endif; ?>><b><?php echo e(__('Create Customer/Client')); ?></b></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('issue_date', __('Issue Date'), ['class' => 'form-label'])); ?>

                                          <span class="text-danger">*</span>
                                        <div class="form-icon-user">
                                            <?php echo e(Form::date('issue_date',date('Y-m-d'), ['class' => 'form-control ', 'required' => 'required', 'placeholder' => 'Select Issue Date'])); ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('quote_validity', __('Quote Validity'), ['class' => 'form-label'])); ?>

                                          <span class="text-danger">*</span>
                                        <div class="form-icon-user">
                                            <input type="text" name="quote_validity" required class="form-control curdatepicker-input"  placeholder="Select date">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('invoice_number', __('Quote Number'), ['class' => 'form-label'])); ?>

                                          <span class="text-danger">*</span>
                                        <div class="form-icon-user">
                                            <input type="text" name="quote_id" class="form-control" value="<?php echo e($quote_number); ?>"
                                                   readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div id="loader" class="card card-flush">
                <div class="card-body">
                    <div class="row">
                        <img class="loader" src="<?php echo e(asset('public/images/loader.gif')); ?>" alt="">
                    </div>
                </div>
            </div>
            <div class="col-12 section_div">

            </div>
            <div class="modal-footer">
                <input type="button" value="<?php echo e(__('Cancel')); ?>" onclick="location.href = '<?php echo e(route('invoice.index')); ?>';"
                       class="btn btn-light ">
                <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary mx-3">
            </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dimensionsystems/webcrm.dimensionsystems.com/Modules/Sales/Resources/views/salesquote/create.blade.php ENDPATH**/ ?>