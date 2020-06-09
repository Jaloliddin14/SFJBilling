@extends('layouts.layout')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="card mt-5">
            <div class="card-header ">
                <h5 class="float-left">Добавить Услугу</h5>
                <div class="clearfix"></div>
            </div>
            <div class="card-body mt-2">
                <form method="post" action="/addservice">
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
                            <label for="service_name" class="col-lg-10 control-label">Наименование услуги</label>
                            <div class="col-lg-auto">
                                <input type="text" class="form-control" id="service_name" name="service_name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="monthly" class="col-lg-10 control-label">Периодичность услуги</label>
                            <div class="col-lg-auto">
                                <select class="form-control" name="monthly" id="monthly" onchange="changes()">
                                    <option value="0">Одноразовая услуга</option>
                                    <option value="1">Ежемесячная услуга</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cena_dinamic" class="col-lg-10 control-label">Стоимость</label>
                            <div class="col-lg-auto">
                                <select class="form-control" name="cena_dinamic" id="cena_dinamic">
                                    <option value="0">По Тарифу</option>
                                    <option value="1">Изменяемая</option>
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
                            <th class="th-sm">Периодичность</th>
                            <th class="th-sm">Активность</th>
                            <th class="th-sm">Действие</th>

                        </tr>
                        </thead>
                        <tbody>
                        @if ($services->isEmpty())
                            Услуги не найдены.
                        @else
                            @foreach($services as $stt)
                                <tr>
                                    <td>{{ $stt->id }} </td>
                                    <td>{{ $stt->service_name }} </td>
                                    <td>@if( $stt->monthly) Ежемесячная @else Одноразовая услуга
                                        услуга @endif </td>
                                    <td>@if( $stt->is_active) Активный @else Не активный @endif </td>
                                    <th>
                                        <a href="{{action('SettingsController@editservice',$stt->id)}}"
                                           class="btn btn-info btn-sm">Редактировать</a>
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

@push('customjs')
    <script type="text/javascript">
        function changes() {
            var vibor = document.getElementById("monthly").value;
            if (vibor == 1) {
                document.getElementById("cena_dinamic").value = 0;
                document.getElementById("cena_dinamic").disabled = true;
            } else {
                document.getElementById("cena_dinamic").disabled = false;
            }

        }
    </script>
@endpush
