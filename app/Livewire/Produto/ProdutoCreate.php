<?php

namespace App\Livewire\Produto;

use App\Models\Produto;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class ProdutoCreate extends Component
{

    public $nome;
    public $descricao;
    public $preco;
    public $quantidade;
    public $quantidade_minima;

    // Regras de validação aprimoradas
    protected $rules = [
        'nome' => 'required|string|max:255',
        'descricao' => 'required|string|max:255',
        'preco' => 'required|numeric|min:0',
        'quantidade' => 'required|integer|min:0',
        'quantidade_minima' => 'required|integer|min:0',
    ];
    // Mensagens de erro personalizadas
    protected $messages = [
        'nome.required' => 'O campo nome é obrigatório e não pode ficar vazio.',
        'nome.string' => 'O campo nome deve ser uma string de texto.',
        'nome.max' => 'O campo nome não pode exceder 255 caracteres.',

        'descricao.required' => 'O campo descrição é obrigatório e não pode ficar vazio.',
        'descricao.string' => 'O campo descrição deve ser uma string de texto.',
        'descricao.max' => 'O campo descrição não pode exceder 255 caracteres.',

        'preco.required' => 'O campo preço é obrigatório e não pode ficar vazio.',
        'preco.numeric' => 'O campo preço deve conter apenas números válidos.',
        'preco.min' => 'O campo preço deve ser um valor positivo ou zero.',

        'quantidade.required' => 'O campo quantidade é obrigatório e não pode ficar vazio.',
        'quantidade.integer' => 'O campo quantidade deve ser um número inteiro.',
        'quantidade.min' => 'O campo quantidade deve ser um valor positivo ou zero.',

        'quantidade_minima.required' => 'O campo quantidade mínima é obrigatório e não pode ficar vazio.',
        'quantidade_minima.integer' => 'O campo quantidade mínima deve ser um número inteiro.',
        'quantidade_minima.min' => 'O campo quantidade mínima deve ser um valor positivo ou zero.',
    ];


    public function store()
    {
         Produto::create([
        'nome' => $this->nome,
        'descricao' => $this->descricao,
        'preco' => $this->preco,
        'quantidade' => $this->quantidade,
        'quantidade_minima' => $this->quantidade_minima,
    ]);


        session()->flash('message', 'Produto cadastrado com sucesso');
        $this->reset('nome', 'descricao', 'preco', 'quantidade', 'quantidade_minima');
    }

    public function render()
    {
        return view('livewire.produto.produto-create');
    }
}
