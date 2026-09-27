<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;

// Rota de login
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', 'App\Http\Controllers\UsuarioController@fazerLogin');

// Rota de logout
Route::post('/logout', 'App\Http\Controllers\UsuarioController@fazerLogout')->middleware(Authenticate::class);

// Rota de cadastro
Route::get('/register', function () {
    return view('register');
});
Route::post('/register', 'App\Http\Controllers\UsuarioController@insert');


//Rotas de usuario
Route::get('/inserir-usuario',function(){
    return view('insertUsuario');
});

Route::get('/usuario','App\Http\Controllers\UsuarioController@index')->middleware(Authenticate::class);
Route::get('/enviar-usuario','App\Http\Controllers\UsuarioController@create')->middleware(Authenticate::class);
Route::post('/criar-usuario','App\Http\Controllers\UsuarioController@insert')->middleware(Authenticate::class);
Route::put('/desativar-usuario/{id}','App\Http\Controllers\UsuarioController@desativar')->middleware(Authenticate::class);
Route::put('/ativar-usuario/{id}','App\Http\Controllers\UsuarioController@ativar')->middleware(Authenticate::class);
Route::put('/editar-usuario/{id}','App\Http\Controllers\UsuarioController@editar')->middleware(Authenticate::class);
Route::delete('/excluir-usuario/{id}','App\Http\Controllers\UsuarioController@excluir')->middleware(Authenticate::class);


//Rotas das tarefas

Route::get('/inserir-tarefa','App\Http\Controllers\TarefaController@tarefasSelect')->middleware(Authenticate::class);
Route::get('/','App\Http\Controllers\TarefaController@index')->middleware(Authenticate::class);
Route::get('/enviar-tarefa','App\Http\Controllers\TarefaController@create')->middleware(Authenticate::class);
Route::post('/criar-tarefa','App\Http\Controllers\TarefaController@insert')->middleware(Authenticate::class);
Route::put('/concluir-tarefa/{id}','App\Http\Controllers\TarefaController@concluir')->middleware(Authenticate::class);
Route::put('/editar-tarefa/{id}','App\Http\Controllers\TarefaController@editar')->middleware(Authenticate::class);
Route::put('/desfazer-tarefa/{id}','App\Http\Controllers\TarefaController@desfazer')->middleware(Authenticate::class);
Route::delete('/excluir-tarefa/{id}','App\Http\Controllers\TarefaController@excluir')->middleware(Authenticate::class);

//Rotas dos Projetos

Route::get('/projeto', 'App\Http\Controllers\ProjetoController@index')->middleware(Authenticate::class);
Route::get('/enviar-projeto','App\Http\Controllers\ProjetoController@create')->middleware(Authenticate::class);
Route::post('/criar-projeto','App\Http\Controllers\ProjetoController@insert')->middleware(Authenticate::class);
Route::get('/inserir-projeto','App\Http\Controllers\ProjetoController@projeto_select')->middleware(Authenticate::class);
Route::put('/editar-projeto/{id}','App\Http\Controllers\ProjetoController@editar')->middleware(Authenticate::class);
Route::delete('/excluir-projeto/{id}','App\Http\Controllers\ProjetoController@excluir')->middleware(Authenticate::class);

// Rota da Dashboard

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')
    ->middleware(Authenticate::class);


