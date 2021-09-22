<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Especialidade;

class EspecialidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // obtendo os dados de todos os especialidades
        $especialidades = Especialidade::all();
        // chamando a tela e enviando o objeto $especialidades
        // como parâmetro
        return view('especialidades.index', compact('especialidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('especialidades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
             // criando regras para validação
             $validateData = $request->validate([
                'nome_esp'      =>      'required|max:35',
                'sigla_esp'    =>      'required|max:35',
                'obs_esp'    =>      'required|max:35'
            ]);
            // executando o método para a gravação do registro
            $especialidade = Especialidade::create($validateData);
            // redirecionando para a tela principal do módulo
            // de especialidades
            return redirect('/especialidades')->with('success','Dados adicionados com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $especialidade = Especialidade::findOrFail($id);
        // retornando a tela de visualização com o
        // objeto recuperado
        return view('especialidades.show',compact('especialidade'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $especialidade = Especialidade::findOrFail($id);
        // retornando a tela de edição com o
        // objeto recuperado
        return view('especialidades.edit', compact('especialidade'));
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
            'nome_esp'      =>      'required|max:35',
            'sigla_esp'    =>      'required|max:35',
            'obs_esp'    =>      'required|max:35'
        ]);
        // criando um objeto para receber o resultado
        // da persistência (atualização) dos dados validados 
        Especialidade::whereId($id)->update($validateData);
        // redirecionando para o diretório raiz (index)
        return redirect('/especialidades')->with('success', 
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
        $especialidade = Especialidade::findOrFail($id);
        // realizando a exclusão
        $especialidade->delete();
        // redirecionando para o diretório raiz (index)
        return redirect('/especialidades')->with('success', 
        'Dados removidos com sucesso!');
    }
}
