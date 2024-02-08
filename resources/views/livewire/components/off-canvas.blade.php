<div>
    <button class="badge bg-primary p-1 shadow" type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvas{{$titulo}}" aria-controls="offCanvas{{$titulo}}">
        {{$titulo}}
    </button>
    
    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offCanvas{{$titulo}}" aria-labelledby="offCanvas{{$titulo}}Label" data-bs-backdrop="false" wire:ignore.self>
        <div class="offcanvas-header" data-bs-theme="dark">
            <h5 class="offcanvas-title text-white" id="offCanvas{{$tabla}}Label">Acciones en: {{$titulo}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">

            @if($columna)
                @livewire('components.orden', ['columna' => $columna, 'direccion' => 1])
            @endif

            @if($tabla)
                {{-- @livewire('components.search', ['tabla' => $tabla]) --}}
                @livewire('components.search-table', ['tabla' => $tabla])
            @endif
            
            @if($columna == 'centro')
                @livewire('components.search-centros')
            @endif

        </div>
    </div>
</div>