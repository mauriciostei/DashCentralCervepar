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

            $danger = 0;
            $warning = 0;
            $success = 0;

            foreach($data as $reg):
                if($reg->tma_estado >= 1){
                    $danger++;
                }
                if($reg->tma_estado >= 0.7 && $reg->tma_estado < 1){
                    $warning++;
                }
                if($reg->tma_estado < 0.7){
                    $success++;
                }

                if($danger > 0){
                    $resultado = "bg-danger";
                }else{
                    if($warning > 0){
                        $resultado = "bg-warning";
                    }else{
                        $resultado = "bg-success";
                    }
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
