<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Solucao extends Model
{
    use SoftDeletes;

    protected $table    = 'solucao';
    protected $fillable = [
        'descricao'.
        'requerente'.
        'ordens_servico_id'.
        'id_user'
    ];

    public function os()
    {
        return $this->belongsTo('App\Os');
    }

    public function users() {
        return $this->belongsTo('App\User');
    }

    public function userName($id){
        $user = User::find($id);
        return $user->name;
    }
}
