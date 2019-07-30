@extends('base')

@section('main')

    <div class="row">

        <div class="col-sm-12">

            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>

        <div>
            <a style="margin: 19px;" href="{{ route('produtos.create')}}" class="btn btn-primary">Novo produto</a>
        </div>

        <div class="col-sm-12">
            <h1 class="display-3">Produtos</h1>

            <table class="table table-striped">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Nome</td>
                    <td>Valor</td>
                    <td>Qtd</td>
                    <td>Status</td>
                    <td colspan = 2>Ações</td>
                </tr>
                </thead>

                <tbody>
                @foreach($produtos as $produto)
                    <tr>
                        <td>{{$produto->id}}</td>
                        <td>{{$produto->nome}}</td>
                        <td>R$@valor($produto->valor/100)</td>
                        <td>{{$produto->qtd}}</td>
                        <td>{{$produto->status}}</td>
                        <td>
                            <a href="{{ route('produtos.edit',$produto->id)}}" class="btn btn-primary">Editar</a>
                        </td>
                        <td>
                            <form action="{{ route('produtos.destroy', $produto->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Deletar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div>
            </div>

@endsection