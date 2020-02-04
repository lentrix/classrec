@extends('layouts.main')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href='{{url("/")}}'>Home</a></li>
      <li class="breadcrumb-item"><a href='{{url("/myclass/$myClass->id")}}'>{{$myClass->name}}</a></li>
      <li class="breadcrumb-item">Attendances</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-4 offset-md-4">
        <h2>
            {{$myClass->name}} Attendance
            <a href='{{url("/myclass/$myClass->id/attendance/create")}}'
                    class="btn btn-secondary float-right">
                +
            </a>
        </h2>

        <div class="list-group">
            @if(count($attendances)==0)
            No attendance yet.
            @endif

            @foreach($attendances as $attn)
            <a href='{{url("/myclass/$myClass->id/attendance/$attn->id")}}'
                    class="list-group-item list-group-item-action">
                {{$attn->date->format('l - F d, Y')}}
            </a>
            @endforeach
        </div>
    </div>
</div>

@stop
