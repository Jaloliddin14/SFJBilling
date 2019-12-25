@extends('layouts.layout')

@section('content')

    <div class="container col-md-8 col-md-offset-2 mt-5">
        <div class="card">
            <div class="card-header ">
                <h5 class="float-left">{{ $abonents->pass_fio }}</h5>
                <div class="clearfix"></div>
            </div>
            <div class="card-body">
                <p><strong>Счет абонента</strong>: {{ $abonents-> id}} </p>
                <p><strong>Адрес</strong>: ул. {{ $abonents-> add_street_id }} Дом {{ $abonents-> add_dom }} Корпус {{ $abonents-> add_korpus }} Подъезд {{ $abonents-> add_podyezd }} Квартира {{ $abonents-> add_kvartira }}</p>
                <p><strong>Номер договора</strong>: {{ $abonents-> dogovor_nomer}} </p>
                <p><strong>Дата договора</strong>: {{ $abonents-> dogovor_sana}} </p>
                <p><strong>Телефон</strong>: {{ $abonents-> phone}} </p>
                <p><strong>Электронная почта</strong>: {{ $abonents-> email}} </p>
                <p><strong>Паспорт серия и номер</strong>: {{ $abonents-> pass_seriya}} {{ $abonents-> pass_nomer}}</p>
                <p><strong>Кем выдан</strong>: {{ $abonents-> pass_iib}} </p>
                <p><strong>Дата рождение</strong>: {{ $abonents-> pass_sana_birth}} </p>
                <p><strong>Дата получение</strong>: {{ $abonents-> pass_sana_get}} </p>
                <p><strong>Дата истичение</strong>: {{ $abonents-> pass_sana_exp}} </p>
                <p>... </p>
                <p> <strong>Status</strong>: {{ $abonents->is_active ? 'Active' : 'Closed' }}</p>
                <a href="#" class="btn btn-info">Edit</a>
            </div>
        </div>
    </div>

@endsection
