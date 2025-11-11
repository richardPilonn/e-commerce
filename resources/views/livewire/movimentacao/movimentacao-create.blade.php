<div>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gestão de Estoque</h2>
            <a class="btn btn-secondary me-2" href="{{ route('dashboard') }}">Voltar</a>
        </div>

        @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        @if($lowStockAlert)
        <div class="alert alert-warning">{{ $lowStockAlert }}</div>
        @endif

        <!-- Formulário de Movimentação -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Registrar Movimentação de Estoque</h5>
            </div>
            <div class="card-body">
                <form wire:submit="registerMovement">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Produto</label>
                                <select class="form-select" wire:model="selectedProductId">
                                    <option value="">Selecione um produto</option>
                                    @foreach($produtos as $produto)
                                    <option value="{{ $produto->id }}">{{ $produto->nome }} (Estoque: {{
                                        $produto->quantidade }})</option>
                                    @endforeach
                                </select>
                                @error('selectedProductId') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Tipo</label>
                                <select class="form-select" wire:model="tipo">
                                    <option value="entrada">Entrada</option>
                                    <option value="saida">Saída</option>
                                </select>
                                @error('tipo') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Quantidade</label>
                                <input type="number" class="form-control" wire:model="quantidade_movimentada">
                                @error('quantidade_movimentada') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label">Data</label>
                                <input type="date" class="form-control" wire:model="data_movimentacao">
                                @error('data_movimentacao') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar Movimentação</button>
                </form>
            </div>
        </div>

        <!-- Lista de Produtos -->
        <div class="card">
            <div class="card-header">
                <h5>Produtos Cadastrados</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Preço</th>
                                <th>Estoque Atual</th>
                                <th>Estoque Mínimo</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produtos as $produto)
                            <tr>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ Str::limit($produto->descricao, 50) }}</td>
                                <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                                <td>{{ $produto->quantidade }}</td>
                                <td>{{ $produto->quantidade_minima }}</td>
                                <td>
                                    @if($produto->quantidade < $produto->quantidade_minima)
                                        <span class="badge bg-danger">Estoque Baixo</span>
                                        @elseif($produto->quantidade == $produto->quantidade_minima)
                                        <span class="badge bg-warning">Estoque Mínimo</span>
                                        @else
                                        <span class="badge bg-success">Normal</span>
                                        @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        Livewire.on('redirect', (data) => {
            window.location.href = data.url;
        });
    </script>
</div>