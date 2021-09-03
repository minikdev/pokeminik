<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pokeminik</title>

        <!-- Fonts -->

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- <link rel="icon" type="image/png" sizes="32x32" href="../../public/favicon-32x32.png"> -->
        <!-- <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon"/> -->
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
        <!-- <link rel="icon" type="image/png" sizes="16x16" href="../../public/favicon-16x16.png"> -->
        <!-- <link rel="apple-touch-icon" sizes="180x180" href="../../public/apple-touch-icon.png"> -->
    </head>
    <body class="antialiased">

        <div id="app"></div>
        <script src="{{mix('js/app.js')}}"></script>
    </body>
</html>
