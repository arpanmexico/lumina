$('#errorMessage').hide();
$('#successMessage').hide();
$('#contactErrorMessage').hide();
$('#contactSuccessMessage').hide();
$('#contactInfoMessage').hide();

$(document).ready(function () {
    initScrollAnimations();
    scrollAnimation();
    readScroll();

    let quienesSomosLink = $('#quienes_somos_link');
    let serviciosLink = $('#servicios_link');
    let tiendaLink = $('#tienda_link');
    let citaLink = $('#cita_link');
    let contactoLink = $('#contacto_link');

    quienesSomosLink.click(function(){
        accion = 'click';
        seccion = 'quienes_somos';
        insertStat(accion, seccion);
    });
    serviciosLink.click(function(){
        accion = 'click';
        seccion = 'servicios';
        insertStat(accion, seccion);
    });
    tiendaLink.click(function(){
        accion = 'click';
        seccion = 'tienda';
        insertStat(accion, seccion);
    });
    citaLink.click(function(){
        accion = 'click';
        seccion = 'agenda';
        insertStat(accion, seccion);
    });
    contactoLink.click(function(){
        accion = 'click';
        seccion = 'contacto';
        insertStat(accion, seccion);
    });

    insertStat('visita', 'index');

    $('#contactButton').click(function () {
        if (validateEmail($('[name=correo]').val())) {
            $('#errorMessage').hide();
            //sendEmail({ 'id': 1, 'user_email': $('[name=correo]').val() }, 1);
            insertStat('correo', 'contacto');
        } else {
            $('#errorMessage').show();
        }
    });

    $('#sendCommentButton').click(function () {
        if (!($('#inputName').val().length === 0 &&
            $('#inputEmail').val().length === 0 &&
            $('#inputSubject').val().length === 0 &&
            $('#inputMessage').val().length === 0)) {

            if (validateEmail($('#inputEmail').val())) {
                let data = {
                    'id': 2,
                    'user_name': $('#inputName').val(),
                    'user_email': $('#inputEmail').val(),
                    'subject': $('#inputSubject').val(),
                    'message': $('#inputMessage').val()
                };
                //sendEmail(data, 2);
                saveComment(data);
                insertStat('comentario', 'contacto');
                $('#contactErrorMessage').hide();
            } else {
                $('#contactErrorMessage').hide();
                $('#contactErrorMessage').show();
                $('#contactErrorMessage').html('El correo no es correcto, escríbelo de nuevo con la forma <b>correo@dominio.com</b> o <b>correo@dominio.com.mx</b>');
            }
        } else {
            $('#contactErrorMessage').show();
            $('#contactErrorMessage').html('Por favor rellena todos los campos');
        }
    });
});

function sendEmail(data, id) {
    $.ajax({
        method: 'POST',
        url: 'https://us-central1-arcloud-299717.cloudfunctions.net/luminaMailing',
        data: data,
        success: function (response) {
            switch (id) {
                case 1:
                    $('#successMessage').show();
                    break;
                case 2:
                    console.log(response);
                    break;
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
}

function saveComment(data) {
    $.ajax({
        method: 'POST',
        url: 'system/controller/SaveNewComment.php',
        data: { data: data },
        beforeSend: function(){
            $('#contactInfoMessage').show();
        },
        success: function (response) {
            console.log(response);
            var jsonObject = JSON.parse(response);
            $('#contactInfoMessage').hide();
            $('#contactSuccessMessage').show();
            $('#contactSuccessMessage').html(jsonObject.response.body);
        },
        error: function (error) {
            console.log(error);
        }
    });
}

function scrollAnimation() {
    $(document).on('click', 'a[href^="#"]', function (event) {
        event.preventDefault();

        $('html, body').animate({
            scrollTop: $($.attr(this, 'href')).offset().top - 150
        }, 500);
    });
}

function readScroll() {
    $(window).scroll(function () {
        var scrollTop = $(document).scrollTop();
       
        if ($(document).scrollTop() > 200) {
            $('nav').addClass('navChanged').removeClass('navInactive');
        } else {
            $('nav').removeClass('navChanged').addClass('navInactive');
        }

        switch(scrollTop){
            case 700: // Seccion queines somos
                insertStat('visita','quienes_somos');
                break;
            case 1660: // Secion de servicios
                insertStat('visita', 'servicios');
                break;
            case 4162: // Seccion de Calendario
                insertStat('visita', 'agenda');
                break;
            case 5160: // Seccion de contacto
                insertStat('visita', 'contacto');
                break;        
        }
    });
}

function initScrollAnimations() {
    AOS.init();
}

function validateEmail(data) {
    var $regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!(data.match($regex))) {
        return false;
    } else {
        return true;
    }
}

function insertStat(accion, seccion){
    $.ajax({
        url: 'system/controller/LandingController.php',
        method: 'POST',
        data: {
            accion: accion,
            seccion: seccion
        },
        beforeSend: function(){
            console.log('Guardando acción...');  
        },
        success: function(response){
            if(response == "true"){
                console.log('Accion guardada');
            }else{
                console.log('No se guardó la acción', response);
            } 
        },
        error: function(error){
            console.log(error);
        }

    });
}