@extends('layouts.main')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href='{{url("/")}}'>Home</a></li>
      <li class="breadcrumb-item"><a href='{{url("/myclass/$myClass->id")}}'>{{$myClass->name}}</a></li>
      <li class="breadcrumb-item"><span class="capitalize">{{$component}}</span></li>
    </ol>
</nav>

<h2>
    {{$myClass->name}} - <span class="capitalize">{{$component}}</span>
    <a href='{{url("/myclass/$myClass->id/column/$component/create")}}'
            class="btn btn-secondary float-right">
        + New
    </a>
</h2>

<hr>

{{-- show table on large screen --}}
<div class="hide-sm">
    <table class="table table-bordered">
        <thead>
            <tr class="bg-light">
                <th rowspan="2">Student</th>
                @foreach($cols as $col)
                <th>
                    <a href='{{url("/myclass/$myClass->id/column/$col->id/view")}}'>
                        {{$col->title}}
                    </a>
                </th>
                @endforeach
                <th>TOTAL</th>
            </tr>
            <tr class="bg-light">
                <?php $tot=0;?>
                @foreach($cols as $col)
                <th>{{$col->total}}</th>
                <?php $tot+=$col->total ?>
                @endforeach
                <th>{{$tot}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($enrols as $enrol)
            <tr>
                <?php $total = 0; ?>
                <td>{{$enrol->user->fullName}}</td>
                @foreach($cols as $col)
                <?php $score = $enrol->score($col->id)->score; ?>
                <?php $total+=$score;?>
                <td>{{$score}}</td>
                @endforeach
                <td>{{$total}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- show accordion on small screen --}}
<div class="hide-med">
    Hide on medium
</div>
@stop
