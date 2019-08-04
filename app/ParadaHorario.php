<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class ParadaHorario extends Model
{
    protected $table = "parada_horario";

 	

    public static function getParadasHorarios($id_ruta, $id_horario){

        $paradas = DB::select('select DISTINCT paradas.* FROM paradas INNER JOIN parada_horario ON (parada_horario.id_parada=paradas.id) INNER JOIN rutas ON (rutas.id = paradas.id_ruta) WHERE rutas.id ='. $id_ruta.' AND parada_horario.id_horario ='. $id_horario .' ORDER BY parada_horario.orden');

        return $paradas;
    }



    public static function parada_existente_position($paradas, $parada_a_buscar){

    	for($i=0; $i < count($paradas) ; $i++){

    		if(intval($paradas[$i]) == intval($parada_a_buscar->id_parada) )
    			return $i+1;

		}

		return $parada_a_buscar->orden;
    }


    public static function parada_nueva_position($paradas){

    	for($i=0; $i < count($paradas) ; $i++){
			
    		if($paradas[$i] == 0 || $paradas[$i] == '0' )
    			return $i+1;

		}

		return -1;
    }


    public static function parada_horario_existentes($id_horario, $id_ruta, $id_parada_nueva){
    	$paradas = DB::select('select DISTINCT parada_horario.* FROM parada_horario INNER JOIN paradas ON (parada_horario.id_parada=paradas.id) INNER JOIN rutas ON (rutas.id = paradas.id_ruta) WHERE parada_horario.id_horario ='. $id_horario.' AND rutas.id = '.$id_ruta.' AND paradas.id <> '.intval($id_parada_nueva).' ORDER BY parada_horario.orden');

    	return $paradas;
    }

    public static function parada_horario_existentes_con_actual_incluida($id_horario, $id_ruta){
        $paradas = DB::select('select DISTINCT parada_horario.* FROM parada_horario INNER JOIN paradas ON (parada_horario.id_parada=paradas.id) INNER JOIN rutas ON (rutas.id = paradas.id_ruta) WHERE parada_horario.id_horario ='. $id_horario.' AND rutas.id = '.$id_ruta.' ORDER BY parada_horario.orden');

        return $paradas;
    }


}
