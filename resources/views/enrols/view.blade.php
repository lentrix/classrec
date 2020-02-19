@extends('layouts.main')
@section('content')

<h2>{{$enrol->myClass->name}}</h2>
<hr>

<div class="row">
    <div class="col-md-4">
        <h3>Class Details</h3>
        <table class="table table-striped">
            <tr><th>Name</th><td>{{$enrol->myClass->name}}</td></tr>
            <tr><th>Description</th><td>{{$enrol->myClass->description}}</td></tr>
            <tr><th>Schedule</th><td>{{$enrol->myClass->schedule}}</td></tr>
            <tr><th>Venue</th><td>{{$enrol->myClass->venue}}</td></tr>
            <tr><th>Grading Period</th><td>{{$enrol->myClass->gradingPeriod}}</td></tr>
        </table>
    </div>
    <div class="col-md-8">
        @include('students._performance')
    </div>
</div>

@stop
