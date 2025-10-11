<?php

namespace App\Traits;

use App\Enums\CDS;
use App\Models\CurrentData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait GetCurrentHomeTable{

    public function updateTable(){
        $table = [];

        foreach(CDS::cases() as $c):
            try {
                $consulta = DB::connection($c->value)->select("
                with datos as (
                    select r.moviles_id
                        , r.choferes_id
                        , r.puntos_id
                        , r.tiers_id
                        , r.inicio
                        , (
                            select min(inicio)
                            from recorridos
                            where cast(inicio as date) = cast(r.inicio as date)
                                and tiers_id = r.tiers_id
                                and moviles_id = r.moviles_id
                                and choferes_id = r.choferes_id
                                and viaje = r.viaje
                        ) primer_punto
                        , tv.tiempo_tma
                    from recorridos r
                        left join tiers_viajes tv on r.tiers_id = tv.tiers_id and r.viaje = tv.viajes_id
                    where cast(r.inicio as date) = current_date
                        and r.tiers_id = 1
                        and r.fin is null
                )
                select '$c->value' centro
                    , m.nombre movil
                    , o.nombre operador
                    , p.nombre punto
                    , d.inicio
                    , d.primer_punto
                    , d.tiempo_tma
                from datos d
                    join moviles m on m.id = d.moviles_id
                    join choferes c on c.id = d.choferes_id
                    join operadoras o on o.id = c.operadoras_id
                    join puntos p on p.id = d.puntos_id
                ");
                
                foreach($consulta as $line):
                    $table[] = $line;
                endforeach;
            } catch (\Exception $e) {
                Log::warning("CD {$c->value} - updateTable: {$e->getMessage()}");
            }
        endforeach;

        CurrentData::query()->truncate();

        foreach($table as $line):
            CurrentData::create([
                'centro' => $line->centro,
                'movil' => $line->movil,
                'operador' => $line->operador,
                'punto' => $line->punto,
                'inicio' => $line->inicio,
                'primer_punto' => $line->primer_punto,
                'tiempo_tma' => $line->tiempo_tma,
            ]);
        endforeach;
    }
}