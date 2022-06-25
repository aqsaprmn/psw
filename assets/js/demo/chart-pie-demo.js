// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796'; 

const local = "http://localhost/systemlogin/dashapi/donatChart";
const server = "http://103.242.181.10/systemlogin/dashapi/donatChart";

const xhr = new XMLHttpRequest;

xhr.open('POST', server);
xhr.send();

xhr.addEventListener('load', function () { 
  const jsonRes = JSON.parse(xhr.response)['barang'];

  // Pie Chart Example
  var ctx = document.getElementById("myPieChart");
  var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: [jsonRes[0]['tipe'],jsonRes[1]['tipe']],
    datasets: [{
      data: [jsonRes[0]['total'],jsonRes[1]['total']],
      backgroundColor: ['#4e73df', '#1cc88a'],
      hoverBackgroundColor: ['#2e59d9', '#17a673'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
      borderRadius: 20
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80
  },
  });
 })


