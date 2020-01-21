@extends('layouts.layout')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="card mt-5">
            <div class="card-header ">
                <h5 class="float-left">Добавить тип адреса</h5>
                <div class="clearfix"></div>
            </div>
            <div class="card-body mt-2">
                <form method="post" action="/addstreettip">
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
                            <label for="tip_street_name" class="col-lg-10 control-label">Номер документа</label>
                            <div class="col-lg-auto">
                                <input type="text" class="form-control" id="tip_street_name"
                                       placeholder="Тип адреса (улица, проспект,...)" name="tip_street_name">
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
                        @if ($streettip->isEmpty())

                        @else

                            @foreach($streettip as $stt)
                                <tr>
                                    <td>{{ $stt->id }} </td>
                                    <td>{{ $stt->street_tip_name }} </td>
                                    <td>{{ $stt->is_active }} </td>
                                    <th>
                                        <a href="{{action('SettingsController@editstreettip',$stt->id)}}" class="btn btn-info btn-sm">Редактировать</a>
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
