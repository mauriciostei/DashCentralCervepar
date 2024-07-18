<?php

namespace App\Traits;

use App\Enums\CDS;
use App\Models\JornadaWarehouse;
use App\Models\Plan;
use App\Models\Recorrido;
use Exception;
use Illuminate\Support\Facades\DB;

trait GetTransactionalData{

    public function updatePlans(){
        $table = [];

        foreach(CDS::cases() as $c):
            $consulta = DB::connection($c->value)->select("select '$c->value' centro, p.fecha, cmp.choferes_id, cmp.moviles_id, cmp.viaje, cmp.hora_esperada, cmp.corresponde, cmp.ayudantes_id
            from planes p
                join choferes_moviles_planes cmp on p.id = cmp.planes_id
            where fecha = current_date");

            foreach($consulta as $line):
                $table[] = $line;
            endforeach;
            
        endforeach;

        Plan::whereRaw('fecha = current_date')->delete();

        foreach($table as $line):
            try{
                Plan::create([
                    'centro' => $line->centro,
                    'fecha' => $line->fecha,
                    'chofers_id' => $line->choferes_id,
                    'movils_id' => $line->moviles_id,
                    'viaje' => $line->viaje,
                    'hora_esperada' => $line->hora_esperada,
                    'corresponde' => $line->corresponde,
                    'ayudantes_id' => $line->ayudantes_id,
                ]);
            }catch(Exception $err){}
        endforeach;
    }

    public function updateRecorridos($days = 0){
        $table = [];

        foreach(CDS::cases() as $c):
            $consulta = DB::connection($c->value)->select("with
            grupo_recorrido as (
                select '22:00:00'::time inicio, '24:00:00'::time fin, 'Noche' turno
                union
                select '00:00:00'::time inicio, '06:00:00'::time fin, 'Noche' turno
                union
                select '06:00:00', '14:00:00', 'Mañana'
                union
                select '14:00:00', '22:00:00', 'Tarde'
            ),
            reco as (
                select *,
                    '$c->value' centro,
                    current_date - $days fecha
                from recorridos
                where cast(inicio as date) = current_date - $days
            )
            
            select r.*, gr.turno
            from reco r
                left join grupo_recorrido gr on r.inicio::time between gr.inicio and gr.fin");

            foreach($consulta as $line):
                $table[] = $line;
            endforeach;
            
        endforeach;

        Recorrido::whereRaw("fecha = current_date - $days")->delete();

        foreach($table as $line):
            try{
                Recorrido::create([
                    'centro' => $line->centro,
                    'fecha' => $line->fecha,
                    'chofers_id' => $line->choferes_id,
                    'movils_id' => $line->moviles_id,
                    'puntos_id' => $line->puntos_id,
                    'tiers_id' => $line->tiers_id,
                    'viaje' => $line->viaje,
                    'inicio' => $line->inicio,
                    'target' => $line->target,
                    'ponderacion' => $line->ponderacion,
                    'fin' => $line->fin,
                    'estado' => $line->estado,
                    'turno' => $line->turno,
                    'ayudantes_id' => $line->ayudantes_id,
                ]);
            }catch(Exception $err){}
        endforeach;
    }

    public function updateWarehouse($days = 0){
        $table = [];

        foreach(CDS::cases() as $c):
            $consulta = DB::connection($c->value)->select("select *, cast(fecha_hora as date) fecha, '$c->value' centro
                from jornada_warehouses
                where cast(fecha_hora as date) = current_date - $days");

            foreach($consulta as $line):
                $table[] = $line;
            endforeach;
            
        endforeach;

        JornadaWarehouse::whereRaw("fecha = current_date - $days")->delete();

        foreach($table as $line):
            try{
                JornadaWarehouse::create([
                    'centro' => $line->centro,
                    'id' => $line->id,
                    'colaboradores_id' => $line->colaboradores_id,
                    'puntos_id' => $line->puntos_id,
                    'fecha' => $line->fecha,
                    'fecha_hora' => $line->fecha_hora,
                ]);
            }catch(Exception $err){}
        endforeach;
    }

}