@extends('layouts.master')

@section('content')

<br><br>
<center>
<div class="card" style="width: 40rem;">
    <div class="container">
        <h2>Gráfica de Recolectas por Fecha</h2>
        <canvas id="recolectasChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var ctx = document.getElementById('recolectasChart').getContext('2d');

            var recolectasData = @json($recolectas);

            // Organizar los datos por cultivo
            var cultivos = {}; // Diccionario para cada cultivo

            recolectasData.forEach(data => {
                if (!cultivos[data.cultivo]) {
                    cultivos[data.cultivo] = {};
                }
                cultivos[data.cultivo][data.mes] = data.total;
            });

            var meses = [...new Set(recolectasData.map(data => data.mes))].sort(); // Obtener los meses ordenados
            var datasets = [];

            // Colores para cada cultivo
            var colors = [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ];

            var index = 0;
            Object.keys(cultivos).forEach(cultivo => {
                var data = meses.map(mes => cultivos[cultivo][mes] || 0); // Completar con 0 si no hay datos en algún mes

                datasets.push({
                    label: cultivo,
                    data: data,
                    borderColor: colors[index % colors.length],
                    backgroundColor: colors[index % colors.length].replace('1)', '0.2)'),
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                });

                index++;
            });

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: meses,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
