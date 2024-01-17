@if($customFields)
    @foreach($customFields as $customField)
        @if($customField->type == 'text')
            <div class="form-group">
                {{ Form::label('customField-'.$customField->id, __($customField->name),['class'=>'form-label']) }}
                {{ Form::text('customField['.$customField->id.']', null, array('class' => 'form-control')) }}
            </div>
        @elseif($customField->type == 'email')
            <div class="form-group">
                {{ Form::label('customField-'.$customField->id, __($customField->name),['class'=>'form-label']) }}
                {{ Form::email('customField['.$customField->id.']', null, array('class' => 'form-control')) }}
            </div>
        @elseif($customField->type == 'number')
            <div class="form-group">
                {{ Form::label('customField-'.$customField->id, __($customField->name),['class'=>'form-label']) }}
                {{ Form::number('customField['.$customField->id.']', null, array('class' => 'form-control')) }}
            </div>
        @elseif($customField->type == 'date')
            <div class="form-group">
                {{ Form::label('customField-'.$customField->id, __($customField->name),['class'=>'form-label']) }}
                {{ Form::date('customField['.$customField->id.']', date('Y-m-d'), array('class' => 'form-control')) }}
            </div>
        @elseif($customField->type == 'textarea')
            <div class="form-group">
                {{ Form::label('customField-'.$customField->id, __($customField->name),['class'=>'form-label']) }}
                {{ Form::textarea('customField['.$customField->id.']', null, array('class' => 'form-control')) }}
            </div>
        @endif

    @endforeach
@endif


