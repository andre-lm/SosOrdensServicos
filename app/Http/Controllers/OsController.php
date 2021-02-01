<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Requests\OsRequest;
use App\Http\Requests\AcompanhamentoRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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

    public function emAberto()
    {
        $ordemservico = $this->os->where('status_id',1)->paginate(5);
        $count = $this->os->where('status_id',1)->count();
        if($count == 0){
            return view('os.index', compact('ordemservico','count'), ['warning'=> 'Não existe nenhuma Os em aberto']);
        }
        return view('os.index', compact('ordemservico','count'));
    }

    public function emAtendimento()
    {
        $ordemservico = $this->os->where('status_id',2)->paginate(5);
        $count = $this->os->where('status_id',2)->count();
        if($count == 0){
            return view('os.index', compact('ordemservico','count'), ['warning'=> 'Não existe nenhuma Os em atendimento']);
        }
        return view('os.index', compact('ordemservico','count'));
    }

    public function encerrados()
    {
        $ordemservico = $this->os->where('status_id',3)->paginate(5); 
        $count = $this->os->where('status_id',3)->count();
        if($count == 0){
            return view('os.index', compact('ordemservico','count'), ['warning'=> 'Não existe nenhuma Os encerrada']);
        }
        return view('os.index', compact('ordemservico','count'));
    }

    public function create()
    {
        $user = (Auth::user()) ? Auth::user() : '';
        $tecnicos = count(findTecnicos());
        if($tecnicos < 1){
            return redirect()->route('user.create')->with('error', 'Obrigatório ter um técnico cadastrado');
        }
        return view('os.create', compact('user'));
    }

    public function store(OsRequest $request)
    {
        $os = new Os;
        DB::beginTransaction();
        try {
           
            $os->nome_autor = $request->nome_autor;
            $os->titulo = $request->titulo;
            $os->id_user = $request->atribuido_tecnico;
            $os->equipamento = $request->equipamento;
            $os->descrição = $request->descrição;
            $os->status_id = 1;
            $os->save();

            DB::commit();
            return redirect()->route('os.index')->with('success', "Chamado ID $os->id cadastrado com sucesso" );
        }  catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
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
        $os->id_user = $request->atribuido_tecnico;
        $os->equipamento = $request->equipamento;
        $os->titulo = $request->titulo;
        $os->descrição = $request->descrição;

        $os->update();

        //Metodo alternativo, atualização em massa
        //Os::create($request->all());

        return redirect()->route('os.show', $id)->with('success', "Os ID $os->id atualizada com sucesso" );
    }

    public function destroy($id)
    {
        try{
            $os = Os::find($id);
            $os->delete();
            return ['status'=>1,'msg'=>"Os ID $os->id excluída com sucesso" ];
        }catch (ModelNotFoundException $exception) {
            return ['status'=>'erro','msg'=>'Não foi possível realizar essa ação!'];
        }
    }

    public function acompanhamento($id)
    {        
        $os = Os::findOrFail($id);
        $user = (Auth::user()) ? Auth::user() : '';
        return view('os.acompanhamento', compact('os','user'));
    }

    public function acompanhamentoStore($os_id, AcompanhamentoRequest $request)
    {        
        $acompanhamento = new Acompanhamento;
        DB::beginTransaction();
        try {
            if($request->requerente) $acompanhamento->requerente = $request->requerente;
            if($request->id_user) $acompanhamento->id_user = $request->id_user;
            $acompanhamento->descricao = $request->descrição;
            $acompanhamento->ordens_servico_id = $os_id;
            $acompanhamento->save();

            $os = Os::find($os_id);
            $os->status_id = 2;
            $os->update();
           
            DB::commit();
            return redirect()->route('os.show',$os_id)->with('success', 'Acompanhamento criado com sucesso!');
        }  catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
       
    }

    public function acompanhamentoDestroy($id)
    {
        try{
            $acompanhamento = Acompanhamento::find($id);
            $acompanhamento->delete();
            $os_status = "";

            $os = Os::find($acompanhamento->ordens_servico_id);
            $count = $os->Acompanhamento->count();
            $countSolucao = $os->Solucao->count();
            //se só houver uma acompanhamento, e não houver nenhuma solução voltar pra status 1
            if($count==0 && $os->status_id==2 && $countSolucao == 0){
                $os->status_id = 1;
                $os->update();
                $os_status = "Em aberto";
            }

            return ['status'=>1,'msg'=>"Acompanhamento excluído com sucesso", "os_status"=>$os_status];
        }catch (ModelNotFoundException $exception) {
            return ['status'=>'erro','msg'=>'Não foi possível realizar essa ação!'];
        }
    }


    public function solucao($id)
    {        
        $os = Os::findOrFail($id);
        $user = (Auth::user()) ? Auth::user() : '';
        return view('os.solucao', compact('os','user'));
    }

    public function solucaoStore($os_id, AcompanhamentoRequest $request)
    {        
        $solucao = new Solucao;
        DB::beginTransaction();
        try {
            if($request->requerente) $solucao->requerente = $request->requerente;
            if($request->id_user) $solucao->id_user = $request->id_user;
            $solucao->descricao = $request->descrição;
            $solucao->ordens_servico_id = $os_id;
            $solucao->save();

            $os = Os::find($os_id);
            $os->status_id = 3;
            $os->update();
            
            DB::commit();
            return redirect()->route('os.show',$os_id)->with('success', 'Solução criada e chamado encerrado com sucesso!' );
        }  catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
       
    }

    public function solucaoDestroy($id)
    {
        try{
            $solucao = Solucao::find($id);
            $solucao->delete();
            $os_status = "";
           
            $os = Os::find($solucao->ordens_servico_id);
            //se só houver uma solucao, voltar pra status 2
            $count = $os->Solucao->count();
            if($count==0 && $os->status_id==3){
                $os->status_id = 2;
                $os->update();
                $os_status = "Em atendimento";
            }

            return ['status'=>1,'msg'=>"Solução excluída com sucesso", "os_status"=>$os_status];
        }catch (ModelNotFoundException $exception) {
            return ['status'=>'erro','msg'=>'Não foi possível realizar essa ação!'];
        }
    }

}
