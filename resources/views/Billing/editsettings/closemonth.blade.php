@extends('layouts.layout')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="card mt-5">
            <div class="card-header ">
                <h5 class="float-left">Изменить тип Оплаты</h5>
                <div class="clearfix"></div>
            </div>
            <div class="card-body mt-2">
                <form method="post" action="/closemonthfunc">
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
                        <div class="row">
                            <div class="col-sm">
                                <p><strong>Текущий месяц</strong>: {{ $close-> tekoy}} </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm">
                                <p><strong>Новый месяц</strong>: {{ $close-> tekoy}} </p>
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
