@extends('layouts.layout')


@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="card mt-5">
            <div class="card-header ">
                <h5 class="float-left">Добавить Услугу</h5>
                <div class="clearfix"></div>
            </div>
            <div class="card-body mt-2">
                <form method="post" action="/adduslugacreate">
                    @foreach ($errors->all() as $error)
                        <p class="alert alert-danger">{{ $error }}</p>
                    @endforeach
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="slug" value="{{$abonents->slug}}">
                    <input type="hidden" name="ab_id" value="{{$abonents->id}}">
                    <fieldset>

                        <div class="row">
                            <div class="col-sm">
                                <p><strong>Абонент</strong>: {{ $abonents-> pass_fio}} </p>
                            </div>
                            <div class="col-sm">
                                <p><strong>Счет абонента</strong>: {{ $abonents-> id}} </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pul_tip" class="col-lg-10 control-label">Услуга</label>
                            <div class="col-lg-auto">
                                <select class="form-control" name="item_id" id="item_id"
                                        onchange="changes({{$tip_uslugi}})">
                                    @foreach($tip_uslugi as $item)
                                        <option value="{{$item->id}}" > {{$item->service_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cena" class="col-md-12 control-label">Сумма</label>
                            <div class="col-lg-auto">
                                <input type="number" step="any" class="form-control" id="cena"
                                       placeholder="Введите сумму"
                                       name="cena">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="sana_begin" class="col-lg-10 control-label">Дата начало</label>
                            <div class="col-lg-auto">
                                <input type="date" class="form-control" id="sana_begin" placeholder="Дата документа"
                                       name="sana_begin" value="<?php echo date('Y-m-d');?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="doc_nomer" class="col-lg-10 control-label">Номер документа</label>
                            <div class="col-lg-auto">
                                <input type="text" class="form-control" id="doc_nomer" placeholder="Номер документа"
                                       name="doc_nomer">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="doc_sana" class="col-lg-10 control-label">Дата документа</label>
                            <div class="col-lg-auto">
                                <input type="date" class="form-control" id="doc_sana" placeholder="Дата документа"
                                       name="doc_sana" value="<?php echo date('Y-m-d');?>">
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

@push('customjs')
    <script type="text/javascript">
        function changes(cenaDynamicArray) {
            console.log(cenaDynamicArray[document.getElementById("item_id").value-1].cena_dinamic);
            cenaDynamic = (cenaDynamicArray[document.getElementById("item_id").value-1].cena_dinamic);
            if (cenaDynamic == 1) {
                document.getElementById("cena").value = 0;
                document.getElementById("cena").disabled = false;
            } else {
                document.getElementById("cena").value = 0;
                document.getElementById("cena").disabled = true;
            }

        }
    </script>
@endpush


