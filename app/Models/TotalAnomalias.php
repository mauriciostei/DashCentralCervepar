<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalAnomalias extends Model
{
    use HasFactory;

    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['centro','fecha','total','tratadas'];

    protected function setKeysForSelectQuery($query)
    {
        return $query
            ->where('centro', $this->getAttribute('centro'))
            ->where('fecha',  $this->getAttribute('fecha'));
    }

    protected function setKeysForSaveQuery($query)
    {
        return $query
            ->where('centro', $this->getOriginal('centro') ?? $this->centro)
            ->where('fecha',  $this->getOriginal('fecha')  ?? $this->fecha);
    }
}
