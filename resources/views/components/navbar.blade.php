<div class="bg-primary p-2 my-2 mx-3 d-flex flex-row justify-content-between align-items-center rounded shadow-xl">
    <div class="d-flex flex-row justify-content-between align-items-center">
        <a href="{{ route('home') }}" class="m-2 me-4">
            <img src="{{ asset('img/logo.png') }}" alt="Logo de la empresa" width="150">
        </a>
        <div class="d-flex flex-row justify-content-between align-items-center">
            <a href="{{ route('home') }}" class="me-4 text-light">Pagina Principal</a>
            <a href="{{ route('alertas') }}" class="text-light me-4">Alertas</a>
            @can('users-manager')
                <a href="{{ route('users.index') }}" class="text-light">Usuarios</a>
            @endcan
        </div>
    </div>
    <div class="me-3">
        <a class="text-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvasUsuario" aria-controls="offCanvasUsuario">
            {{ $user->name }}
        </a>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offCanvasUsuario" aria-labelledby="offCanvasUsuario">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offCanvasUsuario">Bienvenido: {{ $user->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">

                <div class="d-flex flex-row justify-content-center">
                    <a href="{{ route('logout') }}" class="btn btn-primary w-100">Cerrar Sistema</a>
                </div>

                @livewire('user.reset-pass', ['user' => $user])

            </div>
        </div>

    </div>
</div>