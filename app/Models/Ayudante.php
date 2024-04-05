<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ayudante extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['centro','id','nombre','documento'];

    public function recorridos(){
        return $this->hasMany(Recorrido::class);
    }
}
