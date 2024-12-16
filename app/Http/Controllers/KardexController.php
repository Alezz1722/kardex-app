<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kardex;
use App\Models\Usuario;
use App\Models\Movimiento;

use Carbon\Carbon;
use Validator;

class KardexController extends Controller
{
    public function kardex(Request $request)
    {
        if (session()->has('usuarioConectado')) {
            $idusuario = session('usuarioConectado')['idUsuario'];
            $kardexs = Kardex::orderBy('fechaKardex', 'desc')->get();
            foreach ($kardexs as $kardex) {
                $usuario = Usuario::where('idUsuario', $kardex->idUsuario)->first();
                $kardex->idUsuario = $usuario;

                $movimiento = Movimiento::where('idMovimiento', $kardex->idMovimiento)->first();
                $kardex->idMovimiento = $movimiento;
            }


            #$actividades = Kardex::where('idUsuario', '=', $idusuario)->get();
            #foreach ($actividades as $actividad) {
            #    $periodo = Periodo::where('idPeriodo', $actividad->idPeriodo)->first();
            #    $actividad->idPeriodo = $periodo;
            #    $lugar = Lugar::where('idLugar', $actividad->idLugar)->first();
            #    $actividad->idLugar = $lugar;
            #}
            return view('kardex.kardex', compact('kardexs'));
        } else {
            return redirect()->route('menu');
        }
    }

    public function crearKardex(Request $request)
    {
        if (session()->has('usuarioConectado')) {
            $movimientos = Movimiento::where('estadoMovimiento', '1')->get();
            return view('kardex.crearKardex', compact('movimientos'));
        } else {
            return redirect()->route('menu');
        }
    }

    //Para validar el registro nuevo kardex
    public function validaKardex(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'fechaKardex' => 'required',
            'tipoKardex' => 'required',
            'idMovimiento' => 'required',
            'detalleKardex' => 'required',
            'observacionKardex' => 'required',
            'estadoKardex' => 'required',
            'montoKardex' => 'required'
        ]);

        if ($validator->passes()) {

            return response()->json(['success'=>'Movimiento valido']);

        }else{
            return response()->json(['error'=>$validator->errors()]);
        }
    }

    public function agregarKardex(Request $request)
    {

        try {
            $kardex = new Kardex();
            $kardex->fechaKardex = $request->fechaKardex;
            $kardex->tipoKardex = $request->tipoKardex;
            $kardex->detalleKardex = $request->detalleKardex;
            $kardex->estadoKardex = $request->estadoKardex;
            $kardex->observacionKardex = $request->observacionKardex;
            $kardex->idMovimiento = $request->idMovimiento;
            $kardex->montoKardex = $request->montoKardex;
            $kardex->idUsuario = session('usuarioConectado')['idUsuario'];
            $kardex->save();
            return response()->json(['success'=>'Ingreso/egreso registrado exitosamente']);
        }
        catch(\Exception  $e)
        {
            return response()->json(['error'=>$e->getMessage()]);
        }


    }

    public function eliminarKardex($idKardex){

        try {
            $kardex = Kardex::where('idKardex',$idKardex)->first();
            $kardex->delete();
            return response()->json(['success'=>'Ingreso/Egreso eliminado exitosamente']);
        }
        catch(\Exception  $e)
        {
            return response()->json(['error'=>$e->getMessage()]);
        }
    }

    public function editarKardex($idKardex)
    {
        $kardex = Kardex::where('idKardex',$idKardex)->first();
        #$movimientos= Movimiento::all();
        $movimientos = Movimiento::where('estadoMovimiento', '1')->get();

        return view('kardex.editarKardex', compact('kardex','movimientos'));
    }

    public function updateKardex(Request $request, $idKardex)
    {

        $kardexActualizado = Kardex::where('idKardex', $idKardex)->first();
        $kardexActualizado->fechaKardex = $request->fechaKardex;
        $kardexActualizado->tipoKardex = $request->tipoKardex;
        $kardexActualizado->detalleKardex = $request->detalleKardex;
        $kardexActualizado->estadoKardex = $request->estadoKardex;
        $kardexActualizado->observacionKardex = $request->observacionKardex;
        $kardexActualizado->idMovimiento = $request->idMovimiento;
        $kardexActualizado->montoKardex = $request->montoKardex;
        $kardexActualizado->idUsuario = session('usuarioConectado')['idUsuario'];

        $kardexActualizado->save();

        return response()->json(['success' => 'Ingreso/Egreso editada exitosamente']);
    }



}
