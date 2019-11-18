@extends('xylophone::layout_guest')

<!-- Main Content -->
@section('content')
    <div class="row m-t-40">
        <div class="col-md-4 col-md-offset-4">
            <h3 class="text-center m-b-20">{{ trans('xylophone::base.reset_password') }}</h3>
            <div class="nav-steps-wrapper">
                <ul class="nav nav-tabs nav-steps">
                  <li class="active"><a href="#tab_1" data-toggle="tab"><strong>{{ trans('xylophone::base.step') }} 1.</strong> {{ trans('xylophone::base.confirm_email') }}</a></li>
                  <li><a class="disabled text-muted"><strong>{{ trans('xylophone::base.step') }} 2.</strong> {{ trans('xylophone::base.choose_new_password') }}</a></li>
                </ul>
            </div>
            <div class="nav-tabs-custom">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @else
                    <form class="col-md-12 p-t-10" role="form" method="POST" action="{{ route('xylophone.auth.password.email') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="control-label">{{ trans('xylophone::base.email_address') }}</label>

                            <div>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-block btn-primary">
                                    {{ trans('xylophone::base.send_reset_link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    @endif
                    <div class="clearfix"></div>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div>

              <div class="text-center m-t-10">
                <a href="{{ route('xylophone.auth.login') }}">{{ trans('xylophone::base.login') }}</a>

                @if (config('xylophone.base.registration_open'))
                / <a href="{{ route('xylophone.auth.register') }}">{{ trans('xylophone::base.register') }}</a>
                @endif
              </div>
        </div>
    </div>
@endsection
