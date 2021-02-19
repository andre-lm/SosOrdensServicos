<?php

use App\User;
  
function changeDateFormate($date,$date_format){
    return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format);    
}
function dateToPTBR($date){
    $result = new DateTime($date);
    return $result->format("d/m/Y"); 
}

function datetimeToPTBR($date){
    $result = new DateTime($date);
    return $result->format("d/m/Y h:m:s"); 
}
   
function productImagePath($image_name)
{
    return public_path('images/products/'.$image_name);
}

function userIsAdmin($user){
    if($user->minRoleID($user)==2 || $user->minRoleID($user)==1){
        return true;
    } 
    return false;
}

function userIsTecnico($user){
    if($user->minRoleID($user) == 3){
        return true;
    } 
    return false;
}

function findTecnicos(){
    $users = User::all();
    $tecnicos = [];
    foreach($users as $user){
        if(userIsTecnico($user)){
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