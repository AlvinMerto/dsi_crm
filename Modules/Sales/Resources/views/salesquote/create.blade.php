@extends('layouts.main')
@section('page-title')
    {{ __('Create Sales Quote') }}
@endsection
@section('title')
    {{ __('Sales Quote') }}
@endsection
@section('page-breadcrumb')
    {{ __('Sales Quote') }}
@endsection

@push('scripts')
    @if (module_is_active('Sales'))
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
    @endif
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/jquery.repeater.min.js') }}"></script>

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


        {{--$(document).ready(function() {--}}
        {{--    var customerId = '{{ $customerId }}';--}}
        {{--    if (customerId > 0) {--}}
        {{--        $('#customer').val(customerId).change();--}}
        {{--    }--}}
        {{--});--}}
        
        $(document).on("change","#customer", function(){
            customerchange($(this).val(),$(this).data('url'));
        });

        function customerchange(id, url, selected = false) {
            // var id = ;
            // var url = ;

            $.ajax({
                url     : url,
                type    : "post",
                headers : {
                    'X-CSRF-TOKEN': jQuery('#token').val()
                },
                data    : { 'id' : id },
                cache   : false,
                success : function(data) {
                    var dd = "";

                    if (data.length > 0) {
                        for(var i = 0 ; i <= data.length-1; i++) {
                            var sel = null;

                            if (selected != false) {
                                if (data[i].id == selected) {
                                    sel = "selected";
                                }
                            }
                            dd += "<option value='"+data[i].id+"' "+sel+">"+data[i].name+"</option>";
                        }
                    }

                     $('#contact_person').html(dd);
                }
            });
        }

        $(document).ready(function(){
            var id  = $(document).find("#customer").val();
            var url = $(document).find("#customer").data("url");
            var selected = $(document).find("#cont_person_selected").val();

            customerchange(id,url, selected);
        })
        // $(document).on('change', '#customer', function() {
        //     $('#customer_detail').removeClass('d-none');
        //     $('#customer_detail').addClass('d-block');
        //     $('#customer-box').removeClass('d-block');
        //     $('#customer-box').addClass('d-none');
        //     var id = $(this).val();
        //     var url = $(this).data('url');
        //     $.ajax({
        //         url: url,
        //         type: 'POST',
        //         headers: {
        //             'X-CSRF-TOKEN': jQuery('#token').val()
        //         },
        //         data: {
        //             'id': id
        //         },
        //         cache: false,
        //         success: function(data) {

        //             if (data != '') {
        //                 $('#customer_detail').html(data);
        //             } else {
        //                 $('#customer-box').removeClass('d-none');
        //                 $('#customer-box').addClass('d-block');
        //                 $('#customer_detail').removeClass('d-block');
        //                 $('#customer_detail').addClass('d-none');
        //             }

        //         },

        //     });
        // });

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
        var tab_id  = null;
        var tabname = null;
    
        $(document).on("click","#addinformation_btn", function(){
            // tab_nav_info
            // <span class="btn btn-sm btn-primary" data-btnlabel="Manufacturer"> Manufacturer </span>

            tab_id = $(document).find("#tab_nav_info").children().length-1;
            tab_id = tab_id+1;  
            tab_id = "tab_"+tab_id;

            $("<span class='btn btn-sm btn-primary mx-1 open_info' data-tab='"+tabname+"' id='"+tab_id+"'> &nbsp; </span>").appendTo("#tab_nav_info");
            $(document).find("#info_tab").show();
        });

        $(document).on("click","#save_info_btn", function(){
            var add_info = [];

            var title = $(document).find("#info_title").val();
            var lbl   = $(document).find("#info_label").val();
            var desc  = $(document).find("#info_desc").val();

            additional_info[tab_id] = {};
            additional_info[tab_id]['title']       = title;
            additional_info[tab_id]['label']       = lbl;
            additional_info[tab_id]['description'] = desc;

            alert("Information is saved");

            console.log(additional_info);
        });

        $(document).on("click","#delete_info_btn", function(){
            var conf = confirm("Are you sure you want to remove this?");

            if (!conf) {
                return;
            }

            delete additional_info[tab_id];

            $(document).find("#"+tab_id).remove();
            $(document).find("#info_tab").hide();

            tab_id = null;
            tabname = null;

            alert("Information is removed");

            console.log(additional_info);
        });

        $(document).on("click",".open_info", function(){
            var btnselected = $(this).data("tab");
            var title       = null;
            var infolabel   = null;
            var infodesc    = null;

            switch(btnselected) {
                case "manu_info":
                    tab_id     = 0;
                    $(document).find("#info_title").val("Manufacturer");
                    $(document).find("#infolabel").text("Manufacturer Part Number");
                    $(document).find("#infodesc").text("Manufacturer Name");
                    break;
                case "sup_info":
                    tab_id     = 1;
                    $(document).find("#info_title").val("Supplier");
                    $(document).find("#infolabel").text("Supplier Part Number");
                    $(document).find("#infodesc").text("Supplier Name");
                    break;
                default:
                    $(document).find("#info_title").val(tabname);
                    $(document).find("#infolabel").text("Information Label");
                    $(document).find("#infodesc").text("Information Description");
                    break;
            }

            $(document).find("#info_tab").show();
        });

        $(document).on("input","#info_title", function(){
            tabname     = $(this).val();
            $(document).find("#"+tab_id).text( tabname  )
        });

        $(document).on("change","#expiry",function(){
            if ( $(this).prop("checked") ) {
                $(document).find("#expirydate_text").show();
            } else {
                $(document).find("#expirydate_text").hide();
            }
        });

        $(document).on("change","#deliveryfee___",function(){
            if ( $(this).prop("checked") ) {
                $(document).find("#deliveryfee_text").show();
            } else {
                $(document).find("#deliveryfee_text").hide();
            }
        });

        $(document).on('change', '#tax_project', function() {
            var tax_id = $(this).val();
            if (tax_id.length != 0) {
                $.ajax({
                    type: 'post',
                    url: "{{ route('get.taxes') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
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
                url: "{{ route('invoice.section.type') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    type: type,
                    project_id: project_id,
                    acction: 'create',
                },
                beforeSend: function() {
                    $("#loader").removeClass('d-none');
                },
                success: function(response) {
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
@endpush
@section('content')
<div class="row">
    <?php
        if (isset($quoteid)) {
    ?>
        <div class="col-md-12">
            <div style="display:flex; justify-content:space-between;" class="mb-3">
                <div class="with_as" id="bigbtn_div" style="width: 100%;">
                    
                    <a class="border-right"  title="Convert to Order" data-url="{{route('salesquote.addcomment')}}" data-toggle="tooltip" title="{{ __('Convert to Order') }}"> 
                        <i class="ti ti-transform-filled"></i> <span> Convert to Order </span> 
                    </a>
                    
                    <a class="border-right" id='qt_settings' title="Quotation Settings" data-ajax-popup="true" data-size="md" data-title="{{ __('Quotation Settings') }}" data-url="{{route('salesquote.settings',[$quoteid])}}" data-toggle="tooltip" title="{{ __('settings') }}"> 
                        <i class="ti ti-settings-2"></i> <span> Quotation Settings </span> 
                    </a>
                </div>
            </div>
        </div>
    <?php } ?>
{{--    {{Form::open(array('url'=>'salesquote','method'=>'post','enctype'=>'multipart/form-data','class' => 'w-100'))}}--}}
     <form method="post" action="{{route('salesquote.postcreatequote')}}" class="w-100">
     @csrf
        <?php
            if (isset($quoteid)) {
                echo "<input type='hidden' name='qid' id='qid' value='{$quoteid}'/>";
            }
        ?>

        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        @if (module_is_active('Taskly'))
            <input type="hidden" name="invoice_type" id="invoice_type" value="salesquote">
       @endif
       <?php
        $reduceheight = null;
        $padd         = null;
            if (isset($quoteid)) {
                $reduceheight = "reduceheight"; 
                $padd         = "rem_pad_bot";
            } 
        ?>
        <div class="col-12 topdiv_create <?php echo $reduceheight; ?>">
            <div class="card mb-2">
                <div class="card-body <?php echo $padd; ?>">
                        <div class="row">
                            <?php 
                                if (isset($cont_sel)) {
                                    echo "<input type='hidden' id='cont_person_selected' value='{$cont_sel}'/>";
                                }
                            ?>
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group" id="customer-box">
                                    {{ Form::label('customer_id', __('Customer'), ['class' => 'form-label']) }}
                                    <span class="text-danger">*</span>
                                    <select name="customer_id" class="form-control" id="customer" data-url="{{route('salesquote.getcustomers')}}" data-url1="{{route('invoice.customer')}}" required="required">
                                        <option>Select---</option>
                                        <?php
                                            foreach($customers as $key => $value) {
                                                $sel = null;

                                                if (isset($cust_sel)) {
                                                    if ($key == $cust_sel) {
                                                        $sel = "selected";
                                                    }
                                                }

                                                echo "<option value='{$key}' {$sel}> {$value} </option>";
                                            }
                                        ?>
                                       
                                    </select>
                                    @if (empty($customers->count()))
                                        <div class=" text-xs">
                                            {{ __('Please create Customer/Client first.') }}<a
                                                    @if (module_is_active('Account')) href="{{ route('customer.index') }}"  @else href="{{ route('users.index') }}" @endif><b>{{ __('Create Customer/Client') }}</b></a>
                                        </div>
                                    @endif
                                </div>
                                <div id="customer_detail" class="d-none">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group" id="customer-box">
                                    {{ Form::label('contact_person', __('Contact Person'), ['class' => 'form-label']) }}
                                    <span class="text-danger">*</span>
                                    <select name="contact_person" class="form-control" id="contact_person" required="required">
                                        
                                    </select>
                                    @if (empty($users->count()))
                                        <div class=" text-xs">
                                            {{ __('Please create Customer/Client first.') }}<a
                                                    @if (module_is_active('Account')) href="{{ route('customer.index') }}"  @else href="{{ route('users.index') }}" @endif><b>{{ __('Create Customer/Client') }}</b></a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('issue_date', __('Issue Date'), ['class' => 'form-label']) }}
                                            <span class="text-danger">*</span>
                                            <div class="form-icon-user">
                                                <input type='date' 
                                                       name='issue_date' 
                                                       id = 'issue_date'
                                                       class='form-control' 
                                                       placeholder='Select Issue Date' 
                                                       value='<?php echo $issue_date; ?>' required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('quote_validity', __('Quote Validity'), ['class' => 'form-label']) }}
                                            <span class="text-danger">*</span>
                                            <div class="form-icon-user">
                                                <input type="text" name="quote_validity" id="quote_validity" data-value='<?php echo $date_valid; ?>' required class="form-control curdatepicker-input">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('invoice_number', __('Quote Number'), ['class' => 'form-label']) }}
                                            <span class="text-danger">*</span>
                                            <div class="form-icon-user">
                                                <input type="text" name="quote_id" class="form-control" value="{{ $quote_number }}"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group m-0">
                                        <?php if (!isset($quoteid)) { ?>
                                                <input type='submit' name="create" value="Create Quotation" class="btn  btn-primary"/>
                                        <?php } else { ?>
                                                <div style="display:flex; justify-content:space-between;">
                                                    <input type='submit' name="update" value="Update Quotation" class="btn btn-primary"/>
                                                </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php if (isset($quoteid)) { ?>
                                    <div class="col-md-12">
                                        <p class='upthis'> <i class="ti ti-chevron-up"></i> </p>
                                    </div>
                                   
                                <?php } ?>
                            </div>
                        </div>
                   
                </div>
            </div>
        </div>
    </form>
            <div id="loader" class="card card-flush">
                <div class="card-body">
                    <div class="row">
                        <img class="loader" src="{{ asset('public/images/loader.gif') }}" alt="">
                    </div>
                </div>
            </div>

            <?php if( $showsection == true ): ?> 
                <div class="col-12 section_div" id="topdiv_create">
                    <p> loading.. </p>
                </div>
            <?php endif; ?>
            
            <div class="modal-footer" style="display:none;">
                <input type="button" value="{{ __('Cancel') }}" onclick="location.href = '{{ route('invoice.index') }}';"
                       class="btn btn-light ">
                <input type="submit" value="{{ __('Create') }}" class="btn  btn-primary mx-3">
            </div>

</div>

<style>
    .edittext, .otherinfo_text, .edittext_ship {
        border:0px;
        outline:none;
    }

    .left-it {
        text-align:left !important;
    }

    .reduceheight {
        height:20px;

        transition: height 1s;
        -moz-transition: height 1s;
    }

    .reduceheight:hover > .card {
        cursor:pointer;
        background-color:#333 !important;
    }

    .topdiv_create {
        transition: height 1s;
        -moz-transition: height 1s;
    }

    .upthis {
        margin-bottom:0px;
        text-align: center;
    }

    .upthis:hover {
        cursor:pointer;
        background:#f1f1f1;
    }

    .rem_pad_bot {
        padding-bottom:0px;
    }

    .removethis {
        padding:10px;
    }

    .removethis:hover {
        cursor:pointer;
        color:red;
    }

    #customtext_m_up{
       
    }
</style>

<script>
    $(document).on("click",".reduceheight", function(){
        $(this).removeClass("reduceheight");
    });

    $(document).on("click",".upthis", function(){
        $(document).find(".topdiv_create").addClass("reduceheight");
    })

    $(document).ready(function(){
        $('html, body').animate({
            scrollTop: $(document).find(".topdiv_create, #topdiv_create").offset().top-10
        },1000);

    });

    $(document).on("click","#email_quote", function(){
        var quote_id       = $(document).find("#qid").val();
        var dis            = $(this);

        // dis.html("Sending Quotation.. please wait").attr("disabled","disabled");
        $(document).find("#loading_div").show();

        postAjax("{{route('salesquote.emailquote')}}", {quote_id : quote_id }, function(data){
            if (data == "markup_error") {
                alert("Please ask for the approval of some of the items to continue sending the quote.");
            } else {
                $(document).find("#loading_div").hide();
                alert("Quotation has been successfully sent");
                // dis.html("<i class='ti ti-send'></i> Send Quotation </a>").removeAttr("disabled");
            }
        }); 
    });

</script>
@endsection