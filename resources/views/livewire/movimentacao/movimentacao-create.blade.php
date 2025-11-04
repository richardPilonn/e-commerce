<div class="container mt-5">
    <h1 class="text-3xl font-bold mb-6 d-flex align-items-center gap-3">
        <i class="bi bi-box-seam text-primary"></i>
        Movimentação de Estoque
    </h1>

    <!-- Alertas -->
    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Formulário -->
    <div class="card shadow-sm">
        <div class="card-body">
            <form wire:submit.prevent="store">
                <div class="mb-3">
                    <label for="produto" class="form-label">Produto</label>
                    <select id="produto" class="form-select @error('produtoSelecionado') is-invalid @enderror" wire:model="produtoSelecionado">
                        <option value="">Selecione um produto</option>
                        @foreach($produtos as $produto)
                            <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                        @endforeach
                    </select>
                    @error('produtoSelecionado') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo de Movimentação</label>
                    <select id="tipo" class="form-select @error('tipo') is-invalid @enderror" wire:model="tipo">
                        <option value="">Selecione o tipo</option>
                        <option value="entrada">Entrada</option>
                        <option value="saida">Saída</option>
                    </select>
                    @error('tipo') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="quantidade" class="form-label">Quantidade</label>
                    <input type="number" id="quantidade" class="form-control @error('quantidade') is-invalid @enderror" wire:model="quantidade" min="1">
                    @error('quantidade') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="data_movimentacao" class="form-label">Data da Movimentação</label>
                    <input type="date" id="data_movimentacao" class="form-control @error('data_movimentacao') is-invalid @enderror" wire:model="data_movimentacao">
                    @error('data_movimentacao') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Registrar Movimentação
                </button>
            </form>
        </div>
    </div>

    <!-- Tabela de histórico de movimentações -->
    <div class="mt-5">
        <h2 class="h5 mb-3">Histórico de Movimentações</h2>
        <table class="table table-striped table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Produto</th>
                    <th>Tipo</th>
                    <th>Quantidade</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                @forelse($movimentacoes as $mov)
                    <tr>
                        <td>{{ $mov->id }}</td>
                        <td>{{ $mov->produto->nome }}</td>
                        <td>{{ ucfirst($mov->tipo) }}</td>
                        <td>{{ $mov->quantidade }}</td>
                        <td>{{ \Carbon\Carbon::parse($mov->data_movimentacao)->format('d/m/Y') }}</td>
                        
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted fst-italic">Nenhuma movimentação registrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Paginação -->
        <div class="d-flex justify-content-center mt-3">
            {{ $movimentacoes->links() }}
        </div>
    </div>
</div>
