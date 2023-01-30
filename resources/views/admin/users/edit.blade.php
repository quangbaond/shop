@extends('admin.layouts.app')

@section('css')
    <link href="{{ asset('dist/assets/plugins/select/selectr.min.css') }}" rel="stylesheet" type="text/css" />
@stop
@section('content')
    {{ Breadcrumbs::render('admin_user_edit', $user->name) }}
    <div class="card">
        <div class="card-header">
            {{ 'Chỉnh sửa người dùng' }}
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">{{ __('app.name') }}</label>
                            <input type="text" value="{{ $user->name }}" id="name" name="name" class="form-control" placeholder="{{ __('app.name') }}" >
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">{{ __('app.email') }}</label>
                            <input type="email" value="{{ $user->email }}" id="email" name="email" class="form-control" placeholder="{{ __('app.email') }}" >
                            <div class="help-block with-errors"></div>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="address">{{ 'Địa chi' }}</label>
                            <textarea type="text" id="address" name="address" class="form-control" placeholder="địa ch" >
                            {{ $user->address }}
                        </textarea>
                            <div class="help-block with-errors"></div>
                            @if ($errors->has('address'))
                                <span class="text-danger">{{ $errors->first('address') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">{{ __('app.status_user') }}</label>
                            <select class="form-select" id="status" name="status">
                                @foreach(ARRAY_STATUS as $key => $value)
                                    <option {{ $user->status == $key  ? 'selected' : '' }}
                                            value="{{ $key }}">{{ $value }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="help-block with-errors"></div>
                            @if ($errors->has('status'))
                                <span class="text-danger">{{ $errors->first('status') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3 d-flex justify-content-center">
                            <label for="avatar">
                                <img src="{{ $user->avatar }}" id="avatar-user" class="rounded-circle border-3 border-dark" width="100" height="100" alt="{{ $user->username }}">
                            </label>
                            <input type="file" id="avatar" name="avatar" class="d-none" >
                            <div class="help-block with-errors"></div>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-primary">{{ __('Cap nhat') }}</button>
                </div>
            </form>

        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('dist/assets/plugins/select/selectr.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            function fasterPreview( uploader ) {
                if ( uploader.files && uploader.files[0] ){
                    $('#avatar-user').attr('src',
                        window.URL.createObjectURL(uploader.files[0]) );
                }
            }
            $("#avatar").change(function(){
                fasterPreview( this );
            });
        });
    </script>
@stop
