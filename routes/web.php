<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::resource('/os', 'OsController');
Route::resource('/user', 'UserController');

Route::get('/', function() {
    return redirect('os');
});

//GET
Route::get('/os/{id}/acompanhamento', 'OsController@acompanhamento')->name('os.acompanhamento');
Route::get('/os/{id}/solucao', 'OsController@solucao')->name('os.solucao');
Route::get('/user/{id}/meusChamados', 'UserController@meusChamados')->name('user.meusChamados');

//POST
Route::post('/os/{id}/acompanhamentoStore', 'OsController@acompanhamentoStore')->name('os.acompanhamentoStore');
Route::post('/os/{id}/solucaoStore', 'OsController@solucaoStore')->name('os.solucaoStore');

//PUT atualizar dados


//DELETE


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
