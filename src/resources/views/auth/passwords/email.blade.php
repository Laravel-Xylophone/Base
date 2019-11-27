@extends('xylophone::layout_guest', ['body_class' => 'login-page'])

<!-- Main Content -->
@section('content')
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">{{ trans('xylophone::base.reset_password') }}</p>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @else
                    <form action="{{ route('xylophone.auth.password.email') }}" method="post">
                        {!! csrf_field() !!}
                        <div class="input-group mb-3">
                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="{{ trans('xylophone::base.email_address') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">{{ trans('xylophone::base.send_reset_link') }}</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                @endif

                <p class="mt-3 mb-1">
                    <a href="{{ route('xylophone.auth.login') }}">{{ trans('xylophone::base.login') }}</a>
                </p>
                @if (config('xylophone.base.registration_open'))
                    <p class="mb-0">
                        <a href="{{ route('xylophone.auth.register') }}">{{ trans('xylophone::base.register') }}</a>
                    </p>
                @endif
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection
