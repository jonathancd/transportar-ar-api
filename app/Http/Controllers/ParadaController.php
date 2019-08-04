<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Horario;
use App\Sector;
use App\Ruta;
use App\Parada;
use App\ParadaHorario;

class ParadaController extends Controller
{
    
    public function create($id_ruta){

        $ruta = Ruta::find($id_ruta);

        if($ruta){
            return view("paradas.create", ["ruta" => $ruta]);
        }

        return redirect()->back()->with('status', "Error, Ruta no encontrada.");
    }


    public function store(Request $request){

        $this->validate($request,[
            "nombre" => "required",
            "referencia" => "required",
            "ruta" => "required"
        ]);

        $parada = new Parada;
        $parada->id_ruta = $request->ruta;
        $parada->nombre = $request->nombre;
        $parada->referencia = $request->referencia;
        // $parada->activo = 1;

        if($parada->save()){

            $ruta = Ruta::find($parada->id_ruta);

            return redirect("/admin/sectores/".$ruta->id_sector."/rutas/".$ruta->id)->with('status', "Parada guardada exitosamente.");
        }

        return redirect()->back()->with('status', "Ha ocurrido un error al tratar de guardar la parada.");
    }



    public function show($id_ruta, $id_parada){


        $parada = Parada::find($id_parada);
        

        if($parada){

            $ruta = Ruta::find($id_ruta);
            $horarios = Horario::all();

            foreach($horarios as $horario){
                $horario->parada = ParadaHorario::where([ 'id_parada' => $parada->id, 'id_horario' => $horario->id])->first();
            }


            return view('paradas.show', ["ruta" => $ruta, "parada" => $parada, "horarios" => $horarios]);
        }

        return redirect()->back()->with('status', "Error, Parada no encontrada.");
    }



    public function edit($id_ruta, $id_parada){

        $parada = Parada::find($id_parada);
        $ruta = Ruta::find($id_ruta);

        if($parada){
            return view("paradas.edit", ["ruta" => $ruta, "parada" => $parada]);
        }

        return redirect()->back()->with('status', "Error, Parada no encontrada.");
    }



    public function update(Request $request, $id_ruta, $id_parada){

        $parada = Parada::find($id_parada);

        if($parada){
            $this->validate($request,[
                "nombre" => "required",
                "referencia" => "required"
            ]);

            $parada->nombre = $request->nombre;
            $parada->referencia = $request->referencia;

            if($parada->save()){

                $ruta = Ruta::find($parada->id_ruta);

                return redirect("/admin/sectores/".$ruta->id_sector."/rutas/".$ruta->id)->with('status', "Parada actualizada exitosamente.");
            }

            return redirect()->back()->with('status', "Ha ocurrido un error al tratar de actualizar la parada.");
        }

        return redirect()->back()->with('status', "Error, Parada no encontrada.");
    }



    public function destroy(Request $request){

        $id = $request->id;

        if(!empty($id)){
            $parada = Parada::find($id);

            if($parada){
                if($parada->delete())
                    return redirect()->back()->with('status', "Parada eliminada exitosamente.");
                else
                    return redirect()->back()->with('status', "Error al tratar de eliminar la Parada.");
            }

            return redirect()->back()->with('status', "Error, Parada no encontrado.");
        }

        return redirect()->back()->with('status', "Error, no se ha recibido el id de la Parada.");
    }
}
