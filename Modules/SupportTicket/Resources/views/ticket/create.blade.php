@extends('layouts.main')

@section('page-title')
    {{ __('Create Ticket') }}
@endsection

@section('page-breadcrumb')
    {{ __('Tickets') }},{{ __('Create') }}
@endsection

@section('content')
    <form action="{{ route('support-tickets.store') }}" class="mt-3" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h6>{{ __('Ticket Information') }}</h6>
                        <div class="text-end">
                            @if (module_is_active('AIAssistant'))
                                @include('aiassistant::ai.generate_ai_btn', [
                                    'template_module' => 'ticket',
                                    'module' => 'SupportTicket',
                                ])
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="require form-label">{{ __('Name') }}</label>
                                <input class="form-control {{ !empty($errors->first('name')) ? 'is-invalid' : '' }}"
                                    type="text" name="name" required="" placeholder="{{ __('Name') }}">
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="require form-label">{{ __('Email') }}</label>
                                <input class="form-control {{ !empty($errors->first('email')) ? 'is-invalid' : '' }}"
                                    type="email" name="email" required="" placeholder="{{ __('Email') }}">
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="require form-label">{{ __('Category') }}</label>
                                <select class="form-control {{ !empty($errors->first('category')) ? 'is-invalid' : '' }}"
                                    name="category" required="" id="category">
                                    <option value="">{{ __('Select Category') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    {{ $errors->first('category') }}
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="require form-label">{{ __('Status') }}</label>
                                <select class="form-control {{ !empty($errors->first('status')) ? 'is-invalid' : '' }}"
                                    name="status" required="" id="status">
                                    <option value="">{{ __('Select Status') }}</option>
                                    <option value="In Progress">{{ __('In Progress') }}</option>
                                    <option value="On Hold">{{ __('On Hold') }}</option>
                                    <option value="Closed">{{ __('Closed') }}</option>
                                </select>
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            </div>
                            @if($type == 'account')
                                <div class="form-group col-md-6">
                                    <label class="require form-label">{{ __('Account') }}</label>
                                    <select class="form-control select_data_account {{ !empty($errors->first('account_id')) ? 'is-invalid' : '' }}"
                                            name="account_id" required="" id="account_id">
                                        <option value="">{{ __('Select Account') }}</option>
                                        @foreach ($accounts as $key=> $account)
                                            <option value="{{ $key }}" @if($id == $key) selected @endif>{{ $account }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('account_id') }}
                                    </div>
                                </div>
                            @else
                                <div class="form-group col-md-6">
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
                            @if($type == 'contact')
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

                            <div class="form-group col-md-6">
                                <label class="require form-label">{{ __('Subject') }}</label>
                                <input class="form-control {{ !empty($errors->first('subject')) ? 'is-invalid' : '' }}"
                                    type="text" name="subject" required="" placeholder="{{ __('Subject') }}">
                                <div class="invalid-feedback">
                                    {{ $errors->first('subject') }}
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="require form-label">{{ __('Attachments') }}
                                    <small>({{ __('You can select multiple files') }})</small> </label>
                                <div class="choose-file form-group">
                                    <label for="file" class="form-label d-block">

                                        <input type="file" name="attachments[]" id="file"
                                            class="form-control mb-2 {{ $errors->has('attachments') ? ' is-invalid' : '' }}"
                                            multiple="" data-filename="multiple_file_selection"
                                            onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                        <img src="" id="blah" width="20%" />
                                        <div class="invalid-feedback">
                                            {{ $errors->first('attachments.*') }}
                                        </div>
                                    </label>
                                </div>
                                <p class="multiple_file_selection mx-4"></p>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="require form-label">{{ __('Description') }}</label>
                                <textarea name="description"
                                    class="form-control ckdescription  {{ !empty($errors->first('description')) ? 'is-invalid' : '' }}" required id="description_ck"></textarea>
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            </div>

                            @if (!$fields->isEmpty())
                                @include('supportticket::formBuilder')
                            @endif

                        </div>
                        <div class="d-flex justify-content-end text-end">
                            <a class="btn btn-secondary btn-light btn-submit"
                                href="{{ route('support-tickets.index') }}">{{ __('Cancel') }}</a>
                            <button class="btn btn-primary btn-submit ms-2" type="submit">{{ __('Submit') }}</button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="//cdn.ckeditor.com/4.12.1/basic/ckeditor.js"></script>
    <script src="{{ asset('Modules/SupportTicket/Resources/assets/js/editorplaceholder.js') }}"></script>

    <script>
        $(document).ready(function() {

            $.each($('.ckdescription'), function(i, editor) {
                CKEDITOR.replace(editor, {
                    // contentsLangDirection: 'rtl',
                    extraPlugins: 'editorplaceholder',
                    editorplaceholder: editor.placeholder
                });
            });
        });

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
@endpush
