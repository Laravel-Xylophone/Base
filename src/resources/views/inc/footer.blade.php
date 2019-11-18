@if (config('xylophone.base.show_powered_by'))
    <div class="pull-right hidden-xs">
      {{ trans('xylophone::base.powered_by') }} <a target="_blank" href="http://backpackforlaravel.com?ref=panel_footer_link">Backpack for Laravel</a>
    </div>
@endif
@if (config('xylophone.base.developer_link') && config('xylophone.base.developer_name'))
    {{ trans('xylophone::base.handcrafted_by') }} <a target="_blank" href="{{ config('xylophone.base.developer_link') }}">{{ config('xylophone.base.developer_name') }}</a>.
@endif
