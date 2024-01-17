@php
    $color = Cookie::get('color');
    if ($color == '') {
        $color = 'theme-3';
    }
@endphp
<form class="" method="post" action="{{ route('notes.store') }}">
    @csrf
    <div class="modal-body">
        <div class="text-end">
            @if (module_is_active('AIAssistant'))
                @include('aiassistant::ai.generate_ai_btn', ['template_module' => 'note', 'module' => 'Notes'])
            @endif
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="title" class="col-form-label">{{ __('Title') }}</label>
                <input class="form-control" type="text" id="title" name="title"
                    placeholder="{{ __('Enter Title') }}" required>
            </div>
            <div class="col-md-12 form-group">
                <label for="description" class="col-form-label">{{ __('Description') }}</label>
                <textarea class="form-control" id="description" name="text" placeholder="{{ __('Enter Description') }}" required></textarea>
            </div>
            <div class="col-md-12 form-group">
                <label for="color" class="col-form-label">{{ __('Color') }}</label>
                <select class="form-control" name="color" id="color" required>
                    <option value="bg-primary">{{ __('Primary') }}</option>
                    <option value="bg-secondary">{{ __('Secondary') }}</option>
                    <option value="bg-info">{{ __('Info') }}</option>
                    <option value="bg-warning">{{ __('Warning') }}</option>
                    <option value="bg-danger">{{ __('Danger') }}</option>
                </select>
            </div>
            @if(isset($type)&& ($type=='account'))
                <div class="col-md-12 form-group">
                    <label class="require form-label">{{ __('Account') }}</label>
                    <select class="form-control select_data_account {{ !empty($errors->first('account_id')) ? 'is-invalid' : '' }}"
                            name="account_id" required="" id="account_id">
                        <option value="">{{ __('Select Account') }}</option>
                        @foreach ($accounts as $key=> $account)
                            <option value="{{ $key }}" @if($key==$id) selected @endif>{{ $account }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('account_id') }}
                    </div>
                </div>
            @else
                <div class="col-md-12 form-group">
                    <label class="require form-label">{{ __('Account') }}</label>
                    <select class="form-control select_data_account {{ !empty($errors->first('account_id')) ? 'is-invalid' : '' }}"
                            name="account_id" required="" id="account_id">
                        <option value="">{{ __('Select Account') }}</option>
                        @foreach ($accounts as $key=> $account)
                            <option value="{{ $key }}">{{ $account }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('account_id') }}
                    </div>
                </div>
            @endif
            @if(isset($type)&& ($type=='contact'))
                <div class="form-group col-md-6">
                    <label class="require form-label">{{ __('Contact') }}</label>
                    <select class="form-control {{ !empty($errors->first('contact_id')) ? 'is-invalid' : '' }} contact_data"
                            name="contact_id" id="contact_id">
                        <option>{{__('Select Contact')}}</option>
                        @foreach($all_contacts as $key => $all_contact)
                            <option value="{{$key}}" @if($key==$id) selected @endif>{{$all_contact}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('contact_id') }}
                    </div>
                </div>
            @else
                <div class="form-group col-md-6">
                    <label class="require form-label">{{ __('Contact') }}</label>
                    <select class="form-control {{ !empty($errors->first('contact_id')) ? 'is-invalid' : '' }} contact_data"
                            name="contact_id" id="contact_id">
                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('contact_id') }}
                    </div>
                </div>
            @endif
            <div class="col-md-12 form-group">
                <label class="require form-label">{{ __('Opportunity') }}</label>
                <select class="form-control select_opportunity {{ !empty($errors->first('opportunity_id')) ? 'is-invalid' : '' }}"
                        name="opportunity_id" required="" id="opportunity_id">
                    <option value="">{{ __('Select Opportunity') }}</option>
                </select>
                <div class="invalid-feedback">
                    {{ $errors->first('opportunity_id') }}
                </div>
            </div>


            <div class="col-md-12 form-group">
                <label for="type" class="col-form-label">{{ __('Type') }}</label>
                <div class="selectgroup w-50 ">

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" value="personal" id="personal"
                            checked="checked">
                        <label class="form-check-label" for="personal">
                            {{ __('Personal') }}
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" value="shared" id="shared">
                        <label class="form-check-label" for="shared">
                            {{ __('Shared') }}
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-12 assign_to_selection form-group" style="display: none">
                <label for="assign_to" class="col-form-label">{{ __('Assign to') }}</label>
                <select id="assign_to" name="assign_to[]" class="multi-select" data-toggle="select2" multiple="multiple"
                    data-placeholder="{{ __('Select Users ...') }}">
                    @foreach ($users as $u)
                        <option value="{{ $u->id }}">{{ $u->name }} - {{ $u->email }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">

        <div>
            <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
            <button class="btn  btn-primary" type="submit" id="create-client">{{ __('Create') }}</button>
        </div>
    </div>
</form>


<script type="text/javascript">
    if ($(".multi-select").length > 0) {
        $($(".multi-select")).each(function(index, element) {
            var id = $(element).attr('id');
            var multipleCancelButton = new Choices(
                '#' + id, {
                    removeItemButton: true,
                }
            );
        });
    }
    $(document).on('change', '.select_data_account', function() {

        var id= $(this).val();
        $(".contact_data").empty();

        $.ajax({
            url: '{{ route('contact.get.detail') }}',
            type: 'POST',
            data: {
                "account_id": id,
                "_token": "{{ csrf_token() }}",
            },
            success: function(data) {
                $('.contact_data').html(data);
            }
        });
    });

    $(document).on('change','.contact_data',function () {
        var id= $(this).val();
        $('.select_opportunity').empty();

        $.ajax({
            url: '{{ route('opportunity.get.detail') }}',
            type: 'POST',
            data: {
                "contact_id": id,
                "_token": "{{ csrf_token() }}",
            },
            success: function(data) {
                $('.select_opportunity').append(data);
            }
        });
    });
</script>
