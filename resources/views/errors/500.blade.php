@extends('errors::illustrated-layout')

@section('code', 'Error')
@section('title', __('Error'))

@section('image')
    <div style="background-image: url({{ asset('/svg/wmt.svg') }});" class="absolute pin bg-contain bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', __('Something went wrong.'))

@section('explanation', __($exception->getMessage()))
