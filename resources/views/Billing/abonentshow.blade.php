@extends('layouts.layout')

@section('content')

    <div class="container col-md-8 col-md-offset-2 mt-5">
        <div class="card">
            <div class="card-header ">
                <h5 class="float-left">{{ $abonents->pass_fio }}</h5>
                <div class="clearfix"></div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm">
                        <p><strong>Счет абонента</strong>: {{ $abonents-> id}} </p>
                    </div>
                    <div class="col-sm">
                        <p><strong>Адрес</strong>: ул. {{ $abonents-> street_name }}
                            <strong>Дом</strong> {{ $abonents-> add_dom }}
                            <strong>Корпус</strong> {{ $abonents-> add_korpus }}
                            <strong>Подъезд</strong> {{ $abonents-> add_podyezd }}
                            <strong>Квартира</strong> {{ $abonents-> add_kvartira }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <p><strong>Телефон</strong>: {{ $abonents-> phone}} </p>
                    </div>
                    <div class="col-sm">
                        <p><strong>Электронная почта</strong>: {{ $abonents-> email}} </p>
                    </div>
                    <div class="col-sm">
                        <p><strong>Номер договора</strong>: {{ $abonents-> dogovor_nomer}} </p>
                    </div>
                    <div class="col-sm">
                        <p><strong>Дата
                                договора</strong>: {{ Carbon\Carbon::parse($abonents-> dogovor_sana)->format('d.m.Y')}}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <p><strong>Паспорт серия и
                                номер</strong>: {{ $abonents-> pass_seriya}} {{ $abonents-> pass_nomer}}
                        </p>
                    </div>
                    <div class="col-sm">
                        <p><strong>Кем выдан</strong>: {{ $abonents-> pass_iib}} </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <p><strong>Дата
                                рождение</strong>: {{ Carbon\Carbon::parse($abonents-> pass_sana_birth)->format('d.m.Y')}}
                        </p>
                    </div>
                    <div class="col-sm">
                        <p><strong>Дата
                                получение</strong>: {{ Carbon\Carbon::parse($abonents-> pass_sana_get)->format('d.m.Y')}}
                        </p>
                    </div>
                    <div class="col-sm">
                        <p><strong>Дата
                                истичение</strong>: {{ Carbon\Carbon::parse($abonents-> pass_sana_exp)->format('d.m.Y')}}
                        </p>
                    </div>
                    <div class="col-sm">
                        <p><strong>Status</strong>: {{ $abonents->is_active ? 'Active' : 'Closed' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm">
                        <p><strong>Сальдо на начало :</strong>: {{ $payment-> saldo_begin}} </p>
                    </div>
                    <div class="col-sm">
                        <p><strong>Начисление :</strong>: {{ $payment->service_nach}} </p>
                    </div>
                    <div class="col-sm">
                        <p><strong>Оплаты :</strong>: {{ $payment->oplata}} </p>
                    </div>
                    <div class="col-sm">
                        <p @if($payment->saldo_end>0) style="color:green;" @else style="color:red;" @endif><strong>Сальдо
                                на конец : {{ $payment->saldo_end}}</strong></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm">
                        <p><strong>Применчание :</strong> {{ $abonents-> notes}} </p>
                    </div>
                </div>

                <div class="row">
                    @can('abonent-add_uslugi')
                        <div class="col ">
                            <form method="post" action="/addusluga">
                                <input type="hidden" name="ab_id" value="{{$abonents->id}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-primary btn-block " value="Установка услуги">
                            </form>
                        </div>
                    @endcan
                    @can('abonent-oplata')
                        <div class="col ">
                            <form method="post" action="/addoplata">
                                <input type="hidden" name="ab_id" value="{{$abonents->id}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-primary btn-block" value="Прием оплаты">
                            </form>
                        </div>
                    @endcan
                    @can('abonent-edit')
                        <div class="col">
                            <form method="post" action="/editabonent">
                                <input type="hidden" name="ab_id" value="{{$abonents->id}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-primary btn-block" value="Редактировать">
                            </form>
                        </div>
                    @endcan
                    @can('abonent-edit')
                        <div class="col">
                            <form method="post" action="/editabonent">
                                <input type="hidden" name="ab_id" value="{{$abonents->id}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-primary btn-block" value="Архив">
                            </form>
                        </div>
                    @endcan

                </div>
            </div>
        </div>
    </div>


    <div class="container col-md-8 col-md-offset-2 mt-5">
        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true"
                                aria-controls="collapseOne">
                            Услуги
                        </button>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-hover">
                                <thead class="thead-light">
                                <tr>
                                    <th class="th-sm">Номер</th>
                                    <th class="th-sm">Номер документа</th>
                                    <th class="th-sm">Дата документа</th>
                                    <th class="th-sm">Дата Начало</th>
                                    <th class="th-sm">Услуга</th>
                                    <th class="th-sm">Цена</th>
                                    <th class="th-sm">Пользователь</th>
                                    <th class="th-sm">Действие</th>

                                </tr>
                                </thead>
                                <tbody>
                                @if ($uslugi->isEmpty())

                                @else

                                    @foreach($uslugi as $usl)
                                        <tr>
                                            <td>{{ $usl->id }} </td>
                                            <td>{{ $usl->doc_nomer }} </td>
                                            <td>{{ Carbon\Carbon::parse($usl->doc_sana)->format('d.m.Y') }} </td>
                                            <td>{{ Carbon\Carbon::parse($usl->sana_begin)->format('d.m.Y') }} </td>
                                            <td>{{ $usl->service_name }} </td>
                                            <th>{{ $usl->cena }} </th>
                                            <td>{{ $usl->name }} </td>
                                            <th>
                                                @can('abonent-actions')
                                                    @if($usl->monthly==1 && $usl->sana_end==null)
                                                        <a href="{{action('UslugaController@edit',$usl->id)}}"
                                                           class="btn btn-info btn-sm">Снять</a>
                                                    @else
                                                    @endif
                                                @endcan
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
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                aria-expanded="false" aria-controls="collapseTwo">
                            Оплаты
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-hover">
                                <thead class="thead-light">
                                <tr>
                                    <th class="th-sm">Номер</th>
                                    <th class="th-sm">Номер документа</th>
                                    <th class="th-sm">Дата документа</th>
                                    <th class="th-sm">Дата ввода</th>
                                    <th class="th-sm">Сумма</th>
                                    <th class="th-sm">Тип оплаты</th>
                                    <th class="th-sm">Пользователь</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if ($oplati->isEmpty())

                                @else

                                    @foreach($oplati as $opl)
                                        <tr>
                                            <td>{{ $opl->id }} </td>
                                            <td>{{ $opl->doc_nomer }} </td>
                                            <td>{{ Carbon\Carbon::parse($opl->doc_sana)->format('d.m.Y') }} </td>
                                            <td>{{ Carbon\Carbon::parse($opl->sana_add)->format('d.m.Y H:i:s') }} </td>
                                            <th>{{ $opl->oplata }} </th>
                                            <td>{{ $opl->oplata_tip_name }} </td>
                                            <td>{{ $opl->name }} </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"
                                aria-expanded="false" aria-controls="collapseThree">
                            Счет
                        </button>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-hover">
                                <thead class="thead-light">
                                <tr>
                                    <th class="th-sm">Сальдо на начало</th>
                                    <th class="th-sm">Начисление услуг</th>
                                    <th class="th-sm">Поступление</th>
                                    <th class="th-sm">Сальдо на конец</th>
                                    <th class="th-sm">Месяц</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if ($payments->isEmpty())

                                @else

                                    @foreach($payments as $pm)
                                        <tr>
                                            <td>{{ $pm->saldo_begin }} </td>
                                            <td>{{ $pm->service_nach }} </td>
                                            <td>{{ $pm->oplata }} </td>
                                            <td>{{ $pm->saldo_end }} </td>
                                            <td>{{ Carbon\Carbon::parse($pm->period)->format('d.m.Y') }} </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
