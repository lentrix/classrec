@extends('layouts.main')
@section('content')
<h2>Change Student Password</h2>

<div class="row">
    <div class="col-md-6">
        <h3>Student Details</h3>
        <table class="table table-striped table-bordered">
            <tr><th>ID Number</th><td>{{$enrol->user->idnum}}</td></tr>
            <tr><th>Last Name</th><td>{{$enrol->user->lname}}</td></tr>
            <tr><th>First Name</th><td>{{$enrol->user->fname}}</td></tr>
        </table>
    </div>
    <div class="col-md-6">
        {!!Form::open(['url'=>"/myclass/$myClass->id/students/$enrol->id/change-password"])!!}

        <div class="form-group">
            {{Form::label('password','New Password')}}
            {{Form::password('password',['class'=>'form-control'])}}
        </div>

        <div class="form-group">
            {{Form::label('password_confirmation','Confirm Password')}}
            {{Form::password('password_confirmation',['class'=>'form-control'])}}
        </div>

        <div class="form-group">
            <button class="btn btn-primary" type="submit">Change Password</button>
        </div>

        {!!Form::close() !!}
    </div>
</div>
@stop
