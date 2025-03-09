<?php

namespace App\Http\Controllers;

use App\Models\Recolecta;
use Illuminate\Http\Request;
use App\Models\Cultivos;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class RecolectaController extends Controller

{

    public function rentabilidad()
    {
        $rentabilidad = DB::table('cultivos')
            ->join('recolectas', 'cultivos.id', '=', 'recolectas.cultivo_id')
            ->select(
                'cultivos.nombre',
                'cultivos.presupuesto',
                'cultivos.precio_venta',
                DB::raw('SUM(recolectas.unidad) AS total_cosecha'),
                DB::raw('(SUM(recolectas.unidad) * cultivos.precio_venta) AS ingresos_netos'),
                DB::raw('((SUM(recolectas.unidad) * cultivos.precio_venta) - cultivos.presupuesto) / cultivos.presupuesto * 100 AS rentabilidad')
            )
            ->groupBy('cultivos.id', 'cultivos.nombre', 'cultivos.presupuesto', 'cultivos.precio_venta')
            ->get();
    
        return view('recolectas.rentabilidad', compact('rentabilidad'));
    }

    public function graficas()
    {
        // Obtener los datos agrupados por mes y tipo de cultivo
        $recolectas = DB::table('recolectas')
            ->join('cultivos', 'recolectas.cultivo_id', '=', 'cultivos.id') // Unir con la tabla cultivos
            ->select(
                DB::raw('DATE_FORMAT(recolectas.fecha_recolecta, "%Y-%m") as mes'), // Formato Año-Mes
                'cultivos.nombre as cultivo', // Nombre del cultivo
                DB::raw('SUM(recolectas.cantidad) as total')
            )
            ->groupBy('mes', 'cultivo')
            ->orderBy('mes', 'ASC')
            ->get();
    
        return view('recolectas.graficas', compact('recolectas'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cultivos = Cultivos::all();
        return view('recolectas.create', compact('cultivos'));
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
            'cultivo_id' => 'required|exists:cultivos,id',
            'fecha_recolecta' => 'required|date',
            'cantidad' => 'required|numeric',
            'unidad' => 'required|string',
            'observaciones' => 'nullable|string',
        ]);

        Recolecta::create($request->all());

        return redirect()->route('recolectas.create')->with('success', 'Recolección registrada con éxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recolecta  $recolecta
     * @return \Illuminate\Http\Response
     */
    public function show(Recolecta $recolecta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recolecta  $recolecta
     * @return \Illuminate\Http\Response
     */
    public function edit(Recolecta $recolecta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recolecta  $recolecta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recolecta $recolecta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recolecta  $recolecta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recolecta $recolecta)
    {
        //
    }
}
