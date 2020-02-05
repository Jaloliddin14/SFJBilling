@extends('layouts.layout')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="card mt-5">
            <div class="card-header ">
                <h5 class="float-left">Новый тариф для: {{$service->service_name}}</h5>
                <div class="clearfix"></div>
            </div>
            <div class="card-body mt-2">
                <form method="post" action="/addservicecena">
                    @foreach ($errors->all() as $error)
                        <p class="alert alert-danger">{{ $error }}</p>
                    @endforeach
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="service_id" value="{{ $service->id }}">

                    <fieldset>


                        <div class="form-group">
                            <label for="pul" class="col-md-12 control-label">Сумма</label>
                            <div class="col-lg-auto">
                                <input type="number" step="any" class="form-control" id="pul"
                                       placeholder="Введите сумму"
                                       name="pul">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sana_begin" class="col-lg-10 control-label">Дата документа</label>
                            <div class="col-lg-auto">
                                <input type="date" class="form-control" id="sana_begin" placeholder="Дата начало"
                                       name="sana_begin" value="<?php echo date('Y-m-d');?>">
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
                            <th class="th-sm">Цена</th>
                            <th class="th-sm">Дата Начало</th>
                            <th class="th-sm">Дата конец</th>
                            <th class="th-sm">Активность</th>

                        </tr>
                        </thead>
                        <tbody>
                        @if ($servicecena->isEmpty())
                            Услуги не найдены.
                        @else
                            @foreach($servicecena as $stt)
                                <tr>
                                    <td>{{ $stt->id }} </td>
                                    <td>{{ $stt->cena }} </td>
                                    <td>{{ $stt->sana_begin }} </td>
                                    <td>{{ $stt->sana_end }} </td>
                                    <td>@if( $stt->is_active) Активный @else Не активный @endif </td>
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
