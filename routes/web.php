<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::resources([
    '/os'=> 'OsController',
    '/user'=> 'UserController',
]);

Route::get('/', function() {
    return redirect('os');
});

//GET
Route::get('/os/{id}/acompanhamento', 'OsController@acompanhamento')->name('os.acompanhamento');
Route::get('/os/{id}/solucao', 'OsController@solucao')->name('os.solucao');

Route::get('/emAberto', 'OsController@emAberto')->name('emAberto');
Route::get('/emAtendimento', 'OsController@emAtendimento')->name('emAtendimento');
Route::get('/encerrados', ['as' => 'encerrados', 'uses' => 'OsController@encerrados']);

Route::get('/user/{id}/meusChamados', 'UserController@meusChamados')->name('user.meusChamados');

//POST
Route::post('/os/{id}/acompanhamentoStore', 'OsController@acompanhamentoStore')->name('os.acompanhamentoStore');
Route::post('/os/{id}/solucaoStore', 'OsController@solucaoStore')->name('os.solucaoStore');

//PUT atualizar dados


//DELETE
Route::delete('/acompanhamento/{id}', 'OsController@acompanhamentoDestroy');
Route::delete('/solucao/{id}', 'OsController@solucaoDestroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('export/', 'OsController@export')->name('os.export');
