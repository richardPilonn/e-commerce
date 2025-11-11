<?php

namespace App\Livewire\Movimentacao;

use App\Models\Movimentacao;
use App\Models\Produto;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class MovimentacaoCreate extends Component
{

   public $produtos;
    public $selectedProductId;
    public $tipo = 'saida';
    public $quantidade_movimentada;
    public $data_movimentacao;
    public $lowStockAlert = '';

    protected $rules = [
        'selectedProductId' => 'required|exists:produtos,id',
        'tipo' => 'required|in:entrada,saida',
        'quantidade_movimentada' => 'required|integer|min:1',
        'data_movimentacao' => 'required|date'
    ];

    public function mount()
    {
        $this->produtos = Produto::orderBy('nome')->get();
        $this->data_movimentacao = now()->format('Y-m-d');
    }

    public function registerMovement()
    {
        $this->validate();

        $produto = Produto::findOrFail($this->selectedProductId);

        if ($this->tipo === 'saida' && $produto->quantidade < $this->quantidade_movimentada) {
            $this->addError('quantidade_movimentada', 'Quantidade em estoque insuficiente.');
            return;
        }

        // Atualizar estoque
        if ($this->tipo === 'entrada') {
            $produto->increment('quantidade', $this->quantidade_movimentada);
        } else {
            $produto->decrement('quantidade', $this->quantidade_movimentada);
        }

        // Registrar movimentação
        Movimentacao::create([
            'produto_id' => $this->selectedProductId,
            'tipo' => $this->tipo,
            'quantidade' => $this->quantidade_movimentada,
            'data_movimentacao' => $this->data_movimentacao
        ]);

        // Verificar estoque baixo
        $produto->refresh();
        if ($produto->quantidade < $produto->quantidade_minima) {
            $this->lowStockAlert = "ALERTA: Estoque baixo para {$produto->nome}. Quantidade atual: {$produto->quantidade}";
        } else {
            $this->lowStockAlert = '';
        }

        session()->flash('message', 'Movimentação registrada com sucesso!');
        $this->reset(['quantidade_movimentada', 'tipo']);
        $this->produtos = Produto::orderBy('nome')->get();
    }


    public function render()
    {
        return view('livewire.movimentacao.movimentacao-create');
    }
}

