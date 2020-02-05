@extends('layouts.main')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href='{{url("/")}}'>Home</a></li>
      <li class="breadcrumb-item"><a href='{{url("/myclass/$myClass->id")}}'>{{$myClass->name}}</a></li>
      <li class="breadcrumb-item"><a href='{{url("/myclass/$myClass->id/students")}}'>List of Students</a></li>
      <li class="breadcrumb-item">{{$enrol->user->fullName}}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-8">
        <table class="table table-striped table-bordered">
            <tr><th>Last Name</th><td>{{$enrol->user->lname}}</td></tr>
            <tr><th>First Name</th><td>{{$enrol->user->fname}}</td></tr>
            <tr><th>User Name</th><td>{{$enrol->user->username}}</td></tr>
            <tr><th>Email</th><td>{{$enrol->user->email}}</td></tr>
        </table>
        <table class="table table-striped table-bordered">
            <tr>
                <th>Components</th>
                <th>Midterm</th>
                <th>Final</th>
            </tr>
            <tr>
                <td>Attendance</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Quizzes</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Participation</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Examination</td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>
    <div class="col-md-4">
        <div class="list-group">
            <a href='{{url("")}}' class="list-group-item list-group-item-action bg-danger text-light">Remove Student</a>
            <a href='{{url("")}}' class="list-group-item list-group-item-action bg-warning">Change Password</a>
        </div>
    </div>
</div>

@stop
