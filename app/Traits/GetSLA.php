<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait GetSLA{

    public function getSLA($cd, $ini, $fin){
        try {
            return DB::connection($cd)->select("
            select '$cd' Centro
                , COALESCE(sum(CASE WHEN corresponde THEN 1 ELSE 0 END),0) corresponde
                , COALESCE(sum(CASE WHEN corresponde THEN 0 ELSE 1 END),0) no_corresponde
            from alertas a
                join recorridos r on r.id = a.recorridos_id
                join planes p on p.fecha = cast(a.created_at as date)
                join choferes_moviles_planes cmp on
                    p.id = cmp.planes_id
                    and cmp.moviles_id = r.moviles_id
                    and cmp.choferes_id = r.choferes_id
                    and cmp.viaje = r.viaje
            where a.tipos_alertas_id = 2
                and r.tiers_id = 1
                and cast(a.created_at as date) between '$ini' and '$fin'
            ");
        } catch (\Exception $e) {
            Log::warning("CD {$cd} - getSLA: {$e->getMessage()}");
            return [];
        }
    }

}