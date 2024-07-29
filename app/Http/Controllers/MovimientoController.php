<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Movimiento;

use Carbon\Carbon;
use Validator;

class MovimientoController extends Controller
{
    public function movimiento(Request $request)
    {
        if (session()->has('usuarioConectado')) {
            $movimientos = Movimiento::all();
            foreach ($movimientos as $movimiento) {
                $usuario = Usuario::where('idUsuario', $movimiento->idUsuario)->first();
                $movimiento->idUsuario = $usuario;
            }
            return view('movimiento.movimiento', compact('movimientos'));
        } else {
            return redirect()->route('menu');
        }
    }

    public function crearMovimiento(Request $request){
        if (session()->has('usuarioConectado')){
            return view('movimiento.crearMovimiento');
        }else{
            return redirect()->route('menu');
        }
    }

    //Para validar el registro nuevo movimiento
    public function validaMovimiento(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nombreMovimiento' => 'required',
            'detalleMovimiento' => 'required'
        ]);

        if ($validator->passes()) {

            return response()->json(['success'=>'Movimiento valido']);

        }else{
            return response()->json(['error'=>$validator->errors()]);
        }
    }


    public function agregarMovimiento(Request $request)
    {

        try {
            $movimiento = new Movimiento();
            $movimiento->nombreMovimiento = $request->nombreMovimiento;
            $movimiento->detalleMovimiento = $request->detalleMovimiento;
            $movimiento->idUsuario = session('usuarioConectado')['idUsuario'];
            $movimiento->save();
            return response()->json(['success'=>'Movimiento registrado exitosamente']);
        }
        catch(\Exception  $e)
        {
            return response()->json(['error'=>$e->getMessage()]);
        }


    }

    public function eliminarMovimiento($idMovimiento){

        try {
            $movimiento = Movimiento::where('idMovimiento',$idMovimiento)->first();
            $movimiento->delete();
            return response()->json(['success'=>'Movimiento eliminado exitosamente']);
        }
        catch(\Exception  $e)
        {
            return response()->json(['error'=>$e->getMessage()]);
        }
    }

    public function editarMovimiento($idMovimiento)
    {
        $movimiento = Movimiento::where('idMovimiento',$idMovimiento)->first();
        return view('movimiento.editarMovimiento', compact('movimiento'));
    }

    public function updateMovimiento(Request $request, $idMovimiento){

        $movimientoActualizado = Movimiento::where('idMovimiento',$idMovimiento)->first();

        $movimientoActualizado->nombreMovimiento = $request->nombreMovimiento;
        $movimientoActualizado->detalleMovimiento = $request->detalleMovimiento;
        $movimientoActualizado->idUsuario = session('usuarioConectado')['idUsuario'];
        $movimientoActualizado->save();

        return response()->json(['success'=>'Movimiento editado exitosamente']);

        

    }

}
