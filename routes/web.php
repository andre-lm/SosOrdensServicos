<?php

use Illuminate\Support\Facades\Route;

Route::resource('/os', 'OsController');
//GET

Route::get('/os/{id}/solucao', 'OsController@solucao')->name('os.solucao');
Route::get('/os/{id}/acompanhamento', 'OsController@acompanhamento')->name('os.acompanhamento');
Route::get('/os/{id}/solucao', 'OsController@solucao')->name('os.solucao');

//POST

Route::post('/os/{id}/acompanhamentoStore', 'OsController@acompanhamentoStore')->name('os.acompanhamentoStore');
Route::post('/os/{id}/solucaoStore', 'OsController@solucaoStore')->name('os.solucaoStore');
//PUT atualizar dados


//DELETE

//Route::delete('os/{id}', 'OsController@destroy')->name('os.destroy');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
