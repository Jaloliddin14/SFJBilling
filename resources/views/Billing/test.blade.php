@extends('layouts.layout')

@section('content')
    <ul>
        @foreach($abonents as $abonent)
            <li>{{$abonent -> pass_fio}}</li>
        @endforeach
    </ul>

@endsection
