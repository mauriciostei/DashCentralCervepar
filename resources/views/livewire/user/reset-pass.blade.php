<form class="d-flex flex-column justify-content-center mt-3 card card-body" wire:submit="save">
    
    <h5>Reinicio de contraseña</h5>
    <small class="mb-2">El reinicio lo llevara de nuevo a la ventana para ingresar al sistema con su contraseña nueva</small>

    <x-forms.errors/>

    <x-forms.input type="password" label="Contraseña Actual" placeholder="Contraseña actual del usuario" wire:model="pass"/>

    <x-forms.input type="password" label="Nueva Contraseña" placeholder="Contraseña nueva para el usuario" wire:model="newPass"/>

    <x-forms.input type="password" label="Repetir nueva" placeholder="Repite tu nueva contraseña" wire:model="newPassRetry"/>

    <input type="submit" value="Reiniciar" class="btn btn-primary">

</form>
