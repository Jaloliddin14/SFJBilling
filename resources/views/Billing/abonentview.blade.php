@extends('layouts.layout')

@section('content')

    <div class="container col-md-8 col-md-offset-2 mt-5">

        <div class="card ">
            <div class="card-header">
                Поиск
            </div>
            <div class="card-body">

                <form method="post" class="needs-validation">

                    {{ csrf_field() }}

                    <fieldset>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="abonent_id">Счет абонента </label>
                                <input type="text" class="form-control" id="abonent_id" name="abonent_id">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="pass_fio">Фамилия Имя Отчество </label>
                                <input type="text" class="form-control" id="pass_fio" name="pass_fio">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="phone">Телефон</label>
                                <input type="text" class="form-control" id="phone" name="phone">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="email">Электронная почта</label>
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                        </div>
                        <button {{action('AbonentController@index')}} class="btn btn-success btn-lg btn-block"
                                type="submit">Поиск
                        </button>
                    </fieldset>
                </form>
            </div>
        </div>

        <hr class="mb-4">


        <div class="card">
            <div class="card-header">
                Результаты выборки
            </div>
            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th class="th-sm">Счет абонента</th>
                            <th class="th-sm">Фамилия Имя Отчество</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($abonents->isEmpty())

                        @else

                            @foreach($abonents as $abonent)
                                <tr>
                                    <td>{{ $abonent->id }} </td>
                                    <td>
                                        <a href="{{ action('AbonentController@show', $abonent->slug) }}">{{ $abonent->pass_fio }}</a>
                                    </td>
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
