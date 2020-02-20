<li>
    <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}">
        <i class="custom-icon dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span>
    </a>
</li>
<li>
    <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/sport') }}">
        <i class="custom-icon football-ball"></i> <span>{{ trans('stats.sports') }}</span>
    </a>
</li>
<li>
    <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/season') }}">
        <i class="custom-icon calendar"></i> <span>{{ trans('stats.seasons') }}</span>
    </a>
</li>
<li>
    <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/game') }}">
        <i class="custom-icon cup"></i> <span>{{ trans_choice('stats.games', 2) }}</span>
    </a>
</li>
<li>
    <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/team') }}">
        <i class="custom-icon teams"></i> <span>{{ trans_choice('stats.teams', 2) }}</span>
    </a>
</li>
<li>
    <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/player') }}">
        <i class="custom-icon player"></i> <span>{{ trans_choice('stats.players', 2) }}</span>
    </a>
</li>
<li>
    <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/playertype') }}">
        <i class="fa fa-users"></i> <span>{{ trans_choice('stats.player_types', 2) }}</span>
    </a>
</li>

<li>
    <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/import') }}">
        <i class="custom-icon import"></i> <span>{{ trans('stats.import') }}</span>
    </a>
</li>
<li>
    <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/event') }}">
        <i class="custom-icon calendar"></i> <span>{{ trans('stats.events') }}</span>
    </a>
</li>
<li class="header"><span>{{ trans('backpack::base.administration') }}</span></li>
<li>
    <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/setting') }}">
        <i class="custom-icon settings"></i> <span>Settings</span>
    </a>
</li>
{{--<li>--}}
    {{--<a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/elfinder') }}">--}}
        {{--<i class="custom-icon file-manager"></i> <span>File manager</span>--}}
    {{--</a>--}}
{{--</li>--}}
<li class="treeview">
    <a href="#">
        <i class="custom-icon user-round"></i>
        <span>Users, Roles, Permissions </span><i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li>
            <a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/user') }}">
               <span>Users</span>
            </a>
        </li>
        <li>
            <a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/role') }}">
                <span>Roles</span>
            </a>
        </li>
        <li>
            <a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/permission') }}">
                <span>Permissions</span>
            </a>
        </li>
    </ul>
</li>
<li class="header"><span>{{ trans('backpack::base.user') }}</span></li>
<li>
    <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/logout') }}">
        <i class="custom-icon logout"></i> <span>{{ trans('backpack::base.logout') }}</span>
    </a>
</li>
<section class="sidebar-footer">
    Powered by <a target="_blank" href="https://wmt."><img class="footer-logo" src="{{asset('/img/logo.png')}}" alt="WMT"></a>.
</section>
