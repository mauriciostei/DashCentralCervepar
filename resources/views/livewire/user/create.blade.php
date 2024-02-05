<form class="card card-body mx-3" wire:submit="save">
    
    <div class="d-flex flex-row justify-content-between align-items-center mb-3">
        <h5>Nuevo usuario</h5>
        <div class="btn-group">
            <a href="{{ route('users.index') }}" type="button" class="btn btn-primary">Regresar</a>
            <input type="submit" value="Guardar" class="btn btn-success">
        </div>
    </div>

    <div class="mb-3">

        <x-forms.input type="text" label="Nombre del usuario" placeholder="Nombre y apellido" wire:model="name"/>

        <x-forms.input type="email" label="Correo electrónico del usuario" placeholder="Correo Electrónico" wire:model="email"/>

        <x-forms.input type="password" label="Contraseña del sistema del usuario" placeholder="Contraseña del usuario" wire:model="password"/>

        <div class="input-group">
            <label class="input-group-text bg-primary">Tipo de Usuario</label>
            <select wire:model.live="level" class="form-control">
                <option selected disabled value="100">Seleccione el nivel del usuario</option>
                @foreach(App\Enums\UserLevel::cases() as $case)
                    <option value="{{ $case->value }}"> {{ $case->name }} </option>
                @endforeach
            </select>
        </div>

    </div>

    <x-forms.errors/>

</form>
