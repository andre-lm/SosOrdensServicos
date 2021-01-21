<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table     = 'roles';

	public $timestamps   = false;

	public static $rules = array(
		'name'        => 'required|max:45|unique:roles',
		'description' => 'required|max:100'
	);

	public function users() {
        return $this->belongsToMany('User', 'user_roles');
    }
}
