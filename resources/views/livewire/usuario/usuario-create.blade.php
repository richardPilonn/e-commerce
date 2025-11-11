<div class="container mt-5">
    <h1 class="text-3xl font-bold mb-6 flex items-center gap-3">
        <i class="bi bi-person-plus text-green-600"></i>
        Criar Usuario
    </h1>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="store" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" id="nome" wire:model.defer="nome"
                class="form-control @error('nome') is-invalid @enderror" />
            @error('nome')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Insira seu Email"
                wire:model.defer="email">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" class="form-control" id="password" placeholder="Insira uma senha"
                wire:model.defer="password">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
</div>