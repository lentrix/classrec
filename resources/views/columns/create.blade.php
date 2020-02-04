@extends('layouts.main')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href='{{url("/")}}'>Home</a></li>
      <li class="breadcrumb-item"><a href='{{url("/myclass/$myClass->id")}}'>{{$myClass->name}}</a></li>
      <li class="breadcrumb-item"><a href='{{url("/myclass/$myClass->id/column/$component")}}'><span class="capitalize">{{$component}}</span></a></li>
      <li class="breadcrumb-item">New {{$component}}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-4 offset-md-4">
        <h2>Create <span class="capitalize">{{$component}}</span> Column</h2>
        {!!Form::open(['url'=>"/myclass/$myClass->id/column/$component"])!!}

        <div class="form-group">
            {{Form::label('title')}}
            {{Form::text('title',null,['class'=>'form-control'])}}
        </div>

        <div class="form-group">
            {{Form::label('total')}}
            {{Form::number('total',null,['class'=>'form-control'])}}
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Create Column</button>
        </div>

        {!!Form::close()!!}
    </div>
</div>

@stop
