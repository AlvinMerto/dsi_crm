<form class="" method="post" action="{{ route('notes.update', [$note->id]) }}">
    @csrf
    @method('put')
    <div class="modal-body">
        <div class="text-end">
            @if (module_is_active('AIAssistant'))
                @include('aiassistant::ai.generate_ai_btn', [
                    'template_module' => 'note',
                    'module' => 'Notes',
                ])
            @endif
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="title" class="col-form-label">{{ __('Title') }}</label>
                <input class="form-control" type="text" id="title" name="title"
                    placeholder="{{ __('Enter Title') }}" value="{{ $note->title }}" required>
            </div>
            <div class="col-md-12 form-group">
                <label for="description" class="col-form-label">{{ __('Description') }}</label>
                <textarea class="form-control" id="description" name="text" placeholder="{{ __('Enter Description') }}" required>{{ $note->text }}</textarea>
            </div>
            <div class="col-md-12 form-group">
                <label for="color" class="col-form-label">{{ __('Color') }}</label>
                <select class="form-control" name="color" id="color" required>
                    <option value="bg-primary">{{ __('Primary') }}</option>
                    <option @if ($note->color == 'bg-secondary') selected @endif value="bg-secondary">{{ __('Secondary') }}
                    </option>
                    <option @if ($note->color == 'bg-info') selected @endif value="bg-info">{{ __('Info') }}
                    </option>
                    <option @if ($note->color == 'bg-warning') selected @endif value="bg-warning">{{ __('Warning') }}
                    </option>
                    <option @if ($note->color == 'bg-danger') selected @endif value="bg-danger">{{ __('Danger') }}
                    </option>
                </select>
            </div>

            <div class="col-md-12 form-group">
                <label class="require form-label">{{ __('Account') }}</label>
                <select class="form-control {{ !empty($errors->first('account_id')) ? 'is-invalid' : '' }}"
                        name="account_id" required="" id="account_id">
                    <option value="">{{ __('Select Account') }}</option>
                    @foreach ($accounts as $key=> $account)
                        <option value="{{ $key }}" @if($note->account_id==$key) selected @endif>{{ $account }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    {{ $errors->first('account_id') }}
                </div>
            </div>

            <div class="form-group col-md-12">
                <label class="require form-label">{{ __('Contact') }}</label>
                <select class="form-control {{ !empty($errors->first('contact_id')) ? 'is-invalid' : '' }} contact_data"
                        name="contact_id" required="" id="contact_id">
                    <option>{{__('Select Contact')}}</option>
                    @foreach($contacts as $key => $value)
                        <option value="{{$key}}" @if($key == $note->contact_id) selected @endif>{{$value}}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    {{ $errors->first('contact_id') }}
                </div>
            </div>

            <div class="col-md-12 form-group">
                <label class="require form-label">{{ __('Opportunity') }}</label>
                <select class="form-control select_opportunity {{ !empty($errors->first('opportunity_id')) ? 'is-invalid' : '' }}"
                        name="opportunity_id" required="" id="opportunity_id">
                    <option value="">{{ __('Select Opportunity') }}</option>
                    @foreach($opportunities as $key=> $opportunity)
                        <option value="{{$key}}" @if($key==$note->opportunity_id) selected @endif>{{$opportunity}}</option>
                    @endforeach
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
                            {{ $note->type == 'personal' ? 'checked="checked"' : '' }}>
                        <label class="form-check-label" for="personal">
                            {{ __('Personal') }}
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" value="shared" id="shared"
                            {{ $note->type == 'shared' ? 'checked="checked"' : '' }}>
                        <label class="form-check-label" for="shared">
                            {{ __('Shared') }}
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-12 assign_to_selection">
                <label for="assign_to" class="col-form-label">{{ __('Assign to') }}</label>
                <select id="assign_to"name="assign_to[]" class="multi-select" data-toggle="select2" multiple="multiple"
                    data-placeholder="{{ __('Select Users ...') }}">
                    @foreach ($users as $u)
                        <option value="{{ $u->id }}" @if (in_array($u->id, $note->assign_to)) selected @endif>
                            {{ $u->name }} - {{ $u->email }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">

        <div>
            <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
            <button class="btn  btn-primary" type="submit" id="create-client">{{ __('Save Changes') }}</button>
        </div>
    </div>

</form>
<script>
    $(document).ready(function() {
        $('#{{ $note->type }}').trigger('click');
    });
</script>
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
