<div class="user-panel">
  <a class="pull-left image" href="{{ route('xylophone.account.info') }}">
    <img src="{{ xylophone_avatar_url(xylophone_auth()->user()) }}" class="img-circle" alt="User Image">
  </a>
  <div class="pull-left info">
    <p><a href="{{ route('xylophone.account.info') }}">{{ xylophone_auth()->user()->name }}</a></p>
    <small><small><a href="{{ route('xylophone.account.info') }}"><span><i class="fa fa-user-circle-o"></i> {{ trans('xylophone::base.my_account') }}</span></a> &nbsp;  &nbsp; <a href="{{ xylophone_url('logout') }}"><i class="fa fa-sign-out"></i> <span>{{ trans('xylophone::base.logout') }}</span></a></small></small>
  </div>
</div>
