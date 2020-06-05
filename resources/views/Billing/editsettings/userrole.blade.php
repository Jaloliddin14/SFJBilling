@extends('layouts.layout')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="card mt-5">
            <div class="card-header ">
                <h5 class="float-left">Изменить Роли</h5>
                <div class="clearfix"></div>
            </div>
            <div class="card-body mt-2">
                <form method="post" action="/updateusersrole">
                    @foreach ($errors->all() as $error)
                        <p class="alert alert-danger">{{ $error }}</p>
                    @endforeach
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{$usrs->id }}">
                    <fieldset>

                        <div class="form-group row">
                            <div class="col-md-4 col-form-label text-md-right">
                                Фамилия Имя Отчество
                            </div>
                            <div class="col-md-6 col-form-label">
                                {{$usrs->name}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 col-form-label text-md-right">
                                Электронная почта
                            </div>
                            <div class="col-md-6 col-form-label">
                                {{$usrs->email}}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="admin" class="col-md-4 col-form-label text-md-right">Администратор</label>

                            <input type="checkbox" class="col-md-6 col-form-label col-lg-1" id="admin"
                                   value="Admin" name="admin"
                                   @if ($roles->contains('Admin')) checked @endif >
                        </div>

                        <div class="form-group">
                            <label for="manager" class="col-md-4 col-form-label text-md-right">Менеджер</label>
                            <input type="checkbox" class="col-md-6 col-form-label col-lg-1" id="manager"
                                   value="Manager" name="manager"
                                   @if ($roles->contains('Manager')) checked @endif >
                        </div>

                        <div class="form-group">
                            <label for="cashier" class="col-md-4 col-form-label text-md-right">Кассир</label>
                            <input type="checkbox" class="col-md-6 col-form-label col-lg-1" id="cashier"
                                   value="Cashier" name="cashier"
                                   @if ($roles->contains('Cashier')) checked @endif >
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="javascript:history.back()" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-success">
                                    Submit
                                </button>
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>

@endsection
