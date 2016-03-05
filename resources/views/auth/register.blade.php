@extends('layouts.main')

@section('content')
    <div class="container">

        @include('partials.alerts')

        <div class="page-header">
            <h3>Sign Up</h3>
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form method="POST" action="{{ route('auth.register') }}">
                    {!! csrf_field() !!}
                    @include('partials.errors')

                    <fieldset class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter name">
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                               placeholder="Enter email">
                        <small class="text-muted">We'll never share your email with anyone else.</small>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                               placeholder="Password">
                    </fieldset>

                    <fieldset class="form-group">
                        <label for="password_confirmation">Password confirm</label>
                        <input type="password" name="password_confirmation" class="form-control"
                               id="password_confirmation" placeholder="Password confirm">
                    </fieldset>

                    <button type="submit" class="btn btn-primary">Sign up</button>
                </form>
            </div>
        </div>
    </div>
@stop