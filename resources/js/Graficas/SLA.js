import Chart from 'chart.js/auto';

let sla = document.getElementById("graficaSLA");
let graficaSLA = null;

if(sla){
  graficaSLA = new Chart(sla, {
      type: "pie",
      data: {
          labels: [],
          datasets: [{
            label: 'Cumplimiento de SLA',
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
            },
            tooltip: {
              callbacks: {
                label: function(context){
                  return context.parsed
                }
              }
            }
          }
      }
  });
}

Livewire.on('updateSLA', (grafica) => {
    graficaSLA.data.labels = grafica[0]['labels'];
    graficaSLA.data.datasets.forEach((datasets) => {
      datasets.data = grafica[0]['data']
    })
    graficaSLA.update('none');
    // graficaSLA.height = 250;
});