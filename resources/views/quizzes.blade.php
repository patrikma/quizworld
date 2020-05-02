<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Quizzes | Kvízy pro každého</title>

    <!-- CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" >
</head>
<body>
    <!-- App -->
    <div id="quizzes">
        <App></App>
    </div>

    <!-- JS -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
