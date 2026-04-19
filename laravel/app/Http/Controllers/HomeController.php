<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $usuario = null;

        if (session()->has('usuario_id')) {
            $usuario = [
                'id' => session('usuario_id'),
                'nombre' => session('usuario_nombre'),
                'rol' => session('usuario_rol')
            ];
        }

        return view('home', compact('usuario'));
    }
}