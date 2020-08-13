@extends('layouts.layout')

@section('content')
    @if ($abonent->isEmpty())
        У абонента не имеется изменений
    @else


        @foreach($abonent as $abonents)
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
                                <p><strong>Применчание :</strong> {{ $abonents-> notes}} </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach

    @endif



@endsection
