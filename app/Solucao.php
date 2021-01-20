<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solucao extends Model
{
    protected $table    = 'solucao';
    protected $fillable = [
        'descricao'.
        'requerente'.
        'ordens_servico_id'
    ];

    public function os()
    {
        return $this->belongsTo('App\Os');
    }
}
