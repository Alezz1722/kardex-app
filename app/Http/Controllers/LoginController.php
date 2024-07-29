<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;

class LoginController extends Controller
{
    //login

    public function login(){
        return view('iniciasesion');
    }

    public function acceso(Request $request){
        // return $request->all();

        $request->validate([
            'correo'=> 'required',
            'contrasena'=>'required'
        ]);



        try {
            $usuario = Usuario::select('*')
            ->where('correoUsuario', '=',$request->correo)
            ->where('contrasenaUsuario', '=',md5($request->contrasena))
            ->get()->first();

            if($usuario){//Cuando fue encontrado el usuario
                $request->session()->put('usuarioConectado',$usuario);
                return redirect()->route('menu');
                //return back()->with('mensaje', 'El usuario fue encontrado');
            }else{
                return back()->with('mensajeError', 'El nombre de usuario y/o contraseña no fue el correcto.');

            }
        }
        catch(\Exception  $e)
        {
            //return response()->json(['error'=>$e->getMessage()]);
            return back()->with('mensajeError', $e->getMessage());
        }
    }

    public function cerrarSesion(){
        session()->pull('usuarioConectado');
        return redirect()->route('menu');
    }

    public function usuario(Request $request)
    {
        if (session()->has('usuarioConectado')) {
            $idusuario = session('usuarioConectado')['idUsuario'];
            $usuario = Usuario::where('idUsuario', '=', $idusuario)->first();
            return view('usuario.editaUsuario', compact('usuario'));
        } else {
            return redirect()->route('menu');
        }
    }

    public function editaUsuario(Request $request)
    {

        $usuario = Usuario::where('idUsuario', session('usuarioConectado')['idUsuario'])->first();

        if ($usuario) {
            $usuario->nombreUsuario = $request->nombreUsuario;
            $usuario->apellidoUsuario = $request->apellidoUsuario;
            $usuario->correoUsuario = $request->correoUsuario;

            $usuario->save();

            $request->session()->put('usuarioConectado', $usuario);

            return back()->with('success', 'Tu información fue actualizada correctamente.');
        } else {
            return back()->with('error', 'Error al actualizar la información');
        }
    }

    public function passwordUsuario(Request $request)
    {

        if (session()->has('usuarioConectado')) {
            return view('usuario.cambiaPassword');
        } else {
            return redirect()->route('menu');
        }
    }

    public function editaPasswordUsuario(Request $request)
    {

        $usuario = Usuario::where('idUsuario', session('usuarioConectado')['idUsuario'])->first();

        if ($usuario) {

            if ($usuario->contrasenaUsuario == md5($request->contrasenaActualDocente)) {

                if ($usuario->contrasenaUsuario != md5($request->nuevaContrasenaDocente)) {

                    $usuario->contrasenaUsuario = md5($request->nuevaContrasenaDocente);
                    $usuario->save();

                    $request->session()->put('usuarioConectado', $usuario);

                    return back()->with('success', 'La contraseña fue actualizada correctamente.');
                } else {
                    return back()->with('error', 'La nueva contraseña dede ser diferente a la contraseña actual.');
                }
            } else {
                return back()->with('error', 'La contraseña actual no es la correcta.');
            }
        } else {
            return back()->with('error', 'Error al actualizar la información');
        }
    }
}
