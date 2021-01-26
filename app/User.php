<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Roles;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles() {
       //return $this->hasMany('App\Roles');
        return $this->belongsToMany(Roles::class,'user_roles');
    }    

    public function user_roles() {
        return $this->hasMany('App\UserRoles', 'user_id', 'id');
    }

    public function os()
    {
        return $this->hasMany('App\Os', 'id_user', 'id');
    }

    public function userIsAuth($user) {
        return $user->id === Auth::user()->id; // User must not be null
    }

    //retorna o nome do usuario
    public function roleName($user) {
        $role_id = $user->user_roles->min('role_id');
        $role = Roles::find($role_id);
        return $role->attributes['description'];
    }

    //retorna o id da menor role do usuario
    public function minRoleID($user) {
        $role_id = $user->user_roles->min('role_id');
        $role = Roles::find($role_id);
        return $role->attributes['id'];
    }
    
}
