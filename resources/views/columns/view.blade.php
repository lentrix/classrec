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

        <div class="btn-group float-right">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              ...
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <a href='{{url("/myclass/$myClass->id/column/$column->id/edit")}}'
                    class="dropdown-item">Edit</a>
                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#commonScoreModal" style="margin-right: 8px">
                    Common Score
                </button>
                <a href='{{url("/myclass/$myClass->id/column/$column->id/rescan")}}' class="dropdown-item">
                    Re-Scan
                </a>
                <button type="button" class="dropdown-item text-danger" data-toggle="modal"
                        data-target="#deleteModal" style="margin-right: 8px">
                    Delete
                </button>
            </div>
        </div>

        <h2>
            Record Scores
        </h2>
        <div class="subtitle">
            {{$column->title}} | {{$myClass->name}} |
            {{$column->created_at->format('l D, Y')}} | ({{$column->total}} points)
        </div>
        <hr>
        {!!Form::open(['url'=>"/myclass/$myClass->id/column/$column->id/record"])!!}
        <div class="list-group">
        @foreach($scores as $i=>$score)

            <div class="list-group-item">
                <div class="form-group row">
                    {{Form::label("score[$score->id]",
                    $score->enrol->user->fullName,[
                        'class'=>'col-9 col-form-label'
                    ])}}

                    <div class="col-3">
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

<!-- Modal -->
<div class="modal fade" id="commonScoreModal" tabindex="-1" role="dialog" aria-labelledby="commonScoreModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="commonScoreModalLabel">Set Common Score</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['url'=>"/myclass/$myClass->id/column/$column->id/common-score"])!!}
        <div class="modal-body">
            <p class="alert alert-warning">
              Please understand that you are about to replace all the scores
              in this column with the score below. Please proceed with caution.
            </p>
            <div class="form-group">
                {{Form::label('common_score')}}
                {{Form::number('common_score',null,['class'=>'form-control', 'max'=>$column->total])}}
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        {!!Form::close()!!}
      </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Confirm Delete Column</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['url'=>"/myclass/$myClass->id/column/$column->id",'method'=>'delete'])!!}
        <div class="modal-body">
            <p class="alert alert-danger">
              Are absolutely sure about deleting this column?
              This action will not be undone. Please proceed with caution.
            </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete Column</button>
        </div>
        {!!Form::close()!!}
      </div>
    </div>
</div>

@stop
