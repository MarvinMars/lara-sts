<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<div class="main">
    <div class="login_page">
        <div class="container">
            <div class="login_logo">
                <a href="https://wmt./?utm_source=videosystem&amp;utm_term=loginpage">
                    <img src="https://video.wmt.media/images/wmt.png" alt="Powered By WMT" class="img-responsive">
                </a>
            </div>
            <div class="well bs-component login-form">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('backpack.auth.login') }}">
                    {!! csrf_field() !!}
                    <fieldset>
                        <div class="form-group">
                            <legend class="text-center">Login</legend>
                        </div>
                        <div class="form-group {{ $errors->has($username) ? ' has-error' : '' }}">
                            <label class="control-label" for="email">Email</label>
                            <input type="text" class="form-control" placeholder="Input Username"  name="{{ $username }}" value="{{ old($username) }}" required="" autofocus="">
                            @if ($errors->has($username))
                                <span class="help-block">
                                    <strong>{{ $errors->first($username) }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="control-label" for="password">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Input Password" required="">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="el-button el-button--primary el-button--small form-control">
                                Login
                            </button>
                        </div>
                        @if (backpack_users_have_email())
                            <div class="col-md-8 col-md-offset-2 text-center">
                                    <a class="btn btn-link" href="{{ route('backpack.auth.password.reset') }}">{{ trans('backpack::base.forgot_your_password') }}</a>
                            </div>
                        @endif
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
{{--<div class="row">--}}
        {{--<div class="col-md-8 col-md-offset-2">--}}
            {{--<div class="box box-default">--}}
                {{--<div class="box-header with-border">--}}
                    {{--<div class="box-title">{{ trans('backpack::base.login') }}</div>--}}
                {{--</div>--}}
                {{--<div class="box-body">--}}
                    {{--<form class="form-horizontal" role="form" method="POST" action="{{ route('backpack.auth.login') }}">--}}
                        {{--{!! csrf_field() !!}--}}

                        {{--<div class="form-group{{ $errors->has($username) ? ' has-error' : '' }}">--}}
                            {{--<label class="col-md-4 control-label">{{ config('backpack.base.authentication_column_name') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input type="text" class="form-control" name="{{ $username }}" value="{{ old($username) }}">--}}

                                {{--@if ($errors->has($username))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first($username) }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
                            {{--<label class="col-md-4 control-label">{{ trans('backpack::base.password') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input type="password" class="form-control" name="password">--}}

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<div class="checkbox">--}}
                                    {{--<label>--}}
                                        {{--<input type="checkbox" name="remember"> {{ trans('backpack::base.remember_me') }}--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--{{ trans('backpack::base.login') }}--}}
                                {{--</button>--}}

                                {{--@if (backpack_users_have_email())--}}
                                {{--<a class="btn btn-link" href="{{ route('backpack.auth.password.reset') }}">{{ trans('backpack::base.forgot_your_password') }}</a>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
