<?php

namespace App\Traits;

use App\Enums\CDS;
use App\Models\History;
use Illuminate\Support\Facades\DB;

trait GetCurrentHistoryTable{

    public function updateHistory(){
        foreach(CDS::cases() as $c):
            $consulta = DB::connection($c->value)->select("
            select '$c->value' centro
                , m.nombre movil
                , c.nombre chofer
                , p.nombre punto
                , r.viaje
                , current_date fecha
                , r.inicio
                , r.fin
                , r.target
                , r.ponderacion
                , r.estado
                , case
                    when fin is null then 'SI'
                    when fin is not null and (r.fin - r.inicio) between p.minimo and p.maximo then 'SI'
                    else 'NO'
                end aplica
            from recorridos r
                join moviles m on m.id = r.moviles_id
                join choferes c on c.id = r.choferes_id
                join puntos p on p.id = r.puntos_id
            where r.tiers_id = 1
                and cast(r.inicio as date) = current_date
            ");

            foreach($consulta as $line):

                History::updateOrCreate(
                    [
                        'centro' => $line->centro,
                        'movil' => $line->movil,
                        'chofer' => $line->chofer,
                        'punto' => $line->punto,
                        'viaje' => $line->viaje,
                        'fecha' => $line->fecha,
                    ],
                    [
                        'inicio' => $line->inicio,
                        'fin' => $line->fin,
                        'target' => $line->target,
                        'ponderacion' => $line->ponderacion,
                        'estado' => $line->estado,
                        'aplica' => $line->aplica,
                    ]
                );

            endforeach;
            
        endforeach;
    }

}