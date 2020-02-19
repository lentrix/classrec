@extends('layouts.main')
@section('content')

<div class="row">
    <div class="col-md-5">
        <h1>Edit User Profile</h1>

        {!!Form::model($user, ['url'=>'/profile/update','method'=>'put']) !!}

        <div class="form-group">
            {{Form::label('idnum',"ID Number")}}
            {{Form::text('idnum',null,['class'=>'form-control'])}}
        </div>

        <div class="form-group">
            {{Form::label('lname',"Last Name")}}
            {{Form::text('lname',null,['class'=>'form-control'])}}
        </div>

        <div class="form-group">
            {{Form::label('fname',"First Name")}}
            {{Form::text('fname',null,['class'=>'form-control'])}}
        </div>

        <div class="form-group">
            {{Form::label('username',"User Name")}}
            {{Form::text('username',null,['class'=>'form-control'])}}
        </div>

        <div class="form-group">
            {{Form::label('email',"Email")}}
            {{Form::text('email',null,['class'=>'form-control'])}}
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Update Profile</button>
            <a href="{{url('/profile')}}" class="btn btn-warning float-right">Cancel</a>
        </div>

        {!!Form::close() !!}

    </div>
</div>

@stop
