@if (Auth::check())
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <ul class="sidebar-menu">
                <!-- ================================================ -->
                <!-- ==== Admin menu ==== -->
                <!-- ================================================ -->
                <li>
                    <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}">
                        <i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/sport') }}">
                        <i class="fa fa-futbol-o"></i> <span>{{ trans('stats.sports') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/season') }}">
                        <i class="fa fa-clock-o"></i> <span>{{ trans('stats.seasons') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/game') }}">
                        <i class="fa fa-trophy"></i> <span>{{ trans_choice('stats.games', 2) }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/team') }}">
                        <i class="fa fa-users"></i> <span>{{ trans_choice('stats.teams', 2) }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/player') }}">
                        <i class="fa fa-user"></i> <span>{{ trans_choice('stats.players', 2) }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/import') }}">
                        <i class="fa fa-upload"></i> <span>{{ trans('stats.import') }}</span>
                    </a>
                </li>


                <!-- ======================================= -->

                <li class="header">{{ trans('backpack::base.administration') }}</li>
                <li>
                    <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/setting') }}">
                        <i class="fa fa-cog"></i> <span>Settings</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/elfinder') }}">
                        <i class="fa fa-files-o"></i> <span>File manager</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-group"></i>
                            <span>Users, Roles, Permissions</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/user') }}">
                                <i class="fa fa-user"></i> <span>Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/role') }}">
                                <i class="fa fa-group"></i> <span>Roles</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/permission') }}">
                                <i class="fa fa-key"></i> <span>Permissions</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="header">{{ trans('backpack::base.user') }}</li>
                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/logout') }}"><i
                                class="fa fa-sign-out"></i> <span>{{ trans('backpack::base.logout') }}</span></a></li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
@endif
