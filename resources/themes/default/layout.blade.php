<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="shortcut icon" href="{{ url('/img/wmt-logo.png') }}" type="image/x-icon">
    <title>
        {{ trans('frontend.stats') }} - @yield('title')
    </title>
    @yield('before_styles')

    <link rel="stylesheet" href="{{ mix('/css/frontend.css') }}"/>
    {!! Theme::css('/styles.css') !!}
    @yield('after_styles')
</head>
<body>
<div class="container-fluid">
    @yield('content')
    @include('frontend.partial._footer')
</div>

@stack('before_scripts')
<script async src="{{ mix('/js/app.js') }}"></script>
@stack('after_scripts')
</body>
</html>
