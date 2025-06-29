<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait GetCantidadAnomalias{

    public function getAnomalias($cd, $ini, $fin){
        try {
            return DB::connection($cd)->select("
            select '$cd' Centro
                , count(*) total
                , count(a.users_id) tratadas
            from recorridos r
                join alertas a on r.id = a.recorridos_id and a.tipos_alertas_id = 2
            where
                r.tiers_id = 1
                and cast(a.created_at as date) between '$ini' and '$fin'
            ");
        } catch (\Exception $e) {
            Log::warning("CD {$cd} - getAnomalias");
            return [];
        }
    }

}