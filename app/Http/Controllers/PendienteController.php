<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Usuario;
use App\Models\Pendiente;

use Carbon\Carbon;
use Validator;

class PendienteController extends Controller
{
    public function pendiente(Request $request)
    {
        if (session()->has('usuarioConectado')) {
            $pendientes = Pendiente::all();
            foreach ($pendientes as $pendiente) {
                $usuario = Usuario::where('idUsuario', $pendiente->idUsuario)->first();
                $pendiente->idUsuario = $usuario;
            }
            return view('pendiente.pendiente', compact('pendientes'));
        } else {
            return redirect()->route('menu');
        }
    }

    public function crearPendiente(Request $request){
        if (session()->has('usuarioConectado')){
            return view('pendiente.crearPendiente');
        }else{
            return redirect()->route('menu');
        }
    }


    //Para validar el registro nuevo pendiente
    public function validaPendiente(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nombrePendiente' => 'required',
            'detallePendiente' => 'required',
            'estadoPendiente' => 'required'
        ]);

        if ($validator->passes()) {

            return response()->json(['success'=>'Movimiento valido']);

        }else{
            return response()->json(['error'=>$validator->errors()]);
        }
    }


    public function agregarPendiente(Request $request)
    {

        try {
            $pendiente = new Pendiente();
            $pendiente->nombrePendiente = $request->nombrePendiente;
            $pendiente->detallePendiente = $request->detallePendiente;
            $pendiente->estadoPendiente = $request->estadoPendiente;
            $pendiente->idUsuario = session('usuarioConectado')['idUsuario'];
            $pendiente->save();
            return response()->json(['success'=>'Pendiente registrado exitosamente']);
        }
        catch(\Exception  $e)
        {
            return response()->json(['error'=>$e->getMessage()]);
        }


    }

    public function eliminarPendiente($idPendiente){

        try {
            $pendiente = Pendiente::where('idPendiente',$idPendiente)->first();
            $pendiente->delete();
            return response()->json(['success'=>'Pendiente eliminado exitosamente']);
        }
        catch(\Exception  $e)
        {
            return response()->json(['error'=>$e->getMessage()]);
        }
    }

    public function editarPendiente($idPendiente)
    {
        $pendiente = Pendiente::where('idPendiente',$idPendiente)->first();
        return view('pendiente.editarPendiente', compact('pendiente'));
    }

    public function updatePendiente(Request $request, $idPendiente){

        $pendienteActualizado = Pendiente::where('idPendiente',$idPendiente)->first();

        $pendienteActualizado->nombrePendiente = $request->nombrePendiente;
        $pendienteActualizado->detallePendiente = $request->detallePendiente;
        $pendienteActualizado->estadoPendiente = $request->estadoPendiente;
        $pendienteActualizado->idUsuario = session('usuarioConectado')['idUsuario'];
        $pendienteActualizado->save();

        return response()->json(['success'=>'Pendiente editado exitosamente']);

        

    }

}
