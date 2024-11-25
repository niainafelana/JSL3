<template>
      <Sidebar/>

   
    <div id="application">
      <h3>Impot des 6 derniers mois</h3>
      <div id="stat">
        <canvas id="bar-chart"></canvas>
        <canvas id="line-chart"></canvas>
      </div>
      <h3>Mode de paiment </h3>
        <div id="mode">
            <canvas id="donut"></canvas>
            <canvas id="globe"></canvas>   
        </div>

    </div>
  </template>
  
  <script>
import { Chart, registerables } from 'chart.js';
import Sidebar from '@/components/Sidebar.vue';
Chart.register(...registerables);

export default {
  name: 'App',
  components: {
    Sidebar
  },
  data() {
    return {
      barData: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June'],
        datasets: [
          {
            label: 'Repartition des 6 derniers mois',
            backgroundColor: ['#f87979', '#7acbf9', '#f9e07a', '#79f9b0', '#f97ad4', '#7a7af9'],
            data: [4, 9, 10, 4, 9, 8, 4]
          }
        ]
      },
      lineData: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June'],
        datasets: [
          {
            label: 'Evolution des 6 derniers mois',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            pointBackgroundColor: 'rgba(75, 192, 192, 1)',
            pointBorderColor: '#fff',
            data: [4, 9, 10, 4, 39, 8, 2]
          }
        ]
      },
      donutData: {
        labels: ['Carte bancaire', 'Cheque', 'Espece'],
        datasets: [
          {
            label: 'Repartition des modes de paiement',
            backgroundColor: ['#f87979', '#7acbf9', '#f9e07a'],
            data: []
          }
        ]
      },
      globeData: {
        labels: ['Carte bancaire', 'Cheque', 'Espece'],
        datasets: [
          {
            label: 'Repartition des modes de paiement',
            backgroundColor: ['#f87979', '#7acbf9', '#f9e07a'],
            data: []
          }
        ]
      },
      chartOptions: {
        responsive: true,
        maintainAspectRatio: false
      },
    };
  },
  mounted() {
    this.dashboard();
  },
  methods: {
    dashboard() {
      fetch('http://localhost:3000/dashboard', {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
        },
      })
      .then((response) => response.json())
      .then((data) => {
        this.updateChartData(data);
        this.renderCharts();
      })
      .catch((error) => {
        console.log(error);
      });
    },
    updateChartData(data) {
      // Aggregate the sums of transactions for each payment type.
      const paymentSums = {
        'Carte bancaire': 0,
        'Cheque': 0,
        'Espece': 0
      };

      data.forEach(transaction => {
        switch (transaction.typ.toLowerCase()) {
          
          case 'virement':
            paymentSums['Carte bancaire'] += transaction.som;
            break;
          
          case 'chèque':
          
            paymentSums['Cheque'] += transaction.som;
            break;
          case 'espèce':
          
            paymentSums['Espece'] += transaction.som;
            break;
        }
      });

      this.donutData.datasets[0].data = [
        paymentSums['Carte bancaire'],
        paymentSums['Cheque'],
        paymentSums['Espece']
      ];

      this.globeData.datasets[0].data = [
        paymentSums['Carte bancaire'],
        paymentSums['Cheque'],
        paymentSums['Espece']
      ];
    },
    renderCharts() {
      // Render the bar chart
      const barCtx = document.getElementById('bar-chart').getContext('2d');
      new Chart(barCtx, {
        type: 'bar',
        data: this.barData,
        options: this.chartOptions
      });

      // Render the line chart
      const lineCtx = document.getElementById('line-chart').getContext('2d');
      new Chart(lineCtx, {
        type: 'line',
        data: this.lineData,
        options: this.chartOptions
      });

      // Render the donut chart
      const donutCtx = document.getElementById('donut').getContext('2d');
      new Chart(donutCtx, {
        type: 'doughnut',
        data: this.donutData,
        options: this.chartOptions
      });

      // Render the pie chart
      const globeCtx = document.getElementById('globe').getContext('2d');
      new Chart(globeCtx, {
        type: 'pie',
        data: this.globeData,
        options: this.chartOptions
      });
    }
  }
};
</script>

  <style>
  #application {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;

    margin-left: 17%;
    
    
  }
  #stat, #mode{
    display: flex;
    justify-content: space-around;
    
  }
  canvas {
    max-width: 550px;
    margin: 20px auto;
    height: 230px;
  }
  
  </style>
  