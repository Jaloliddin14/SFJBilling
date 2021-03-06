<?php

use App\Http\Controllers\ConfController;

$tekoy = ConfController::getekoy();
?>
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            SFJBilling
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        Абоненты
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="/">Поиск абонента</a>
                        @can('new-abonent')
                            <a class="dropdown-item" href="/createabonent">Новый абонент</a>
                        @endcan
                    </div>
                </li>

                @can('nastroyki')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            Настройки
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/createstreettip">Тип адреса</a>
                            <a class="dropdown-item" href="/createstreet">Улицы</a>
                            <a class="dropdown-item" href="/createoplatatip">Тип оплаты</a>
                        </div>
                    </li>
                @endcan

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        Отчеты
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        @can('otcheti')
                            <a class="dropdown-item" href="/saldooborot">Сальдо оборот</a>
                        @endcan
                        <a class="dropdown-item" href="/reestroplat">Реестр оплат</a>
                        @can('otcheti')
                            <a class="dropdown-item" href="/reestrnach">Реестр начислений</a>
                            <a class="dropdown-item" href="/postupleniye">Поступления</a>
                            <a class="dropdown-item" href="/nachisleniye">Начисленпия</a>
                        @endcan
                    </div>
                </li>

                @role('Admin')

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        Администратор
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        @can('nastroyki-uslugi')
                            <a class="dropdown-item" href="/createservice">Услуги</a>
                        @endcan
                        @can('nastroyki-cena_uslugi')
                            <a class="dropdown-item" href="/createservicecena">Цена услуги</a>
                        @endcan
                        @can('nastroyki-users')
                            <a class="dropdown-item" href="/createusers">Пользователи</a>
                        @endcan
                        @can('nastroyki-close_month')
                            <a class="dropdown-item" href="/closemonthpage">Закрытие месяца</a>
                        @endcan
                    </div>
                </li>
                @else

                @endrole


            </ul>
            <ul class="navbar-nav mr-sm-auto">
                <li class="nav-item">
                    Текущий отчетный месяц : <strong style="color: red">
                        {{date_format( new DateTime($tekoy), 'F - Y' )}}
                    </strong>
                </li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                    <!--                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> -->
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                        <!--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a> -->
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
