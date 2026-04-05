<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>mogitate</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @if(Route::is('products.index'))
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @endif
</head>

<body>
    <header class="main-header">
        <div class="header-container">
            <span class="logo">mogitate</span>
        </div>
    </header>

    <main class="container">
        @yield('content')
    </main>

</body>

</html>