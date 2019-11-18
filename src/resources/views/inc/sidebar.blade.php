@if (xylophone_auth()->check())
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        @include('xylophone::inc.sidebar_user_panel')

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          {{-- <li class="header">{{ trans('xylophone::base.administration') }}</li> --}}
          <!-- ================================================ -->
          <!-- ==== Recommended place for admin menu items ==== -->
          <!-- ================================================ -->

          @include('xylophone::inc.sidebar_content')

          <!-- ======================================= -->
          {{-- <li class="header">Other menus</li> --}}
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
@endif
