@extends('xylophone::layout')

@section('header')
    <section class="content-header">
      <h1>
        {{ trans('xylophone::base.dashboard') }}<small>{{ trans('xylophone::base.first_page_you_see') }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ xylophone_url() }}">{{ config('xylophone.base.project_name') }}</a></li>
        <li class="active">{{ trans('xylophone::base.dashboard') }}</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="box-title">{{ trans('xylophone::base.login_status') }}</div>
                </div>

                <div class="box-body">{{ trans('xylophone::base.logged_in') }}</div>
            </div>
        </div>
    </div>
@endsection
