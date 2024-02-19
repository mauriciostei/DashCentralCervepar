<div class="card card-body m-3 d-flex flex-column" wire:poll.1s="getInfo">

    <div class="d-flex flex-row justify-content-between mb-3">
        <h5>Móviles Circulantes</h5>
        <small>Ordenado por <b>{{Str::upper($column)}}</b> de forma <b>{{$orden == 'asc' ? 'ASCENDENTE' : 'DESCENDIENTE'}}</b> </small>
    </div>

    <div class="table-responsive" >
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
                    @livewire('dashboard.home-t-m-a.search-internal', [ 'title' => 'Sitio', 'column' => 'punto'])
                </th>
                <th>
                    Duración
                    {{-- @livewire('dashboard.home-t-m-a.search-internal', [ 'title' => 'Duración', 'column' => 'duracion', 'filter' => false]) --}}
                </th>
                <th>
                    TMA
                    {{-- @livewire('dashboard.home-t-m-a.search-internal', [ 'title' => 'TMA', 'column' => 'tma', 'filter' => false]) --}}
                </th>
            </thead>
            <tbody>
                @forelse($tabla as $line)
                    <tr>
                        <td> {{ $line->centro }} </td>
                        <td> {{ $line->movil }} </td>
                        <td> {{ $line->operador }} </td>
                        <td> {{ $line->punto }} </td>
                        <td>
                            {{ $line->duracion }}
                        </td>
                        <td class="{{ !$line->tma_roto ? 'text-success' : 'text-danger' }} w-10">
                            {{ $line->tma }}
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
                    <th colspan="5"></th>
                    <th> {{ $tiempo_perdido }} </th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>