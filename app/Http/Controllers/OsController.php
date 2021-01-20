<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OsRequest;
use App\Http\Requests\AcompanhamentoRequest;
use Illuminate\Support\Facades\DB;
use App\Os;
use App\Acompanhamento;
use App\Solucao;

class OsController extends Controller
{
    private $os;

    public function __construct()
    {
        $this->os = new Os();
    }

    public function index()
    {
        $ordemservico = $this->os->paginate(5);
        $count = $this->os->all()->count();

        return view('os.index', compact('ordemservico','count'));
    }

    public function create()
    {
        return view('os.create');
    }

    public function store(OsRequest $request)
    {
        $os = new Os;
        DB::beginTransaction();
        try {
           
            $os->nome_autor = $request->nome_autor;
            $os->titulo = $request->titulo;
            $os->atribuido_tecnico = $request->atribuido_tecnico;
            $os->equipamento = $request->equipamento;
            $os->descrição = $request->descrição;
            $os->status_id = 1;
            $os->save();

            DB::commit();
            return redirect()->route('os.index')->with('status', "Chamado ID $os->id cadastrado com sucesso" );
        } catch (Exception $e) {
            MainHelper::printLog($e);
            DB::rollback();
            echo $e;
            exit();
        }
    }

    public function edit($id)
    {
        $os = Os::findOrFail($id);

        return view('os.edit', compact('os'));
    }

    public function show($id)
    {
        $os = Os::find($id);
        return view('os.show', compact('os'));
    }

    public function update(OsRequest $request, $id)
    {
        $os = Os::find($id);

        //$os->nome_autor = $request->nome_autor;
        $os->atribuido_tecnico = $request->atribuido_tecnico;
        $os->equipamento = $request->equipamento;
        $os->titulo = $request->titulo;
        $os->descrição = $request->descrição;

        $os->update();

        //Metodo alternativo, atualização em massa
        //Os::create($request->all());

        return redirect()->route('os.index')->with('status', "Os ID $os->id atualizada com sucesso" );;
    }

    public function destroy($id)
    {
        $os = Os::find($id);
        $os->delete();

        return redirect()->route('os.index');

    }

    public function acompanhamento($id)
    {        
        $os = Os::findOrFail($id);
        return view('os.acompanhamento', compact('os'));
    }

    public function acompanhamentoStore($os_id, AcompanhamentoRequest $request)
    {        
        $acompanhamento = new Acompanhamento;
        DB::beginTransaction();
        try {
            $acompanhamento->requerente = $request->requerente;
            $acompanhamento->descricao = $request->descrição;
            $acompanhamento->ordens_servico_id = $os_id;
            $acompanhamento->save();

            $os = Os::find($os_id);
            $os->status_id = 2;
            $os->update();
           
            DB::commit();
            return redirect()->route('os.show',$os_id)->with('status', 'Acompanhamento criado com sucesso!');
        } catch (Exception $e) {
            MainHelper::printLog($e);
            DB::rollback();
            echo $e;
            exit();
        }
       
    }

    public function solucao($id)
    {        
        $os = Os::findOrFail($id);
        return view('os.solucao', compact('os'));
    }

    public function solucaoStore($os_id, AcompanhamentoRequest $request)
    {        
        $solucao = new Solucao;
        DB::beginTransaction();
        try {
            $solucao->requerente = $request->requerente;
            $solucao->descricao = $request->descrição;
            $solucao->ordens_servico_id = $os_id;
            $solucao->save();

            $os = Os::find($os_id);
            $os->status_id = 3;
            $os->update();
            
            DB::commit();
            return redirect()->route('os.show',$os_id)->with('status', 'Chamado encerrado com sucesso!' );
        } catch (Exception $e) {
            MainHelper::printLog($e);
            DB::rollback();
            echo $e;
            exit();
        }
       
    }
}
