<?php

use App\Livewire\Produto\ProdutoCreate;
use App\Livewire\Produto\ProdutoDelete;
use App\Livewire\Produto\ProdutoEdit;
use App\Livewire\Produto\ProdutoIndex;
use App\Livewire\Usuario\UsuarioCreate;
use App\Livewire\Usuario\UsuarioDelete;
use App\Livewire\Usuario\UsuarioEdit;
use App\Livewire\Usuario\UsuarioIndex;
use Illuminate\Support\Facades\Route;

Route::prefix('usuario')->group(function(){
Route::get('/', UsuarioIndex::class)->name('usuarios.index');
Route::get('/create', UsuarioCreate::class)->name('usuarios.create');
Route::get('/{id}/edit', UsuarioEdit::class)->name('usuarios.edit');
Route::get('/{id}/delete', UsuarioDelete::class)->name('usuarios.delete');
});

Route::prefix('produto')->group(function(){
Route::get('/', ProdutoIndex::class)->name('produtos.index');
Route::get('/create', ProdutoCreate::class)->name('produtos.create');
Route::get('/{id}/edit', ProdutoEdit::class)->name('produtos.edit');
Route::get('/{id}/delete', ProdutoDelete::class)->name('produtos.delete');
});