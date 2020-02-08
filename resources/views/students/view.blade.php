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

<div class="btn-group float-right">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Menu
    </button>
    <div class="dropdown-menu dropdown-menu-right">
        <a href='{{url("/myclass/$myClass->id/students/$enrol->id/change-password")}}' class="dropdown-item">Change Password</a>
        <button class="dropdown-item text-danger"
                data-toggle="modal" data-target="#removeModal">
            Remove from class
        </button>
    </div>
</div>

<h2>Student Summary</h2>
<div class="subtitle">
    <strong>{{$enrol->user->idnum}}</strong> | {{$enrol->user->fullName}} |
    {{$myClass->name}} <span class="hide-sm">- {{$myClass->description}}</span>
</div>

<div class="row">
    <div class="col-md-6">
        <h3>Student Details</h3>
        <table class="table table-striped table-bordered">
            <tr><th>ID Number</th><th>{{$enrol->user->idnum}}</th></tr>
            <tr><th>Last Name</th><td>{{$enrol->user->lname}}</td></tr>
            <tr><th>First Name</th><td>{{$enrol->user->fname}}</td></tr>
            <tr><th>User Name</th><td>{{$enrol->user->username}}</td></tr>
            <tr><th>Email</th><td>{{$enrol->user->email}}</td></tr>
        </table>

    </div>
    <div class="col-md-6">
        @include('students._performance')
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="removeModalLabel">Confirm Remove Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!!Form::open(['url'=>"/myclass/$myClass->id/students/$enrol->id/", 'method'=>'delete'])!!}
        <div class="modal-body">
            <div class="alert alert-danger">
                Are you absolutely sure about removing this student from this class?
                Any existing scores and attendances of this student will also be deleted.
                This action cannot be undone. Please proceed with caution.
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="type" class="btn btn-primary">Remove Student</button>
        </div>
        {!!Form::close()!!}
      </div>
    </div>
</div>
@stop
