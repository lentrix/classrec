@extends('layouts.main')
@section('content')

<h1>User Profile</h1>

<div class="row">
    <div class="col-md-3">
        <div class="card">
            <img src="{{asset('images/profile-pics/default.png')}}"
               class="card-img-top" alt="Profile Picture">
        </div>

    </div>
    <div class="col-md-6">
        <table class="table table-striped table-bordered">
            <tr><th>ID Number</th><td>{{$user->idnum}}</td></tr>
            <tr><th>Last Name</th><td>{{$user->lname}}</td></tr>
            <tr><th>First Name</th><td>{{$user->fname}}</td></tr>
            <tr><th>User Name</th><td>{{$user->username}}</td></tr>
            <tr><th>Email</th><td>{{$user->email}}</td></tr>
            <tr><th>Role</th><td>{{$user->role}}</td></tr>
        </table>
        <a href="{{url('/profile/edit')}}" class="btn btn-secondary float-right">
            Edit Profile
        </a>
    </div>
</div>

@stop
