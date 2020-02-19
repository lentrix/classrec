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
    ({{$myClass->gradingPeriod}})
    <a href='{{url("/myclass/$myClass->id/column/$component/create")}}'
            class="btn btn-secondary float-right">
        +
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
                <th class="text-center">
                    <a href='{{url("/myclass/$myClass->id/column/$col->id/view")}}'>
                        {{$col->title}}
                    </a>
                </th>
                @endforeach
                <th class="text-center">TOTAL</th>
            </tr>
            <tr class="bg-light">
                <?php $tot=0;?>
                @foreach($cols as $col)
                <th class="text-center">{{$col->total}}</th>
                <?php $tot+=$col->total ?>
                @endforeach
                <th class="text-center">{{$tot}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($enrols as $enrol)
            <tr>
                <?php $total = 0; ?>
                <td>{{$enrol->user->fullName}}</td>
                @foreach($cols as $col)
                    @if($scoreObj = $enrol->score($col->id))
                        <?php $score=$scoreObj->score;?>
                        <?php $total+=$score;?>
                    @else
                        <?php $score = null?>
                    @endif
                <td class="text-center">{{$score}}</td>
                @endforeach
                <td class="text-center">{{$total}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- show on small screen --}}
<div class="hide-med">

    <div class="list-group">
        @foreach($cols as $col)
        <a href='{{url("/myclass/$myClass->id/column/$col->id/view")}}' class="list-group-item list-group-item-action">
            {{$col->title}} <br>
            <span class="subtitle">{{$col->created_at->format('l M d, Y')}}</span>
            <span class="float-right">
                {{$col->total}}
            </span>
        </a>
        @endforeach
    </div>
</div>
@stop
