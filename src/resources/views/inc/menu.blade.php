<div class="navbar-custom-menu pull-left">
    <ul class="nav navbar-nav">
        <!-- =================================================== -->
        <!-- ========== Top menu items (ordered left) ========== -->
        <!-- =================================================== -->

        @if (xylophone_auth()->check())
            <!-- Topbar. Contains the left part -->
            @include('xylophone::inc.topbar_left_content')
        @endif

    <!-- ========== End of top menu left items ========== -->
    </ul>
</div>


<div class="navbar-custom-menu pull-right">
    <ul class="nav navbar-nav">
        <!-- ========================================================= -->
        <!-- ========= Top menu right items (ordered right) ========== -->
        <!-- ========================================================= -->

        @if (config('xylophone.base.setup_auth_routes'))
            @if (xylophone_auth()->guest())
                <li>
                    <a href="{{ url(config('xylophone.base.route_prefix', 'admin').'/login') }}">{{ trans('xylophone::base.login') }}</a>
                </li>
                @if (config('xylophone.base.registration_open'))
                    <li><a href="{{ route('xylophone.auth.register') }}">{{ trans('xylophone::base.register') }}</a></li>
                @endif
            @else
                <!-- Topbar. Contains the right part -->
                @include('xylophone::inc.topbar_right_content')
                <li><a href="{{ route('xylophone.auth.logout') }}"><i class="fa fa-btn fa-sign-out"></i> {{ trans('xylophone::base.logout') }}</a></li>
            @endif
        @else
        @include('xylophone::inc.topbar_right_content')
        @endif
        <!-- ========== End of top menu right items ========== -->
    </ul>
</div>
