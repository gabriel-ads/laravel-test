@extends('layouts.app')

@section('title', 'Edição')

@section('content')
<div class="container mt-5">
    <h1>Edite um redirecionamento</h1>
    <hr>
    <form action="{{route('web-redirects-update', ['id'=>$redirect->id])}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <div class="form-group">
                <label for="status">Staus:</label>
                <select class="form-select" aria-label="Selecione um status" name="status">
                    <option value="0" {{ $redirect->status ? 'selected' : '' }}>Não</option>
                    <option value="1" {{ $redirect->status == 1 ? 'selected' : '' }}>Sim</option>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="destination">Url de destino:</label>
                <input type="text" class="form-control" name="destination" value="{{$redirect->destination}}" placeholder="Digite a url de destino...">
            </div>
            <br>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-success" value="Atualizar">
            </div>
        </div>
    </form>
</div>

@endsection