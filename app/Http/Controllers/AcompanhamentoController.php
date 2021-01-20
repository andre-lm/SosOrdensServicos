<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Acompanhamento;
use App\Os;

class AcompanhamentoController extends Controller
{
    public function index()
    {
        $os = Os::all();

        return view('os.index', compact('os'));
    }

    public function create()
    {
        return view('os.create');
    }

    public function show($id)
    {

    }

    public function store(Request $request)
    {
        $acompanhamento = new Acompanhamento;
        
        $acompanhamento->descricao = $request->descricao;
        $acompanhamento->solucao = $request->solucao;
        $acompanhamento->ordem_servico_id = $request->ordem_servico_id;

        $acompanhamento->save();

        $os = Os::find($request->ordem_servico_id);

        $os->status_id = 3; 

        $os->save();

        return redirect()->route('os.index')->with('msg_succes', 'Os n. criada' );
    }

    public function edit($id)
    {
        $os = Os::findOrFail($id);

        return view('os.edit', compact('os'));
    }

    public function update(Request $request, $id)
    {
        $os = Os::find($id);

        $os->nome = $request->nome;
        $os->nome_autor = $request->nome_autor;
        $os->Requerente = $request->Requerente;
        $os->atribuido_tecnico = $request->atribuido_tecnico;
        $os->Equipamento = $request->Equipamento;
        $os->descrição = $request->descrição;

        $os->save();

        //Metodo alternativo, atualização em massa
        //Os::create($request->all());

        return redirect()->route('os.index');
    }

    public function destroy($id)
    {
        $os = Os::find($id);
        $os->delete();

        return redirect()->route('os.index');

    }    
}
