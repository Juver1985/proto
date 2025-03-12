<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SolicitudController extends Controller
{
    public function show($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        return view('solicitudes.show', compact('solicitud'));
    }

    // Mostrar todas las solicitudes
    public function index(Request $request)
{
    $query = Solicitud::query();

    if ($request->has('tipo') && $request->tipo != '') {
        $query->where('tipo', $request->tipo);
    }

    if ($request->has('estado') && $request->estado != '') {
        $query->where('estado', $request->estado);
    }

    $solicitudes = $query->with('usuario')->paginate(10); // Paginación

    return view('solicitudes.index', compact('solicitudes'));
}

    // Mostrar formulario para crear una nueva solicitud
    public function create()
    {
        $usuarios = User::whereIn('role', ['admin', 'trabajador'])->get();
    return view('solicitudes.create', compact('usuarios'));
    }

    // Guardar una nueva solicitud en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'tipo' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);
    
        Solicitud::create([
            'usuario_id' => $request->usuario_id,
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
            'estado' => 'Pendiente',
        ]);
    
        return redirect()->route('solicitudes.index')->with('success', 'Solicitud creada correctamente.');
    }

    // Mostrar formulario para editar una solicitud
    public function edit($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        return view('solicitudes.edit', compact('solicitud'));
    }

    // Actualizar una solicitud
    public function update(Request $request, $id)
    {
        $request->validate([
            'tipo' => 'required|string|max:50',
            'descripcion' => 'required|string',
            'estado' => 'required|in:Pendiente,Aprobada,Rechazada'
        ]);

        $solicitud = Solicitud::findOrFail($id);
        $solicitud->update($request->all());

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud actualizada exitosamente.');
    }

    // Eliminar una solicitud
    public function destroy($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->delete();

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud eliminada correctamente.');
    }
}
