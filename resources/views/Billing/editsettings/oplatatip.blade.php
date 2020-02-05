@extends('layouts.layout')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="card mt-5">
            <div class="card-header ">
                <h5 class="float-left">Добавить тип оплаты</h5>
                <div class="clearfix"></div>
            </div>
            <div class="card-body mt-2">
                <form method="post" action="/addoplatatip">
                    @foreach ($errors->all() as $error)
                        <p class="alert alert-danger">{{ $error }}</p>
                    @endforeach
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <fieldset>


                        <div class="form-group">
                            <label for="tip_oplati" class="col-lg-10 control-label">Тип Оплаты</label>
                            <div class="col-lg-auto">
                                <input type="text" class="form-control" id="tip_oplati"
                                       placeholder="Наличный, Терминал ..." name="tip_oplati">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <a href="javascript:history.back()" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th class="th-sm">ID</th>
                            <th class="th-sm">Наименование</th>
                            <th class="th-sm">Активность</th>
                            <th class="th-sm">Действие</th>

                        </tr>
                        </thead>
                        <tbody>
                        @if ($oplatatip->isEmpty())

                        @else

                            @foreach($oplatatip as $stt)
                                <tr>
                                    <td>{{ $stt->id }} </td>
                                    <td>{{ $stt->oplata_tip_name }} </td>
                                    <td>@if( $stt->is_active) Активный @else Не активный @endif </td>
                                    <th>
                                        <a href="{{action('SettingsController@editoplatatip',$stt->id)}}" class="btn btn-info btn-sm">Редактировать</a>
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
