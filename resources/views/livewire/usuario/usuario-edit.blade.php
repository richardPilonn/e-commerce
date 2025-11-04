<div class="mt-5">
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mx-auto my-5 shadow-lg p-3 mb-5 bg-white rounded w-75">
        <h3 class="card-header d-flex justify-content-center">Editar Usuario</h3>
        <div class="card-body">
            <form wire:submit.prevent="update">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome"
                        wire:model.defer="nome" placeholder="Insira o nome">
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        wire:model.defer="email" placeholder="Insira o e-mail">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="senha" class="form-label">Senha (deixe em branco para não alterar)</label>
                    <input type="password" class="form-control @error('senha') is-invalid @enderror" id="senha"
                        wire:model.defer="senha" placeholder="Insira a senha">
                    @error('senha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 d-flex justify-content-center">
                    <button type="submit" class="btn btn-dark w-75 p-3">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
