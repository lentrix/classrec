@extends('layouts.main')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href='{{url("/")}}'>Home</a></li>
      <li class="breadcrumb-item"><a href='{{url("/myclass/$myClass->id")}}'>{{$myClass->name}}</a></li>
      <li class="breadcrumb-item"><a href='{{url("/myclass/$myClass->id/attendance")}}'>Attendances</a></li>
      <li class="breadcrumb-item">New Attendance</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-4 offset-md-4">
        <h2>Create Attendance</h2>
        {!!Form::open(['url'=>"/myclass/$myClass->id/attendance"])!!}
        <div class="form-group">
            {{Form::label('date')}}
            {{Form::date('date',null,['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('remarks')}}
            {{Form::text('remarks',null,['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Next</button>
        </div>
        {!!Form::close()!!}
    </div>
</div>

@stop
