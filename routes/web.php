<?php

use App\Livewire\Auth\Login;
use App\Livewire\Dashboard;
use App\Livewire\Movimentacao\MovimentacaoCreate;
use App\Livewire\Produto\ProdutoCreate;
use App\Livewire\Produto\ProdutoDelete;
use App\Livewire\Produto\ProdutoEdit;
use App\Livewire\Produto\ProdutoIndex;
use App\Livewire\Usuario\UsuarioCreate;
use App\Livewire\Usuario\UsuarioDelete;
use App\Livewire\Usuario\UsuarioEdit;
use App\Livewire\Usuario\UsuarioIndex;
use Illuminate\Support\Facades\Route;

Route::get('/', Login::class)->name('login');
Route::get('/dashboard', Dashboard::class)->middleware('auth')->name('dashboard');

Route::prefix('usuario')->group(function(){
Route::get('/', UsuarioIndex::class)->middleware('auth')->name('usuarios.index');
Route::get('/create', UsuarioCreate::class)->middleware('auth')->name('usuarios.create');
Route::get('/{id}/edit', UsuarioEdit::class)->middleware('auth')->name('usuarios.edit');
Route::get('/{id}/delete', UsuarioDelete::class)->middleware('auth')->name('usuarios.delete');
});

Route::prefix('produto')->group(function(){
Route::get('/', ProdutoIndex::class)->middleware('auth')->name('produtos.index');
Route::get('/create', ProdutoCreate::class)->middleware('auth')->name('produtos.create');
Route::get('/{id}/edit', ProdutoEdit::class)->middleware('auth')->name('produtos.edit');
Route::get('/{id}/delete', ProdutoDelete::class)->middleware('auth')->name('produtos.delete');
});

Route::prefix('movimentacao')->group(function(){
Route::get('/create', MovimentacaoCreate::class)->middleware('auth')->name('movimentacaos.create');
});