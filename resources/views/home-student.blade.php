@extends('layouts.main')
@section('content')
<h1>
    My Enrolled Classes
    <a href="{{url('/enrol')}}" class="btn btn-secondary float-right">+Enrol</a>
</h1>
<hr>

@if(count($interactiveAttn)>0)
    <div class="alert alert-info">
        Your teacher has posted an interactive attendance that you
        haven't responded yet.
    @foreach($interactiveAttn as $intr)
        <div>
            {{$intr->enrol->myClass->name}} - {{$intr->enrol->myClass->description}}
            <a href='{{url("/attendance/interactive-response/$intr->id")}}' class="btn btn-success btn-sm">Respond as present</a>
        </div>
    @endforeach
    </div>
@endif

<table class="table table-striped">
    <thead>
        <tr>
            <th>Class Name</th>
            <th>Description</th>
            <th class="hide-sm">Schedule</th>
            <th class="hide-sm">Venue</th>
        </tr>
    </thead>
    <tbody>
        @foreach($enrols as $enrol)
        <tr>
            <td><a href='{{url("/enrol/$enrol->id/view")}}' class="btn btn-secondary btn-sm">{{$enrol->myClass->name}}</a></td>
            <td>{{$enrol->myClass->description}}</td>
            <td class="hide-sm">{{$enrol->myClass->schedule}}</td>
            <td class="hide-sm">{{$enrol->myClass->venue}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop
