<?php

namespace App\Http\Controllers;

use App\Models\Cultivos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CultivosController extends Controller
{

  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos = Cultivos::all();
        return view('listac', compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('formcultivo');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Cultivos = new Cultivos();
        $Cultivos->fecha = $request->post('fecha');
        $Cultivos->nombre = $request->post('nombre');
        $Cultivos->tipo = $request->post('tipo');
        $Cultivos->area = $request->post('area');
        $Cultivos->presupuesto = $request->post('presupuesto');
        $Cultivos->save();
        return view('formcultivo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cultivos  $cultivos
     * @return \Illuminate\Http\Response
     */
    public function show(Cultivos $cultivos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cultivos  $cultivos
     * @return \Illuminate\Http\Response
     */
    public function edit(Cultivos $cultivos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cultivos  $cultivos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $insumo = Insumos::findOrFail($id);
        $insumo->fecha_registro = $request->input('fecha');
        $insumo->nombre = $request->input('nombre');
        $insumo->marca = $request->input('marca');
        $insumo->tipo = $request->input('tipo');
        $insumo->valor_unitario = $request->input('precio');
        $insumo->cantidad = $request->input('cantidad');
        $insumo->disponible = $request->input('disponible');
        $insumo->save();
    
        return redirect()->route('insumos.index')->with('success', 'Insumo Actualizado Exitosamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cultivos  $cultivos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cultivos = Cultivos::findorFail($id);
        $cultivos->delete();

        return redirect()->route('cultivos.index')->with('dark', 'Cultivo eliminado con éxito');
    }
}
