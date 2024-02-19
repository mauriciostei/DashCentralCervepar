<?php

namespace App\Livewire\Dashboard\HomeTMA;

use App\Models\CurrentData;
use Livewire\Component;

class SearchInternal extends Component
{
    public $search;
    public $title;
    public $column;
    public $list = [];
    public $filter;
    public $changes = false;

    public function mount($title, $column, $filter = true){
        $this->title = $title;
        $this->column = $column;
        $this->filter = $filter;
        if($filter){
            $this->getInfo();
        }
    }

    public function getInfo(){
        $data = CurrentData::select($this->column)->distinct()->pluck($this->column)->toArray();
        $current = array_column(array_filter($this->list, function($value){ return $value['visible']==false; }), 'nombre');
        $this->list = [];

        if(count($current) > 0){ $this->changes = true; }else{ $this->changes = false; }

        foreach($data as $line):
            $value = !in_array($line, $current);
            $this->list[] = Array('nombre' => $line, 'visible' => $value);
        endforeach;
        $this->updated();
    }

    public function changeAll($status){
        foreach($this->list as $key => $lis):
            $this->list[$key]['visible'] = $status;
        endforeach;
        $this->updated();
    }

    public function changeOrder($direccion){
        $this->dispatch('updateTableOrder', ['column' => $this->column, 'order' => $direccion]);
    }

    public function updated(){
        $lista = array_filter($this->list, function($var){ return $var['visible']; });
        $lista = array_column($lista, 'nombre');
        $this->dispatch("updateFilter$this->column", $lista);
    }

    public function render()
    {
        return view('livewire.dashboard.home-t-m-a.search-internal');
    }
}
