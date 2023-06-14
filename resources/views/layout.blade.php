<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Triton Security</title>
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <link rel="shortcut icon" href="{{asset('logo.png')}}" type="image/x-icon">
</head>
<body>
<header>
    <img src="{{asset('logo.png')}}" alt="">
    <nav>
        <ul><li><a href="{{route('ugyfel.index')}}">Adatok</a></li>
       <li><a href="{{route('ugyfel.create')}}">Új adat</a></li>
        @if(auth()->check())
            <li>
            <form action="{{route('logout')}}" method="post">
                @csrf
                <button type="submit">Kijelentkezés {{auth()->user()->name}}</button>
            </form>
            </li>
        @endif
    </ul>
    </nav>
</header>
<main>
    @yield('content')
</main>
<footer>
    <p>© 2023 Triton Securty KFT.</p>
</footer>
</body>
</html>
