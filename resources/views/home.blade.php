@extends('layouts.main')
@section('content')

<h1>
    My Classes
    <a href="{{url('/myclass/create')}}" class="btn btn-secondary float-right">
        +
    </a>
</h1>
<hr>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Class Name</th>
            <th>Description</th>
            <th class="hide-sm">Population</th>
            <th class="hide-sm">Venue</th>
        </tr>
    </thead>
    <tbody>
        @foreach($classes as $cls)

        <tr>
            <td><a href="{{url('/myclass/' . $cls->id)}}" class="btn btn-sm btn-secondary">{{$cls->name}}</a></td>
            <td>
                {{$cls->description}}
                <div class="subtitle hide-md" style="font-size: 0.8em">
                    {{$cls->schedule}}
                </div>
            </td>
            <td class="hide-sm">{{$cls->countStud()}}</td>
            <td class="hide-sm">{{$cls->venue}}</td>
        </tr>

        @endforeach
    </tbody>
</table>

@stop
