<?php

namespace App\Http\Controllers;

use App\Models\Gestora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GestoraController extends Controller
{
    public function index()
    {
        $gestoras = Gestora::withCount('incidencias')->get();

        return view('gestoras.index', compact('gestoras'));
    }

    public function create()
    {
        return view('gestoras.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'email'    => 'required|email|unique:gestoras,email',
            'password' => 'required|string|min:6',
            'telefono' => 'nullable|string|max:20',
            'comision' => 'required|numeric|min:0|max:100',
        ]);

        Gestora::create([
            'nombre'   => $request->nombre,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'telefono' => $request->telefono,
            'comision' => $request->comision,
        ]);

        return redirect()->route('gestoras.index')->with('success', 'Gestora creada correctamente.');
    }

    public function edit($id)
    {
        $gestora = Gestora::findOrFail($id);

        return view('gestoras.edit', compact('gestora'));
    }

    public function update(Request $request, $id)
    {
        $gestora = Gestora::findOrFail($id);

        $request->validate([
            'nombre'   => 'required|string|max:255',
            'email'    => 'required|email|unique:gestoras,email,' . $id,
            'telefono' => 'nullable|string|max:20',
            'comision' => 'required|numeric|min:0|max:100',
        ]);

        $datos = [
            'nombre'   => $request->nombre,
            'email'    => $request->email,
            'telefono' => $request->telefono,
            'comision' => $request->comision,
        ];

        if ($request->filled('password')) {
            $datos['password'] = Hash::make($request->password);
        }

        $gestora->update($datos);

        return redirect()->route('gestoras.index')->with('success', 'Gestora actualizada.');
    }

    public function destroy($id)
    {
        $gestora = Gestora::findOrFail($id);
        $gestora->delete();

        return redirect()->route('gestoras.index')->with('success', 'Gestora eliminada.');
    }
}
