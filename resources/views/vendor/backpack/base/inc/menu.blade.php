<div class="navbar-custom-menu pull-left">
    <ul class="nav navbar-nav">
        <!-- =================================================== -->
        <!-- ========== Top menu items (ordered left) ========== -->
        <!-- =================================================== -->

    <!-- <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> <span>Home</span></a></li> -->

        <!-- ========== End of top menu left items ========== -->
    </ul>
</div>

@if (backpack_auth()->check())
<ol class="breadcrumb">
    <li><a href="{{ url(config('backpack.base.route_prefix'), 'dashboard') }}">{{ mb_strtoupper(trans('backpack::crud.admin')) }}</a></li>
    @if(!empty($crud))
        <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ mb_strtoupper($crud->entity_name_plural) }}</a></li>
        <li class="active">{{ mb_strtoupper(trans('backpack::crud.list')) }}</li>
    @endif
</ol>
@endif
<div class="navbar-custom-menu">
    @if (config('backpack.base.setup_auth_routes'))
        @if(backpack_auth()->check())
            <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/cachePurge') }}">
                <div class="btn btn-outline publish-btn">  <i class="custom-icon rocket"></i> Publish Stats</div>
            </a>
        @endif
    @endif
</div>
