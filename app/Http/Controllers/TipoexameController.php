<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipoexame;

class TipoexameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoexames = Tipoexame::all();
        // chamando a tela e enviando o objeto $tipoexames
        // como parâmetro
        return view('tipoexames.index', compact('tipoexames'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('tipoexames.create');
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
            'nome_tpex'      =>      'required|max:35',
            'sigla_tpex'    =>      'required|max:35',
            'desc_tpex'    =>      'required|max:35'
        ]);
        // executando o método para a gravação do registro
        $tipoexame = Tipoexame::create($validateData);
        // redirecionando para a tela principal do módulo
        // de tipoexames
        return redirect('/tipoexames')->with('success','Dados adicionados com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoexame = Tipoexame::findOrFail($id);
        // retornando a tela de visualização com o
        // objeto recuperado
        return view('tipoexames.show',compact('tipoexame'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoexame = Tipoexame::findOrFail($id);
        // retornando a tela de edição com o
        // objeto recuperado
        return view('tipoexames.edit', compact('tipoexame'));
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
            'nome_tpex'      =>      'required|max:35',
            'sigla_tpex'    =>      'required|max:35',
            'desc_tpex'    =>      'required|max:35'
        ]);
        // criando um objeto para receber o resultado
        // da persistência (atualização) dos dados validados 
        Tipoexame::whereId($id)->update($validateData);
        // redirecionando para o diretório raiz (index)
        return redirect('/tipoexames')->with('success', 
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
        $tipoexame = Tipoexame::findOrFail($id);
        // realizando a exclusão
        $tipoexame->delete();
        // redirecionando para o diretório raiz (index)
        return redirect('/tipoexames')->with('success', 
        'Dados removidos com sucesso!');
    }
}
