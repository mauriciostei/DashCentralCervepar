<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JornadaWarehouse extends Model
{
    use HasFactory;

    protected $primaryKey = ['centro','id'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['centro', 'id', 'colaboradores_id', 'puntos_id', 'fecha', 'fecha_hora'];

    public function puntos(){
        return $this->belongsTo(Punto::class);
    }

    public function colaboradores(){
        return $this->belongsTo(Colaboradores::class);
    }

    protected function setKeysForSelectQuery($query){
        $query
            ->where('centro', $this->getAttribute('centro'))
            ->where('id', $this->getAttribute('id'))
        ;
        return $query;
    }

    protected function setKeysForSaveQuery($query){
        $query
            ->where('centro', $this->getAttribute('centro'))
            ->where('id', $this->getAttribute('id'))
        ;
        return $query;
    }
}
