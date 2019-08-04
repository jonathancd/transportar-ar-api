<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Horario;
use App\Parada;
use App\ParadaHorario;
use App\Ruta;

class ParadaHorarioController extends Controller
{
    
    public function __construct(){
		$this->messages = [
            'latitud.required' => "Debe seleccionar una posición en el mapa",
            'longitud.required' => "Debe seleccionar una posición en el mapa",
            'parada.required' => "Debe colocar la parada en una posición dentro del orden de la lista",
            'parada_horario.required' => "Debe colocar la parada en una posición dentro del orden de la lista"
        ];
    }


	public function create($id_parada, $id_horario){

		$parada = Parada::find($id_parada);
		$horario = Horario::find($id_horario);

        if($parada && $horario){

        	$ruta = Ruta::find($parada->id_ruta);
        	$ruta->paradas = ParadaHorario::getParadasHorarios($ruta->id, $horario->id);

            return view("paradas_horarios.create", ["parada" => $parada, "horario" => $horario, "ruta" => $ruta]);
        }

        return redirect()->back()->with('status', "Error, Parada no encontrada.");

	}


	public function edit($id_parada, $id_horario, $id_parada_horario){

		$parada_horario = ParadaHorario::find($id_parada_horario);	

        if($parada_horario){

        	$parada = Parada::find($id_parada);
			$horario = Horario::find($id_horario);

        	$ruta = Ruta::find($parada->id_ruta);

        	$ruta->paradas = ParadaHorario::getParadasHorarios($ruta->id, $horario->id);

            return view("paradas_horarios.edit", ["parada_horario" => $parada_horario,"parada" => $parada, "horario" => $horario, "ruta" => $ruta]);
        }

        return redirect()->back()->with('status', "Error, No se encontró información para esta parada en este horario.");
	}



	public function show($id_parada, $id_horario, $id_parada_horario){

		$parada_horario = ParadaHorario::find($id_parada_horario);	

        if($parada_horario){

        	$parada = Parada::find($id_parada);
			$horario = Horario::find($id_horario);

        	$ruta = Ruta::find($parada->id_ruta);
        	$ruta->paradas = ParadaHorario::getParadasHorarios($ruta->id, $horario->id);

            return view("paradas_horarios.show", ["parada_horario" => $parada_horario,"parada" => $parada, "horario" => $horario, "ruta" => $ruta]);
        }

        return redirect()->back()->with('status', "Error, no se encontró información para esta parada y horario.");

	}



	public function store(Request $request){

		$this->validate($request,[
    		"latitud" => "required",
    		"longitud" => "required",
    		"parada" => "required",
    		"paradas_horario" => "required"
    	], $this->messages);

		$parada_horario = new ParadaHorario;
		$parada_horario->id_parada = $request->get('parada');
		$parada_horario->id_horario = $request->get('horario');
		$parada_horario->latitud = $request->get('latitud');
		$parada_horario->longitud = $request->get('longitud');
		$parada_horario->altitud = 124.9596;
		$parada_horario_orden = ParadaHorario::parada_nueva_position($request->get('paradas_horario'));

		if($parada_horario_orden != -1)
			$parada_horario->orden = $parada_horario_orden;
		else
			$parada_horario->orden = count(ParadaHorario::where(["id_parada" => $request->get('parada'),"id_horario" => $request->get('horario')])->get())+1;


		if($parada_horario->save()){


			$parada = Parada::find($request->get('parada'));
			$ruta = Ruta::find($parada->id_ruta);
        	
			$paradas_en_este_horario = ParadaHorario::parada_horario_existentes($request->get('horario'), $ruta->id, $parada_horario->id_parada);

			foreach($paradas_en_este_horario as $parada_e){

				$parada_existente = ParadaHorario::find($parada_e->id);

				$parada_existente->orden = ParadaHorario::parada_existente_position($request->get('paradas_horario'), $parada_existente);

				$parada_existente->save();
			}


			$url_redirect = "/admin/rutas/".$request->get('ruta')."/paradas/".$request->get('parada');

			return redirect($url_redirect)->with('status', "Parada guardada exitosamente.");
		}

		return redirect()->back()->with('status', "Ha ocurrido un error al tratar de guardar la información de la parada.");
	}




	public function update(Request $request, $id_parada, $id_horario, $id_parada_horario){
		
		
		$this->validate($request,[
    		"latitud" => "required",
    		"longitud" => "required",
    		"parada" => "required",
    		"paradas_horario" => "required"
    	], $this->messages);


		$parada_horario = ParadaHorario::find($id_parada_horario);

		if($parada_horario){

			$parada_horario->latitud = $request->get('latitud');
			$parada_horario->longitud = $request->get('longitud');

			if($parada_horario->save()){

				$parada = Parada::find($request->get('parada'));
				$ruta = Ruta::find($parada->id_ruta);
	        	
				$paradas_en_este_horario = ParadaHorario::parada_horario_existentes_con_actual_incluida($request->get('horario'), $ruta->id);

				foreach($paradas_en_este_horario as $parada_e){

					$parada_existente = ParadaHorario::find($parada_e->id);

					$parada_existente->orden = ParadaHorario::parada_existente_position($request->get('paradas_horario'), $parada_existente);

					$parada_existente->save();
				}

				$url_redirect = "/admin/rutas/".$request->get('ruta')."/paradas/".$request->get('parada');

				return redirect($url_redirect)->with('status', "Parada actualizada exitosamente.");
			}

			return redirect()->back()->with('status', "Ha ocurrido un error al tratar de actualizar la información de la parada.");
		}

		return redirect()->back()->with('status', "Error, info no encontrada.");

	}




	public function destroy(Request $request){

		$id = $request->id;

    	if(!empty($id)){
    		$parada_horario = ParadaHorario::find($id);

    		if($parada_horario){

    			if($parada_horario->delete())
    				return redirect()->back()->with('status', "Información para este horario eliminada exitosamente.");
    			else
    				return redirect()->back()->with('status', "Error al tratar de eliminar la información para esta parada.");
    		}

    		return redirect()->back()->with('status', "Error, Información para este horario no encontrada.");
    	}

    	return redirect()->back()->with('status', "Error, no se ha recibido el id de la parada.");
	}



	public function test(Request $request){
		return $request->all();
	}

}
