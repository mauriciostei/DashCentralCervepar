<div class="card card-body m-2">
    
    <div class="d-flex flex-row justify-content-between align-items-center mb-3">
        <h5>Administración de Usuarios</h5>

        <div class="input-group w-25">
            <span class="input-group-text">Buscar...</span>
            <input type="search" class="form-control" wire:model.live="search">
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-primary">Nuevo</a>
    </div>

    <div class="table-responsive">
        <table class="table table-sm table-hover table-striped">
            <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Tipo</th>
                <th>Activo</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td> {{$user->id}} </td>
                        <td> {{$user->name}} </td>
                        <td> {{$user->email}} </td>
                        <td>
                            <span class="badge bg-{{ ($user->level->value == 0) ? 'warning' : 'success' }}"> {{$user->level->name}}  </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $user->active ? 'success' : 'warning' }}"> {{ $user->active ? 'Activo' : 'Inactivo' }} </span>
                        </td>
                        <td>
                            <a href="{{ route('users.edit', [ 'user' => $user->id ]) }}" class="badge bg-primary">Editar</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <th class="text-center text-muted" colspan="100">Sin Registros!</th>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $users->links() }}
    </div>

</div>
