<?php

Route::get('/usuarios','UsuariosController@lista')->name('usuarios.lista');
Route::get('/usuarios/{id}/detalhes/', 'UsuariosController@mostra')->name('usuarios.detalhes');
Route::get('/usuarios/form', 'UsuariosController@novo')->name('usuarios.novo');
Route::get('/usuarios/adiciona', 'UsuariosController@adicionado')->name('usuarios.notifica-novo');
Route::get('/categorias/form-categoria', 'CategoriasController@nova')->name('categorias.nova');
Route::get('/categorias/adiciona-categoria', 'CategoriasController@adicionadaCategoria')->name('categorias.notifica-nova-categoria');
Route::get('/usuarios/{id}/alterar', 'UsuariosController@alter')->name('usuarios.alterar');
Route::post('/usuarios/{id}', 'UsuariosController@altera')->name('usuarios.alterando');
Route::get('/usuarios/alterado', function () {
    return view('usuarios/alterado');
})->name('usuarios.alterado');
Route::get('/usuarios/{id}', 'UsuariosController@excluir')->name('usuarios.excluir');
//Route::resource('usuarios', 'UsuariosController');
