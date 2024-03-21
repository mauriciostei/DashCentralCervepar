<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movil extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['centro','id','tiers_id','nombre','chapa','chapa_trasera'];
}
