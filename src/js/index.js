$('#errorMessage').hide();
$('#successMessage').hide();
$('#contactErrorMessage').hide();
$('#contactSuccessMessage').hide();
$('#contactInfoMessage').hide();

$(document).ready(function () {
    initScrollAnimations();
    scrollAnimation();
    readScroll();

    $('#contactButton').click(function () {
        if (validateEmail($('[name=correo]').val())) {
            $('#errorMessage').hide();
            sendEmail({ 'id': 1, 'user_email': $('[name=correo]').val() }, 1);
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
                sendEmail(data, 2);
                saveComment(data);
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
        if ($(document).scrollTop() > 200) {
            $('nav').addClass('navChanged').removeClass('navInactive');
        } else {
            $('nav').removeClass('navChanged').addClass('navInactive');
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