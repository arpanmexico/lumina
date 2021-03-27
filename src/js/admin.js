$(document).ready(function () {
    soldByMonthChart(2021);
    let selectYear = $('#selectYear');

    selectYear.change(function(){
        soldByMonthChart(selectYear.val());
    });
});

function soldByMonthChart(year){
    let soldMsg = $('#soldMsg');
    soldMsg.hide();
    var meses = [], total = [];
    
    $.ajax({
        url: "../../system/controller/UserController.php",
        type: "POST",
        dataType: "json",
        data:{
            year: year
        },
        beforeSend: function(){
            console.log('Cargando gráfica');
            soldMsg.html('<div class="spinner mx-auto"></div><h3 class="mx-auto text-center">Cargando...</h3><h5 class="mx-auto text-center">Espere un momento por favor</h5>');
            soldMsg.fadeIn(900);
        },
        success: function(response){
            soldMsg.fadeOut(800);
            $.each(response, function (key, value) {
                meses.push(key);
                total.push(value);
              });
           
            makeChart(meses,total, year);
        },
        error: function(error){
            console.log(error);
        }
    });
}

function makeChart(labels, data, year){
    var ctx = document.getElementById('soldChart');

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
               
                data: data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value, index, values) {
                            return '$  ' + value;
                        }
                    },
                    title: {
                        display: true,
                        text: 'Ingreso'
                    }
                }]
            },
            legend: {
                display: false,
            },
            layout: {
                padding: {
                  top: 30,
                },
            },
            plugins: {
                datalabels: {
                  color: "black",
                  labels: {
                    title: {
                      font: {
                        weight: "bold",
                        size: 10,
                      },
                    },
                  },
                  align: "top",
                  anchor: "end",
                  padding: {
                    top: 2,
                    bottom: 2,
                    left: 5,
                    right: 5,
                  },
        
                  borderWidth: 1,
                  borderRadius: 1,
                  listeners: {
                    enter: function (context) {
                      // Receives `enter` events for any labels of any dataset. Indices of the
                      // clicked label are: `context.datasetIndex` and `context.dataIndex`.
                      // For example, we can modify keep track of the hovered state and
                      // return `true` to update the label and re-render the chart.
                      context.hovered = true;
                      return true;
                    },
                    leave: function (context) {
                      // Receives `leave` events for any labels of any dataset.
                      context.hovered = false;
                      return true;
                    },
                  },
                  color: function (context) {
                    // Change the label text color based on our new `hovered` context value.
                    return context.hovered ? "#BDBDBD" : "black";
                  },
                },
            },
            title: {
                display: true,
                text: 'Ingresos del ' + year
            }
           
        }
    });
}
