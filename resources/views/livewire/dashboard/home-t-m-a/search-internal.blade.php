<div wire:poll.1s="getInfo">
    <button class="badge bg-primary btn-sm shadow position-relative" type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvasFilter{{$column}}" aria-controls="offCanvasFilter{{$column}}">
        {{ $title }}
        @if($changes)
            <span class="bg-warning rounded-pill p-1 pb-0 fw-bold position-absolute top-0 right-0">*</span>
        @endif 
    </button>
      
      <div class="offcanvas offcanvas-start" id="offCanvasFilter{{$column}}" aria-labelledby="offCanvasFilter{{$column}}Label" data-bs-scroll="true" data-bs-backdrop="false" wire:ignore.self>
            <div class="offcanvas-header" data-bs-theme="dark">
                <h5 class="offcanvas-title text-white">Acciones en: {{$title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">

                <div class="btn-group mb-3 w-100" role="group">
                    <button class="btn btn-primary" wire:click.live="changeOrder('asc')">Ascendente</button>
                    <button class="btn btn-primary" wire:click.live="changeOrder('desc')">Descendente</button>
                </div>

                @if($filter)
                    <div class="btn-group mb-3 w-100" role="group">
                        <button class="btn btn-primary" wire:click.live="changeAll(true)">Seleccionar Todo</button>
                        <button class="btn btn-primary" wire:click.live="changeAll(false)">Seleccionar Nada</button>
                    </div>
                
                    <input type="search" placeholder="Búsqueda..." class="form-control mb-2" wire:model.live="search">
                
                    <div class="row p-3">
                        @foreach($list as $key => $lis)
                            @if(str_contains(strtolower($lis['nombre']), strtolower($search)))
                                <div class="form-check form-switch col-6">
                                    <input class="form-check-input" type="checkbox" value="true" wire:model.live="list.{{$key}}.visible">
                                    <label class="form-check-label text-white"> {{$lis['nombre']}} </label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
      </div>
</div>