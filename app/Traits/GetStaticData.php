<?php

namespace App\Traits;

use App\Enums\CDS;
use App\Models\Ayudante;
use App\Models\Chofer;
use App\Models\Colaboradores;
use App\Models\Movil;
use App\Models\Punto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait GetStaticData{

    public function updateMovils(){
        foreach(CDS::cases() as $c):
            try {
                $consulta = DB::connection($c->value)->select("select '$c->value' as centro, id, tiers_id, nombre, chapa, chapa_trasera from moviles");

                foreach($consulta as $line):
                    Movil::updateOrCreate([ 'centro' => $line->centro, 'id' => $line->id ], [ 'tiers_id' => $line->tiers_id, 'nombre' => $line->nombre, 'chapa' => $line->chapa, 'chapa_trasera' => $line->chapa_trasera ]);
                endforeach;
            } catch (\Exception $e) {
                Log::warning("CD {$c->value} - updateMovils {$e->getMessage()}");
            }
        endforeach;
    }

    public function updateChofers(){
        foreach(CDS::cases() as $c):
            try {
                $consulta = DB::connection($c->value)->select("select '$c->value' as centro, c.id, c.nombre, documento, tiers_id, o.nombre operadora
                from choferes c
                    left join operadoras o on c.operadoras_id = o.id");

                foreach($consulta as $line):
                    Chofer::updateOrCreate([ 'centro' => $line->centro, 'id' => $line->id ], [ 'tiers_id' => $line->tiers_id, 'nombre' => $line->nombre, 'documento' => $line->documento, 'operadora' => $line->operadora ]);
                endforeach;
            } catch (\Exception $e) {
                Log::warning("CD {$c->value} - updateChofers {$e->getMessage()}");
            }
        endforeach;
    }

    public function updatePuntos(){
        foreach(CDS::cases() as $c):
            try {
                $consulta = DB::connection($c->value)->select("select '$c->value' as centro, id, nombre, minimo, maximo, tiempos_financieros, tipo_tiempo, tiempos_fisicos from puntos");

                foreach($consulta as $line):
                    Punto::updateOrCreate([ 'centro' => $line->centro, 'id' => $line->id ], [ 'nombre' => $line->nombre, 'minimo' => $line->minimo, 'maximo' => $line->maximo, 'tiempos_financieros' => $line->tiempos_financieros, 'tipo_tiempo' => $line->tipo_tiempo, 'tiempos_fisicos' => $line->tiempos_fisicos ]);
                endforeach;
            } catch (\Exception $e) {
                Log::warning("CD {$c->value} - updatePuntos {$e->getMessage()}");
            }
        endforeach;
    }

    public function updateAyudantes(){
        foreach(CDS::cases() as $c):
            try {
                $consulta = DB::connection($c->value)->select("select '$c->value' as centro, * from ayudantes");

                foreach($consulta as $line):
                    Ayudante::updateOrCreate([ 'centro' => $line->centro, 'id' => $line->id ], [ 'nombre' => $line->nombre, 'documento' => $line->cedula ]);
                endforeach;
            } catch (\Exception $e) {
                Log::warning("CD {$c->value} - updateAyudantes {$e->getMessage()}");
            }
        endforeach;
    }

    public function updateColaboradores(){
        foreach(CDS::cases() as $c):
            try {
                $consulta = DB::connection($c->value)->select("select '$c->value' as centro, * from colaboradores");

                foreach($consulta as $line):
                    Colaboradores::updateOrCreate([ 'centro' => $line->centro, 'id' => $line->id ], [ 'nombre' => $line->nombre, 'documento' => $line->cedula ]);
                endforeach;
            } catch (\Exception $e) {
                Log::warning("CD {$c->value} - updateColaboradores {$e->getMessage()}");
            }
        endforeach;
    }

}