<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acompanhamento extends Model
{
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
