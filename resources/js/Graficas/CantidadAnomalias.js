import Chart from 'chart.js/auto';

let cantidadAnomalias = document.getElementById("cantidadAnomalias");
let graficoCantidadAnomalias = null;

if(cantidadAnomalias){
    graficoCantidadAnomalias = new Chart(cantidadAnomalias, {
        type: "doughnut",
        data: {
            labels: [],
            datasets: [{
              label: 'Cantidad de anomalías',
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

Livewire.on('cantidadAnomalias', (grafica) => {
    graficoCantidadAnomalias.data.labels = grafica[0]['labels'];
    graficoCantidadAnomalias.data.datasets.forEach((datasets) => {
      datasets.data = grafica[0]['data']
    })
    graficoCantidadAnomalias.update('none');
    // graficoCantidadAnomalias.height = 150;
});