<div class="d-flex flex-row justify-content-center align-items-center mt-5 pt-5">
    <div class="card w-90 w-lg-25">
        <form class="card-body" wire:submit="ingresar">
    
            <div class="d-flex flex-row justify-content-center mb-4 p-2">
                <img src="{{ asset('img/logo.png') }}" alt="Logo de la empresa" width="200">
            </div>
    
            <x-forms.errors/>

            <x-forms.input type="email" label="Correo electrónico del usuario" placeholder="Correo Electrónico" wire:model="email"/>

            <x-forms.input type="password" label="Contraseña del sistema del usuario" placeholder="Contraseña del usuario" wire:model="password"/>
    
            <input type="submit" value="Ingresar" class="btn btn-primary w-100">
    
        </form>
    </div>
</div>
