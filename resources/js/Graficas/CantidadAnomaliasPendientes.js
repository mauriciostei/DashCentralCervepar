import Chart from 'chart.js/auto';

let cantidadAnomaliasPendientes = document.getElementById("cantidadAnomaliasPendientes");
let graficoCantidadAnomaliasPendientes = null;

if(cantidadAnomaliasPendientes){
    graficoCantidadAnomaliasPendientes = new Chart(cantidadAnomaliasPendientes, {
        type: "doughnut",
        data: {
            labels: [],
            datasets: [{
              label: 'Cantidad de anomalías Pendientes',
              data: [],
              hoverOffset: 4,
              backgroundColor: [
                'rgba(255, 99, 132, 0.8)',
                'rgba(255, 159, 64, 0.8)',
                'rgba(255, 205, 86, 0.8)',
                'rgba(75, 192, 192, 0.8)',
                'rgba(54, 162, 235, 0.8)',
                'rgba(153, 102, 255, 0.8)',
                'rgba(201, 203, 207, 0.8)'
              ],
            }]
        },
        options: {
            animation: false,
            responsive: false,
            plugins: {
              legend: {
                position: 'bottom',
              }
            }
        }
    });
}

Livewire.on('cantidadAnomaliasPendientes', (grafica) => {
    graficoCantidadAnomaliasPendientes.data.labels = grafica[0]['labels'];
    graficoCantidadAnomaliasPendientes.data.datasets.forEach((datasets) => {
      datasets.data = grafica[0]['data']
    })
    graficoCantidadAnomaliasPendientes.update('none');
    // graficoCantidadAnomaliasPendientes.height = 150;
});