@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('title')
    зарегистрироваться
@endsection
@section('content')


<div class="login-container">
        <form action="{{route('register-form')}}" method="post">
            @csrf
            <div class="form-container">
                <h2>Регистрация</h2>
                @if($errors->any())
                    <div class="allert">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <label for="name">Введите имя</label>
                <input type="text" name="name" id="name" placeholder="введите имя">
                <label for="surname">Введите фамилию</label>
                <input type="text" name="surname" id="surname" placeholder="введите фамилию">
                <label for="e-mail">Введите адрес электронной почты</label>
                <input type="text" name="e-mail" id="e-mail" placeholder="e-mail">
                <label for="phone">Введите номер телефона</label>
                <input type="tel" name="phone" id="phone" placeholder="+7-777-777-77-77">
                <label for="password">Введите пароль</label>
                <input type="password" name="password" id="password" placeholder="пароль">
                <input type="hidden" value="пользователь" name="role" id="role">
                <button type="submit" name="reg">Зарегистрироваться</button>
            </div>
        </form>
    </div>


@endsection