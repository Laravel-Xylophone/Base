@extends('xylophone::layout_guest')

@section('content')
    <div class="row m-t-40">
        <div class="col-md-4 col-md-offset-4">
            <h3 class="text-center m-b-20">{{ trans('xylophone::base.register') }}</h3>
            <div class="box">
                <div class="box-body">
                    <form class="col-md-12 p-t-10" role="form" method="POST" action="{{ route('xylophone.auth.register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="control-label">{{ trans('xylophone::base.name') }}</label>

                            <div>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has(xylophone_authentication_column()) ? ' has-error' : '' }}">
                            <label class="control-label">{{ config('xylophone.base.authentication_column_name') }}</label>

                            <div>
                                <input type="{{ xylophone_authentication_column()=='email'?'email':'text'}}" class="form-control" name="{{ xylophone_authentication_column() }}" value="{{ old(xylophone_authentication_column()) }}">

                                @if ($errors->has(xylophone_authentication_column()))
                                    <span class="help-block">
                                        <strong>{{ $errors->first(xylophone_authentication_column()) }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="control-label">{{ trans('xylophone::base.password') }}</label>

                            <div>
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="control-label">{{ trans('xylophone::base.confirm_password') }}</label>

                            <div>
                                <input type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-block btn-primary">
                                    {{ trans('xylophone::base.register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @if (xylophone_users_have_email())
                <div class="text-center m-t-10"><a href="{{ route('xylophone.auth.password.reset') }}">{{ trans('xylophone::base.forgot_your_password') }}</a></div>
            @endif
            <div class="text-center m-t-10"><a href="{{ route('xylophone.auth.login') }}">{{ trans('xylophone::base.login') }}</a></div>
        </div>
    </div>
@endsection
