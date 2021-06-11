$(document).ready(function(){
    let saveBtn = $('#ticketMsgBtn');
    $('#ticketMsg').on('input', function(){
        let msg = $('#ticketMsg').val();
        let prev = $('#prev-ticket-msg');
       
        prev.html(msg);
    
        if(msg == ''){
            saveBtn.fadeOut(800);
        }else{
            saveBtn.fadeIn(800);
            localStorage.setItem('msg', msg);
        }
    });

    saveBtn.click(function(){
        mensaje = localStorage.getItem('msg');

        data = {
            'id_ticket': 1,
            'mensaje': mensaje,
            'accion': 2
        };

        manageMessage(data);
    });
});

function manageMessage(data){
    let result = $('#result');
    $.ajax({
        url: '../../system/controller/TicketController.php',
        method: 'POST',
        data: {
            action: 'ticket',
            ticket: data,
        },
        beforeSend: function(){
            result.html('<div class="spinner mx-auto"></div><h3 class="mx-auto text-center">Cargando...</h3><h5 class="mx-auto text-center">Espere un momento por favor</h5>');
            result.fadeIn(800);
        },
        error: function (error) {
            console.log('No se guardó la venta -> ', error);
            result.fadeIn(800);
          },
        success: function (response) {
            result.hide();
            console.log("Respuesta de venta -> ", response);
            if (response == 'true') {
                result.addClass('bg-primary');
                result.html('<lottie-player src="https://assets6.lottiefiles.com/packages/lf20_gaSt56.json" background="#4E73DF"  speed="1"  style="width: 100%; height: 25vh;"  loop  autoplay></lottie-player><h4 class="text-center font-weight-bolder bg-primary py-3 text-white">Mensaje guardado con éxito!</h4>');
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

