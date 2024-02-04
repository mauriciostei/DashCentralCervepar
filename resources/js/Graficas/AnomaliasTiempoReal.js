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
            'rgb(238, 245, 255)',
            'rgb(180, 212, 255)',
            'rgb(134, 182, 246)',
            'rgb(23, 107, 135)',
            'rgb(146, 199, 207)',
          ],
          borderColor: [
            'rgb(238, 245, 255)',
            'rgb(180, 212, 255)',
            'rgb(134, 182, 246)',
            'rgb(23, 107, 135)',
            'rgb(146, 199, 207)',
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
