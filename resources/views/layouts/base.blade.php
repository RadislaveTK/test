<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <header class="d-flex justify-content-center py-3">
            <ul class="nav nav-pills">
                @auth
                <li class="nav-item ms-3"><a href="{{ route('workspace') }}" class="btn btn-primary" aria-current="page">Пространства</a></li>
                <li class="nav-item ms-3"><a href="{{ route('bills') }}" class="btn btn-primary" aria-current="page">Счета</a></li>
                @if (Auth::user()->role == 'admin')
                <li class="nav-item ms-3"><a href="{{ route('admin.panel') }}" class="btn btn-primary" aria-current="page">Админ Панель</a></li>
                @endif
                <form action="{{ route('logout') }}" class="form form-inline ms-3" method="post">
                    @csrf
                    <input type="submit" value="Выйти" class="btn btn-danger">
                </form>
                @endauth
                @guest
                <li class="nav-item ms-3"><a href="{{ route('login') }}" class="btn btn-success" aria-current="page">Войти</a></li>
                <li class="nav-item ms-3"><a href="{{ route('register') }}" class="btn btn-primary" aria-current="page">Зарегестрироваться</a></li>
                @endguest
            </ul>
        </header>
    </div>

    <div class="container">
        @yield('content')
    </div>

</body>

</html>