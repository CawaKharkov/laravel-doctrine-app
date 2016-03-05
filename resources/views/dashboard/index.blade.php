@extends('layouts.main')

@section('content')
        <!-- Begin page content -->
<div class="container">
    <div class="page-header m-t-1">
        <h1>Dashboard</h1>
    </div>


    <table class="table table-inverse">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row">{{$user->getId()}}</th>
                <td>{{$user->getName()}}</td>
                <td>{{$user->getEmail()}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


@endsection