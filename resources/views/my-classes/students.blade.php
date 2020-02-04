@extends('layouts.main')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href='{{url("/")}}'>Home</a></li>
      <li class="breadcrumb-item"><a href='{{url("/myclass/$myClass->id")}}'>{{$myClass->name}}</a></li>
      <li class="breadcrumb-item">List of Students</li>
    </ol>
</nav>

<h1>{{$myClass->name}} Students</h1>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
            <table class="table-striped">
                <tr>
                    <th>Description</th>
                    <td>{{$myClass->description}}</td>
                </tr>
                <tr>
                    <th>Schedule</th>
                    <td>{{$myClass->schedule}}</td>
                </tr>
                <tr>
                    <th>Venue</th>
                    <td>{{$myClass->venue}}</td>
                </tr>
                <tr>
                    <th>Code</th>
                    <td>{{$myClass->code}}</td>
                </tr>
            </table>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="list-group">
            @foreach($enrols as $key=>$enrol)
            <a href='{{url("/myclass/$myClass->id/students/$enrol->id")}}' class="list-group-item list-group-item-action">
                {{($key+1) . ".)"}} {{$enrol->user->fullName}}
            </a>
            @endforeach
        </div>
    </div>
</div>
@stop
