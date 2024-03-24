<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recorrido extends Model
{
    use HasFactory;

    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'centro'
        ,'fecha'
        ,'chofers_id'
        ,'movils_id'
        , 'viaje'
        , 'puntos_id'
        , 'tiers_id'
        , 'viaje'
        , 'inicio'
        , 'target'
        , 'ponderacion'
        , 'fin'
        , 'estado'
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
}
