@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            {{ trans('import.import_processing_item', [
                'item' => $title
            ]) }}
            <small>{{ $importItem->file }}</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">
                    {{ config('backpack.base.project_name') }}
                </a>
            </li>
            <li class="active">{{ trans('stats.import') }}</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-xs-12">
                            <h4>{{ $title }}</h4>
                            <div class="box-group" id="items">
                                @forelse ($items as $item)
                                    @include('import.partial._item')
                                @empty
                                    @include('import.partial._empty')
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <a href="{{ route('crud.import.processing', [
                                'id' => $importItem->id
                            ]) }}" class="btn btn-success">
                                <span class="fa fa-arrow-circle-o-right"></span>
                                {{ trans('import.next_step') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
