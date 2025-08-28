@extends('layouts.app')

@section('content')
    <div class="container" style="background-color: #f8f9fa; padding: 30px; border-radius: 10px;">
        <h1 style="color: #2c3e50; margin-bottom: 30px;">Rapports de Performance</h1>

        @if ($completedTasksCount > 0)
            <div class="p-4 mb-4 shadow rounded"
                style="background: linear-gradient(45deg, #d4edda, #c3e6cb); border-left: 5px solid #28a745;">
                <h2 style="color: #155724;">Status de Performance</h2>
                <p><strong>Tâches de la semaine:</strong> {{ $completedTasksCount }} / {{ $total_task }}</p>
                <p><strong>Date de fin de l'élevage (estimation):</strong> {{ $endDatePrediction }}</p>
            </div>

            <div class="p-4 mb-4 shadow rounded"
                style="background: linear-gradient(45deg, #cce5ff, #b8daff); height: 400px; border-left: 5px solid #007bff;">
                <h2 style="color: #004085;">Graphe des tâches</h2>
                <canvas id="tasksChart" style="width: 100%; height: 100%"></canvas>
            </div>
        @else
            <p>Aucune tâche complétée pour l'instant.</p>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('tasksChart').getContext('2d');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Tâches faites', 'Tâches restantes'],
                datasets: [{
                    data: [
                        {{ $completedTasksData->last() ?? 0 }},
                        {{ ($totalTasksData->last() ?? 0) - ($completedTasksData->last() ?? 0) }}
                    ],
                    backgroundColor: [
                        'rgba(40, 167, 69, 0.7)',
                        'rgba(220, 53, 69, 0.7)'
                    ],
                    borderColor: [
                        'rgba(40, 167, 69, 1)',
                        'rgba(220, 53, 69, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 14,
                                weight: 'bold'
                            },
                            color: '#2c3e50'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                let value = context.raw || 0;
                                return label + ': ' + value + ' tâches';
                            }
                        }
                    }
                }
            },
            plugins: [{
                id: 'centerText',
                afterDraw(chart) {
                    const {
                        width
                    } = chart;
                    const {
                        height
                    } = chart;
                    const ctx = chart.ctx;
                    ctx.save();
                    const total = chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                    const done = chart.data.datasets[0].data[0];
                    const percent = Math.round((done / total) * 100);

                    ctx.font = 'bold 22px Arial';
                    ctx.fillStyle = '#2c3e50';
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.fillText(percent + '%', width / 2, height / 2);
                    ctx.restore();
                }
            }]

        });
    </script>
@endsection
