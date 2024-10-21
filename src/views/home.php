<h2>Sistema de Ventas - DOLLARTOY</h2>

<div class="chart-container">
    <div class="chart">
        <canvas id="ventasChart"></canvas>
    </div>
    <div class="chart">
        <canvas id="ingresosChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    const ventasPorMes = <?= $ventasPorMesJSON; ?>; // Datos de ventas por mes
    const ingresosPorMes = <?= $ingresosPorMesJSON; ?>; // Datos de ingresos por mes

    const ctxVentas = document.getElementById('ventasChart').getContext('2d');
    const ventasChart = new Chart(ctxVentas, {
        type: 'bar',
        data: {
            labels: meses,
            datasets: [{
                label: 'Cantidad de Ventas',
                data: ventasPorMes,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const ctxIngresos = document.getElementById('ingresosChart').getContext('2d');
    const ingresosChart = new Chart(ctxIngresos, {
        type: 'line',
        data: {
            labels: meses,
            datasets: [{
                label: 'Ingresos',
                data: ingresosPorMes,
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>