<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['centro','id','fecha','chofers_id','movils_id', 'viaje', 'hora_esperada', 'corresponde', 'ayudantes_id'];

    public function movils(){
        return $this->belongsTo(Movil::class);
    }

    public function chofers(){
        return $this->belongsTo(Chofer::class);
    }

    public function ayudantes(){
        return $this->belongsTo(Ayudante::class);
    }
}
