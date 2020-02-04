@extends('layouts.main')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href='{{url("/")}}'>Home</a></li>
      <li class="breadcrumb-item"><a href='{{url("/myclass/$myClass->id")}}'>{{$myClass->name}}</a></li>
      <li class="breadcrumb-item">Edit Class</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-4 offset-md-4">
        <h1>Edit Class</h1>

        {!! Form::model($myClass, ['url'=>"/myclass/$myClass->id", 'method'=>'put'])!!}

        <div class="form-group">
            {{Form::label('name')}}
            {{Form::text('name',null,['class'=>'form-control'])}}
        </div>

        <div class="form-group">
            {{Form::label('description')}}
            {{Form::text('description',null,['class'=>'form-control'])}}
        </div>

        <div class="form-group">
            {{Form::label('schedule')}}
            {{Form::text('schedule',null,['class'=>'form-control'])}}
        </div>

        <div class="form-group">
            {{Form::label('venue')}}
            {{Form::text('venue',null,['class'=>'form-control'])}}
        </div>

        <div class="form-group">
            {{Form::label('sem')}}
            {{Form::text('sem',null,['class'=>'form-control'])}}
        </div>

        <div class="form-group">
            {{Form::label('weights')}}
            <div class="row">
                <div class="col-sm-4">
                    {{Form::label('quiz_weight','Quiz')}}
                    {{Form::number('quiz_weight',null,['class'=>'form-control'])}}
                </div>
                <div class="col-sm-4">
                    {{Form::label('part_weight','Particpn')}}
                    {{Form::number('part_weight',null,['class'=>'form-control'])}}
                </div>
                <div class="col-sm-4">
                    {{Form::label('exam_weight','Exams')}}
                    {{Form::number('exam_weight',null,['class'=>'form-control'])}}
                </div>
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-primary" type="submit">
                Submit
            </button>
        </div>

        {!!Form::close()!!}
    </div>
</div>
@stop
