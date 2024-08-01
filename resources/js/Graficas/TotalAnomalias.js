import Chart from 'chart.js/auto';
import ChartDataLabels from 'chartjs-plugin-datalabels';

let totalAnomalias = document.getElementById("TotalAnomalias");
let graficoTotalAnomalias = null;

if(totalAnomalias){
    graficoTotalAnomalias = new Chart(totalAnomalias, {
      type: "bar",
      data: {
          labels: [],
          datasets: [{
            axis: 'y',
            label: 'Anomalias detectadas en el dia',
            data: [],
            fill: false,
            backgroundColor: [
              'rgb(238, 245, 255)',
              'rgb(180, 212, 255)',
              'rgb(134, 182, 246)',
              'rgb(23, 107, 135)',
              'rgb(146, 199, 207)',
            ],
          }]
        },
      plugins: [ChartDataLabels],
      options: {
        animation: false,
        responsive: false,
        maintainAspectRatio: false,
        indexAxis: 'y',
        plugins: {
          legend: {
            position: 'bottom',
          },
          datalabels: {
            anchor: 'center',
            align: 'center',
            clamp: true,
            formatter: function(value){
              return value > 0 ? value : ''
            },
            color: '#000',
            font: {
              weight: 'bold',
              size: 14,
            }
          },
          tooltip: {
            callbacks: {
              title: function(){
                return 'Anomalias Detectadas'
              },
              label: function(context){
                return context.parsed.x
              }
            }
          }
        },
        scales: {
          x: {
            ticks: {
              stepSize: 1,
              callback: function(value, index, ticks){
                return  index  + ' Anomalía';
              }
            }
          }
        }
      },
    });
}

Livewire.on('updateGraficaTotalAnomalias', (grafica) => {
    graficoTotalAnomalias.data.labels = grafica[0]['labels'];
    graficoTotalAnomalias.data.datasets.forEach((datasets) => {
      datasets.data = grafica[0]['data']
    })
    graficoTotalAnomalias.update('none');
    // graficoTotalAnomalias.height = 150;
});