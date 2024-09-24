<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cookie;

class CookieController extends Controller
{
    public function index(Request $request){
        $mostrarCifrado = $request->input('cifrado', 'true') === 'true';
        $cookies = json_decode(request()->cookies->get('alumnos', '[]'), true);
        return view('cookies.index', compact('cookies', 'mostrarCifrado'));
    }

    public function create() {
        return view('cookies.create');
    }

    public function store(Request $request) {
        $alumnos = json_decode(Cookie::get('alumnos'), true) ?? [];
        $alumno = [
            'email' => Crypt::encryptString($request->email),
            'password' => Crypt::encryptString($request->password)
        ];
        $alumnos[] = $alumno;
        Cookie::queue('alumnos', json_encode($alumnos), 60);
        return redirect('/cookies/listado');
    }

    public function edit($pos){
    $cookies = json_decode(request()->cookies->get('alumnos', '[]'), true);

    if (isset($cookies[$pos])) {
        $alumno = $cookies[$pos];
        $alumno['email'] = Crypt::decryptString($alumno['email']);
        $alumno['password'] = Crypt::decryptString($alumno['password']);
        return view('cookies.editar', compact('alumno', 'pos'));
    }

    return redirect('/cookies/listado')->with('error', 'Alumno no encontrado');
}


    public function update($pos, Request $request) {
        $alumnos = json_decode(Cookie::get('alumnos'), true);
        $alumnos[$pos]['email'] = Crypt::encryptString($request->email);
        $alumnos[$pos]['password'] = Crypt::encryptString($request->password);
        Cookie::queue('alumnos', json_encode($alumnos), 60);
        return redirect('/cookies/listado');
    }

    public function destroy($pos) {
        $alumnos = json_decode(Cookie::get('alumnos'), true);
        unset($alumnos[$pos]);
        Cookie::queue('alumnos', json_encode(array_values($alumnos)), 60);
        return redirect('/cookies/listado');
    }

    public function vaciar() {
        Cookie::queue(Cookie::forget('alumnos'));
        return redirect('/cookies/listado');
    }

}
