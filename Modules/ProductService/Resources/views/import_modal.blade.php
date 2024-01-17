<div class="modal-body">
    <div class="row">
        <div class="col-12">
            <div id="process_area" class="overflow-auto import-data-table">
            </div>
        </div>
        <div class="form-group col-12 d-flex justify-content-end col-form-label">
            <input type="button" value="{{ __('Cancel') }}" class="btn btn-secondary btn-light" data-bs-dismiss="modal">
            <button type="submit" name="import" id="import" class="btn btn-primary ms-2" disabled>{{__('Import')}}</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var total_selection = 0;

        var first_name = 0;

        var last_name = 0;

        var email = 0;

        var column_data = [];

        $(document).on('change', '.set_column_data', function() {
            var column_name = $(this).val();

            var column_number = $(this).data('column_number');

            if (column_name in column_data) {

                toastrs('Error', 'You have already define ' + column_name + ' column', 'error');

                $(this).val('');
                return false;
            }
            if (column_name != '') {
                column_data[column_name] = column_number;
            } else {
                const entries = Object.entries(column_data);

                for (const [key, value] of entries) {
                    if (value == column_number) {
                        delete column_data[key];
                    }
                }
            }

            total_selection = Object.keys(column_data).length;

            if (total_selection == 11) {
                $("#import").removeAttr("disabled");
                name = column_data.name;
                sku = column_data.sku;
                purchase_price = column_data.purchase_price;
                quantity = column_data.quantity;
                type = column_data.type;
                description = column_data.description;
                markup = column_data.markup;
                manufacturer_part_number = column_data.manufacturer_part_number;
                manufacturer_name = column_data.manufacturer_name;
                supplier_part_number = column_data.supplier_part_number;
                supplier_name = column_data.supplier_name;
            } else {
                $('#import').attr('disabled', 'disabled');
            }
        });

        $(document).on('click', '#import', function(event) {
            event.preventDefault();

            $.ajax({
                url: "{{ route('product-service.import.data') }}",
                method: "POST",
                data: {
                    name: name,
                    sku: sku,
                    purchase_price: purchase_price,
                    quantity: quantity,
                    type: type,
                    description: description,
                    markup: markup,
                    manufacturer_part_number: manufacturer_part_number,
                    manufacturer_name: manufacturer_name,
                    supplier_part_number: supplier_part_number,
                    supplier_name: supplier_name,
                    _token: "{{ csrf_token() }}"
                },
                beforeSend: function() {
                    $('#import').attr('disabled', 'disabled');
                    $('#import').text('Importing...');
                },
                success: function(data) {
                    $('#import').attr('disabled', false);
                    $('#import').text('Import');
                    $('#upload_form')[0].reset();

                    if (data.html == true) {
                        $('#process_area').html(data.response);
                        $("button").hide();
                        toastrs('Error', 'These data are not inserted', 'error');

                    } else {
                        $('#message').html(data.response);
                        $('#commonModalOver').modal('hide')
                        toastrs('Success', data.response, 'success');
                        location.reload();
                    }

                }
            })

        });
    });
</script>
