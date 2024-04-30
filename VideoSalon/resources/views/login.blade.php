@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('title')
    Войти
@endsection


@section('content')
    @include('inc.massages')
    <div class="login-container">
        <form action="{{route('login-form')}}" method="post">
            @csrf
            <div class="form-container">
                <h2>Добро пожаловать</h2>
                <label for="e-mail">e-mail</label>
                <input type="text" name="e-mail" placeholder="e-mail" id="e-mail">
                <label for="password">пароль</label>
                <input type="password" name="password" placeholder="пароль" id="password">
                <button type="submit" name="auth">Войти</button>
                <div class="reg-link">
                    Нет аккаунта? <a href="{{route('register')}}">зарегистрироваться сейчас</a>
                </div>
            </div>
        </form>
    </div>


@endsection