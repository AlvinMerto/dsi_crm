@extends('layouts.main')
@section('page-title')
    {{__('Manage Assets')}}
@endsection
@section("page-breadcrumb")
    {{__('Assets')}}
@endsection

@section('page-action')
    <div>
        @stack('addButtonHook')
        @can('assets import')
            <a href="#"  class="btn btn-sm btn-primary" data-ajax-popup="true" data-title="{{__('Assets Import')}}" data-url="{{ route('assets.file.import') }}"  data-toggle="tooltip" title="{{ __('Import') }}"><i class="ti ti-file-import"></i>
            </a>
        @endcan
        @can('assets create')
            <a  class="btn btn-sm btn-primary" data-size="md" data-url="{{ route('asset.create') }}" data-ajax-popup="true" data-title="{{__('Create New Assets')}}"  data-bs-toggle="tooltip"  data-bs-original-title="{{ __('Create') }}">
                <i class="ti ti-plus"></i>
            </a>
        @endcan
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0 pc-dt-simple" id="assets">
                            <thead>
                            <tr>
                                @if(module_is_active('Hrm'))
                                @if (in_array(\Auth::user()->type, \Auth::user()->not_emp_type))
                                    <th>{{ __('Employee') }}</th>
                                @endif
                                @endif

                                <th>{{__('Name')}}</th>
                                <th>{{__('Purchase Date')}}</th>
                                <th>{{__('Supported Date')}}</th>
                                <th>{{__('Amount')}}</th>
                                <th>{{__('Description')}}</th>
                                @if (Gate::check('assets edit') || Gate::check('assets delete'))
                                    <th class="text-end">{{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($assets as $asset)
                                <tr>
                                    @if(module_is_active('Hrm'))

                                        <td>{{ !empty( Modules\Hrm\Entities\Employee::getEmployee($asset->user_id)) ? Modules\Hrm\Entities\Employee::getEmployee($asset->user_id)->name : '' }}</td>
                                    @endif
                                        <td class="font-style">{{ $asset->name }}</td>
                                        <td class="font-style">{{ company_date_formate($asset->purchase_date) }}</td>
                                        <td class="font-style">{{ company_date_formate($asset->supported_date) }}</td>
                                        <td class="font-style">{{ currency_format($asset->amount) }}  {{ company_setting('defult_currancy') ? company_setting('defult_currancy') : 'USD' }}</td>
                                        <td class="font-style">{{ !empty($asset->description)?$asset->description:'-' }}</td>
                                    @if (Gate::check('assets edit') || Gate::check('assets delete'))
                                        <td class="text-end">
                                            <span>
                                                    @can('assets edit')
                                                        <div class="action-btn bg-info ms-2">
                                                            <a  class="mx-3 btn btn-sm align-items-center" data-url="{{ route('asset.edit',$asset->id) }}" data-ajax-popup="true" data-title="{{__('Edit Assets')}}" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-original-title="{{__('Edit')}}">
                                                                <i class="ti ti-pencil text-white"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                    @can('assets delete')
                                                        <div class="action-btn bg-danger ms-2" data-bs-whatever="{{ __('Delete Asset') }}" data-bs-toggle="tooltip" title="" data-bs-original-title="{{ __('Delete') }}">
                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['asset.destroy', $asset->id],'id'=>'delete-form-'.$asset->id]) !!}
                                                            <a  class="mx-3 btn btn-sm align-items-center bs-pass-para show_confirm" data-confirm="{{__('Are You Sure?')}}" data-text="{{__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$asset->id}}').submit();">
                                                                <i class="ti ti-trash text-white"></i>
                                                            </a>
                                                        {!! Form::close() !!}
                                                        </div>
                                                    @endcan
                                            </span>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
