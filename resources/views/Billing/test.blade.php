@extends('layouts.layout')

@section('content')
    @foreach($str as $stt)
        1-{{$stt->id}}<br>
        2-{{$stt->sana_begin}}<br>
        3-{{$stt->sana_end}}<br>
        4-{{(strtotime($stt->sana_begin)-strtotime($stt->sana_end))/86400}}
    @endforeach
@endsection
