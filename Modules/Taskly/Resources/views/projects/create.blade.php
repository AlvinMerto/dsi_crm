{{ Form::open(array('route' => 'projects.store')) }}
<div class="modal-body">
    <div class="text-end">
        @if (module_is_active('AIAssistant'))
            @include('aiassistant::ai.generate_ai_btn',['template_module' => 'project','module'=>'Taskly'])
        @endif
    </div>
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('projectname', __('Name'),['class'=>'form-label']) }}
            {{ Form::text('name', '', array('class' => 'form-control','required'=>'required','id'=>"projectname",'placeholder'=> __('Project Name'))) }}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('projectname', __('Description'),['class'=>'form-label']) }}
            {{ Form::textarea('description', '', array('class' => 'form-control','rows'=>3,'required'=>'required','id'=>"description",'placeholder'=> __('Add Description'))) }}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('users_list', __('Users'),['class'=>'form-label']) }}
            <select class=" multi-select choices" id="users_list" name="users_list[]"  multiple="multiple" data-placeholder="{{ __('Select Users ...') }}">
                @foreach($workspace_users as $user)
                        <option value="{{$user->email}}">{{$user->name}} - {{$user->email}}</option>
                @endforeach
            </select>
            <p class="text-danger d-none" id="user_validation">{{__('Users filed is required.')}}</p>
        </div>
        @if(module_is_active('CustomField') && !$customFields->isEmpty())
            <div class="col-md-12">
                <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                    @include('customfield::formBuilder')
                </div>
            </div>
        @endif
        @if(isset($type) && ($type=="account"))
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
        @if(isset($type) && ($type=="contact"))
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
            <div class="form-group col-md-12">
                <label class="require form-label">{{ __('Contact') }}</label>
                <select class="form-control {{ !empty($errors->first('contact_id')) ? 'is-invalid' : '' }} contact_data"
                        name="contact_id" id="contact_id">
                    <option>{{__('Select Contact')}}</option>
                </select>
                <div class="invalid-feedback">
                    {{ $errors->first('contact_id') }}
                </div>
            </div>
        @endif
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary" id="submit">
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
    $(function(){
        $("#submit").click(function() {
            var user =  $("#users_list option:selected").length;
            if(user == 0){
            $('#user_validation').removeClass('d-none')
                return false;
            }else{
            $('#user_validation').addClass('d-none')
            }
        });
    });

</script>
