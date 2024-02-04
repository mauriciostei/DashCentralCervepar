import Chart from 'chart.js/auto';

let pareto = document.getElementById("pareto");
let graficaPareto = null;

if(pareto){
  graficaPareto = new Chart(pareto, {
    type: "bar",
    data: {
        labels: [],
        datasets: [{
          type: 'bar',
          axis: 'y',
          label: 'Pareto de Motivos',
          data: [],
          fill: false,
          backgroundColor: 'rgba(146, 199, 207, 0.6)',
          borderColor: 'rgb(54, 162, 235)',
        },{
          type: 'line',
          label: 'Proporción de Anomalías',
          data: [],
          fill: false,
          backgroundColor: 'rgb(134, 182, 246)',
          borderColor: 'rgb(134, 182, 246)',
        }]
      },
    options: {
        animation: false,
        responsive: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        scales: {
          y: {
            type: 'linear',
            position: 'left',
            ticks: {
              stepSize: 20,
            },
            grid: {
              display: false
            }
          },
          y2: {
            type: 'linear',
            position: 'right',
            min: 0,
            max: 100,
            ticks: {
              stepSize: 20,
              callback: function(value, index, ticks){
                return value + '%';
              }
            },
            grid: {
              display: false
            }
          }
        }
    }
  });
}

Livewire.on('updatePareto', (grafica) => {
  graficaPareto.data.labels = grafica[0]['labels'];
  graficaPareto.data.datasets[0].data = grafica[0]['data'];
  graficaPareto.data.datasets[1].data = grafica[0]['proporcion'];
  graficaPareto.update('none');
});