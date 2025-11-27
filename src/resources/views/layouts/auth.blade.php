<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    {{-- 認証画面専用 CSS --}}
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>
    <main>
        @yield('content')
    </main>
</body>

</html>