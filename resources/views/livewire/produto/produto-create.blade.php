<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moda Express</title>
    <!-- Bootstrap CSS para estilização responsiva e moderna -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #ff6b6b, #4ecdc4);
            font-family: 'Arial', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 600px;
            width: 100%;
        }
        .form-control {
            border-radius: 10px;
            border: 2px solid #ddd;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            border-color: #ff6b6b;
            box-shadow: 0 0 5px rgba(255, 107, 107, 0.5);
        }
        .btn-primary {
            background: linear-gradient(135deg, #ff6b6b, #ffa500);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: bold;
            transition: transform 0.2s;
        }
        .btn-primary:hover {
            transform: scale(1.05);
            background: linear-gradient(135deg, #ffa500, #ff6b6b);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h2 {
            color: #333;
            font-weight: bold;
        }
        .header p {
            color: #666;
        }
        .icon {
            color: #ff6b6b;
            margin-right: 10px;
        }
        .alert {
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <i class="fas fa-tshirt icon"></i>
            <h2>Moda Express</h2>
            <p>Sistema de E-Commerce com Controle de Estoque</p>
            <h4>Cadastrar Novo Produto</h4>
        </div>

        <!-- Exibir mensagens de erro ou sucesso (integrar com Laravel/Livewire) -->
        @if(session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulário de cadastro (integrar com Livewire ou Laravel) -->
        <form wire:submit.prevent="store" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nome" class="form-label"><i class="fas fa-tag icon"></i>Nome do Produto</label>
                <input type="text" class="form-control" id="nome" wire:model="nome" placeholder="Ex: Camiseta Básica">
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label"><i class="fas fa-align-left icon"></i>Descrição</label>
                <textarea class="form-control" id="descricao" rows="3" wire:model="descricao" placeholder="Descreva o produto..."></textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="preco" class="form-label"><i class="fas fa-dollar-sign icon"></i>Preço (R$)</label>
                    <input type="number" step="0.01" class="form-control" id="preco" wire:model="preco" placeholder="0.00">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="quantidade" class="form-label"><i class="fas fa-boxes icon"></i>Quantidade em Estoque</label>
                    <input type="number" class="form-control" id="quantidade" wire:model="quantidade" placeholder="0">
                </div>
            </div>
            <div class="mb-3">
                <label for="quantidade_minima" class="form-label"><i class="fas fa-exclamation-triangle icon"></i>Quantidade Mínima</label>
                <input type="number" class="form-control" id="quantidade_minima" wire:model="quantidade_minima" placeholder="0">
            </div>
            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-save"></i> Cadastrar Produto</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Validação simples em JavaScript (para iniciante) -->
    <script>
        // Quando o formulário for enviado, faz uma verificação simples
        document.querySelector('form').addEventListener('submit', function(e) {
            // Pega os valores dos campos
            const nome = document.getElementById('nome').value.trim(); // Remove espaços extras
            const preco = document.getElementById('preco').value;
            const quantidade = document.getElementById('quantidade').value;
            const quantidadeMinima = document.getElementById('quantidade_minima').value;

            // Verifica se algum campo está vazio
            if (!nome || !preco || !quantidade || !quantidadeMinima) {
                alert('Erro: Todos os campos são obrigatórios! Preencha tudo antes de enviar.');
                e.preventDefault(); // Para o envio do formulário
                return; // Sai da função
            }

            // Verifica se o preço é um número válido e positivo
            if (isNaN(preco) || preco < 0) {
                alert('Erro: O preço deve ser um número válido e maior ou igual a zero.');
                e.preventDefault();
                return;
            }

            // Verifica se a quantidade é um número inteiro positivo
            if (isNaN(quantidade) || quantidade < 0 || !Number.isInteger(Number(quantidade))) {
                alert('Erro: A quantidade deve ser um número inteiro maior ou igual a zero.');
                e.preventDefault();
                return;
            }

            // Verifica se a quantidade mínima é um número inteiro positivo
            if (isNaN(quantidadeMinima) || quantidadeMinima < 0 || !Number.isInteger(Number(quantidadeMinima))) {
                alert('Erro: A quantidade mínima deve ser um número inteiro maior ou igual a zero.');
                e.preventDefault();
                return;
            }

            // Se tudo estiver certo, o formulário será enviado (validações PHP assumem o resto)
        });
    </script>
</body>
</html>
