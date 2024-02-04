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
                'rgb(238, 245, 255)',
                'rgb(180, 212, 255)',
                'rgb(134, 182, 246)',
                'rgb(23, 107, 135)',
                'rgb(146, 199, 207)',
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