<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recorrido extends Model
{
    use HasFactory;

    protected $primaryKey = ['centro','fecha','chofers_id','movils_id', 'puntos_id', 'tiers_id', 'viaje'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        // Datos PK
        'centro'
        ,'fecha'
        ,'chofers_id'
        ,'movils_id'
        , 'puntos_id'
        , 'tiers_id'
        , 'viaje'
        // Datos adicionales
        , 'inicio'
        , 'target'
        , 'ponderacion'
        , 'fin'
        , 'estado'
        , 'turno'
        , 'ayudantes_id'
    ];

    public function movils(){
        return $this->belongsTo(Movil::class);
    }

    public function chofers(){
        return $this->belongsTo(Chofer::class);
    }

    public function puntos(){
        return $this->belongsTo(Punto::class);
    }

    public function ayudantes(){
        return $this->belongsTo(Ayudante::class);
    }
}
