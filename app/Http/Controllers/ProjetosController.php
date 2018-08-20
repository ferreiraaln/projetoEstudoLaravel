<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Projetos;

class ProjetosController extends Controller
{

    public function index()
    {
        $projetos = Projetos::all();
        return view('pages.projects',['todosProjetos' => $projetos]);
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $msg = 'Erro ao cadastrar Projeto';

        $this->validate($request, [
            'titulo'    =>  'required',
            'descricao' =>  'required',
            'prazo'     =>  'required',
            'inicio'    =>  'required'
        ]);

        $projetos = new Projetos;
        $projetos->titulo = $request->titulo;
        $projetos->descricao = $request->descricao;
        $projetos->data_fim = $request->prazo;
        $projetos->data_inicio = $request->inicio;

        if($projetos->save()){

            $msg = 'Projeto cadastrado com sucesso!';
        }

        return redirect('/projects')->with('message', $msg);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
