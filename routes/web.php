<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Rota inicial (página login)
Route::get('/', function () {
    return view('index');
})->name('index');

//Rota de Dashboard de usuário
Route::middleware('auth')->prefix('/dashboard')->group(function(){
    Route::get('/', function(){
        return view('dashboard.user.index');
    })->name('user.dashboard');

    //Rotas de perfil e atualização de perfil
    Route::get('/perfil', [App\Http\Controllers\User\PerfilController::class, 'index'])->name('user.perfil');
    Route::put('/perfil/update', [App\Http\Controllers\User\PerfilController::class, 'editarProprioPerfil'])->name('user.perfil.update');
});

//Rotas de dashboard administrativo
Route::middleware('admin')->prefix('/admin')->group(function(){
    //Padrão REST sendo aplicado

    //Rotas de CRUD de departamento
    Route::get('/departamentos', [App\Http\Controllers\Admin\DepartamentoController::class, 'index'])->name('departamento');

    Route::get('/departamentos/criar', [App\Http\Controllers\Admin\DepartamentoController::class, 'formCreate'])->name('departamento.create.form');
    Route::post('/departamentos/criar', [App\Http\Controllers\Admin\DepartamentoController::class, 'criarDep'])->name('departamento.create');

    Route::get('/departamentos/editar/{id}', [App\Http\Controllers\Admin\DepartamentoController::class, 'formEdit'])->name('departamento.update.form');
    Route::put('/departamentos/editar/{id}', [App\Http\Controllers\Admin\DepartamentoController::class, 'editarDep'])->name('departamento.update');

    Route::delete('/departamentos/deletar/{id}', [App\Http\Controllers\Admin\DepartamentoController::class, 'delete'])->name('departamento.delete');

    //Rotas de CRUD de usuários
    Route::get('/usuarios', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('usuario');

    Route::get('/usuarios/criar', [App\Http\Controllers\Admin\UserController::class, 'formCreate'])->name('usuario.create.form');
    Route::post('/usuarios/criar', [App\Http\Controllers\Admin\UserController::class, 'criarUser'])->name('usuario.create');

    Route::get('/usuarios/editar/{id}', [App\Http\Controllers\Admin\UserController::class, 'formEdit'])->name('usuario.update.form');
    Route::put('/usuarios/editar/{id}', [App\Http\Controllers\Admin\UserController::class, 'editarUser'])->name('usuario.update');

    Route::delete('/usuarios/deletar/{id}', [App\Http\Controllers\Admin\UserController::class, 'delete'])->name('usuario.delete');
});

Auth::routes(['register' => false]);