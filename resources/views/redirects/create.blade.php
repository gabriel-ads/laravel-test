@extends('layouts.app')

@section('title', 'Criação')

@section('content')
<div class="container mt-5">
    <h1>Crie um redirecionamento</h1>
    <hr>
    <form action="{{route('web-redirects-store')}}" method="POST">
        @csrf
        <div class="form-group">
            <div class="form-group">
                <label for="status">Staus:</label>
                <select class="form-select" aria-label="Selecione um status" name="status">
                    <option selected>Defina o status</option>
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="destination">Url de destino:</label>
                <input type="text" class="form-control" name="destination" placeholder="Digite a url de destino...">
            </div>
            <br>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary">
            </div>
        </div>
    </form>
</div>

@endsection