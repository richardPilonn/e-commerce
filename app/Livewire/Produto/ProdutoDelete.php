<?php

namespace App\Livewire\Produto;

use App\Models\Produto;
use Livewire\Component;

class ProdutoDelete extends Component
{

     public $Id;
    public $nome;

    public function mount($id)
    {
        $produto = Produto::find($id);
        if ($produto == null) {
            session()->flash('error', 'Produto não Existente ou não encontrado');
            return redirect()->route('admins.index');
        } else {
        $produto = Produto::find($id);
        $this->Id = $id;
        $this->nome = $produto->nome;
        }
    }

    public function delete()
    {
        $produto = Produto::find($this->Id);
        $produto->delete();

        session()->flash('message', 'Produto deletado com sucesso.');
        return redirect()->route('produtos.index');
    }


    public function render()
    {
        return view('livewire.produto.produto-delete');
    }
}
