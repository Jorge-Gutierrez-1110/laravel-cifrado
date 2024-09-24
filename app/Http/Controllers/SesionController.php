<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SesionController extends Controller
{
    public function index(Request $request){
        $mostrarCifrado = $request->input('cifrado', 'true') === 'true';
        $alumnos = session('alumnos', []);

        return view('/sesiones/index', compact('alumnos', 'mostrarCifrado'));
    }


    public function create() {
        return view('/sesiones/create');
    }

    public function store(Request $request) {
        $alumnos = session('alumnos', []);
        $alumno = [
            'email' => Crypt::encryptString($request->email),
            'password' => Crypt::encryptString($request->password)
        ];
        session()->push('alumnos', $alumno);
        return redirect('/sesiones/listado');
    }

    public function edit($pos){
        $alumnos = session('alumnos');
        $alumnos[$pos]['email'] = Crypt::decryptString($alumnos[$pos]['email']);
        $alumnos[$pos]['password'] = Crypt::decryptString($alumnos[$pos]['password']);

        return view('/sesiones/editar')->with('alumno', $alumnos[$pos])->with('pos', $pos);
    }

    public function update($pos, Request $request) {
        $alumnos = session('alumnos');
        $alumno = $alumnos[$pos];
        $alumno['email'] = Crypt::encryptString($request->email);
        $alumno['password'] = Crypt::encryptString($request->password);
        $alumnos[$pos] = $alumno;
        session()->put('alumnos', $alumnos);
        return redirect('/sesiones/listado');
    }

    public function show($pos){
        $alumnos = session('alumnos', []);
        if (isset($alumnos[$pos])) {
            $alumno = $alumnos[$pos];
            $alumno['email'] = Crypt::decryptString($alumno['email']);
            $alumno['password'] = Crypt::decryptString($alumno['password']);
            return view('sesiones.show', compact('alumno'));
        }
        return redirect('/sesiones/listado')->with('error', 'Alumno no encontrado');
    }


    public function destroy($pos) {
        $alumnos = session('alumnos', []);
        unset($alumnos[$pos]);
        session()->put('alumnos', array_values($alumnos));
        return redirect('/sesiones/listado');
    }

    public function vaciar() {
        session()->forget('alumnos');
        return redirect('/sesiones/listado');
    }
}

