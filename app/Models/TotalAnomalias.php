<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalAnomalias extends Model
{
    use HasFactory;

    protected $primaryKey = ['centro','fecha'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['centro','fecha','total','tratadas'];

    protected function setKeysForSelectQuery($query){
        $query
            ->where('centro', $this->getAttribute('centro'))
            ->where('fecha', $this->getAttribute('fecha'))
        ;
        return $query;
    }

    protected function setKeysForSaveQuery($query){
        $query
            ->where('centro', $this->getAttribute('centro'))
            ->where('fecha', $this->getAttribute('fecha'))
        ;
        return $query;
    }
}
