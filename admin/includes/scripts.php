<!-- Bootstrap core JavaScript-->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="https://cdn.jsdelivr.net/npm/jquery-easing@1.4.1/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="./backend/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
  <script src="./backend/js/demo/chart-pie-demo.js"></script>
  <script src="./backend/js/demo/chart-area-demo.js"></script>
  <script src="./backend/js/demo/chart-bar-demo.js"></script>
  <script src="./backend/js/sweetalert2.min.js"></script>
  <script>
    var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($label); ?>,
      datasets: [{
        label: "Grafik Penjualan",
        backgroundColor: "#4e73df",
        hoverBackgroundColor: "#2e59d9",
        borderColor: "#4e73df",
        data: <?php echo json_encode($jumlah_produk); ?>,
      }],
    },
    options: {
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 25,
          top: 25,
          bottom: 0
        }
      },
      scales: {
        xAxes: [{
          time: {
            unit: 'month'
          },
          gridLines: {
            display: false,
            drawBorder: false
          },
          ticks: {
            maxTicksLimit: 12
          },
          maxBarThickness: 25,
        }],
        yAxes: [{
          ticks: {
            min: 0,
            max: 700000,
            maxTicksLimit: 8,
            padding: 20,
            // Include a dollar sign in the ticks
            callback: function(value, index, values) {
              return 'Rp.' + number_format(value);
            }
          },
          gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
          }
        }],
      },
      legend: {
        display: false
      },
      tooltips: {
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        callbacks: {
          label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': Rp.' + number_format(tooltipItem.yLabel);
          }
        }
      },
    }
  });
  </script>