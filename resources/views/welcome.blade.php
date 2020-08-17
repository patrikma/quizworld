<!DOCTYPE html>
<html lang="cs">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Quizzes | Kvízy pro každého</title>

        <!-- CSS -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" >
    </head>
    <body>
        <main class="welcome">
            <article class="info-box">
                <h1>Quiz World</h1>
                <p>Otestujte si svoje znalosti na některých z našich kvízů. Ihned a bez registrace.</p>
                <img src="{{url('/img/quiz-board.svg')}}" alt="">
                <a href="{{url('/play')}}">
                    <button class="call-to-action">Zobrazit kvízy</button>
                </a>
            </article>
        </main>
    </body>
</html>
