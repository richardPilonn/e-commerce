<div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <span class="navbar-brand">Moda Express</span>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-3">Olá, {{ $user->name }}</span>
                <button class="btn btn-outline-light btn-sm" wire:click="logout">Sair</button>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Cadastro de Produtos</h5>
                        <p class="card-text">Gerencie os produtos da loja</p>
                        <a href="{{ route('produtos.index') }}" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Gestão de Estoque</h5>
                        <p class="card-text">Controle as movimentações</p>
                        <a href="{{ route('movimentacaos.create') }}" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
