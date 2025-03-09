<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use Illuminate\Http\Request;

class InsumoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $insumos = Insumo::all();
        return view('insumos.index', compact('insumos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('insumos.create');
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
            'disponible' => 'required|string|max:50',
        ]);

        Insumo::create($request->all());

        return redirect()->route('insumos.create')->with('success', 'Insumo registrado correctamente.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Insumos  $insumos
     * @return \Illuminate\Http\Response
     */
    public function show(Insumos $insumos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Insumos  $insumos
     * @return \Illuminate\Http\Response
     */
    public function edit(Insumos $insumo)
    {
        return view('insumos.edit', compact('insumo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Insumos  $insumos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validar datos del formulario
        $request->validate([
            'fecha_registro' => 'required|date',
            'nombre' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'valor_unitario' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:1',
            'disponible' => 'required|in:Sí,No',
        ]);
    
        // Buscar insumo por ID
        $insumo = Insumo::findOrFail($id);
    
        // Actualizar datos
        $insumo->update([
            'fecha_registro' => $request->fecha_registro,
            'nombre' => $request->nombre,
            'marca' => $request->marca,
            'tipo' => $request->tipo,
            'cantidad' => $request->cantidad,
            'valor_unitario' => $request->precio,
            'disponible' => $request->disponible,
        ]);
    
        // Redireccionar con mensaje de éxito
        return redirect()->route('insumos.index')->with('success', 'Insumo actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Insumos  $insumos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Buscar insumo por ID
        $insumo = Insumo::findOrFail($id);

        // Eliminar insumo
        $insumo->delete();

        // Redireccionar con mensaje de éxito
        return redirect()->route('insumos.index')->with('success', 'Insumo eliminado correctamente.');
    }
}
