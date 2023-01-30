@extends('admin.layouts.app')

@section('css')
    <link href="{{ asset('dist/assets/plugins/select/selectr.min.css') }}" rel="stylesheet" type="text/css" />
@stop
@section('content')
    {{ Breadcrumbs::render('admin_user_list') }}
    <div class="card">
        <div class="card-header">
            <form action="{{ route('admin.users.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-3">
                        <label for="keyword">{{ __('app.keyword') }}</label>
                        <input type="text" value="{{ $requester['keyword'] ?? '' }}" id="keyword" name="keyword" class="form-control" placeholder="{{ __('app.keyword') }}" >
                    </div>
                    <div class="col-md-3">
                        <label for="status">{{ __('app.status_user') }}</label>
                        <select class="form-select" id="status" name="status">
                            @foreach(ARRAY_STATUS as $key => $value)
                                <option {{ isset($requester['status']) && $requester['status'] == $key  ? 'selected' : '' }}
                                        value="{{ $key }}">{{ $value }}
                                </option>
                            @endforeach
                            <option {{ !isset($requester['status']) ? 'selected' : '' }} value="">{{ __('app.select_status') }}</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="orderBy">{{ 'Thứ tự sắp xếp'  }}</label>
                        <select class="form-select" id="orderBy" name="orderBy">
                            <option value="asc"
                                @selected(isset($requester['orderBy']) && $requester['orderBy'] == 'asc')
                            >
                                {{ 'Tăng dần' }}
                            </option>
                            <option value="desc"
                                @selected(isset($requester['orderBy']) && $requester['orderBy'] == 'desc')
                            >
                                {{ 'Giảm dần' }}
                            </option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="limit">{{ 'Số lương hiển thị'  }}</label>
                        <select class="form-select" id="limit" name="limit">
                            @foreach(ARRAY_LIMIT as $limit)
                                <option
                                    @selected(isset($requester['limit']) && $requester['limit'] == $limit)
                                    value="{{ $limit }}">{{ $limit }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="orderByColumn">{{ __('app.select_order_by_column') }}</label>
                        <select id="orderByColumn" name="orderByColumn[]" multiple="multiple">
                            @foreach(ARRAY_ORDER_BY_USER as $key => $value)
                                <option
                                    @selected(isset($requester['orderByColumn']) && in_array($key, $requester['orderByColumn']))
                                    value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end align-self-center mt-3">
                    <button type="submit" class="btn btn-primary" id="btnSearch">{{ 'Tìm kiếm' }}</button>
                </div>
            </form>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped my-0">
                    <thead>
                    <tr>
                        <th>{{ __('app.stt') }}</th>
                        <th>{{ __('app.username') }}</th>
                        <th>{{ __('app.name') }}</th>
                        <th>{{ __('app.email') }}</th>
                        <th>{{ __('So dien thoai') }}</th>
                        <th>{{ __('app.status_user') }}</th>
                        <th>{{ __('app.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $user)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>
                                <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded-circle border-3 border-dark" width="50" height="50">
                                {{ $user->username }}
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->number_phone }}</td>
                            <td>
                            <span class="badge badge-soft-{{ \App\Helpers\HelperUi::showStatusUser($user)['class_name']  }}">
                                {{ \App\Helpers\HelperUi::showStatusUser($user)['status_name'] }}
                            </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary mx-1">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{ route('admin.users.destroy', $user->id) }}" class="btn btn-danger mx-1" data-method="delete"
                                       data-confirm="{{ __('app.confirmDelete') }}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="col-md-12 ">
                <div class="d-flex justify-content-between">
                    <div class="align-self-center">
                        <p>{{ __('app.show', ['record' => $users ? $users->perpage() : 0, 'all' => $users ? $users->total() : 0]) }}</p>
                    </div>
                    {{ $users ? $users->withQueryString()->onEachSide(1)->render('admin.partials.pagination') : '' }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('dist/assets/plugins/select/selectr.min.js') }}"></script>
    <script>
        new Selectr('#orderByColumn',{
            multiple: true,
            searchable: false,
            placeholder: "{{ __('app.select_order_by_column') }}"
        });
    </script>
@stop
