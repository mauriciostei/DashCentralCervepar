<div class="card card-body m-3 d-flex flex-column flex-grow-1" wire:poll.1s="getInfo">

    <div class="d-flex flex-row justify-content-between mb-3">
        <h5>Móviles Circulantes</h5>
        <small>Ordenado por <b>{{Str::upper($column)}}</b> de forma <b>{{$orden == 'asc' ? 'ASCENDENTE' : 'DESCENDIENTE'}}</b> </small>
    </div>

    <div class="table-responsive">
        <table class="table table-sm table-hover table-striped table-dark">
            <thead>
                <th>
                    @livewire('dashboard.home-t-m-a.search-internal', [ 'title' => 'Centros', 'column' => 'centro'])
                </th>
                <th>
                    @livewire('dashboard.home-t-m-a.search-internal', [ 'title' => 'Móviles', 'column' => 'movil'])
                </th>
                <th>
                    @livewire('dashboard.home-t-m-a.search-internal', [ 'title' => 'OL', 'column' => 'operador'])
                </th>
                <th>
                    TMA
                </th>
            </thead>
            <tbody>
                @forelse($tabla as $line)
                    <tr>
                        <td style="width: 25%;"> {{ $line->centro }} </td>
                        <td style="width: 25%;"> {{ $line->movil }} </td>
                        <td style="width: 25%;"> {{ $line->operador }} </td>
                        <td style="width: 25%;">
                            @if($line->tma_estado < 0.70)
                                <span class="text-success" style="text-shadow: 2px 2px 4px #000000;">{{ $line->tma }}</span>
                            @elseif($line->tma_estado >= 0.70 && $line->tma_estado < 1)
                                <span class="text-warning" style="text-shadow: 2px 2px 4px #000000;">{{ $line->tma }}</span>
                            @else
                                <span class="text-danger" style="text-shadow: 2px 2px 4px #000000;">{{ $line->tma }}</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <th class="text-center" colspan="100">Sin registros!</th>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3"></th>
                    <th style="text-shadow: 2px 2px 4px #000000;"> {{ $tiempo_perdido }} </th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>