{{ Form::model($productService, ['route' => ['product-service.update', $productService->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="text-end">
        @if (module_is_active('AIAssistant'))
            @include('aiassistant::ai.generate_ai_btn',['template_module' => 'product','module'=>'ProductService'])
        @endif
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}<span class="text-danger">*</span>
                <div class="form-icon-user">
                    {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) }}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('sku', __('SKU'), ['class' => 'form-label']) }}<span class="text-danger">*</span>
                <div class="form-icon-user">
                    {{ Form::text('sku', null, ['class' => 'form-control', 'required' => 'required']) }}
                </div>
            </div>
        </div>
        <div class="form-group  col-md-12">
            {{ Form::label('description', __('Description'), ['class' => 'form-label']) }}
            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '2']) !!}
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('purchase_price', __('Cost'), ['class' => 'form-label']) }}<span
                        class="text-danger">*</span>
                <div class="form-icon-user">
                    {{ Form::number('purchase_price', null, ['class' => 'form-control', 'required' => 'required', 'step' => '0.01','id'=> 'cost']) }}
                </div>
            </div>
        </div>
        <div class="form-group col-md-6 markup">
            {{ Form::label('markup', __('MarkUp'), ['class' => 'form-label']) }}
           <span class="text-danger">*</span>
            {{ Form::number('markup', null, ['class' => 'form-control', 'min'=>'0', 'required' => 'required','id'=>'markup']) }}
        </div>

        <div class="form-group col-md-6 quantity">
            {{ Form::label('quantity', __('Quantity'), ['class' => 'form-label']) }}<span class="text-danger">*</span>
            {{ Form::text('quantity', null, ['class' => 'form-control', 'required' => 'required','id'=>'quantity']) }}
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('sale_price', __('Price'), ['class' => 'form-label']) }}<span
                        class="text-danger">*</span>
                <div class="form-icon-user">
                    {{ Form::number('sale_price', null, ['class' => 'form-control', 'required' => 'required', 'step' => '0.01','id' => 'price']) }}
                </div>
            </div>
        </div>

        <div class="form-group  col-md-6">
            {{ Form::label('tax_id', __('Tax'), ['class' => 'form-label']) }}
            {{ Form::select('tax_id[]', $tax, null, ['class' => 'form-control choices', 'id' => 'choices-multiple1', 'multiple' => '']) }}
        </div>

        <div class="form-group  col-md-6">
            {{ Form::label('category_id', __('Category'), ['class' => 'form-label']) }}<span
                class="text-danger">*</span>
            {{ Form::select('category_id', $category, null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        <div class="form-group  col-md-6">
            {{ Form::label('unit_id', __('Unit'), ['class' => 'form-label']) }}<span class="text-danger">*</span>
            {{ Form::select('unit_id', $unit, null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        <div class="col-6 form-group">
            {{ Form::label('image', __('Image'), ['class' => 'col-form-label']) }}
            <div class="choose-files ">
                <label for="image">

                    <input type="file" class="form-control file" name="image" id="image"
                        data-filename="image_update"
                        onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                    @php
                        if (check_file($productService->image) == false) {
                            $path = asset('Modules/ProductService/Resources/assets/image/img01.jpg');
                        } else {
                            $path = get_file($productService->image);
                        }
                    @endphp
                    <img id="blah" src="{{ $path }}" alt="your image" width="100" height="100" />
                </label>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="d-block form-label">{{ __('Type') }}</label>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input type" id="customRadio5" name="type"
                                value="product" @if ($productService->type == 'product') checked @endif
                                onclick="hide_show(this)">
                            <label class="custom-control-label form-label"
                                for="customRadio5">{{ __('Product') }}</label>
                        </div>
                    </div>
                    <div class="col-md-6" id="ksk">
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input type services" id="customRadio6"
                                name="type" value="service" @if ($productService->type == 'service') checked @endif
                                onclick="hide_show(this)">
                            <label class="custom-control-label form-label"
                                for="customRadio6">{{ __('Service') }}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-md-6 manufacturer_part_number">
            {{ Form::label('manufacturer_part_number', __('Manufacturer Part Number'), ['class' => 'form-label']) }}
                        <span class="text-danger">*</span>
            {{ Form::text('manufacturer_part_number', null, ['class' => 'form-control','required' => 'required']) }}
        </div>
        <div class="form-group col-md-6 manufacturer_name">
            {{ Form::label('manufacturer_name', __('Manufacturer Name'), ['class' => 'form-label']) }}
                        <span class="text-danger">*</span>
            {{ Form::text('manufacturer_name', null, ['class' => 'form-control','required' => 'required']) }}
        </div>
        <div class="form-group col-md-6 supplier_part_number">
            {{ Form::label('supplier_part_number', __('Supplier Part Number'), ['class' => 'form-label']) }}
                        <span class="text-danger">*</span>
            {{ Form::text('supplier_part_number', null, ['class' => 'form-control','required' => 'required']) }}
        </div>
        <div class="form-group col-md-6 supplier_name">
            {{ Form::label('supplier_name', __('Supplier Name'), ['class' => 'form-label']) }}
                        <span class="text-danger">*</span>
            {{ Form::text('supplier_name', null, ['class' => 'form-control','required' => 'required']) }}
        </div>
        @if(module_is_active('CustomField') && !$customFields->isEmpty())
            <div class="col-md-12">
                <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                    @include('customfield::formBuilder')
                </div>
            </div>
        @endif

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Update') }}" class="btn  btn-primary">
</div>
{{ Form::close() }}

{{ Form::close() }}
<script>
    $(document).ready(function() {
        if ($("input[value='service']").is(":checked")) {;
            $('.quantity').addClass('d-none')
            $('.quantity').removeClass('d-block');
        }
    });

    $(document).on('click', '.type', function() {
        var type = $(this).val();
        if (type == 'product') {
            $('.quantity').removeClass('d-none')
            $('.quantity').addClass('d-block');
        } else {
            $('.quantity').addClass('d-none')
            $('.quantity').removeClass('d-block');
        }
    });

    $(document).ready(function() {
        $('#markup, #cost, #quantity').on('input', function() {

            // Get the values from the input fields
            var markup = parseFloat($('#markup').val());
            var cost = parseFloat($('#cost').val());
            var quantity = parseInt($('#quantity').val());

            // Check if the input values are valid numbers
            if (!isNaN(markup) && !isNaN(cost) && !isNaN(quantity)) {
                // Perform the calculation
                var markupprice= cost * markup/ 100;
                var price = (markupprice + cost) * quantity;
                // Update the price field with the calculated value
                $('#price').val(price.toFixed(2)); // You can adjust the number of decimal places as needed
            } else {
                // If any input is not a valid number, display an error or handle it as needed
                $('#price').val(''); // Clear the price field or handle the error as you see fit
            }
        });
    });

</script>
