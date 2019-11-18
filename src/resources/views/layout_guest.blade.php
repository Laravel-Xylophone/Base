<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('xylophone::inc.head')
</head>
<body class="hold-transition {{ config('xylophone.base.skin') }} fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper no-margin no-padding">

        <!-- Content Header (Page header) -->
         @yield('header')

        <!-- Main content -->
        <section class="content">

          @yield('content')

        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <footer class="main-footer m-l-0 text-sm">
        @include('xylophone::inc.footer')
      </footer>
    </div>
    <!-- ./wrapper -->


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
