<div class="flex-grow-1 d-flex flex-column">
    
    <div class="flex-grow-1 d-flex">
        @livewire('dashboard.home-t-m-a.alertas')
    </div>

    <div class="flex-grow-1 d-flex">
        <div class="d-flex me-1 w-100 overflow-scroll h-100 flex-grow-1">
            @livewire('dashboard.home-t-m-a.table-movil') 
        </div>
        <div class="d-flex ms-1 w-100">
            @livewire('dashboard.home-t-m-a.grafica-cantidad-anomalias') 
        </div>
    </div>

</div>
