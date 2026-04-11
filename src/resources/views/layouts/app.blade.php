<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>mogitate</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    @if(Route::is('products.index'))
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @endif
    @if(Route::is('product.register'))
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    @endif
    @if(Route::is('products.show'))
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
    @endif
    @yield('css')
</head>

<body>
    <header class="main-header">
        <div class="header-container">
            <a class="logo" href="/products">mogitate</a>
            <nav>
                <ul class="header-nav">
                    @if (Auth::check())
                    <li class="header-nav__item">
                        <form class="form" action="/logout" method="post">
                            @csrf
                            <button class="header-nav__button" type="submit">ログアウト</button>
                        </form>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        @yield('content')
    </main>

</body>

</html>