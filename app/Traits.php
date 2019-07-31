<?php

namespace App;

trait ProdutoUpdates
{

    public function updateQtd($id, $qtd)
    {
        if ($qtd > 0)
            Produto::find($id)->update(['qtd' => $qtd, 'status' => '1']);

        elseif ($qtd == 0)
            Produto::find($id)->update(['qtd' => $qtd, 'status' => '0']);

    }

}