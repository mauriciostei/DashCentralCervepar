<form class="card card-body mx-3" wire:submit="save">
    
    <div class="d-flex flex-row justify-content-between align-items-center mb-3">
        <h5>Editar usuario</h5>
        <div class="btn-group">
            <a href="{{ route('users.index') }}" type="button" class="btn btn-primary">Regresar</a>
            <input type="submit" value="Guardar" class="btn btn-success">
        </div>
    </div>

    <div class="mb-3">

        <x-forms.input type="text" label="Nombre del usuario" placeholder="Nombre y apellido" wire:model="name"/>

        <x-forms.input type="email" label="Correo electrónico del usuario" placeholder="Correo Electrónico" wire:model="email"/>

        <div class="input-group mb-3">
            <label class="input-group-text bg-primary">Tipo de Usuario</label>
            <select wire:model.live="level" class="form-control">
                <option selected disabled value="100">Seleccione el nivel del usuario</option>
                @foreach(App\Enums\UserLevel::cases() as $case)
                    <option value="{{ $case->value }}"> {{ $case->name }} </option>
                @endforeach
            </select>
        </div>

        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" role="switch" wire:model.live="active">
            <label class="form-check-label">Usuario Activo?</label>
        </div>

        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" role="switch" wire:model.live="changePassword">
            <label class="form-check-label">Cambiar la contraseña?</label>
        </div>

        @if($changePassword)
            <x-forms.input type="password" label="Nueva contraseña" placeholder="Nueva contraseña" wire:model="newPass"/>
            <x-forms.input type="password" label="Repetir contraseña" placeholder="Repetir contraseña nueva" wire:model="newPassRetry"/>
        @endif

    </div>

    <x-forms.errors/>

</form>
