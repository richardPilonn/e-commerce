<div class="container mt-5">
    <h1 class="text-3xl font-bold mb-6 flex items-center gap-3">
        <i class="bi bi-people-fill text-primary"></i>
        Lista de Usuarios
    </h1>
    <div class="d-flex flex-row justify-content-end">
        <a href="{{ route('usuarios.create') }}" class="btn btn-outline-primary mb-3 btn-sm"
            style="border-radius: 0.25rem; height: 38px; padding-top: 6px; min-width: 140px;">
            <i class="bi bi-person-add"></i> Novo Usuario
        </a>
    </div>
    @if (session()->has('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex flex-row justify-content-start">

        <input type="text" class="form-control flex-item justify-content-start" id="search"
            placeholder="Buscar usuarios..." wire:model.live="search" />
        <div class="flex-item col-md-3 ms-2">
            <select wire:model.live="perPage" class="form-select" style="border-color: #ced4da;">
                <option value="10">10 por página</option>
                <option value="25">25 por página</option>
                <option value="50">50 por página</option>
                <option value="100">100 por página</option>
                <option value="all">todos usuários</option>

            </select>
        </div>
    </div>

    <table class="table table-striped table-hover align-middle mt-3">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->nome }}</td>
                    <td>{{ $usuario->user->email ?? '' }}</td>
                    <td {{ $usuario->acoes }}>
                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-sm btn-warning" title="Editar">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <a href="{{ Route('usuarios.delete', $usuario->id) }}" class="btn btn-sm btn-danger"
                            title="Excluir">
                            <i class="bi bi-trash"></i></a>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted fst-italic">Nenhum usuario encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex flex-column align-items-center mt-3">
        <div class="mb-2">
            Mostrando {{ $usuarios->firstItem() }} até {{ $usuarios->lastItem() }} de
            {{ $usuarios->total() }} resultados
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">

                <li class="page-item {{ $usuarios->onFirstPage() ? 'disabled' : '' }}">
                    <a href="#" class="page-link" wire:click.prevent="previousPage" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                @foreach ($usuarios->getUrlRange(1, $usuarios->lastPage()) as $page => $url)
                    <li class="page-item {{ $usuarios->currentPage() == $page ? 'active' : '' }}">
                        <a href="#" class="page-link"
                            wire:click.prevent="gotoPage({{ $page }})">{{ $page }}</a>
                    </li>
                @endforeach

                <li class="page-item {{ $usuarios->hasMorePages() ? '' : 'disabled' }}">
                    <a href="#" class="page-link" wire:click.prevent="nextPage" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>

    </div>



</div>

</div>

</div>