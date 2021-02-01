<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Acompanhamento extends Model
{
    use SoftDeletes;

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
