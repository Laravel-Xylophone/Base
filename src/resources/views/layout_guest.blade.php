<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('xylophone::inc.head')
</head>
<body class="hold-transition {{ config('xylophone.base.skin') }} {{ $body_class ?? '' }}">
    <div class="login-logo">
        @yield('header')
    </div>
    <!-- /.login-logo -->
    @yield('content')

    @yield('before_scripts')
    @stack('before_scripts')

    @include('xylophone::inc.scripts')
    @include('xylophone::inc.alerts')

    @yield('after_scripts')
    @stack('after_scripts')

    <!-- JavaScripts -->
    {{-- <script src="{{ mix('js/app.js') }}"></script> --}}
</body>
</html>
