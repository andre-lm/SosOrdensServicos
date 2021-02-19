<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Os extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nome_autor',
        'titulo',
        // 'atribuido_tecnico',
        'equipamento',
        'descrição',
        'status_id',
        'id_user'
    ];

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function Acompanhamento()
    {
        return $this->hasMany('App\Acompanhamento','ordens_servico_id','id');
    }

    public function Solucao()
    {
        return $this->hasMany('App\Solucao','ordens_servico_id','id');
    }

    public function users() {
        return $this->belongsTo('App\User', 'id_user','id');
    }

    public function userName($id){
        $user = User::find($id);
        return $user->name;
    }
}
