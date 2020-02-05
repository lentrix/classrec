@extends('layouts.main')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href='{{url("/")}}'>Home</a></li>
      <li class="breadcrumb-item"><a href='{{url("/myclass/$myClass->id")}}'>{{$myClass->name}}</a></li>
      <li class="breadcrumb-item">Attendances</li>
    </ol>
</nav>

<h2>
    {{$myClass->name}} Attendance ({{$myClass->gradingPeriod}})
    <a href='{{url("/myclass/$myClass->id/attendance/create")}}'
            class="btn btn-secondary float-right">
        +
    </a>
</h2>

<div class="hide-sm">

    <table class="table table-stripped table-border">
        <thead>
            <tr>
                <th>Students</th>
                @foreach($attendances as $attn)
                <th class="text-center">
                    <a href='{{url("/myclass/$myClass->id/attendance/$attn->id")}}'
                            title="{{$attn->date->format('l M d, Y')}}"
                            class="btn btn-sm btn-info">
                        {{$attn->date->format('d-m')}}
                    </a>
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($enrols as $i=>$enrol)
            <tr>
                <td>{{($i+1)}}.) {{$enrol->user->fullName}}</td>
                @foreach($attendances as $attn)
                <td class="text-center">
                    {{$enrol->attendance($attn->id)->attendance}}
                </td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<div class="row hide-med">
    <div class="col-md-4">

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
