<div class="card card-body m-3 d-flex flex-column flex-grow-1" wire:poll.1s="getInfo">

    <div class="d-flex flex-row justify-content-between mb-3">
        <h5>Total de Anomalías</h5>
        {{-- <small>
            <span class="text-danger">Rojo</span> Gestión Reactiva, <span class="text-warning">Amarillo</span> Gestión Preventiva
        </small> --}}
    </div>

    <div class="flex-grow-1 position-relative">
        <div class="chart position-absolute top-50 start-50 translate-middle py-5">
            <canvas id="TotalAnomalias" width="920" height="500"></canvas>
        </div>
    </div>

</div>