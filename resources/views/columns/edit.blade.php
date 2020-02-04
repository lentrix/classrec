@extends('layouts.main')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href='{{url("/")}}'>Home</a></li>
      <li class="breadcrumb-item"><a href='{{url("/myclass/$myClass->id")}}'>{{$myClass->name}}</a></li>
      <li class="breadcrumb-item"><a href='{{url("/myclass/$myClass->id/column/$column->component")}}'><span class="capitalize">{{$column->component}}</span></a></li>
      <li class="breadcrumb-item">{{$column->title}}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-4 offset-md-4">
        <h2>Update <span class="capitalize">{{$column->component}}</span> Column</h2>
        {!!Form::model($column, ['url'=>"/myclass/$myClass->id/column/$column->id",'method'=>"put"])!!}

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
