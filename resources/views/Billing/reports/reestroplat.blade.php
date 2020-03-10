@extends('layouts.layout')

@section('content')
    <?php
    use App\Http\Controllers\ConfController;
    $period = ConfController::geteperiod();
    $nr = 1;
    ?>
    <div class="container col-md-8 col-md-offset-2">
        <div class="card mt-5">
            <div class="card-header ">
                <h5 class="float-left">Отчет Сальдо</h5>
                <div class="clearfix"></div>
            </div>
            <div class="card-body mt-2">
                <form method="post" action="/reestroplatget">
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
                            <label for="sana_ot" class="col-lg-10 control-label">Период с</label>
                            <div class="col-lg-auto">
                                <input type="date" class="form-control" id="sana_ot" placeholder="Дата от"
                                       name="sana_ot" value="<?php echo date('Y-m-d');?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sana_do" class="col-lg-10 control-label">Период до</label>
                            <div class="col-lg-auto">
                                <input type="date" class="form-control" id="sana_do" placeholder="Дата до"
                                       name="sana_do" value="<?php echo date('Y-m-d');?>">
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
                            <th class="th-sm">№</th>
                            <th class="th-sm">Абонент</th>
                            <th class="th-sm">№ док</th>
                            <th class="th-sm">Дата док</th>
                            <th class="th-sm">Дата добавление</th>
                            <th class="th-sm">Сумма</th>
                            <th class="th-sm">Тип оплаты</th>
                            <th class="th-sm">Пользователь</th>
                            <th class="th-sm">Месяц</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if ($oplata->isEmpty())

                        @else

                            @foreach($oplata as $item)
                                <tr>

                                    <td>{{ $item->id }} </td>
                                    <td>{{ $item->pass_fio }} </td>
                                    <td>{{ $item->doc_nomer }} </td>
                                    <td>{{ $item->doc_sana }} </td>
                                    <td>{{ $item->sana_add }} </td>
                                    <td>{{ $item->oplata }} </td>
                                    <td>{{ $item->oplata_tip_name }} </td>
                                    <td>{{ $item->name }} </td>
                                    <td>{{ $item->period }} </td>
                                </tr>
                                <?php
                                $nr = $nr + 1
                                ?>
                            @endforeach
                        @endif
                        </tbody>

                    </table>

                    <div class="card-body">

                        <form method="post" action="/excelreestroplatget">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="periodot" value="{{ $periodot }}">
                            <input type="hidden" name="perioddo" value="{{ $perioddo }}">
                            <fieldset>
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <button type="submit" class="btn btn-success">Export to Excel</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>

                </div>

            </div>

        </div>
    </div>

@endsection
