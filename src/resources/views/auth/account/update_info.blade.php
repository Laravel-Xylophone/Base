@extends('xylophone::layout')

@section('after_styles')
<style media="screen">
    .xylophone-profile-form .required::after {
        content: ' *';
        color: red;
    }
</style>
@endsection

@section('header')
<section class="content-header">

    <h1>
        {{ trans('xylophone::base.my_account') }}
    </h1>

    <ol class="breadcrumb">

        <li>
            <a href="{{ xylophone_url() }}">{{ config('xylophone.base.project_name') }}</a>
        </li>

        <li>
            <a href="{{ route('xylophone.account.info') }}">{{ trans('xylophone::base.my_account') }}</a>
        </li>

        <li class="active">
            {{ trans('xylophone::base.update_account_info') }}
        </li>

    </ol>

</section>
@endsection

@section('content')
<div class="row">
    <div class="col-md-3">
        @include('xylophone::auth.account.sidemenu')
    </div>
    <div class="col-md-6">

        <form class="form" action="{{ route('xylophone.account.info') }}" method="post">

            {!! csrf_field() !!}

            <div class="box padding-10">

                <div class="box-body xylophone-profile-form">

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->count())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        @php
                            $label = trans('xylophone::base.name');
                            $field = 'name';
                        @endphp
                        <label class="required">{{ $label }}</label>
                        <input required class="form-control" type="text" name="{{ $field }}" value="{{ old($field) ? old($field) : $user->$field }}">
                    </div>

                    <div class="form-group">
                        @php
                            $label = config('xylophone.base.authentication_column_name');
                            $field = xylophone_authentication_column();
                        @endphp
                        <label class="required">{{ $label }}</label>
                        <input required class="form-control" type="{{ xylophone_authentication_column()=='email'?'email':'text' }}" name="{{ $field }}" value="{{ old($field) ? old($field) : $user->$field }}">
                    </div>

                    <div class="form-group m-b-0">
                        <button type="submit" class="btn btn-success"><span class="ladda-label"><i class="fa fa-save"></i> {{ trans('xylophone::base.save') }}</span></button>
                        <a href="{{ xylophone_url() }}" class="btn btn-default"><span class="ladda-label">{{ trans('xylophone::base.cancel') }}</span></a>
                    </div>

                </div>
            </div>

        </form>

    </div>
</div>
@endsection
