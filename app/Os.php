<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Os extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nome_autor',
        'titulo',
        'atribuido_tecnico',
        'equipamento',
        'descrição',
        'status_id'
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

}
