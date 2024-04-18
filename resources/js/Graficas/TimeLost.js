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
            return time(value)
          },
          color: '#000',
          font: {
            weight: 'bold',
            size: 14,
          }
        },
        tooltip: {
          callbacks: {
            label: function(context){
              return time(context.parsed.x)
            }
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

function time(value){
  let ss, mm, hh, dd = 0;

  ss = value;
  mm = Math.floor( ss / 60 ); ss = ss % 60;
  hh = Math.floor( mm / 60 ); mm = mm % 60;
  dd = Math.floor( hh / 24 ); hh = hh % 24;

  return dd + 'd ' + PadLeft(hh, 2) + ':' + PadLeft(mm, 2) + ':' + PadLeft(ss, 2);
}

Livewire.on('updateTableTimeLost', (grafica) => {
  graficaTimeLost.data.labels = grafica[0]['labels'];
  graficaTimeLost.data.datasets.forEach((datasets) => {
    datasets.data = grafica[0]['data'];
  })
  graficaTimeLost.update('none');
});