<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('style')
    <title>@yield('title')</title>
</head>
<body>
    <header>
        <nav>
            <ul class="menu">
                <li><a href="{{route('main')}}">ФИЛЬМЫ</a></li>
                <li><a href="{{route('sales')}}">АКЦИИ</a></li>
                <li><a href="{{route('about')}}">О НАС</a></li>
                <li><a href="{{route('contacts')}}">КОНТАКТЫ</a></li>
                <li><a href="{{route('login')}}">ВХОД</a></li>
            </ul>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <footer id="bottom">
        <h1>foot</h1>
    </footer>
</body>
</html>