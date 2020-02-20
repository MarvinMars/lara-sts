@extends('errors::illustrated-layout')

@section('title', __('Page Not Found'))

@section('image')
    <div style="background-image: url({{ asset('/svg/wmt.svg') }});"
         class="absolute pin bg-contain bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message')
    {!! isset($exception)? ($exception->getMessage()?$exception->getMessage(): __('Sorry, the page you are looking for could not be found.')): __('Sorry, the page you are looking for could not be found.') !!}
@endsection
