<?php

namespace App\Models;

use App\Traits\AddTimeIntervals;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentData extends Model
{
    use HasFactory;
    use AddTimeIntervals;

    protected $fillable = ['centro','movil','operador','punto','inicio','primer_punto','tiempo_tma'];

    public function getDuracionAttribute(){
        $fecha_actual = date("Y-m-d H:i:s");
        $diferencia = strtotime($fecha_actual) - strtotime($this->inicio);
        return $this->toTime($diferencia);
    }

    public function getTMAAttribute(){
        $fecha_actual = date("Y-m-d H:i:s");
        $diferencia = strtotime($fecha_actual) - strtotime($this->primer_punto);
        return $this->toTime($diferencia);
    }

    public function getTMARotoAttribute(){
        $actual = $this->toSecond($this->tma);
        $corte = $this->toSecond($this->tiempo_tma);
        return $actual > $corte;
    }

    public function getTMAEstadoAttribute(){
        $actual = $this->toSecond($this->tma);
        $corte = $this->toSecond($this->tiempo_tma);
        if($corte>0){
            return $actual/$corte;
        } else {
            return 0;
        }
    }

    public function getTiempoPerdidoAttribute(){
        if($this->tma_roto){
            $actual = $this->toSecond($this->tma);
            $corte = $this->toSecond($this->tiempo_tma);
            return $this->toTime($actual - $corte);
        }
        return '00:00:00';
    }
}
