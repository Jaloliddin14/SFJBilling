@extends('layouts.layout')

@section('content')
    @if ($abonents->isEmpty())
        <p> There is no ticket.</p>
    @else
        <ul>
            @foreach($abonents as $abonent)
                <li>{{$abonent -> pass_fio}}</li>
            @endforeach
        </ul>
    @endif

@endsection
