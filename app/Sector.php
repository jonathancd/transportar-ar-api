<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Sector extends Model
{
    protected $table = "sectores";

    public static function paradas($id_sector, $id_horario){
    	$paradas = DB::select('select distinct rutas.id as id_ruta, rutas.nombre as ruta_nombre, paradas.referencia, parada_horario.id_parada, paradas.nombre as nombre, parada_horario.id_horario, parada_horario.orden, parada_horario.latitud, parada_horario.altitud, parada_horario.longitud
				FROM sectores
				INNER JOIN rutas ON (rutas.id_sector='.$id_sector.')
                INNER JOIN paradas ON (paradas.id_ruta = rutas.id)
                INNER JOIN parada_horario ON (parada_horario.id_parada = paradas.id)
				WHERE parada_horario.id_horario = '.$id_horario.'
                ORDER BY rutaS.nombre, parada_horario.orden');

    	return $paradas;
    }
}