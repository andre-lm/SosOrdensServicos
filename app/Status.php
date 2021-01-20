<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';

    protected $fillable = [
        'status'
    ];

    public function os()
    {
        return $this->hasMany('App\Os');
    }
}