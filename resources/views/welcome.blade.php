<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Quizzes | Kvízy pro každého</title>

        <!-- CSS -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" >
    </head>
    <body>
        <div id="particles-background"></div>
        <div class="welcome">
            <div class="info-box">
                <h1>Kvízy a testy pro každého!</h1>
                <p>Otestujte si svoje znalosti na některých z našich kvízů. Ihned a bez registrace.</p>
                <a href="{{url('/play')}}">
                    <button class="call-to-action">Zobrazit nabídku kvízů</button>
                </a>
            </div>
        </div>
        <!-- JS -->
        <script src="{{ asset('js/particles.js') }}"></script>
        <script>
            particlesJS.load('particles-background', './js/particles.json', function() {});
        </script>
    </body>
</html>
