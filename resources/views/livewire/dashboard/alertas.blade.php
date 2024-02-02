<div wire:poll.2s="send">
    <div class="card card-body d-flex flex-row justify-content-between align-items-center m-3">
        <div class="d-flex flex-row justify-content-around align-items-center">
            <h5 class="me-3 mt-2">CDS:</h5>
            
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center">
                @foreach($cds as $key => $cd)
                    <div class="form-check me-3">
                        <input class="form-check-input" type="checkbox" wire:model.live="cds.{{$key}}.visible" value="true">
                        <label class="form-check-label"> {{$cd['CD']}} </label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="d-flex flex-column flex-lg-row justify-content-between">
            <div class="input-group mb-3 mb-lg-0 me-lg-3">
                <span class="input-group-text">Desde</span>
                <input type="date" class="form-control" wire:model.live="ini">
            </div>
    
            <div class="input-group">
                <span class="input-group-text">Hasta</span>
                <input type="date" class="form-control" wire:model.live="fin">
            </div>
        </div>
    </div>
    
    <div class="d-flex flex-column flex-lg-row justify-content-between">
        @livewire('dashboard.alertas-t-m-a.cantidad-anomalias-total', ['ini' => $ini, 'fin' => $fin, 'cds' => $cds])
        @livewire('dashboard.alertas-t-m-a.pareto', ['ini' => $ini, 'fin' => $fin, 'cds' => $cds])
    </div>

    <div class="d-flex flex-column flex-lg-row justify-content-between">
        @livewire('dashboard.alertas-t-m-a.tiempo-perdido', ['ini' => $ini, 'fin' => $fin, 'cds' => $cds])
        @livewire('dashboard.alertas-t-m-a.s-l-a', ['ini' => $ini, 'fin' => $fin, 'cds' => $cds]) 
    </div>

</div>
