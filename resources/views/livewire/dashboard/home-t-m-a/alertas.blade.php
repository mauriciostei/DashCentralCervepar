<div class="card card-body m-3 d-flex flex-column flex-grow-1" wire:poll.1s="getInfo">

    <div class="d-flex flex-row justify-content-between mb-3">
        <h5>Alertas de desvíos</h5>
        <small>
            <span class="text-danger">Rojo</span> Gestión Reactiva, <span class="text-warning">Amarillo</span> Gestión Preventiva
        </small>
    </div>

    <div class="d-flex flex-grow-1 flex-row p-2">
        @foreach($tabla as $line)
            <div class="{{$line['color']}} bg-gradient opacity-75 block flex-grow-1 shadow-lg rounded ms-1 me-1 position-relative" style="height: 237px;">
                <div class="position-absolute top-50 start-50 translate-middle">
                    <h1 style="text-shadow: 2px 2px 4px #000000;" class="font-weight-bold">
                        {{$line["centro"]}}
                    </h1>
                </div>
            </div>
        @endforeach
    </div>

</div>