
{{ Form::model($project, array('route' => array('projects.update', $project->id), 'method' => 'PUT')) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('projectname', __('Name'),['class'=>'form-label']) }}
            {{ Form::text('name', null, array('class' => 'form-control','required'=>'required','id'=>"projectname",'placeholder'=> __('Project Name'))) }}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('description', __('Description'),['class'=>'form-label']) }}
            {{ Form::textarea('description', null, array('class' => 'form-control','rows'=>3,'required'=>'required','id'=>"description",'placeholder'=> __('Add Description'))) }}
        </div>
        <div class="form-group col-md-6">

            {{ Form::label('status', __('Status'),['class'=>'form-label']) }}
            {{ Form::select('status', ['Ongoing'=>__('Ongoing'),'Finished'=>__('Finished'),'OnHold'=>__('OnHold')],null, array('class' => 'form-control','id'=>'status')) }}
        </div>

        <div class="form-group col-md-6">
            {{ Form::label('budget', __('Budget'),['class'=>'form-label']) }}
            <div class="input-group mb-3">
                <span class="input-group-text">{{ company_setting('defult_currancy')}}</span>
                {{ Form::number('budget', null, array('class' => 'form-control currency_input','required'=>'required','id'=>"budget",'placeholder'=> __('Project Budget'))) }}
            </div>
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('start_date', __('Start Date'),['class'=>'form-label']) }}
            <div class="input-group date ">
                {{ Form::date('start_date', null, array('class' => 'form-control','required'=>'required','id'=>"start_date")) }}
            </div>
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('end_date', __('End Date'),['class'=>'form-label']) }}
            <div class="input-group date ">
                {{ Form::date('end_date', null, array('class' => 'form-control','required'=>'required','id'=>"end_date")) }}
            </div>
        </div>
        <div class="col-md-6 form-group">
            <label class="require form-label">{{ __('Account') }}</label>
            <select class="form-control select_data_account {{ !empty($errors->first('account_id')) ? 'is-invalid' : '' }}"
                    name="account_id" id="account_id">
                <option value="">{{ __('Select Account') }}</option>
                @foreach ($accounts as $key=> $account)
                    <option value="{{ $key }}" @if($project->account_id) selected @endif>{{ $account }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                {{ $errors->first('account_id') }}
            </div>
        </div>

        <div class="form-group col-md-6">
            <label class="require form-label">{{ __('Contact') }}</label>
            <select class="form-control {{ !empty($errors->first('contact_id')) ? 'is-invalid' : '' }} contact_data"
                    name="contact_id" id="contact_id">
                <option>{{__('Select Contact')}}</option>
                @foreach($contacts as $key => $value)
                    <option value="{{$key}}" @if($key==$project->contact_id) selected @endif>{{$value}}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                {{ $errors->first('contact_id') }}
            </div>
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
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close')}}</button>
    <input type="submit" value="{{ __('Save Changes')}}" class="btn  btn-primary">
</div>
{{ Form::close() }}
<script>
    $(document).on('change', '.select_data_account', function() {
        var id= $(this).val();
        $('.contact_data').empty();
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
</script>



