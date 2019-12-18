@extends('layouts.app')

@section('content')

    <div class="container col-md-8 col-md-offset-2 mt-5">
        <div class="card">
            <div class="card-header ">
                <h5 class="float-left">Abonents</h5>
                <div class="clearfix"></div>
            </div>
            <div class="card-body mt-2">
                @if ($abonents->isEmpty())
                    <p> There is no ticket.</p>
                @else
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($abonents as $abonent)
                            <tr>
                                <td>{{ $abonent->id }} </td>
                                <td>
                                    <a href="{{ action('AbonentController@show', $abonent->slug) }}">{{ $abonent->pass_fio }}</a>
                                </td>
                                <td>{{ $abonent->is_active ? 'Active' : 'Not Active' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

@endsection
