$(document).ready(function () {
    let income = $('#soldChart');
    let views = $('#viewsChart');
    let clicks = $('#clicksChart');
    let quotes = $('#quoteChart');
    let comments = $('#commentChart');
    let emails = $('#contactChart');

    soldByMonthChart(2021, income);
    viewChart(views);
    clickChart(clicks);
    quoteChart(quotes);
    contactChart(emails);
    commentChart(comments);
    let selectYear = $('#selectYear');
    
    selectYear.change(function(){
        soldByMonthChart(selectYear.val(), income);
    });
});

function soldByMonthChart(year, id){
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
           
            barChart(meses,total, year, id);
        },
        error: function(error){
            console.log(error);
        }
    });
}

function viewChart(id){
    let viewMsg = $('#viewMsg');
    viewMsg.hide();
    var secciones = [], vistas = [];
    
    $.ajax({
        url: "../../system/controller/UserController.php",
        type: "POST",
        dataType: "json",
        data:{
            view: 'view'
        },
        beforeSend: function(){
            console.log('Cargando gráfica');
            viewMsg.html('<div class="spinner mx-auto"></div><h3 class="mx-auto text-center">Cargando...</h3><h5 class="mx-auto text-center">Espere un momento por favor</h5>');
            viewMsg.fadeIn(900);
        },
        success: function(response){
            viewMsg.fadeOut(800);
            $.each(response, function (key, value) {
                secciones.push(key);
                vistas.push(value);
              });
           
            circleChart(secciones,vistas, id);
        },
        error: function(error){
            console.log(error);
        }
    });
}

function clickChart(id){
    let clickMsg = $('#clickMsg');
    clickMsg.hide();
    var secciones = [], clicks = [];
    
    $.ajax({
        url: "../../system/controller/UserController.php",
        type: "POST",
        dataType: "json",
        data:{
            view: 'click'
        },
        beforeSend: function(){
            console.log('Cargando gráfica');
            clickMsg.html('<div class="spinner mx-auto"></div><h3 class="mx-auto text-center">Cargando...</h3><h5 class="mx-auto text-center">Espere un momento por favor</h5>');
            clickMsg.fadeIn(900);
        },
        success: function(response){
            clickMsg.fadeOut(800);
            $.each(response, function (key, value) {
                secciones.push(key);
                clicks.push(value);
              });
           
            circleChart(secciones,clicks, id);
        },
        error: function(error){
            console.log(error);
        }
    });
}

function quoteChart(id){
    let quotekMsg = $('#quoteMsg');
    quotekMsg.hide();
    var hora = [], citas=[];
    $.ajax({
        url: "../../system/controller/UserController.php",
        type: "POST",
        dataType: "json",
        data:{
            view: 'quote'
        },
        beforeSend: function(){
            console.log('Cargando gráfica');
            quotekMsg.html('<div class="spinner mx-auto"></div><h3 class="mx-auto text-center">Cargando...</h3><h5 class="mx-auto text-center">Espere un momento por favor</h5>');
            quotekMsg.fadeIn(900);
        },
        success: function(response){
            quotekMsg.fadeOut(800);
            $.each(response, function (key, value) {
                hora.push(key);
                citas.push(value);
              });
           polarChart(hora, citas, id);
        },
        error: function(error){
            console.log(error);
        }
    });
}
function contactChart(id){
    let contactkMsg = $('#contactMsg');
    contactkMsg.hide();
    var hora = [], correos=[];
    $.ajax({
        url: "../../system/controller/UserController.php",
        type: "POST",
        dataType: "json",
        data:{
            view: 'contact'
        },
        beforeSend: function(){
            console.log('Cargando gráfica');
            contactkMsg.html('<div class="spinner mx-auto"></div><h3 class="mx-auto text-center">Cargando...</h3><h5 class="mx-auto text-center">Espere un momento por favor</h5>');
            contactkMsg.fadeIn(900);
        },
        success: function(response){
            contactkMsg.fadeOut(800);
            $.each(response, function (key, value) {
                hora.push(key);
                correos.push(value);
              });
           polarChart(hora, correos, id);
        },
        error: function(error){
            console.log(error);
        }
    });
}
function commentChart(id){
    let commentMsg = $('#commentMsg');
    commentMsg.hide();
    var hora = [], comentarios=[];
    $.ajax({
        url: "../../system/controller/UserController.php",
        type: "POST",
        dataType: "json",
        data:{
            view: 'comment'
        },
        beforeSend: function(){
            console.log('Cargando gráfica');
            commentMsg.html('<div class="spinner mx-auto"></div><h3 class="mx-auto text-center">Cargando...</h3><h5 class="mx-auto text-center">Espere un momento por favor</h5>');
            commentMsg.fadeIn(900);
        },
        success: function(response){
            commentMsg.fadeOut(800);
            $.each(response, function (key, value) {
                hora.push(key);
                comentarios.push(value);
              });
           polarChart(hora, comentarios, id);
        },
        error: function(error){
            console.log(error);
        }
    });
}



function barChart(labels, data, year, id){
    var ctx = id;

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
               
                data: data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                borderColor: [
                    'rgba(255,82,82 ,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(63, 81, 181,1.0)',
                    'rgba(255,82,82 ,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(63, 81, 181,1.0)',
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
                }]
            },
            legend: {
                display: false,
            },
            layout: {
                padding: {
                  top: 5,
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
                text: year
            }
           
        }
    });
}
function circleChart(labels, data,id){
    var ctx = id;

    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
               
                data: data,
                backgroundColor: [
                    'rgba(255,82,82 ,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(63, 81, 181,1.0)',
                    
                    'rgba(255,82,82 ,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(63, 81, 181,1.0)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderColor: [
                    'rgba(255,82,82 ,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(63, 81, 181,1.0)',
                    'rgba(255,82,82 ,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(63, 81, 181,1.0)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            legend: {
                display: true,
            },
            layout: {
                padding: {
                  top: 5,
                },
            },
            plugins: {
                datalabels: {
                  color: "white",
                  labels: {
                    title: {
                        display:true,
                      font: {
                        weight: "bold",
                        size: 12,
                      },
                    },
                  },
                  align: "center",
                  anchor: "center",
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
                    return context.hovered ? "#BDBDBD" : "white";
                  },
                },
            },
            
           
        }
    });
}

function polarChart(labels, data,id){
    var ctx = id;

    var myChart = new Chart(ctx, {
        type: 'polarArea',
        data: {
            labels: labels,
            datasets: [{
               
                data: data,
                backgroundColor: [
                    'rgba(255,82,82 ,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(63, 81, 181,1.0)',
                    'rgba(255,82,82 ,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(63, 81, 181,1.0)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderColor: [
                    'rgba(255,82,82 ,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(63, 81, 181,1.0)',
                    'rgba(255,82,82 ,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(63, 81, 181,1.0)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            legend: {
                display: true,
            },
            layout: {
                padding: {
                  top: 5,
                },
            },
            plugins: {
                datalabels: {
                  color: "white",
                  labels: {
                    title: {
                        display:true,
                      font: {
                        weight: "bold",
                        size: 12,
                      },
                    },
                  },
                  align: "center",
                  anchor: "center",
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
                    return context.hovered ? "#BDBDBD" : "white";
                  },
                },
            },
            
           
        }
    });
}
