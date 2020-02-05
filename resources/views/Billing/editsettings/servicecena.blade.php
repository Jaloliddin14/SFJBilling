@extends('layouts.layout')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="card mt-5">
            <div class="card-header ">
                <h5 class="float-left">Услуги</h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th class="th-sm">ID</th>
                            <th class="th-sm">Наименование</th>
                            <th class="th-sm">Периодичность</th>
                            <th class="th-sm">Активность</th>
                            <th class="th-sm">Тариф</th>
                            <th class="th-sm">Действие</th>

                        </tr>
                        </thead>
                        <tbody>
                        @if ($servicecena->isEmpty())
                            Услуги не найдены.
                        @else
                            @foreach($servicecena as $stt)
                                <tr>
                                    <td>{{ $stt->id }} </td>
                                    <td>{{ $stt->service_name }} </td>
                                    <td>@if( $stt->monthly_disposible) Одноразовая услуга @else Ежемесячная
                                        услуга @endif </td>
                                    <td>@if( $stt->is_active) Активный @else Не активный @endif </td>
                                    <td>{{ $stt->id }} </td>
                                    <th>
                                        <a href="{{action('SettingsController@editservicecena',$stt->id)}}"
                                           class="btn btn-info btn-sm">Тариф</a>
                                    </th>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
