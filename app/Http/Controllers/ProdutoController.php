<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Pedido;

use App\ProdutoUpdates;

class ProdutoController extends Controller
{

    use ProdutoUpdates;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::all();
        $pedidos = Pedido::all();

        return view('produtos.index', compact('produtos', 'pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produtos.create');
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
            'nome'=>'required',
            'valor'=>'required',
            'qtd'=>'required'
        ]);

        $produto = new Produto([
            'nome' => $request->get('nome'),
            'valor' => str_replace(array('.', ','), '', $request->get('valor')),
            'qtd' => $request->get('qtd'),
            'status' => $request->get('qtd') > 0 ? 1 : 0
        ]);

        $produto->save();
        return redirect('/produtos')->with('success', 'Produto cadastrado com sucesso.');
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
        $produto = Produto::find($id);
        return view('produtos.edit', compact('produto'));
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
            'nome'=>'required',
            'valor'=>'required',
            'qtd'=>'required'
        ]);

        $produto = Produto::find($id);

        $produto->nome =  $request->get('nome');
        $produto->valor = str_replace(array('.', ','), '', $request->get('valor'));
        $produto->qtd = $request->get('qtd');
        $produto->status = $request->get('qtd') > 0 ? 1 : 0;

        $produto->save();

        return redirect('/produtos')->with('success', 'Produto atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = Produto::find($id);
        $produto->delete();

        return redirect('/produtos')->with('success', 'Produto deletado com sucesso.');
    }

}
