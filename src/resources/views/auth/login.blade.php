@extends('xylophone::layout_guest')

@section('content')
    <div class="row m-t-40">
        <div class="col-md-4 col-md-offset-4">
            <h3 class="text-center m-b-20">{{ trans('xylophone::base.login') }}</h3>
            <div class="box">
                <div class="box-body">
                    <form class="col-md-12 p-t-10" role="form" method="POST" action="{{ route('xylophone.auth.login') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has($username) ? ' has-error' : '' }}">
                            <label class="control-label">{{ config('xylophone.base.authentication_column_name') }}</label>

                            <div>
                                <input type="text" class="form-control" name="{{ $username }}" value="{{ old($username) }}">

                                @if ($errors->has($username))
                                    <span class="help-block">
                                        <strong>{{ $errors->first($username) }}</strong>
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

                        <div class="form-group">
                            <div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> {{ trans('xylophone::base.remember_me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-block btn-primary">
                                    {{ trans('xylophone::base.login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @if (xylophone_users_have_email())
                <div class="text-center m-t-10"><a href="{{ route('xylophone.auth.password.reset') }}">{{ trans('xylophone::base.forgot_your_password') }}</a></div>
            @endif
            @if (config('xylophone.base.registration_open'))
                <div class="text-center m-t-10"><a href="{{ route('xylophone.auth.register') }}">{{ trans('xylophone::base.register') }}</a></div>
            @endif
        </div>
    </div>
@endsection
