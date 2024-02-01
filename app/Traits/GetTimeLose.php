<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait GetTimeLose{

    public function getTime($cd, $ini, $fin){
        return DB::connection($cd)->select("
        with
        analisis as (
            select cast(r.inicio as date) fecha, r.moviles_id, r.choferes_id, r.tiers_id, r.viaje
            from alertas a
                join recorridos r on r.id = a.recorridos_id
            where a.tipos_alertas_id = 2
                and r.tiers_id = 1
                and cast(a.created_at as date) between '$ini' and '$fin'
        )
        , datos as (
            select cast(inicio as date) fecha, moviles_id, choferes_id, tiers_id, viaje
                , count(*) puntos
                , sum(
                    case when fin is not null then 1
                    else 0
                end
                ) culminados
                , min(inicio) inicio
                , max(fin) fin
            from recorridos
            where cast(inicio as date) between '$ini' and '$fin'
                and tiers_id = 1
            group by cast(inicio as date), moviles_id, choferes_id, tiers_id, viaje
        )
        , resultados as (
            select d.puntos, d.culminados, d.inicio, d.fin, tv.tiempo_tma
                , case
                    when d.puntos > d.culminados then ( (current_date - inicio) - tv.tiempo_tma )
                    else ( (d.fin - d.inicio) - tv.tiempo_tma )
                end resultado
            from analisis a
                join datos d on 
                    a.fecha = d.fecha 
                    and a.moviles_id = d.moviles_id 
                    and a.choferes_id = d.choferes_id 
                    and a.tiers_id = d.tiers_id 
                    and a.viaje = d.viaje
                join tiers_viajes tv on tv.tiers_id = a.tiers_id and tv.viajes_id = a.viaje
        )

        select '$cd' Centro, sum(resultado) resultado
        from resultados
        ");
    }

}