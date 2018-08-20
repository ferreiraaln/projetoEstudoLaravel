
@extends('templates.default')
@section('content')

<button class="btn btn-pri" id="btn-mensagem">Novo Projeto</button>

<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Cod.</th>
            <th>Título</th>
            <th>Descricão</th>
            <th>Data Início</th>
            <th>Entrega</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($todosProjetos as $project)
        <tr>
            <td>{{  $project->id }}</td>
            <td>{{  $project->titulo }}</td>
            <td>{{  $project->descricao }}</td>
            <td>{{  ajustaData( $project->data_entrada) }}</td>
            <td>{{  ajustaData( $project->data_fim) }}</td>
            <td>
                <a href="#" id=""><span class="glyphicon glyphicon-edit"></span></a>
                <a href="#"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@if(Session::get('message'))

    @include('includes.alertCadProj')

@endif

@stop




