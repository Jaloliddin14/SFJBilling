@extends('layouts.layout')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="card mt-5">
            <div class="card-header ">
                <h5 class="float-left">Добавить адрес</h5>
                <div class="clearfix"></div>
            </div>
            <div class="card-body mt-2">
                <form method="post" action="/addstreet">
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
                            <label for="street_name" class="col-lg-10 control-label">Адрес</label>
                            <div class="col-lg-auto">
                                <input type="text" class="form-control" id="street_name"
                                       placeholder="И. Каримов" name="street_name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tip_street_name" class="col-lg-10 control-label">Тип адреса</label>
                            <div class="col-lg-auto">
                                <select class="form-control" name="tip_street_item_id" id="tip_street_name">
                                    @foreach($street_tip as $item)
                                        <option value="{{$item->id}}">{{$item->street_tip_name}}</option>
                                    @endforeach
                                </select>
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
                            <th class="th-sm">Тип</th>
                            <th class="th-sm">Активность</th>
                            <th class="th-sm">Действие</th>

                        </tr>
                        </thead>
                        <tbody>
                        @if ($street->isEmpty())

                        @else

                            @foreach($street as $stt)
                                <tr>
                                    <td>{{ $stt->id }} </td>
                                    <td>{{ $stt->street_name }} </td>
                                    <td>{{ $stt->street_tip_name }} </td>
                                    <td>@if( $stt->is_active) Активный @else Не активный @endif </td>
                                    <th>
                                        <a href="{{action('SettingsController@editstreet',$stt->id)}}" class="btn btn-info btn-sm">Редактировать</a>
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
