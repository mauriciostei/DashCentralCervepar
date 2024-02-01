<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait GetCantidadAnomalias{

    public function getAnomalias($cd, $ini, $fin){
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
    }

}