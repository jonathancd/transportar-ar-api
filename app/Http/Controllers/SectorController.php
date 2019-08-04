<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sector;
use App\Ruta;

class SectorController extends Controller
{
    
    public function index(){

    	$sectores = Sector::all();

    	return view("sectores.index", ['sectores' => $sectores]);
    }


    public function create(){

    	return view("sectores.create");
    }


    public function store(Request $request){

    	$this->validate($request,[
    		"nombre" => "required"
    	]);

    	$sector = new Sector;
    	$sector->id_sede = 0;
    	$sector->nombre = $request->nombre;

    	if($sector->save()){
    		return redirect("/admin/sectores")->with('status', "Sector guardado exitosamente.");
    	}

    	return redirect()->back()->with('status', "Ha ocurrido un error al tratar de guardar el sector.");
    }


    public function show($id){
         // return "SECTOR SHOW";

        $sector = Sector::find($id);

        if($sector){

            $sector->rutas = Ruta::where('id_sector', $sector->id)->get();

            return view('sectores.show', ["sector" => $sector]);
        }

        return redirect()->back()->with('status', "Error, sector no encontrado.");
    }


    public function edit($id){

    	$sector = Sector::find($id);

    	if($sector){
    		return view("sectores.edit", ["sector" => $sector]);
    	}

    	return redirect()->back()->with('status', "Error, Sector no encontrado.");
    }


    public function update(Request $request, $id){
 // return "SECTOR UPDATE";
    	$sector = Sector::find($id);

    	if($sector){
	    	$this->validate($request,[
	    		"nombre" => "required"
	    	]);

	    	$sector->nombre = $request->nombre;

	    	if($sector->save()){
	    		return redirect("/admin/sectores")->with('status', "Sector actualizado exitosamente.");
	    	}

	    	return redirect()->back()->with('status', "Ha ocurrido un error al tratar de actualizar el sector.");
	    }

	    return redirect()->back()->with('status', "Error, Sector no encontrado.");
    }


    public function destroy(Request $request){

    	$id = $request->id;

    	if(!empty($id)){
    		$sector = Sector::find($id);

    		if($sector){
    			if($sector->delete())
    				return redirect()->back()->with('status', "Sector eliminado exitosamente.");
    			else
    				return redirect()->back()->with('status', "Error al tratar de eliminar sector.");
    		}

    		return redirect()->back()->with('status', "Error, sector no encontrado.");
    	}

    	return redirect()->back()->with('status', "Error, no se ha recibido el id del sector.");
    }

}
