@extends('layouts.layout')

@section('content')
    <?php
    use App\Http\Controllers\ConfController;
    $period = ConfController::geteperiod();
    $nr=1;
    ?>
    <div class="container col-md-8 col-md-offset-2">
        <div class="card mt-5">
            <div class="card-header ">
                <h5 class="float-left">Отчет Сальдо</h5>
                <div class="clearfix"></div>
            </div>
            <div class="card-body mt-2">
                <form method="post" action="/saldooborotget">
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
                            <label for="period" class="col-lg-10 control-label">Период отчета</label>
                            <div class="col-lg-auto">
                                <select class="form-control" name="period" id="period">
                                    @foreach($period as $item)
                                        <option value="{{$item->period}}">{{$item->period}}</option>
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
                            <th class="th-sm">№</th>
                            <th class="th-sm">№ Счета</th>
                            <th class="th-sm">Ф. И. О.</th>
                            <th class="th-sm">Сальдо на начало</th>
                            <th class="th-sm">Начисление</th>
                            <th class="th-sm">Поступление</th>
                            <th class="th-sm">Сальдо на конец</th>

                        </tr>
                        </thead>
                        <tbody>

                        @if ($payments->isEmpty())

                        @else

                            @foreach($payments as $item)
                                <tr>
                                    <td>{{ $nr }} </td>
                                    <td>{{ $item->id }} </td>
                                    <td>{{ $item->pass_fio }} </td>
                                    <td>{{ $item->saldo_begin }} </td>
                                    <td>{{ $item->service_nach }} </td>
                                    <td>{{ $item->oplata }} </td>
                                    <td>{{ $item->saldo_end }} </td>
                                </tr>
                                <?php $nr=$nr+1 ?>
                            @endforeach
                        @endif
                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>

@endsection
