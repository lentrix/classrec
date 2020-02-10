@extends('layouts.main')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href='{{url("/")}}'>Home</a></li>
      <li class="breadcrumb-item"><a href='{{url("/myclass/$myClass->id")}}'>{{$myClass->name}}</a></li>
      <li class="breadcrumb-item">Summary</li>
    </ol>
</nav>

<h1>Class Summary</h1>

<table class="table table-bordered table-striped table-sm">
    <thead>
        <tr>
            <th rowspan="2">Student</th>
            <th colspan="2" class="text-center">Midterm</th>
            <th colspan="2" class="text-center">Final</th>
        </tr>
        <tr class="text-center">
            <th>Grade</th>
            <th>Rating</th>
            <th>Grade</th>
            <th>Rating</th>
        </tr>
    </thead>
    <tbody>
        @foreach($enrols as $idx=>$enrol)

        <tr>
            <td>{{$idx+1}}. {{$enrol->user->fullName}}</td>
            <td class="text-center">{{$enrol->grade(1)}}</td>
            <td class="text-center"></td>
            <td class="text-center">{{$enrol->grade(2)}}</td>
            <td class="text-center"></td>
        </tr>

        @endforeach
    </tbody>
</table>

@stop
