@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <div class="header-container" style="">
            <h1>
                <span class="text-capitalize">{{ $crud->entity_name_plural }}</span>
            </h1>
        </div>
        <div class="pull-right user-btn-container">
            @if ( $crud->buttons->where('stack', 'top')->count() ||  $crud->exportButtons())
                <div class="box-header hidden-print {{ $crud->hasAccess('create')?'with-border':'' }}">
                    <i class="fa fa-search custom-search-icon"></i>
                    <input type="text" class="global_filter custom-table-search" placeholder="Search..."
                           id="global_filter">
                    @include('crud::inc.button_stack', ['stack' => 'top'])

                    <div id="datatable_button_stack" class="pull-right text-right hidden-xs"></div>
                </div>
            @endif
        </div>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="info-box">
                <span class="info-box-icon bg-green">
                    <i class="fa fa-flag-o"></i>
                </span>

                <div class="info-box-content">
                    <span class="info-box-text">Your team codes:</span>
                    <span class="info-box-number">
                        <strong>
                            {{ implode(', ', \App\Models\Team::teamIds()) }}
                        </strong>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Default box -->
    <div class="row">
        <!-- THE ACTUAL CONTENT -->
        <div class="col-md-12">
            <div class="box">
                <div class="box-body overflow-hidden">

                    {{-- Backpack List Filters --}}
                    @if ($crud->filtersEnabled())
                        @include('crud::inc.filters_navbar')
                    @endif

                    <table id="crudTable" class="table table-striped table-hover display responsive nowrap"
                           cellspacing="0">
                        <thead>
                        <tr class="background-hidden">
                            {{-- Table columns --}}
                            @foreach ($crud->columns as $column)
                                <th
                                        data-orderable="{{ var_export($column['orderable'], true) }}"
                                        data-priority="{{ $column['priority'] }}"
                                        data-visible-in-modal="{{ (isset($column['visibleInModal']) && $column['visibleInModal'] == false) ? 'false' : 'true' }}"
                                >
                                    {!! $column['label'] !!}
                                </th>
                            @endforeach
                            @if ( $crud->buttons->where('stack', 'line')->count() )
                                <th data-orderable="false" data-priority="{{ $crud->getActionsColumnPriority() }}"></th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after_styles')
    <!-- DATA TABLES -->
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/crud.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/list.css') }}">

    <!-- CRUD LIST CONTENT - crud_list_styles stack -->
    @stack('crud_list_styles')
@endsection

@section('after_scripts')
    @include('crud::inc.datatables_logic')
    {{--<script src="{{ asset('/js/popup.js') }}"></script>--}}
    <script src="{{ asset('vendor/backpack/crud/js/crud.js') }}"></script>
    <script src="{{ asset('vendor/backpack/crud/js/form.js') }}"></script>
    <script src="{{ asset('vendor/backpack/crud/js/list.js') }}"></script>

    <!-- CRUD LIST CONTENT - crud_list_scripts stack -->
    @stack('crud_list_scripts')
@endsection
