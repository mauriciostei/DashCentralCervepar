<?php

namespace App\Livewire\Dashboard\HomeTMA;

use App\Models\CurrentData;
use Livewire\Component;
use App\Enums\CDS;

class Alertas extends Component
{
    public $tabla;

    public function getInfo(){
        $this->tabla = Array();
        foreach(CDS::cases() as $line):

            $resultado = "bg-transparent";
            $data = CurrentData::where('centro', $line->value)->get();
            foreach($data as $reg):
                if($reg->tma_estado >= 1){
                    $resultado = "bg-danger";
                    break 2;
                }elseif($reg->tma_estado >= 0.70 && $reg->tma_estado < 1){
                    $resultado = "bg-warning";
                    break 2;
                }else{
                    $resultado = "bg-success";
                    break 2;
                }
            endforeach;

            $this->tabla[] = Array("centro" =>  $line->value, "color" => $resultado);
        endforeach;
    }

    public function render()
    {
        $this->getInfo();
        return view('livewire.dashboard.home-t-m-a.alertas');
    }
}
