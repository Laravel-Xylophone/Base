<div class="box">
    <div class="box-body box-profile">
	    <img class="profile-user-img img-responsive img-circle" src="{{ xylophone_avatar_url(xylophone_auth()->user()) }}">
	    <h3 class="profile-username text-center">{{ xylophone_auth()->user()->name }}</h3>
	</div>

	<ul class="nav nav-pills nav-stacked">

	  <li role="presentation"
		@if (Request::route()->getName() == 'xylophone.account.info')
	  	class="active"
	  	@endif
	  	><a href="{{ route('xylophone.account.info') }}">{{ trans('xylophone::base.update_account_info') }}</a></li>

	  <li role="presentation"
		@if (Request::route()->getName() == 'xylophone.account.password')
	  	class="active"
	  	@endif
	  	><a href="{{ route('xylophone.account.password') }}">{{ trans('xylophone::base.change_password') }}</a></li>

	</ul>
</div>
