<?php

namespace App\Traits;

use App\Enums\CDS;
use App\Models\Plan;
use App\Models\Recorrido;
use Illuminate\Support\Facades\DB;

trait GetTransactionalData{

    public function updatePlans(){
        foreach(CDS::cases() as $c):
            $consulta = DB::connection($c->value)->select("select p.fecha, cmp.choferes_id, cmp.moviles_id, cmp.viaje, cmp.hora_esperada, cmp.corresponde
            from planes p
                join choferes_moviles_planes cmp on p.id = cmp.planes_id
            where fecha = current_date");

            foreach($consulta as $line):
                Plan::updateOrCreate(
                    [
                        'centro' => $c->value,
                        'fecha' => $line->fecha,
                        'chofers_id' => $line->choferes_id,
                        'movils_id' => $line->moviles_id,
                        'viaje' => $line->viaje,
                    ], 
                    [
                        'hora_esperada' => $line->hora_esperada,
                        'corresponde' => $line->corresponde,
                    ]);
            endforeach;
            
        endforeach;
    }

    public function updateRecorridos(){
        foreach(CDS::cases() as $c):
            $consulta = DB::connection($c->value)->select("select *
            from recorridos
            where cast(inicio as date) = current_date
                and id in (
                    select max(id)
                    from recorridos
                    where cast(inicio as date) = current_date
                    group by choferes_id, moviles_id, puntos_id, tiers_id, viaje
            )");

            foreach($consulta as $line):
                Recorrido::updateOrCreate(
                    [
                        'centro' => $c->value,
                        'fecha' => date('Y-m-d'),
                        'chofers_id' => $line->choferes_id,
                        'movils_id' => $line->moviles_id,
                        'puntos_id' => $line->puntos_id,
                        'tiers_id' => $line->tiers_id,
                        'viaje' => $line->viaje,
                        'inicio' => $line->inicio,
                        'target' => $line->target,
                        'ponderacion' => $line->ponderacion,
                    ], 
                    [
                        'fin' => $line->fin,
                        'estado' => $line->estado,
                    ]);
            endforeach;
            
        endforeach;
    }

}