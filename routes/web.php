<?php

Route::get('/', function(){
    return view('welcome');
});

//usuarios
Route::get('/usuarios','UsuariosController@lista')->name('usuarios.lista');
Route::get('/usuarios/{id}/detalhes/', 'UsuariosController@mostra')->name('usuarios.detalhes');
Route::get('/usuarios/form', 'UsuariosController@novo')->name('usuarios.novo');
Route::post('/usuarios/adiciona', 'UsuariosController@adicionado')->name('usuarios.notifica-novo');
Route::get('/usuarios/{id}/alterar', 'UsuariosController@alter')->name('usuarios.alterar');
Route::post('/usuarios/{id}', 'UsuariosController@altera')->name('usuarios.alterando');
Route::get('/usuarios/alterado', function () {
    return view('usuarios/alterado');
})->name('usuarios.alterado');
Route::get('/usuarios/{id}', 'UsuariosController@excluir')->name('usuarios.excluir');

//categorias
Route::get('/categorias','CategoriasController@lista')->name('categorias.lista');
Route::get('/categorias/form-categoria', 'CategoriasController@nova')->name('categorias.nova');
Route::get('/categorias/adiciona-categoria', 'CategoriasController@adicionadaCategoria')->name('categorias.notifica-nova-categoria');
Route::get('/categorias/{id}/alterar', 'CategoriasController@alter')->name('categorias.alterar');
Route::post('/categorias/{id}', 'CategoriasController@altera')->name('categorias.alterando');
Route::get('/categorias/alterado', function () {
    return view('categorias/alterado');
})->name('categorias.alterado');
Route::get('/categorias/{id}', 'CategoriasController@excluir')->name('categorias.excluir');
//Route::resource('usuarios', 'UsuariosController');
