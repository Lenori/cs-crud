@extends('base')

@section('main')

    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Adicionar produto</h1>
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

                <form method="post" action="{{ route('produtos.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control" name="nome"/>
                    </div>

                    <div class="form-group">
                        <label for="qtd">Quantidade:</label>
                        <input type="number" min="0" class="form-control" name="qtd"/>
                    </div>

                    <div class="form-group">
                        <label for="valor">Valor (R$):</label>
                        <input type="text" id="valor" class="form-control" name="valor"/>
                    </div>

                    <button type="submit" class="btn btn-primary-outline">Adicionar</button>
                </form>

                <script>

                    $('#valor').mask("#.##0,00", {reverse: true});

                </script>

            </div>
        </div>
    </div>

@endsection