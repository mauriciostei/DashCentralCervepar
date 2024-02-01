import './bootstrap';
import { Toast } from 'bootstrap';
import Chart from 'chart.js/auto';

Chart.defaults.borderColor = '#fff';
Chart.defaults.color = '#fff';

// Gráficos del sistema
require('./Graficas/AnomaliasTiempoReal');
require('./Graficas/CantidadAnomalias');
require('./Graficas/CantidadAnomaliasPendientes');
require('./Graficas/TimeLost');
require('./Graficas/SLA');
require('./Graficas/Pareto');

const toastElList = document.querySelectorAll('.toast')
const toastList = [...toastElList].map(toastEl => new Toast(toastEl).show())

window.bootstrap = require('bootstrap/dist/js/bootstrap.bundle.js');
