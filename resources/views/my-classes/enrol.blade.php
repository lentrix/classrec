@extends('layouts.main')
@section('content')

<div class="row">
    <div class="col-md-4 offset-md-4">
        <h1>Enrol to a Class</h1>
        {!!Form::open(['url'=>'/enrol'])!!}
        <div class="form-group">
            {{Form::label("code",'Enter enrol code')}}
            {{Form::text('code',null,['class'=>'form-control','required'])}}
        </div>
        <div class="form-group">
            <button class="btn btn-primary float-right">Enrol</button>
        </div>
        {!!Form::close()!!}
    </div>
</div>

@stop
