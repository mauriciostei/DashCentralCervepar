import Chart from 'chart.js/auto';
import ChartDataLabels from 'chartjs-plugin-datalabels';

let timeLost = document.getElementById("timeLost");
let graficaTimeLost = null;

if(timeLost){
  graficaTimeLost = new Chart(timeLost, {
    type: "bar",
    data: {
        labels: [],
        datasets: [{
          axis: 'y',
          label: 'Tiempos perdidos',
          data: [],
          fill: false,
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
    plugins: [ChartDataLabels],
    options: {
      animation: false,
      responsive: false,
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
            let ss, mm, hh, dd = 0;

            ss = value;
            mm = Math.floor( ss / 60 ); ss = ss % 60;
            hh = Math.floor( mm / 60 ); mm = mm % 60;
            dd = Math.floor( hh / 24 ); hh = hh % 24;

            return dd + 'd ' + PadLeft(hh, 2) + ':' + PadLeft(mm, 2) + ':' + PadLeft(ss, 2);
          },
          font: {
            weight: 'bold',
            size: 14,
          }
        }
      },
      scales: {
        x: {
          ticks: {
            stepSize: 36000,
            callback: function(value, index, ticks){
              return  (index * 10) + ' Horas';
            }
          }
        }
      }
    },
  });
}

function PadLeft(value, length) {
  return (value.toString().length < length) ? PadLeft("0" + value, length) : value;
}

Livewire.on('updateTableTimeLost', (grafica) => {
  graficaTimeLost.data.labels = grafica[0]['labels'];
  graficaTimeLost.data.datasets.forEach((datasets) => {
    datasets.data = grafica[0]['data'];
  })
  graficaTimeLost.update('none');
});