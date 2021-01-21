<?php

use App\User;
  
function changeDateFormate($date,$date_format){
    return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format);    
}
   
function productImagePath($image_name)
{
    return public_path('images/products/'.$image_name);
}

function findTecnicos(){
    $users = User::all();
    $tecnicos = [];
    foreach($users as $user){
        if($user->roleID($user) == 3){
            $tecnicos[$user->id] = $user->name;
        }
    }
    return $tecnicos;
}

function countOs($user){
    $ordens = $user->os;
    $count=0;
    foreach($ordens as $os){
        if($os->status->id == 1){
            $count++;
        }
    }
    return $count;
}