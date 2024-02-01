<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait GetParetoMotivos{

    public function getPareto($cd, $ini, $fin){
        return DB::connection($cd)->select("
        select '$cd' Centro, c.id, c.nombre, count(*) cantidad
        from alertas a
            join causas c on c.id = a.causas_id
            join causa_raizs cr on cr.id = a.causa_raizs_id
        where a.tipos_alertas_id = 2
            and cast(a.created_at as date) between '$ini' and '$fin'
        group by c.id, c.nombre
        order by 3 desc
        ");
    }

}