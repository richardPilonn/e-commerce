<?php

namespace App\Livewire\Produto;

use App\Models\Produto;
use Livewire\Component;
use Livewire\WithPagination;

class ProdutoIndex extends Component
{
    use WithPagination;
    public $search = '';
    public $perPage = 10; 

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];


    public function render()
    {
       $produtos = Produto::where('nome', 'like', "%{$this->search}%")
    ->orWhere('descricao', 'like', "%{$this->search}%")
    ->orWhere('preco', 'like', "%{$this->search}%")
    ->orWhere('quantidade', 'like', "%{$this->search}%")
    ->orWhere('quantidade_minima', 'like', "%{$this->search}%")
    ->paginate($this->perPage);

        return view('livewire.produto.produto-index', compact('produtos'));
    }
}
