@extends('layouts.app')

@section('content')

    <div class="container col-md-8 col-md-offset-2 mt-5">
        <div class="card">
            <div class="card-header ">
                <h5 class="float-left">{{ $abonents->pass_fio }}</h5>
                <div class="clearfix"></div>
            </div>
            <div class="card-body">
                <p> <strong>Status</strong>: {{ $abonents->is_active ? 'Active' : 'Closed' }}</p>
                <p> {{ $abonents-> pass_iib}} </p>
                <p> {{ $abonents-> phone}} </p>
                <p> {{ $abonents-> email}} </p>
                <a href="#" class="btn btn-info">Edit</a>
                <a href="#" class="btn btn-info">Delete</a>
            </div>
        </div>
    </div>

@endsection
