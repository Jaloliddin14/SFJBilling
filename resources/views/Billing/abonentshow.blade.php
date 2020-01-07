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
                        <p><strong>Адрес</strong>: ул. {{ $abonents-> add_street_id }} Дом {{ $abonents-> add_dom }}
                            Корпус {{ $abonents-> add_korpus }} Подъезд {{ $abonents-> add_podyezd }}
                            Квартира {{ $abonents-> add_kvartira }}</p>
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
                        <p><strong>Дата договора</strong>: {{ $abonents-> dogovor_sana}} </p>
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
                        <p><strong>Дата рождение</strong>: {{ $abonents-> pass_sana_birth}} </p>
                    </div>
                    <div class="col-sm">
                        <p><strong>Дата получение</strong>: {{ $abonents-> pass_sana_get}} </p>
                    </div>
                    <div class="col-sm">
                        <p><strong>Дата истичение</strong>: {{ $abonents-> pass_sana_exp}} </p>
                    </div>
                    <div class="col-sm">
                        <p><strong>Status</strong>: {{ $abonents->is_active ? 'Active' : 'Closed' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm">
                        <p><strong>Баланс</strong>: {{ $abonents-> pass_sana_birth}} </p>
                    </div>
                    <div class="col-sm">
                        <p><strong>Последняя оплата</strong>: {{ $abonents-> pass_sana_get}} </p>
                    </div>
                </div>
                <div class="row">

                    <div class="col-sm-2">
                        <form method="post" action="/addoplata">
                            <input type="hidden" name="ab_id" value="{{$abonents->id}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-primary" value="Установка услуги">
                        </form>
                    </div>
                    <div class="col-sm-2">
                        <form method="post" action="/addoplata">
                            <input type="hidden" name="ab_id" value="{{$abonents->id}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-primary" value="Прием оплаты">
                        </form>
                    </div>
                    <div class="col-sm-2">
                        <form method="post" action="/addoplata">
                            <input type="hidden" name="ab_id" value="{{$abonents->id}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-primary" value="Изменить">
                        </form>
                    </div>
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
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                        squid.
                        3
                        wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                        laborum
                        eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                        nulla
                        assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                        nesciunt
                        sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                        farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them
                        accusamus
                        labore sustainable VHS.
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
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                        squid.
                        3
                        wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                        laborum
                        eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                        nulla
                        assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                        nesciunt
                        sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                        farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them
                        accusamus
                        labore sustainable VHS.
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
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                        squid.
                        3
                        wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                        laborum
                        eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                        nulla
                        assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                        nesciunt
                        sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                        farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them
                        accusamus
                        labore sustainable VHS.
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
