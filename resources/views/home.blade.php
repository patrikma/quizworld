@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Vítejte!
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center my-2">
        <div class="col-md-8">
            <a href="/create-new-quiz"><button type="button" class="btn btn-secondary btn-lg btn-block my-2">Vytvořit nový kvíz</button></a>
            <a href="/create-new-question"><button type="button" class="btn btn-secondary btn-lg btn-block">Vytvořit novou otázku</button></a>
        </div>
    </div>
</div>
@endsection
