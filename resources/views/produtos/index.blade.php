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
                    <td colspan = 3>Ações</td>
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
                            <a href="{{ route('produtos.edit', $produto->id)}}" class="btn btn-primary">Editar</a>
                        </td>

                        @if($produto->status == 1)

                            <td>
                                <a href="{{ route('pedidos.create', $produto->id)}}" class="btn btn-success">Comprar</a>
                            </td>

                        @endif

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

        </div>

        <div class="col-sm-12" style="margin-top: 40px;">
            <h1 class="display-3">Pedidos</h1>

            <table class="table table-striped">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Produto</td>
                    <td>Qtd</td>
                    <td>Valor</td>
                    <td>Status</td>
                    <td colspan = 2>Ações</td>
                </tr>
                </thead>

                <tbody>
                @foreach($pedidos as $pedido)
                    <tr>
                        <td>{{$pedido->id}}</td>

                        @foreach($produtos as $produto)
                            @if ($produto->id == $pedido->produto)

                                <td>{{$produto->nome}}</td>

                            @endif
                        @endforeach


                        <td>{{$pedido->qtd}}</td>
                        <td>R$@valor($pedido->valor/100)</td>
                        <td>{{$pedido->status}}</td>

                        <td>
                            <a href="{{ route('pedidos.edit', $pedido->id)}}" class="btn btn-primary">Editar</a>
                        </td>

                        <td>
                            <form action="{{ route('pedidos.destroy', $pedido->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Deletar</button>
                            </form>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

@endsection