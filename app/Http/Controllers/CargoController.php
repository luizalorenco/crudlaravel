<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cargo;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargos = Cargo::all();
        // chamando a tela e enviando o objeto $cargos
        // como parâmetro
        return view('cargos.index', compact('cargos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('cargos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nome_cargo'      =>      'required|max:35',
            'desc_cargo'    =>      'required|max:35'
        ]);
        // executando o método para a gravação do registro
        $cargo = Cargo::create($validateData);
        // redirecionando para a tela principal do módulo
        // de cargos
        return redirect('/cargos')->with('success','Dados adicionados com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cargo = Cargo::findOrFail($id);
        // retornando a tela de visualização com o
        // objeto recuperado
        return view('cargos.show',compact('cargo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cargo = Cargo::findOrFail($id);
        // retornando a tela de edição com o
        // objeto recuperado
        return view('cargos.edit', compact('cargo'));
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
        $validateData = $request->validate([
            'nome_cargo'      =>      'required|max:35',
            'desc_cargo'    =>      'required|max:35'
        ]);
        // criando um objeto para receber o resultado
        // da persistência (atualização) dos dados validados 
        Cargo::whereId($id)->update($validateData);
        // redirecionando para o diretório raiz (index)
        return redirect('/cargos')->with('success', 
        'Dados atualizados com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cargo = Cargo::findOrFail($id);
        // realizando a exclusão
        $cargo->delete();
        // redirecionando para o diretório raiz (index)
        return redirect('/cargos')->with('success', 
        'Dados removidos com sucesso!');
    }
}
