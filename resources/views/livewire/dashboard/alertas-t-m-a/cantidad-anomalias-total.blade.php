<div>
    <div class="d-flex flex-row justify-content-between align-items-center">
        <div class="card card-body d-flex flex-column justify-content-between m-3">
            <h5 class="text-center">Cantidad de Anomalías</h5>
            <div class="chart mx-auto">
                <canvas id="cantidadAnomalias" height="350"></canvas>
            </div>
            <small class="mt-3 text-center text-muted">El total de anomalías es de {{number_format($subTotal)}}</small>
        </div>
    
        <div class="card card-body d-flex flex-column justify-content-between m-3">
            <h5 class="text-center">Cantidad de Anomalías por resolver</h5>
            <div class="chart mx-auto">
                <canvas id="cantidadAnomaliasPendientes" height="350"></canvas>
            </div>
            <small class="mt-3 text-center text-muted">El total de anomalías por responder es de {{number_format($subTotalPendiente)}}</small>
        </div>
    </div>
</div>
