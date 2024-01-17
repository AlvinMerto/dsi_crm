{{ Form::model($asset, ['route' => ['asset.update', $asset->id], 'method' => 'PUT']) }}
<div class="modal-body">
    <div class="row">
        @if (module_is_active('Hrm'))
            <div class="form-group">
                {{ Form::label('employee_id', __('Employee'), ['class' => 'form-label']) }}
                {{ Form::select('employee_id', $employees,!empty($asset->user_id) ? $asset->user_id : null, ['class' => 'form-control ', 'required' => 'required', 'placeholder' => 'Select Employee']) }}
            </div>
        @endif
        <div class="form-group col-md-6">
            {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Enter Name']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('amount', __('Amount'), ['class' => 'form-label']) }}
            {{ Form::number('amount', null, ['class' => 'form-control', 'required' => 'required', 'step' => '1', 'placeholder' => 'Enter Amount']) }}
        </div>

        <div class="form-group col-md-6">
            {{ Form::label('purchase_date', __('Purchase Date'), ['class' => 'form-label']) }}
            {{ Form::date('purchase_date', null, ['class' => 'form-control', 'placeholder' => 'Select Purchase Date','required' => 'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('supported_date', __('Supported Date'), ['class' => 'form-label']) }}
            {{ Form::date('supported_date', null, ['class' => 'form-control', 'placeholder' => 'Select Supported Date','required' => 'required']) }}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('description', __('Description'), ['class' => 'form-label']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Enter Description']) }}
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
    <div class="text-end">
        <input type="button" value="{{ __('Cancel') }}" class="btn  btn-light" data-bs-dismiss="modal">
        <input type="submit" value="{{ __('Update') }}" class="btn  btn-primary">
    </div>
</div>
{{ Form::close() }}
