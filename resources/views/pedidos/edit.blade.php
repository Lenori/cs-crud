@extends('base')
@section('main')

    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Editar pedido</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br />
            @endif
            <form method="post" action="{{ route('pedidos.update', $pedido->id) }}">
                @method(
                'PATCH')
                @csrf

                <div class="form-group">
                    <label for="produto-nome">Produto:</label>
                    <input type="text" class="form-control" name="produto-nome" value="{{$produto->nome}}" readonly required />
                </div>

                <div class="form-group">
                    <label for="qtd">Quantidade:</label>
                    <input type="number" min="1" max="{{$pedido->qtd + $produto->qtd}}" class="form-control" name="qtd" id="qtd" value="{{$pedido->qtd}}" onChange="updateValue({{$produto->valor}})" required />
                </div>

                <div class="form-group">
                    <label for="valor">Valor (R$):</label>
                    <input type="text" id="valor" class="form-control" name="valor" value="{{$pedido->valor}}" readonly required />
                </div>

                <div class="form-group">
                    <label for="cliente">Cliente:</label>
                    <input type="text" class="form-control" name="cliente" value="{{$pedido->cliente}}" required />
                </div>

                <div class="form-group">
                    <label for="cep">CEP:</label>
                    <input type="text" id="cep" class="form-control" name="cep" value="{{$pedido->cep}}" required />
                </div>

                <div class="form-group">
                    <label for="uf">UF:</label>
                    <select name="uf" class="form-control" required>
                        <option {{$pedido->status == 'AC' ? 'selected' : ''}} value="AC">Acre</option>
                        <option {{$pedido->status == 'AL' ? 'selected' : ''}} value="AL">Alagoas</option>
                        <option {{$pedido->status == 'AP' ? 'selected' : ''}} value="AP">Amapá</option>
                        <option {{$pedido->status == 'AM' ? 'selected' : ''}} value="AM">Amazonas</option>
                        <option {{$pedido->status == 'BA' ? 'selected' : ''}} value="BA">Bahia</option>
                        <option {{$pedido->status == 'CE' ? 'selected' : ''}} value="CE">Ceará</option>
                        <option {{$pedido->status == 'DF' ? 'selected' : ''}} value="DF">Distrito Federal</option>
                        <option {{$pedido->status == 'ES' ? 'selected' : ''}} value="ES">Espírito Santo</option>
                        <option {{$pedido->status == 'GO' ? 'selected' : ''}} value="GO">Goiás</option>
                        <option {{$pedido->status == 'MA' ? 'selected' : ''}} value="MA">Maranhão</option>
                        <option {{$pedido->status == 'MT' ? 'selected' : ''}} value="MT">Mato Grosso</option>
                        <option {{$pedido->status == 'MS' ? 'selected' : ''}} value="MS">Mato Grosso do Sul</option>
                        <option {{$pedido->status == 'MG' ? 'selected' : ''}} value="MG">Minas Gerais</option>
                        <option {{$pedido->status == 'PA' ? 'selected' : ''}} value="PA">Pará</option>
                        <option {{$pedido->status == 'PB' ? 'selected' : ''}} value="PB">Paraíba</option>
                        <option {{$pedido->status == 'PR' ? 'selected' : ''}} value="PR">Paraná</option>
                        <option {{$pedido->status == 'PE' ? 'selected' : ''}} value="PE">Pernambuco</option>
                        <option {{$pedido->status == 'PI' ? 'selected' : ''}} value="PI">Piauí</option>
                        <option {{$pedido->status == 'RJ' ? 'selected' : ''}} value="RJ">Rio de Janeiro</option>
                        <option {{$pedido->status == 'RN' ? 'selected' : ''}} value="RN">Rio Grande do Norte</option>
                        <option {{$pedido->status == 'RS' ? 'selected' : ''}} value="RS">Rio Grande do Sul</option>
                        <option {{$pedido->status == 'RO' ? 'selected' : ''}} value="RO">Rondônia</option>
                        <option {{$pedido->status == 'RR' ? 'selected' : ''}} value="RR">Roraima</option>
                        <option {{$pedido->status == 'SC' ? 'selected' : ''}} value="SC">Santa Catarina</option>
                        <option {{$pedido->status == 'SP' ? 'selected' : ''}} value="SP">São Paulo</option>
                        <option {{$pedido->status == 'SE' ? 'selected' : ''}} value="SE">Sergipe</option>
                        <option {{$pedido->status == 'TO' ? 'selected' : ''}} value="TO">Tocantins</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="municipio">Municipio:</label>
                    <input type="text" class="form-control" name="municipio" value="{{$pedido->municipio}}" required />
                </div>

                <div class="form-group">
                    <label for="bairro">Bairro:</label>
                    <input type="text" class="form-control" name="bairro" value="{{$pedido->bairro}}" required />
                </div>

                <div class="form-group">
                    <label for="rua">Rua:</label>
                    <input type="text" class="form-control" name="rua" value="{{$pedido->rua}}" required />
                </div>

                <div class="form-group">
                    <label for="numero">Número:</label>
                    <input type="text" class="form-control" name="numero" value="{{$pedido->numero}}" required />
                </div>

                <div class="form-group">
                    <label for="despachante">Despachante:</label>
                    <input type="text" class="form-control" name="despachante" value="{{$pedido->despachante}}" required />
                </div>

                <div class="form-group">
                    <label for="status">Status:</label>
                    <select name="status" class="form-control" required >
                        <option {{$pedido->status == 0 ? 'selected' : ''}} value="0">Embalando</option>
                        <option {{$pedido->status == 1 ? 'selected' : ''}} value="1">Enviado</option>
                        <option {{$pedido->status == 2 ? 'selected' : ''}} value="2">Entregue</option>
                    </select>
                </div>

                <script>

                    $('#valor').mask("#.##0,00", {reverse: true, watchDataMask: true});
                    $('#cep').mask("00000-000", {reverse: true});

                    function updateValue(price) {

                        var qtd = $('#qtd').val();
                        var valor = (price * qtd);

                        $('#valor').val(valor).trigger('input');

                    }

                </script>

                <button type="submit" class="btn btn-primary">Atualizar</button>

            </form>
        </div>
    </div>

@endsection