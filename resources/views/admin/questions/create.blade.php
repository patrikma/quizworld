@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <h1>Přidat novou otázku a odpověď/odpovědi</h1>
            </div>
        </div>
        <form action="/store-new-question" method="POST">
            @csrf
            <h2>Otázka</h2>
            <div class="form-group">
                <label for="">Kvíz</label>
                <select name="quiz_id" id="quiz_id" class="form-control">
                    @foreach($quizes as $quiz)
                        <option value="{{$quiz->id}}">{{$quiz->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Typ otázky</label>
                <select name="question_type" id="question_type" class="form-control">
                    <option value="0">Výběr z možností</option>
                    <option value="1">Napsání odpovědi</option>
                </select>
            </div>
            <div class="form-group">
                <label for="text">Text</label>
                <input class="form-control" id="text" type="text" name="text" required>
            </div>
            <h2>Odpověď</h2>
            <div class="form-group">
                <label for="answer">Textová odpověď</label>
                <input class="form-control" type="text" id="answer" name="answer">
            </div>
            <h2>Možnosti</h2>
            <div class="form-group">
                <input class="form-control mb-2" type="text" name="option[0]" placeholder="Možnost 1">
                <input class="form-control mb-2" type="text" name="option[1]" placeholder="Možnost 2">
                <input class="form-control mb-2" type="text" name="option[2]" placeholder="Možnost 3">
                <input class="form-control mb-2" type="text" name="option[3]" placeholder="Možnost 4">
            </div>
            <div class="form-group">
                <label for="">Správná možnost</label>
                <select name="correct_option" id="question_type" class="form-control">
                    <option value="0">Možnost 1</option>
                    <option value="1">Možnost 2</option>
                    <option value="2">Možnost 3</option>
                    <option value="3">Možnost 4</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Vytvořit</button>
        </form>
    </div>
@endsection
