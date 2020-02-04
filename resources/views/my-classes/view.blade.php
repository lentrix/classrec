@extends('layouts.main')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href='{{url("/")}}'>Home</a></li>
      <li class="breadcrumb-item">{{$myClass->name}}</li>
    </ol>
</nav>

<h2>{{$myClass->name}}</h2>
<span class="subtitle">
    {{$myClass->description}} |
    {{$myClass->schedule}} {{$myClass->venue}} |
    {{$myClass->sem}} <br>
    <strong>Class Code: {{$myClass->code}}
</span>
<hr>

<div class="row">
    <div class="col-md-4 offset-md-4">
        <div class="list-group">
            <a href='{{url("myclass/$myClass->id/students")}}' class="list-group-item list-group-item-action">Students</a>
            <a href='{{url("myclass/$myClass->id/attendance")}}' class="list-group-item list-group-item-action">Attendance</a>
            <a href='{{url("myclass/$myClass->id/column/participation")}}' class="list-group-item list-group-item-action">Participation</a>
            <a href='{{url("myclass/$myClass->id/column/quiz")}}' class="list-group-item list-group-item-action">Quiz</a>
            <a href='{{url("myclass/$myClass->id/column/exam")}}' class="list-group-item list-group-item-action">Examination</a>
            <a href='{{url("myclass/$myClass->id/summary")}}' class="list-group-item list-group-item-action">Summary</a>
        </div>
    </div>
</div>

@stop
