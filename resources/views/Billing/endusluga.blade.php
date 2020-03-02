@extends('layouts.layout')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="card mt-5">
            <div class="card-header ">
                <h5 class="float-left">Закрытие услуги</h5>
                <div class="clearfix"></div>
            </div>
            <div class="card-body mt-2">
                <form method="post" action="/docloseusluga">
                    @foreach ($errors->all() as $error)
                        <p class="alert alert-danger">{{ $error }}</p>
                    @endforeach
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="sid" value="{{ $usl-> service_id}}">
                    <input type="hidden" name="id" value="{{ $usl-> id}}">
                    <input type="hidden" name="ab_id" value="{{ $usl-> abonent_id}}">
                    <fieldset>
                        <div class="row">
                            <div class="col-sm">
                                <p><strong>Абонент</strong>: {{ $usl-> pass_fio}} </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm">
                                <p><strong>Услуга</strong>: {{ $usl-> service_name}} </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm">
                                <p><strong>Дата начало</strong>: {{ $usl-> sana_begin}} </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sana_end" class="col-lg-10 control-label">Дата Окончание услуги</label>
                            <div class="col-lg-auto">
                                <input type="date" class="form-control" id="sana_end"
                                       name="sana_end" value="<?php echo date('Y-m-d');?>">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">

                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

@endsection
