@extends('layouts.main')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href='{{url("/")}}'>Home</a></li>
      <li class="breadcrumb-item"><a href='{{url("/myclass/$myClass->id")}}'>{{$myClass->name}}</a></li>
      <li class="breadcrumb-item"><a href='{{url("/myclass/$myClass->id/attendance")}}'>Attendances</a></li>
      <li class="breadcrumb-item">List of Students</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2>Check Attendance</h2>
        <div class="subtitle">
            {{$attn->date->format('l - F d, Y')}}
        </div>
        <hr>
        {!!Form::open(['url'=>"/myclass/$myClass->id/attendance/$attn->id"])!!}
        <div class="list-group">
        @foreach($studAttns as $key=>$studAttn)
            <div class="list-group-item">
                <strong>{{($key+1) . ".) " . $studAttn->enrol->user->fullName}}</strong> <br>
                <span class="float-right">
                    <input type="radio" value="pr" name="attn[{{$studAttn->id}}]"
                            id="pr-{{$studAttn->id}}"
                            @if($studAttn->attendance=="pr") checked @endif>
                    <label for="pr-{{$studAttn->id}}">Present</label>

                    <input type="radio" value="ab" name="attn[{{$studAttn->id}}]"
                            id="ab-{{$studAttn->id}}"
                            @if($studAttn->attendance=="ab") checked @endif>
                    <label for="ab-{{$studAttn->id}}">Absent</label>

                    <input type="radio" value="lt" name="attn[{{$studAttn->id}}]"
                            id="lt-{{$studAttn->id}}"
                            @if($studAttn->attendance=="lt") checked @endif>
                    <label for="lt-{{$studAttn->id}}">Late</label>

                    <input type="radio" value="ex" name="attn[{{$studAttn->id}}]"
                            id="ex-{{$studAttn->id}}"
                            @if($studAttn->attendance=="ex") checked @endif>
                    <label for="ex-{{$studAttn->id}}">Excused</label>

                </span>
            </div>
        @endforeach
            <div class="form-group">
                <br>
                <button class="btn btn-primary btn-block" type="submit">Submit</button>
            </div>
        </div>
        {!!Form::close()!!}
    </div>
</div>

@stop
