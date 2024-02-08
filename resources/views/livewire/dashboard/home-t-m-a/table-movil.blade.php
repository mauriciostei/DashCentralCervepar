<div class="card card-body table-responsive m-3">
    <caption>Móviles circulantes</caption>
    <table class="table table-sm table-hover table-striped table-dark">
        <thead>
            <th>
                @livewire('components.off-canvas', ['titulo' => 'Centros', 'columna' => 'centro'])
            </th>
            <th>
                @livewire('components.off-canvas', ['tabla' => 'movil', 'titulo' => 'Móviles', 'columna' => 'movil'])
            </th>
            <th>
                @livewire('components.off-canvas', ['tabla' => 'operador', 'titulo' => 'OL', 'columna' => 'operador'])
            </th>
            <th>
                @livewire('components.off-canvas', ['tabla' => 'punto', 'titulo' => 'Sitio', 'columna' => 'punto'])
            </th>
            <th>
                @livewire('components.off-canvas', ['titulo' => 'Duración', 'columna' => 'duracion'])
            </th>
            <th>
                @livewire('components.off-canvas', ['titulo' => 'TMA', 'columna' => 'tma'])
            </th>
        </thead>
        <tbody>
            @forelse($tabla as $d)
                @if(in_array($d['movil'], $moviles) && in_array($d['operador'], $operadoras) && in_array($d['punto'], $puntos))
                    <tr>
                        <td> {{ $d['centro'] }} </td>
                        <td> {{ $d['movil'] }} </td>
                        <td> {{ $d['operador'] }} </td>
                        <td> {{ $d['punto'] }} </td>
                        <td> {{ date('H:i:s', strtotime($d['duracion'])) }} </td>
                        <td class="{{ !$d['tma_roto'] ? 'text-success' : 'text-danger' }} w-10"> {{ date('H:i:s', strtotime($d['tma'])) }} </td>
                    </tr>
                @endif
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