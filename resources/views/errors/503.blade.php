@extends('errors::illustrated-layout')

@section('code', '503')
@section('title', __('Stats will update shortly.'))

@section('image')
    <div style="background-image: url({{ asset('/svg/wmt.svg') }});"
         class="absolute pin bg-contain bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', __('Stats will update shortly'))

@section('explanation', __($exception->getMessage()))
