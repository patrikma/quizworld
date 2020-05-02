@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Vytvořit nový kvíz</h1>
            </div>
        </div>
        <form action="/store-new-quiz" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Jméno</label>
                <input class="form-control" id="name" type="text" name="name">
            </div>
            <button type="submit" class="btn btn-primary">Vytvořit</button>
        </form>
    </div>
@endsection