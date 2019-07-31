<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;
use App\Produto;

use App\ProdutoUpdates;

class PedidoController extends Controller
{
    use ProdutoUpdates;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        session()->put('produto', $id);
        $produto = Produto::find($id);
        return view('pedidos.create', compact('produto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'qtd'=>'required',
            'valor'=>'required',
            'cliente'=>'required',
            'cep'=>'required',
            'uf'=>'required',
            'municipio'=>'required',
            'bairro'=>'required',
            'rua'=>'required',
            'numero'=>'required',
            'despachante'=>'required',
            'status'=>'required'
        ]);

        $pedido = new Pedido([
            'produto' => session()->pull('produto', ''),
            'qtd' => $request->get('qtd'),
            'valor' => str_replace(array('.', ','), '', $request->get('valor')),
            'cliente' => $request->get('cliente'),
            'cep' => $request->get('cep'),
            'uf' => $request->get('uf'),
            'municipio' => $request->get('municipio'),
            'bairro' => $request->get('bairro'),
            'rua' => $request->get('rua'),
            'numero' => $request->get('numero'),
            'despachante' => $request->get('despachante'),
            'status' => $request->get('status')
        ]);

        $produto = Produto::find($pedido->produto);
        $newQtd = $produto->qtd - $pedido->qtd;

        $this->updateQtd($produto->id, $newQtd);

        $pedido->save();
        return redirect('/produtos')->with('success', 'Pedido cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pedido = Pedido::find($id);
        session()->put('produto', $pedido->produto);
        $produto = Produto::find($pedido->produto);
        return view('pedidos.edit', compact('pedido', 'produto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'qtd'=>'required',
            'valor'=>'required',
            'cliente'=>'required',
            'cep'=>'required',
            'uf'=>'required',
            'municipio'=>'required',
            'bairro'=>'required',
            'rua'=>'required',
            'numero'=>'required',
            'despachante'=>'required',
            'status'=>'required'
        ]);

        $pedido = Pedido::find($id);

        $oldQtd = $pedido->qtd;

        $produto = Produto::find($pedido->produto);

        $estoque = $produto->qtd;

        $pedido->produto = session()->pull('produto', '');
        $pedido->qtd = $request->get('qtd');
        $pedido->valor = str_replace(array('.', ','), '', $request->get('valor'));
        $pedido->cliente = $request->get('cliente');
        $pedido->cep = $request->get('cep');
        $pedido->uf = $request->get('uf');
        $pedido->municipio = $request->get('municipio');
        $pedido->bairro = $request->get('bairro');
        $pedido->rua = $request->get('rua');
        $pedido->numero = $request->get('numero');
        $pedido->despachante = $request->get('despachante');
        $pedido->status = $request->get('status');

        $qtd = $oldQtd - ($pedido->qtd);
        $newEstoque = $estoque + ($qtd);

        $this->updateQtd($pedido->produto, $newEstoque);

        $pedido->save();

        return redirect('/produtos')->with('success', 'Pedido atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pedido = Pedido::find($id);
        $pedido->delete();

        return redirect('/produtos')->with('success', 'Pedido deletado com sucesso.');
    }
}
