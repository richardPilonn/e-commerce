<?php

namespace App\Livewire\Produto;

use App\Models\Produto;
use Livewire\Component;

class ProdutoEdit extends Component
{
  // Propriedades públicas para os campos do formulário
    public $Id; // ID do produto a ser editado
    public $nome;
    public $descricao;
    public $preco;
    public $quantidade;
    public $quantidade_minima;

    // Regras de validação (iguais às de criação, mas aplicáveis na edição)
    protected $rules = [
        'nome' => 'required|string|min:5|max:255',
        'descricao' => 'required|string|max:1000', // Aumentei o limite para descrição
        'preco' => 'required|numeric|min:0',
        'quantidade' => 'required|integer|min:0',
        'quantidade_minima' => 'required|integer|min:0',
    ];


        // Mensagens de erro personalizadas
    protected $messages = [
        'nome.required' => 'O campo nome é obrigatório.',
        'nome.string' => 'O campo nome deve ser texto.',
        'nome.min' => 'O campo nome deve ter pelo menos 5 caracteres',
        'nome.max' => 'O campo nome não pode exceder 255 caracteres.',

        'descricao.required' => 'O campo descrição é obrigatório.',
        'descricao.string' => 'O campo descrição deve ser texto.',
        'descricao.max' => 'O campo descrição não pode exceder 1000 caracteres.',

        'preco.required' => 'O campo preço é obrigatório.',
        'preco.numeric' => 'O campo preço deve ser um número.',
        'preco.min' => 'O campo preço deve ser positivo.',

        'quantidade.required' => 'O campo quantidade é obrigatório.',
        'quantidade.integer' => 'O campo quantidade deve ser um número inteiro.',
        'quantidade.min' => 'O campo quantidade deve ser positivo.',

        'quantidade_minima.required' => 'O campo quantidade mínima é obrigatório.',
        'quantidade_minima.integer' => 'O campo quantidade mínima deve ser um número inteiro.',
        'quantidade_minima.min' => 'O campo quantidade mínima deve ser positivo.',
    ];

      // Método executado ao montar o componente (carrega o produto pelo ID)
    public function mount($id)
    {
        $produto = Produto::find($id); // garante que existe, caso contrário lança 404
    $this->Id = $produto->id;
    $this->nome = $produto->nome;
    $this->descricao = $produto->descricao;
    $this->preco = $produto->preco;
    $this->quantidade = $produto->quantidade;
    $this->quantidade_minima = $produto->quantidade_minima;
    }

    // Método para salvar as alterações
    public function update()
    {
        // Valida os dados
        $this->validate();
        // Atualiza o produto no banco
        $produto = Produto::find($this->Id);
        $produto->update([
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'preco' => $this->preco,
            'quantidade' => $this->quantidade,
            'quantidade_minima' => $this->quantidade_minima,
        ]);
        // Mensagem de sucesso e redirecionamento (opcional)
        session()->flash('message', 'Produto editado com sucesso!');
        return redirect()->route('produtos.index'); // Ajuste a rota conforme necessário
    }


    public function render()
    {
        return view('livewire.produto.produto-edit');
    }
}
