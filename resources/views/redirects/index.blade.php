@extends('layouts.app')

@section('title', 'Listagem')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-10">
            <h1>Listagem</h1>

        </div>
        <div class="col-sm-2">
            <a href="{{route('redirects-create')}}" class="btn btn-success">Novo redirecionamento</a>
        </div>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">Código</th>
                <th scope="col">Status</th>
                <th scope="col">URL de destino</th>
                <th scope="col">Último acesso</th>
                <th scope="col">Data de criação</th>
                <th scope="col">Data de atualização</th>
            </tr>
        </thead>
        <tbody>
            @foreach($redirects as $redirect)
            <tr>
                <th>{{$redirect->id}}</th>
                <th scope="row">{{$redirect->status}}</th>
                <th>{{$redirect->destination}}</th>
                <th>{{$redirect->last_access}}</th>
                <th>{{$redirect->created_at}}</th>
                <th>{{$redirect->updated_at}}</th>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection