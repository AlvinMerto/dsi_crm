<style>
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
{{ Form::open(['method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'upload_form']) }}
<div class="modal-body">
    <div class="row">
        <div class="col-md-12 mb-6">
            {{ Form::label('file', __('Download Sample Product & Service CSV File'), ['class' => 'col-form-label text-danger mx-1']) }}
            @if(check_file('uploads/sample/new_import.csv'))
                <a href="{{ asset('uploads/sample/new_import.csv') }}"
                    class="btn btn-sm btn-primary btn-icon-only">
                    <i class="fa fa-download"></i>
                </a>
            @endif
        </div>
        <div class="col-md-12 mt-1">
            {{ Form::label('file', __('Select CSV File'), ['class' => 'col-form-label']) }}
            <div class="choose-file form-group">
                <label for="file" class="col-form-label">
                    <input type="file" class="form-control" name="file" id="file" data-filename="upload_file"
                        required>
                </label>
                <p class="upload_file"></p>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
            <span id='loading_div_ct' style='display:none;'>
                <span style='position: absolute;left: 20px;margin-top: -15px;'>
                    <div class='loader'></div> 
                </span>
            </span>
    <input type="button" value="{{ __('Cancel') }}" class="btn btn-secondary btn-light" data-bs-dismiss="modal">
    <button type="submit" value="{{ __('Upload') }}" class="btn btn-primary ms-2">
        {{__('Upload')}}
    </button>
    <a href="" data-url="{{ route('product-service.import.modal') }}" data-ajax-popup-over="true" title="{{ __('Create') }}" data-size="xl" data-title="{{ __('Import Product & Service CSV Data') }}"  class="d-none import_modal_show"></a>
</div>
{{ Form::close() }}

<script>
    $('#upload_form').on('submit', function(event) {

        event.preventDefault();

        $(document).find("#loading_div_ct").show();
        let data = new FormData(this);
        data.append('_token', "{{ csrf_token() }}");
        $.ajax({
            // url: "{{ route('product-service.import') }}",
            url : "{{ route('product-service.new_fileimport') }}",
            method: "POST",
            data: data,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data) {
                    alert("Items successfully uploaded")
                    window.location.reload();
                }

                // if (data.error != '')
                // {
                //     toastrs('Error',data.error, 'error');
                // } else {
                //     $('#commonModal').modal('hide');
                //     $(".import_modal_show").trigger( "click");
                //     setTimeout(function() {
                //         SetData(data.output);
                //     }, 700);
                // }
            }
        });

    });
    
</script>
