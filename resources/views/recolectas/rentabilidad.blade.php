@extends('layouts.master')

@section('content')
<div class="container">
    <h2 class="text-center">📈 Análisis de Rentabilidad de los Cultivos</h2>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Cultivo</th>
                <th>Presupuesto Inicial ($)</th>
                <th>Total Cosechado (Kg)</th>
                <th>Precio de Venta ($)->Kg</th>
                <th>Ingresos Netos ($)</th>
                <th>Rentabilidad (%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentabilidad as $item)
                <tr>
                    <td>{{ $item->nombre }}</td>
                    <td>${{ number_format($item->presupuesto, 2) }}</td>
                    <td>{{ number_format($item->total_cosecha, 2) }}</td>
                    <td>${{ number_format($item->precio_venta, 2) }}</td>
                    <td>${{ number_format($item->ingresos_netos, 2) }}</td>
                    <td>
                        <span class="{{ $item->rentabilidad >= 0 ? 'text-success' : 'text-danger' }}">
                            {{ number_format($item->rentabilidad, 2) }}%
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div><br><br>
<center>
<div style="width: 35%">
<canvas id="rentabilidadChart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('rentabilidadChart').getContext('2d');
    var rentabilidadChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($rentabilidad->pluck('nombre')),
            datasets: [{
                label: 'Rentabilidad (%)',
                data: @json($rentabilidad->pluck('rentabilidad')),
                backgroundColor: function(context) {
                    var value = context.dataset.data[context.dataIndex];
                    return value >= 0 ? 'rgba(75, 192, 192, 0.7)' : 'rgba(255, 99, 132, 0.7)';
                },
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</div>
</center>
@endsection
