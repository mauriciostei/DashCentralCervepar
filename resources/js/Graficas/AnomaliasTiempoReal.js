import Chart from 'chart.js/auto';

let anomaliasTiempoReal = document.getElementById("anomalias");
let graficoAnomaliasTiempoReal = null;

if(anomaliasTiempoReal){
  graficoAnomaliasTiempoReal = new Chart(anomaliasTiempoReal, {
    type: "bar",
    data: {
        labels: [],
        datasets: [{
          axis: 'y',
          label: 'Anomalías en tiempo real',
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
          borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)',
            'rgb(201, 203, 207)'
          ],
          borderWidth: 1
        }]
      },
    options: {
        animation: false,
        responsive: false,
        indexAxis: 'y',
        plugins: {
          legend: {
            display: false,
          }
        },
        scales: {
          x: {
            ticks: {
              stepSize: 1,
            }
          }
        },
        color: '#198754'
    }
  });
}

Livewire.on('updateGraficaTiempoReal', (grafica) => {
  // graficoAnomaliasTiempoReal.defaults.global.defaultFontColor = "#fff";
  // graficoAnomaliasTiempoReal.defaults.color = 'red';

  graficoAnomaliasTiempoReal.data.labels = grafica[0]['labels'];
  graficoAnomaliasTiempoReal.data.datasets.forEach((datasets) => {
    datasets.data = grafica[0]['data']
  })
  graficoAnomaliasTiempoReal.update('none');
});
