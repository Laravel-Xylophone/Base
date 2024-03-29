<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('xylophone::inc.head')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
</head>
<body class="hold-transition {{ config('xylophone.base.skin') }} sidebar-mini">
	<script type="text/javascript">
		/* Recover sidebar state */
		(function () {
			if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
				var body = document.getElementsByTagName('body')[0];
				body.className = body.className + ' sidebar-collapse';
			}
		})();
	</script>
    <!-- Site wrapper -->
    <div class="wrapper">

      @include('xylophone::inc.main_header')

      <!-- =============================================== -->

      @include('xylophone::inc.sidebar')

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         @yield('header')

        <!-- Main content -->
        <section class="content">

          @yield('content')

        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <footer class="main-footer text-sm clearfix">
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

    <script>
        /* Store sidebar state */
        $('.sidebar-toggle').click(function(event) {
          event.preventDefault();
          if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
            sessionStorage.setItem('sidebar-toggle-collapsed', '');
          } else {
            sessionStorage.setItem('sidebar-toggle-collapsed', '1');
          }
        });

        // Set active state on menu element
        var full_url = "{{ Request::fullUrl() }}";
        var $navLinks = $("ul.sidebar-menu li a");
        // First look for an exact match including the search string
        var $curentPageLink = $navLinks.filter(
            function() { return $(this).attr('href') === full_url; }
        );
        // If not found, look for the link that starts with the url
        if(!$curentPageLink.length > 0){
            $curentPageLink = $navLinks.filter(
                function() { return $(this).attr('href').startsWith(full_url) || full_url.startsWith($(this).attr('href')); }
            );
        }

        $curentPageLink.parents('li').addClass('active');
    </script>

    <!-- JavaScripts -->
    {{-- <script src="{{ mix('js/app.js') }}"></script> --}}
</body>
</html>
