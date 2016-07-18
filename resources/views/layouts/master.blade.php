<!doctype html>
<html>
    <head>
        <title>Laradex - @yield('title')</title>

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

        <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/pokemons.css') }}" />

    </head>
    <body>

        @yield('content')

        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('scripts')

    </body>
</html>
