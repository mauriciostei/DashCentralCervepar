<?php

namespace App\Traits;

use App\Enums\CDS;
use App\Models\Chofer;
use App\Models\Movil;
use App\Models\Punto;
use Illuminate\Support\Facades\DB;

trait GetStaticData{

    public function updateMovils(){
        foreach(CDS::cases() as $c):
            $consulta = DB::connection($c->value)->select("select id, tiers_id, nombre, chapa, chapa_trasera from moviles");

            foreach($consulta as $line):
                Movil::updateOrCreate([ 'centro' => $c->value, 'id' => $line->id ], [ 'tiers_id' => $line->tiers_id, 'nombre' => $line->nombre, 'chapa' => $line->chapa, 'chapa_trasera' => $line->chapa_trasera ]);
            endforeach;
            
        endforeach;
    }

    public function updateChofers(){
        foreach(CDS::cases() as $c):
            $consulta = DB::connection($c->value)->select("select c.id, c.nombre, documento, tiers_id, o.nombre operadora
            from choferes c
                left join operadoras o on c.operadoras_id = o.id");

            foreach($consulta as $line):
                Chofer::updateOrCreate([ 'centro' => $c->value, 'id' => $line->id ], [ 'tiers_id' => $line->tiers_id, 'nombre' => $line->nombre, 'documento' => $line->documento, 'operadora' => $line->operadora ]);
            endforeach;
            
        endforeach;
    }

    public function updatePuntos(){
        foreach(CDS::cases() as $c):
            $consulta = DB::connection($c->value)->select("select id, nombre, minimo, maximo, tiempos_financieros, tipo_tiempo, tiempos_fisicos from puntos");

            foreach($consulta as $line):
                Punto::updateOrCreate([ 'centro' => $c->value, 'id' => $line->id ], [ 'nombre' => $line->nombre, 'minimo' => $line->minimo, 'maximo' => $line->maximo, 'tiempos_financieros' => $line->tiempos_financieros, 'tipo_tiempo' => $line->tipo_tiempo, 'tiempos_fisicos' => $line->tiempos_fisicos ]);
            endforeach;
            
        endforeach;
    }

}