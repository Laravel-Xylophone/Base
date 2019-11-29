@extends('xylophone::layout_guest', ['body_class' => 'login-page'])

@section('content')
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">{{ trans('xylophone::base.login') }}</p>

                <form class="" action="{{ route('xylophone.auth.login') }}" method="post">
                    {!! csrf_field() !!}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control{{ $errors->has($username) ? ' is-invalid' : '' }}" name="{{ $username }}" value="{{ old($username) }}" placeholder="{{ config('xylophone.base.authentication_column_name') }}" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @if ($errors->has($username))
                            <div class="invalid-feedback">
                                {{ $errors->first($username) }}
                            </div>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ trans('xylophone::base.password') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    {{ trans('xylophone::base.remember_me') }}
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ trans('xylophone::base.login') }}
                            </button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div>
                <!-- /.social-auth-links -->

                <p class="mb-1">
                    <a href="{{ route('xylophone.auth.password.reset') }}">{{ trans('xylophone::base.forgot_your_password') }}</a>
                </p>
                <p class="mb-0">
                    <a href="{{ route('xylophone.auth.register') }}" class="text-center">
                        {{ trans('xylophone::base.register') }}
                    </a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection
