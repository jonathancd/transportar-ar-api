<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sector;
use App\Ruta;
use App\Parada;

class RutaController extends Controller
{


    public function create($id_sector){

    	$sector = Sector::find($id_sector);

    	if($sector){
    		return view("rutas.create", ["sector" => $sector]);
    	}

    	return redirect()->back()->with('status', "Error, Sector no encontrado.");
    }


    public function store(Request $request){

    	$this->validate($request,[
    		"nombre" => "required",
    		"sector" => "required"
    	]);

    	$ruta = new Ruta;
    	$ruta->id_sector = $request->sector;
    	$ruta->nombre = $request->nombre;
    	$ruta->activo = 1;

    	if($ruta->save()){
    		return redirect("/admin/sectores/".$ruta->id_sector)->with('status', "Ruta guardada exitosamente.");
    	}

    	return redirect()->back()->with('status', "Ha ocurrido un error al tratar de guardar la ruta.");
    }



    public function show($id_sector,$id_ruta){

        $ruta = Ruta::find($id_ruta);
        $sector = Sector::find($id_sector);

        if($ruta){

            $ruta->paradas = Parada::where('id_ruta', $ruta->id)->get();

            return view('rutas.show', ["ruta" => $ruta, "sector" => $sector]);
        }

        return redirect()->back()->with('status', "Error, Ruta no encontrada.");
    }



    public function edit($id_sector, $id_ruta){

    	$ruta = Ruta::find($id_ruta);
    	$sector = Sector::find($id_sector);

    	if($ruta){
    		return view("rutas.edit", ["ruta" => $ruta, "sector" => $sector]);
    	}

    	return redirect()->back()->with('status', "Error, Ruta no encontrado.");
    }



    public function update(Request $request, $id_sector, $id_ruta){

    	$ruta = Ruta::find($id_ruta);

    	if($ruta){
	    	$this->validate($request,[
	    		"nombre" => "required"
	    	]);

	    	$ruta->nombre = $request->nombre;

	    	if($ruta->save()){
	    		return redirect("/admin/sectores/".$ruta->id_sector)->with('status', "Ruta actualizada exitosamente.");
	    	}

	    	return redirect()->back()->with('status', "Ha ocurrido un error al tratar de actualizar la ruta.");
	    }

	    return redirect()->back()->with('status', "Error, Ruta no encontrado.");
    }


    public function activar(Request $request){

        // return "Ruta activar";

    	$ruta = Ruta::find($request->id);

    	if($ruta){

    		if($ruta->activo == 1)
	    		$ruta->activo = 0;
	    	else
	    		$ruta->activo = 1;

	    	if($ruta->save()){

	    		$msj = "";

	    		switch ($ruta->activo){
	    			case 0: 
	    				$msj = "Ruta desactivada exitosamente.";
	    				break;
	    			case 1:
	    				$msj = "Ruta activada exitosamente";
	    				break;
	    		}

	    		// return redirect("/admin/sectores/".$ruta->id)->with('status', $msj);
                return redirect()->back()->with('status', $msj);
	    	}


	    	return redirect()->back()->with('status', "Ha ocurrido un error al tratar de actualizar la ruta.");
	    }

	    return redirect()->back()->with('status', "Error, Ruta no encontrado.");
    }


    public function destroy(Request $request){

    	$id = $request->id;

    	if(!empty($id)){
    		$ruta = Ruta::find($id);

    		if($ruta){
    			if($ruta->delete())
    				return redirect()->back()->with('status', "Ruta eliminado exitosamente.");
    			else
    				return redirect()->back()->with('status', "Error al tratar de eliminar la ruta.");
    		}

    		return redirect()->back()->with('status', "Error, Ruta no encontrado.");
    	}

    	return redirect()->back()->with('status', "Error, no se ha recibido el id de la ruta.");
    }
    
}
