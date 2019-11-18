<header class="main-header">
  <!-- Logo -->
  <a href="{{ url('') }}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">{!! config('xylophone.base.logo_mini') !!}</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">{!! config('xylophone.base.logo_lg') !!}</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">{{ trans('xylophone::base.toggle_navigation') }}</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>

    @include('xylophone::inc.menu')
  </nav>
</header>
