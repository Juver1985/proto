<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NuevaSolicitud;

class SolicitudController extends Controller
{
    public function show($id)
    {
        $solicitud = Solicitud::with('usuario')->findOrFail($id);
    
        // Marcar la notificación como leída
        foreach (auth()->user()->unreadNotifications as $notification) {
            if ($notification->data['solicitud_id'] == $id) {
                $notification->markAsRead();
            }
        }
    
        // Determinar qué layout usar según el rol del usuario autenticado
        $layout = match (auth()->user()->role) {
            'admin' => 'layouts.master',
            'mayordomo' => 'layouts.mastermayordomo',
            'trabajador' => 'layouts.mastertrabajador',
            default => 'layouts.master', // O cualquier layout por defecto
        };
    
        return view('solicitudes.show', compact('solicitud', 'layout'));
    }
    
    
    public function index()
    {
        $solicitudes = Solicitud::with('usuario')->get(); // O filtra según el destinatario
    
        // Determinar el layout correcto según el rol del usuario autenticado
        $layout = match (auth()->user()->role) {
            'admin' => 'layouts.master',
            'mayordomo' => 'layouts.mastermayordomo',
            'trabajador' => 'layouts.mastertrabajador',
            default => 'layouts.master', // Opcional: layout por defecto
        };
    
        return view('solicitudes.index', compact('solicitudes', 'layout'));
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
    
        // Guardar la solicitud y obtener el objeto creado
        $solicitud = Solicitud::create([
            'usuario_id' => $request->usuario_id,
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
            'estado' => 'Pendiente',
        ]);
    
        // Buscar el usuario destinatario y enviar la notificación
        $destinatario = User::find($request->usuario_id);
        if ($destinatario) {
            $destinatario->notify(new NuevaSolicitud($solicitud));
        }
    
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
