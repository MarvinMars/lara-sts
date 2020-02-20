@if ($crud->hasAccess('create'))
	{{--@if($crud->route=='cms-wmt/import')--}}
		{{--<btn--}}
		   {{--class="btn btn-primary ladda-button custom-btn popup-btn"--}}
		   {{--data-style="zoom-in"--}}
		   {{--data-toggle="modal"--}}
		   {{--data-target="#popup">--}}
			{{--<span class="ladda-label">--}}
				{{--<i class="fa fa-plus"></i> {{ trans('backpack::crud.add') }} {{ $crud->entity_name }}--}}
			{{--</span>--}}
		{{--</btn>--}}
		{{--@else--}}
		<a href="{{ url($crud->route.'/create') }}"
		   class="btn btn-primary ladda-button custom-btn"
		   data-style="zoom-in">
			<span class="ladda-label">
				<i class="fa fa-plus"></i> {{ trans('backpack::crud.add') }} {{ $crud->entity_name }}
			</span>
		</a>
	{{--@endif--}}
@endif