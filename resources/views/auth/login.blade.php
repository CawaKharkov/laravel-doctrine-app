@extends('layouts.main')

@section('content')
    <div class="container">

        @include('partials.alerts')

        <div class="page-header">
            <h3 class=>Sign In</h3>
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form method="POST" action="{{ route('auth.login') }}">
                    {!! csrf_field() !!}
                    @include('partials.errors')
                    <fieldset class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        <small class="text-muted">We'll never share your email with anyone else.</small>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </fieldset>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="rememberMe" value="1" name="remember"> Remember me
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>

        <hr/>

        <a href="/auth/vkontakte" class="btn btn-block btn-vkontakte btn-social"><i class="fa fa-vk"></i>Sign in with VK</a>
    </div>
@stop