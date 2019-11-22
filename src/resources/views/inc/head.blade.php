<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
@if (config('xylophone.base.meta_robots_content'))
<meta name="robots" content="{{ config('xylophone.base.meta_robots_content', 'noindex, nofollow') }}">
@endif

{{-- Encrypted CSRF token for Laravel, in order for Ajax requests to work --}}
<meta name="csrf-token" content="{{ csrf_token() }}" />

<title>
  {{ isset($title) ? $title.' :: '.config('xylophone.base.project_name').' Admin' : config('xylophone.base.project_name').' Admin' }}
</title>

@yield('before_styles')
@stack('before_styles')

<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 4.3.1 -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/fontawesome-free/css/fontawesome.min.css">
<link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/fontawesome-free/css/all.min.css">

<link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/dist/css/adminlte.min.css">
<link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/dist/css/alt/adminlte.components.min.css">
<link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/dist/css/alt/adminlte.core.min.css">
<link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/dist/css/alt/adminlte.extra-components.min.css">
<link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/dist/css/alt/adminlte.plugins.min.css">
<link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
{{--<link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/dist/css/skins/_all-skins.min.css">--}}

<!-- BackPack Base CSS -->
<link rel="stylesheet" href="{{ asset('vendor/xylophone/base/xylophone.base.css') }}?v=3">
@if (config('xylophone.base.overlays') && count(config('xylophone.base.overlays')))
    @foreach (config('xylophone.base.overlays') as $overlay)
    <link rel="stylesheet" href="{{ asset($overlay) }}">
    @endforeach
@endif


@yield('after_styles')
@stack('after_styles')

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
