@extends('layouts.main')
@section('content')

@include('my-classes._grading-modal')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href='{{url("/")}}'>Home</a></li>
      <li class="breadcrumb-item">{{$myClass->name}}</li>
    </ol>
</nav>

<div class="btn-group float-right">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      ...
    </button>
    <div class="dropdown-menu dropdown-menu-right">
        <a href='{{url("/myclass/$myClass->id/edit")}}' class="dropdown-item">Edit</a>
        <a href='{{url("/myclass/$myClass->id/recode")}}'
            class="dropdown-item">Change Class Code</a>
        <button data-toggle="modal" data-target="#gradingModal"
            class="dropdown-item">Change Grading Period</button>
    </div>
</div>

<h2>
    {{$myClass->name}}
</h2>

<div class="row">
    <div class="col-md-7">
        <table class="table table-striped table-bordered">
            <tr><th>Name</th><td>{{$myClass->name}}</td></tr>
            <tr><th>Description</th><td>{{$myClass->description}}</td></tr>
            <tr><th>Schedule</th><td>{{$myClass->schedule}}</td></tr>
            <tr><th>Venue</th><td>{{$myClass->venue}}</td></tr>
            <tr>
                <th>Class Code</th>
                <td>
                    <strong>{{$myClass->code}}</strong>
                </td>
            </tr>
            <tr>
                <th>Grading Period</th>
                <td>
                    {{$myClass->grading==1?"Midterm":"Final"}}
                </td>
            </tr>
            <tr>
                <th>Population</th><td>{{count($myClass->enrols)}}</td>
            </tr>
        </table>
    </div>
    <div class="col-md-5">
        <div class="list-group">
            <a href='{{url("myclass/$myClass->id/students")}}' class="list-group-item list-group-item-action">Students</a>
            <a href='{{url("myclass/$myClass->id/attendance")}}' class="list-group-item list-group-item-action">Attendance</a>
            <a href='{{url("myclass/$myClass->id/column/participation")}}' class="list-group-item list-group-item-action">Participation</a>
            <a href='{{url("myclass/$myClass->id/column/quiz")}}' class="list-group-item list-group-item-action">Quiz</a>
            <a href='{{url("myclass/$myClass->id/column/exam")}}' class="list-group-item list-group-item-action">Examination</a>
            <a href='{{url("myclass/$myClass->id/summary")}}' class="list-group-item list-group-item-action">Summary</a>
            <a href='{{url("myclass/$myClass->id/settings")}}' class="bg-lightp list-group-item list-group-item-action">Settings</a>
        </div>
    </div>
</div>



@stop
