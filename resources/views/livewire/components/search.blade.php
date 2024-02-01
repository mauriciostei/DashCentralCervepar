<div>
    <div class="btn-group mb-3 w-100" role="group">
        <button class="btn btn-primary" wire:click.live="changeAll(true)">Seleccionar Todo</button>
        <button class="btn btn-primary" wire:click.live="changeAll(false)">Seleccionar Nada</button>
    </div>

    <input type="search" placeholder="Búsqueda..." class="form-control mb-2" wire:model.live="search">

    <div class="row p-3">
        @foreach($lista as $key => $lis)
            @if(str_contains(strtolower($lis['nombre']), strtolower($search)))
                <div class="form-check form-switch col-6">
                    <input class="form-check-input" type="checkbox" value="true" wire:model.live="lista.{{$key}}.visible">
                    <label class="form-check-label"> {{$lis['nombre']}} </label>
                </div>
            @endif
        @endforeach
    </div>
</div>