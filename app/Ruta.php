<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Ruta extends Model
{
    public static function paradas($id_ruta, $id_horario){
    	$paradas = DB::select('select distinct paradas.*, parada_horario.id as id_parada_horario, parada_horario.id_horario, parada_horario.orden, 	parada_horario.latitud, parada_horario.altitud, parada_horario.longitud
				FROM paradas 
				INNER JOIN rutas ON (paradas.id_ruta='.$id_ruta.')
				INNER JOIN parada_horario ON (parada_horario.id_parada = paradas.id)
				WHERE parada_horario.id_horario = '.$id_horario.'
				ORDER BY parada_horario.orden');

    	return $paradas;
    }
}
