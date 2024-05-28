<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chofer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['centro','id','tiers_id','nombre','documento','operadora'];

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
