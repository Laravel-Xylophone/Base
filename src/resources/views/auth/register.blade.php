@extends('xylophone::layout_guest', ['body_class' => 'register-page'])

@section('content')
    <div class="register-box">
        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">{{ trans('xylophone::base.register') }}</p>

                <form action="{{ route('xylophone.auth.register') }}" method="post">
                    {!! csrf_field() !!}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="{{ trans('xylophone::base.name') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input type="{{ xylophone_authentication_column()=='email'?'email':'text'}}" class="form-control{{ $errors->has(xylophone_authentication_column()) ? ' is-invalid' : '' }}" name="{{ xylophone_authentication_column() }}" value="{{ old(xylophone_authentication_column()) }}" placeholder="{{ config('xylophone.base.authentication_column_name') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @if ($errors->has(xylophone_authentication_column()))
                            <div class="invalid-feedback">
                                {{ $errors->first(xylophone_authentication_column()) }}
                            </div>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ trans('xylophone::base.password') }}">
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
                    <div class="input-group mb-3">
                        <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" placeholder="{{ trans('xylophone::base.confirm_password') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @if ($errors->has('password_confirmation'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password_confirmation') }}
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-8">
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ trans('xylophone::base.register') }}
                            </button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i>
                        Sign up using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i>
                        Sign up using Google+
                    </a>
                </div>

                @if (xylophone_users_have_email())
                    <p class="mb-1">
                        <a href="{{ route('xylophone.auth.password.reset') }}">
                            {{ trans('xylophone::base.forgot_your_password') }}
                        </a>
                    </p>
                @endif
                <p class="mb-0">
                    <a href="{{ route('xylophone.auth.login') }}" class="text-center">
                        {{ trans('xylophone::base.login') }}
                    </a>
                </p>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
@endsection
