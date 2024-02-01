<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait GetCurrentTMATable{

    public function getTMATableByCD($cd){
        return DB::connection($cd)->select("
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
                ) primer_punto
                , tv.tiempo_tma
            from recorridos r
                left join tiers_viajes tv on r.tiers_id = tv.tiers_id and r.viaje = tv.viajes_id
            where cast(r.inicio as date) = current_date
                and r.tiers_id = 1
                and r.fin is null
        )
        
        select '$cd' centro
            , m.nombre movil
            , o.nombre operador
            , p.nombre punto
            , current_timestamp - d.inicio duracion
            , current_timestamp - d.primer_punto tma
            , d.tiempo_tma
            , case
                when (current_timestamp - d.primer_punto) > d.tiempo_tma then true
                else false
            end tma_roto
            , case
                when (current_timestamp - d.primer_punto) > d.tiempo_tma then (current_timestamp - d.primer_punto) - d.tiempo_tma
                else '00:00:00'
            end tiempo_perdido
        from datos d
            join moviles m on m.id = d.moviles_id
            join choferes c on c.id = d.choferes_id
            join operadoras o on o.id = c.operadoras_id
            join puntos p on p.id = d.puntos_id
        ");
    }

}