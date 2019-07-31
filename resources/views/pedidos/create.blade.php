@extends('base')
@section('main')

    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Adicionar pedido</h1>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif

                <form method="post" action="{{ route('pedidos.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="produto-nome">Produto:</label>
                        <input type="text" class="form-control" name="produto-nome" value="{{$produto->nome}}" readonly required />
                    </div>

                    <div class="form-group">
                        <label for="qtd">Quantidade:</label>
                        <input type="number" min="1" max="{{$produto->qtd}}" class="form-control" name="qtd" id="qtd" value="1" onChange="updateValue({{$produto->valor}})" required />
                    </div>

                    <div class="form-group">
                        <label for="valor">Valor (R$):</label>
                        <input type="text" id="valor" class="form-control" name="valor" value="{{$produto->valor}}" readonly required />
                    </div>

                    <div class="form-group">
                        <label for="cliente">Cliente:</label>
                        <input type="text" class="form-control" name="cliente" required />
                    </div>

                    <div class="form-group">
                        <label for="cep">CEP:</label>
                        <input type="text" id="cep" class="form-control" name="cep" required />
                    </div>

                    <div class="form-group">
                        <label for="uf">UF:</label>
                        <select name="uf" class="form-control" required>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="municipio">Municipio:</label>
                        <input type="text" class="form-control" name="municipio" required />
                    </div>

                    <div class="form-group">
                        <label for="bairro">Bairro:</label>
                        <input type="text" class="form-control" name="bairro" required />
                    </div>

                    <div class="form-group">
                        <label for="rua">Rua:</label>
                        <input type="text" class="form-control" name="rua" required />
                    </div>

                    <div class="form-group">
                        <label for="numero">Número:</label>
                        <input type="text" class="form-control" name="numero" required />
                    </div>

                    <div class="form-group">
                        <label for="despachante">Despachante:</label>
                        <input type="text" class="form-control" name="despachante" required />
                    </div>

                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select name="status" class="form-control" readonly required >
                            <option selected value="0">Embalando</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary-outline">Adicionar</button>

                </form>

                <script>

                    $('#valor').mask("#.##0,00", {reverse: true, watchDataMask: true});
                    $('#cep').mask("00000-000", {reverse: true});

                    function updateValue(price) {

                        var qtd = $('#qtd').val();
                        var valor = (price * qtd);

                        $('#valor').val(valor).trigger('input');

                    }

                </script>

            </div>
        </div>
    </div>

@endsection