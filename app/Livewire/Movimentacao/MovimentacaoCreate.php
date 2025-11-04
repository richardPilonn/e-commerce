<?php

namespace App\Livewire\Movimentacao;

use App\Models\Movimentacao;
use App\Models\Produto;
use Illuminate\Validation\Rule;
use Livewire\Component;

class MovimentacaoCreate extends Component
{

    public $produtos;          // lista de produtos
    public $produtoSelecionado; // ID do produto selecionado
    public $tipo;               // 'entrada' ou 'saida'
    public $quantidade;
    public $data_movimentacao;

    protected $rules = [
    'produtoSelecionado' => 'required|exists:produtos,id',
    'tipo' => 'required|in:entrada,saida', // ✅ Usando string
    'quantidade' => 'required|integer|min:1',
    'data_movimentacao' => 'required|date',
];

protected $messages = [
    'produtoSelecionado.required' => 'Selecione um produto.',
    'produtoSelecionado.exists' => 'Produto inválido.',

    'tipo.required' => 'Selecione o tipo de movimentação.',
    'tipo.in' => 'O tipo deve ser entrada ou saída.',

    'quantidade.required' => 'Informe a quantidade.',
    'quantidade.integer' => 'A quantidade deve ser um número inteiro.',
    'quantidade.min' => 'A quantidade deve ser no mínimo 1.',

    'data_movimentacao.required' => 'Informe a data da movimentação.',
    'data_movimentacao.date' => 'A data é inválida.',
];


    public function mount()
    {
        $this->produtos = Produto::orderBy('nome')->get();
    }

    public function store()
    {
        $this->validate();

        $produto = Produto::find($this->produtoSelecionado);

        // Atualiza estoque
        if ($this->tipo === 'entrada') {
            $produto->quantidade += $this->quantidade;
        } else {
            $produto->quantidade -= $this->quantidade;
        }
        $produto->save();

        // Cria movimentação
        Movimentacao::create([
            'produto_id' => $produto->id,
            'tipo' => $this->tipo,
            'quantidade' => $this->quantidade,
            'data_movimentacao' => $this->data_movimentacao,
        ]);

        session()->flash('message', 'Movimentação registrada com sucesso!');

        // Limpa formulário
        $this->reset(['produtoSelecionado', 'tipo', 'quantidade', 'data_movimentacao']);
    }

    public function render()
    {
        return view('livewire.movimentacao.movimentacao-create');
    }
}
