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
          responsive: true,
          plugins: {
            legend: {
              position: 'bottom',
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