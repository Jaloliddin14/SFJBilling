@extends('layouts.layout')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="card mt-5">
            <div class="card-header ">
                <h5 class="float-left">Добавить нового абонента</h5>
                <div class="clearfix"></div>
            </div>
            <div class="card-body mt-2">
                <form method="post">
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
                            <label for="pass_fio" class="col-md-12 control-label">Фамилия Имя Отчество</label>
                            <div class="col-lg-auto">
                                <input type="text" class="form-control" id="pass_fio" placeholder="Фамилия Имя Отчество"
                                       name="pass_fio">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="dogovor_nomer" class="col-lg-10 control-label">Номер договора</label>
                                <div class="col-lg-auto">
                                    <input type="text" class="form-control" id="dogovor_nomer"
                                           placeholder="Номер договора"
                                           name="dogovor_nomer">
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="dogovor_sana" class="col-lg-10 control-label">Дата договора</label>
                                <div class="col-lg-auto">
                                    <input type="date" class="form-control" id="dogovor_sana"
                                           placeholder="Дата договора"
                                           name="dogovor_sana">
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="phone" class="col-lg-10 control-label">Телефон</label>
                                <div class="col-lg-auto">
                                    <input type="text" class="form-control" id="phone" placeholder="Телефон"
                                           name="phone">
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="email" class="col-lg-12 control-label">Электронная почта</label>
                                <div class="col-lg-auto">
                                    <input type="text" class="form-control" id="email" placeholder="E-mail"
                                           name="email">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="add_street_id" class="col-lg-10 control-label">Улица</label>
                            <div class="col-lg-auto">

                                <select class="form-control" name="add_street_id" id="add_street_id">
                                    @foreach($streetid as $item)
                                        <option value="{{$item->id}}">{{$item->street_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="add_dom" class="col-lg-10 control-label">Дом</label>
                                <div class="col-lg-auto">
                                    <input type="text" class="form-control" id="add_dom" placeholder="Номер дома"
                                           name="add_dom">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="add_korpus" class="col-lg-10 control-label">Корпус</label>
                                <div class="col-lg-auto">
                                    <input type="text" class="form-control" id="add_korpus" placeholder="Корпус"
                                           name="add_korpus">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="add_podyezd" class="col-lg-10 control-label">Подъезд</label>
                                <div class="col-lg-auto">
                                    <input type="text" class="form-control" id="add_podyezd"
                                           placeholder="Номер подъезда"
                                           name="add_podyezd">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="add_kvartira" class="col-lg-10 control-label">Квартира</label>
                                <div class="col-lg-auto">
                                    <input type="text" class="form-control" id="add_kvartira"
                                           placeholder="Номер квартиры"
                                           name="add_kvartira">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="pass_seriya" class="col-lg-10 control-label">Паспорт серия</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="pass_seriya" placeholder="АА"
                                           name="pass_seriya">
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="pass_nomer" class="col-lg-10 control-label">Паспорт номер</label>
                                <div class="col-lg-auto">
                                    <input type="text" class="form-control" id="pass_nomer" placeholder="1234567"
                                           name="pass_nomer">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="pass_sana_birth" class="col-lg-10 control-label">Дата рождения</label>
                                <div class="col-lg-auto">
                                    <input type="date" class="form-control" id="pass_sana_birth" name="pass_sana_birth">
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="pass_sana_get" class="col-lg-10 control-label">Дата выдачи паспорта
                                </label>
                                <div class="col-lg-auto">
                                    <input type="date" class="form-control" id="pass_sana_get" name="pass_sana_get">
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="pass_sana_exp" class="col-lg-10 control-label">Срок истечение</label>
                                <div class="col-lg-auto">
                                    <input type="date" class="form-control" id="pass_sana_exp" name="pass_sana_exp">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pass_iib" class="col-lg-10 control-label">Кем выдан</label>
                            <div class="col-lg-auto">
                                <input type="text" class="form-control" id="pass_iib" placeholder="Кем выдан паспорт"
                                       name="pass_iib">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="notes" class="col-lg-10 control-label">Примечание</label>
                            <div class="col-lg-auto">
                                <input type="text" class="form-control" id="notes" placeholder="Примечание"
                                       name="notes">
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
        </div>
    </div>
@endsection
