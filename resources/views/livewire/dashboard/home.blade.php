<div wire:poll.1s="getInfo">

    @livewire('dashboard.home-t-m-a.grafica', ['cds' => $cds, 'tabla' => $tabla])

    @livewire('dashboard.home-t-m-a.table-movil', ['cds' => $cds, 'tabla' => $tabla])

</div>
