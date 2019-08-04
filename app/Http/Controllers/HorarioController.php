<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Horario;
use Response;


class HorarioController extends Controller
{
    public function index(){

    	$horarios = Horario::all();

    	return view("horarios.index", ['horarios' => $horarios]);
    }


    public function create(){

    	return view("horarios.create");
    }


    public function store(Request $request){

    	$this->validate($request,[
    		"hora" => "required",
    		"activo" => "required"
    	]);

    	$horario = new Horario;
    	$horario->hora = $request->hora;
    	$horario->periodo = $request->periodo;
    	$horario->activo = $request->activo;

    	if($horario->save()){
    		return redirect("/admin/horarios")->with('status', "Horario guardado exitosamente.");
    	}

    	return redirect()->back()->with('status', "Ha ocurrido un error al tratar de guardar el horario.");
    }

    public function edit($id){

    	$horario = Horario::find($id);

    	if($horario){
    		return view("horarios.edit", ["horario" => $horario]);
    	}

    	return redirect()->back()->with('status', "Error, Horario no encontrado.");
    }


    public function update(Request $request, $id){

    	// return "update";

    	$horario = Horario::find($id);

    	if($horario){
	    	$this->validate($request,[
	    		"hora" => "required",
	    		"activo" => "required"
	    	]);

	    	$horario->hora = $request->hora;
	    	$horario->periodo = $request->periodo;
	    	$horario->activo = $request->activo;

	    	if($horario->save()){
	    		return redirect("/admin/horarios")->with('status', "Horario actualizado exitosamente.");
	    	}

	    	return redirect()->back()->with('status', "Ha ocurrido un error al tratar de actualizar el horario.");
	    }

	    return redirect()->back()->with('status', "Error, horario no encontrado.");
    }


    public function activar(Request $request){


    	$horario = Horario::find($request->id);

    	if($horario){

    		if($horario->activo == 1)
	    		$horario->activo = 0;
	    	else
	    		$horario->activo = 1;

	    	if($horario->save()){

	    		$msj = "";

	    		switch ($horario->activo){
	    			case 0: 
	    				$msj = "Horario desactivado exitosamente.";
	    				break;
	    			case 1:
	    				$msj = "Horario activado exitosamente";
	    				break;
	    		}

	    		return redirect("/admin/horarios")->with('status', $msj);
	    	}

	    	return redirect()->back()->with('status', "Ha ocurrido un error al tratar de actualizar el horario.");
	    }

	    return redirect()->back()->with('status', "Error, horario no encontrado.");
    }


    public function destroy(Request $request){

    	// return "destroy";

    	$id = $request->id;

    	if(!empty($id)){
    		$horario = Horario::find($id);

    		if($horario){
    			if($horario->delete())
    				return redirect()->back()->with('status', "Horario eliminado exitosamente.");
    			else
    				return redirect()->back()->with('status', "Error al tratar de eliminar horario.");
    		}

    		return redirect()->back()->with('status', "Error, horario no encontrado.");
    	}

    	return redirect()->back()->with('status', "Error, no se ha recibido el id del horario.");
    }
}
