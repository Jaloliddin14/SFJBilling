@extends('layouts.layout')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="card mt-5">
            <div class="card-header ">
                <h5 class="float-left">Изменить тип Оплаты</h5>
                <div class="clearfix"></div>
            </div>
            <div class="card-body mt-2">
                <form method="post" action="/updateservice">
                    @foreach ($errors->all() as $error)
                        <p class="alert alert-danger">{{ $error }}</p>
                    @endforeach
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{$services->id }}">

                    <fieldset>

                        <div class="form-group">
                            <label for="service_name" class="col-lg-10 control-label">Наименование услуги</label>
                            <div class="col-lg-auto">
                                <input type="text" class="form-control" id="service_name"
                                       value="{{$services->service_name}}" name="service_name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="isactive" class="col-lg-10 control-label">Активный</label>
                            <div class="col-lg-auto">
                                <input type="checkbox" class="form-control" id="isactive"
                                       value="{{$services->is_active}}" name="isactive"
                                       @if ($services->is_active) checked @endif >
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
