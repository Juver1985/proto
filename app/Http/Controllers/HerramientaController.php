<?php

namespace App\Http\Controllers;

use App\Models\Herramienta;
use Illuminate\Http\Request;

class HerramientaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $herramientas = Herramienta::all();
        return view('herramientas.index', compact('herramientas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('herramientas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fecha_registro' => 'required|date',
            'nombre' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'valor_unitario' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:1',
            'estado' => 'required|string',
            'disponible' => 'required|boolean',
        ]);

        Herramienta::create($request->all());

        return redirect()->route('herramientas.index')->with('success', 'Herramienta registrada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Herramienta  $herramientas
     * @return \Illuminate\Http\Response
     */
    public function show(Herramienta $herramientas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Herramienta  $herramientas
     * @return \Illuminate\Http\Response
     */
    public function edit(Herramienta $herramientas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Herramienta  $herramientas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Herramienta $herramientas)
    {
       
            // Validación de los datos enviados en el formulario
            $request->validate([
                'fecha_registro' => 'required|date',
                'nombre' => 'required|string|max:255',
                'marca' => 'required|string|max:255',
                'tipo' => 'required|string|max:255',
                'valor_unitario' => 'required|numeric|min:0',
                'cantidad' => 'required|integer|min:0',
                'estado' => 'required|string|max:255',
                'disponible' => 'required|string|max:255',
            ]);
        
            // Buscar la herramienta por su ID
            $herramienta = Herramienta::findOrFail($id);
        
            // Actualizar los valores con los datos enviados desde el formulario
            $herramienta->update([
                'fecha_registro' => $request->fecha_registro,
                'nombre' => $request->nombre,
                'marca' => $request->marca,
                'tipo' => $request->tipo,
                'valor_unitario' => $request->valor_unitario,
                'cantidad' => $request->cantidad,
                'estado' => $request->estado,
                'disponible' => $request->disponible,
            ]);
        
            // Redireccionar con un mensaje de éxito
            return redirect()->route('herramientas.index')->with('success', 'Herramienta actualizada correctamente.');
        }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Herramienta  $herramientas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Herramienta $herramientas)
    {
        $herramienta = Herramienta::findOrFail($id);
    $herramienta->delete();

    return redirect()->route('herramientas.index')->with('success', 'Herramienta eliminada correctamente.');
    }
}
