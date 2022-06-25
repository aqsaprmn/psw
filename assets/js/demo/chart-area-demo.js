// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

const xhr2 = new XMLHttpRequest;

const local2 = "http://localhost/systemlogin/dashapi/areaChart";
const server2 = "http://103.242.181.10/systemlogin/dashapi/areaChart";

const month = document.getElementById('month');

xhr2.addEventListener('load', function () { 
  const jsonRes = JSON.parse(xhr2.response)['barang'];

  console.log(jsonRes);

  month.addEventListener('change', function() {
      const xhr = new XMLHttpRequest;
      xhr.open('POST', server2);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.send('date=' + this.value);
      xhr.addEventListener('load', function() {
          const jsonRes = JSON.parse(xhr.response)['barang'];
          const date = [];
          // const datelabel = [];

          jsonRes.forEach((val, index, arr) => {
            console.log(jsonRes);
              date.push({
                  x: Date.parse(val['tgl_hilang']),
                  y: val['total']
              })

              // datelabel.push(val['total']);
          });

          updateChart(myLineChart, date);
      })
  })
  const date = [];
  // const datelabel = [];

  jsonRes.forEach((val, index, arr) => {
      date.push({
          x: Date.parse(val['tgl_hilang']),
          y: val['total']
      })

      // datelabel.push(val['total']);
  });
  // Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    datasets: [{
      label: "Earnings",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: date,
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
        type: 'time',
        time: {
          unit: 'day'
        },
      }],
      yAxes: [{
        ticks: {
          // maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          // callback: function(value, index, values) {
          //   return '$' + number_format(value);
          // }
        },
      }],
    },
    legend: {
      display: false
    },
  }
});
 });

 xhr2.open('POST', server2);
 xhr2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
 xhr2.send("date=" + month.value);

 function updateChart(chart, mydata) {
  // console.log(chart.data, mydata);
  chart.data.datasets.forEach((dataset) => {
      dataset.data = mydata;
  });
  chart.update();
}

