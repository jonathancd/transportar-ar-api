<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Horario;
use App\Parada;
use App\ParadaHorario;
use App\Ruta;
use App\Sector;
use App\Sede;


class ApiController extends Controller
{
    
	public function inicio(){

		$horarios = Horario::all();

		$sedes = collect();


		foreach(Sede::all() as $sede){

			$sectores = collect();

			foreach(Sector::where('id_sede',$sede->id)->get() as $sector){

				$rutas = collect();

				foreach(Ruta::where('id_sector', $sector->id)->get() as $ruta){

					$paradas = collect();

					foreach(Parada::where('id_ruta', $ruta->id)->get() as $parada){

						if(ParadaHorario::where(['id_parada' => $parada->id])->count() > 0){
							$paradas->push($parada);
						}

					}

					if(count ($paradas) > 0){
						$rutas->push($ruta);
					}

				}

				if(count($rutas)>0){
					$sector->rutas = $rutas;

					$sectores->push($sector);
				}

			}

			if(count($sectores) > 0){
				$sede->sectores = $sectores;

				$sedes->push($sede);
			}
		}

		return response()->json([
					'status' => 200,
					'sedes' =>  $sedes,
					'horarios' => $horarios
				]);
	}





	public function ruta($id_ruta, $id_horario){

		$ruta = Ruta::find($id_ruta);

		$paradas = collect();

		if($ruta){

			$paradas = Ruta::paradas($id_ruta, $id_horario);


			// $paradas_ruta = Parada::where('id_ruta', $ruta->id)->get();

			// foreach($paradas_ruta as $parada){

			// 	if(empty($id_horario))
			// 		$id_horario = 1;

			// 	$parada_horario = ParadaHorario::where(['id_parada' => $parada->id, 'id_horario' => $id_horario])->first();

			// 	if(!empty($parada_horario)){

			// 		$parada->datos = $parada_horario;

			// 		$paradas->push($parada);
			// 	}

			// }

			return response()->json([
					'status' => 200,
					'paradas' => $paradas
				]);
		}

		return response()->json([
					'status' => 404,
					'msj' => "No hay paradas para esta Ruta"
				]);
	}



	public function sector($id_sector, $id_horario){

		$sector = Sector::find($id_sector);

		$paradas = collect();

		if($sector){

			$paradas = Sector::paradas($id_sector, $id_horario);

			// $rutas = Ruta::where('id_sector', $sector->id)->get();

			// foreach($rutas as $ruta){

			// 	foreach(Parada::where('id_ruta', $ruta->id)->get() as $parada){

			// 		if(empty($id_horario))
			// 			$id_horario = 1;

			// 		$parada_horario = ParadaHorario::where(['id_parada' => $parada->id, 'id_horario' => $id_horario])->first();

			// 		if(!empty($parada_horario)){

			// 			$parada->datos = $parada_horario;

			// 			$paradas->push($parada);
			// 		}

			// 	}
			// }


			return response()->json([
					'status' => 200,
					'paradas' => $paradas
				]);
		}

		return response()->json([
					'status' => 404,
					'msj' => "No hay paradas para este Sector"
				]);
	}

}
