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
    <div class="col-md-6 offset-md-3">
        <h2>Record Scores</h2>
        <div class="subtitle">
            {{$column->title}} | {{$myClass->name}} | {{$column->created_at->format('l D, Y')}}
        </div>
        <hr>
        {!!Form::open(['url'=>"/myclass/$myClass->id/column/$column->id/record"])!!}
        <div class="list-group">
        @foreach($scores as $i=>$score)

            <div class="list-group-item">
                <div class="form-group row">
                    {{Form::label("score[$score->id]",
                    ($i+1) . ".) " . $score->enrol->user->fullName,[
                        'class'=>'col-sm-9 col-form-label'
                    ])}}

                    <div class="col-sm-3">
                        {{Form::number("score[$score->id]",
                                $score->score,['class'=>'form-control','max'=>$column->total])}}
                    </div>
                </div>
            </div>

        @endforeach
        </div>
        <div class="form-group">
            <br>
            <button class="btn btn-primary btn-block">Submit Scores</button>
        </div>

        {!!Form::close()!!}
    </div>
</div>

@stop
