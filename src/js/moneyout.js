$(document).ready(function(){
    let moneyOutBtn = $('#moneyOutBtn');
    let monto = $('#input-monto');
    let concepto = $('#input-concepto');
   moneyOutBtn.hide();
    moneyOutBtn.click(function(){
        
        if(monto.val() != '' && concepto.val() != ''){
            data = {
                'id_salida': 'null',
                'monto' : monto.val(),
                'concepto' : concepto.val(),
                'accion' : 1
            };
            manageMoneyOut(data);
            monto.val('');
            concepto.val('');

        }else{
            $('#result').html('<div class="alert alert-warning col-12 animated fadeIn">No debe dejar campos vacíos.</div>')
        }
    });
    
    monto.on('input', function(){
        if(monto.val() == '' || concepto.val() == ''){
            moneyOutBtn.fadeOut(800);
        }else{
            moneyOutBtn.fadeIn(800);
        }
    });
    concepto.on('input', function(){
        if(monto.val() == '' || concepto.val() == ''){
            moneyOutBtn.fadeOut(800);
        }else{
            moneyOutBtn.fadeIn(800);
        }
    });
});

function manageMoneyOut(data){
    let result = $('#result');
    $.ajax({
        url: '../../system/controller/MoneyOutController.php',
        method: 'POST',
        data: {
            money: data,
        },
        beforeSend: function(){
            result.html('<div class="spinner mx-auto"></div><h3 class="mx-auto text-center">Cargando...</h3><h5 class="mx-auto text-center">Espere un momento por favor</h5>');
            result.fadeIn(800);
        },
        error: function (error) {
            console.log('No se guardó la salida -> ', error);
            result.fadeIn(800);
          },
        success: function (response) {
            result.hide();
            console.log("Respuesta de salida de dinero -> ", response);
            if (response == 'true') {
                result.addClass('bg-primary');

                loadPagination('out', 1, '');
                result.html('<lottie-player src="https://assets6.lottiefiles.com/packages/lf20_gaSt56.json" background="#4E73DF"  speed="1"  style="width: 100%; height: 25vh;"  loop  autoplay></lottie-player><h4 class="text-center font-weight-bolder bg-primary py-3 text-white">Salida guardada con éxito!</h4>');
                result.fadeIn(800);
                setTimeout(function () { result.fadeOut(800); }, 2200);
                
            } else {
                result.html('<lottie-player src="https://assets2.lottiefiles.com/packages/lf20_ed9D2z.json"  background="transparent"  speed=".5"  style="width: 100%; height: 25vh;"  loop  autoplay></lottie-player><h4 class="text-center font-weight-bolder py-3 text-danger">Oops ha ocurrido un error! Por favor vuelve a intentarlo</h4>');
                result.fadeIn(800);
                setTimeout(function () { result.fadeOut(800); }, 3500);
            }
        },
    });
}