$(document).ready(function(){
    $('.clockpicker').clockpicker({
        placement: 'top',
        align: 'left',
        autoclose: true
    });
    $('#txtPhone').on('input', function(){
        if($('#txtPhone').val().length > 10 || $('#txtPhone').val().length < 10){
            $('#phoneValidation').fadeIn(800);
        }else{
            $('#phoneValidation').hide();
        }
    });
    $('label').addClass('font-weight-bold text-muted');
    $('#phoneValidation').hide();

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        themeSystem: 'bootstrap',
        locale: 'es',
        events:'http://localhost:9000/lumina/system/controller/CalendarController.php?action=landing',
        dateClick:function(info){
            clear();
            $('#eventTitle').html("Agregar una nueva cita: " + info.dateStr);
            $('#txtDate').val(info.dateStr);
            $('#btnAdd').show();
            $('#btnDelete').hide();
            $('#btnUpdate').hide();
            $('#colorContent').show();
            $('#emptyField').hide();
            $('#wrongDate').hide();
            $('#eventModal').modal();
        },
        eventTimeFormat: { // like '14:30:00'
        hour: 'numeric',
        minute: '2-digit',
        meridiem: 'short'
        }
        
    });
    calendar.render();
    var event;
    
    $('#btnAdd').click(function(){
        getDataFromUI();
        if(validate()){
            setData('add', event);
            insertStat('cita', 'agenda');
        }
    });

    
    function getDataFromUI(){
        event = {
            id:$('#eventId').val(),
            nombre:$('#txtName').val(),
            apellidos:$('#txtLastName').val(),
            telefono:$('#txtPhone').val(),
            descripcion:$('#txtDescription').val(),
            title:$('#txtName').val() + " " + $('#txtLastName').val(),
            date:$('#txtDate').val() + " " + $('#txtTime').val(),
            textColor:"#FFFFFF",
            color: "#EF6C00"
        };
    }

    function setData(action, objEvent){
        $.ajax({
            type: 'POST',
            url: 'http://localhost:9000/lumina/system/controller/CalendarController.php?action=' + action,
            data: objEvent,
            success:function(msg){
                calendar.refetchEvents();
                $('#eventModal').modal('toggle');
            },
            error:function(error){
                alert("Ha ocurrido un error" + error.msg);
            }
        });
    }
    
    function clear(){
        $('#eventId').val("");
        $('#txtName').val("");
        $('#txtLastName').val("");
        $('#txtTime').val("12:00");
        $('#txtDescription').val("");
        $('#txtPhone').val("");
    }

    function validate(){
        let name= $('#txtName').val();
        let lastName = $('#txtLastName').val();
        
        let time = $('#txtTime').val();
        let date = $('#txtDate').val();
        let phone = $('#txtPhone').val();
        let emptyField = $('#emptyField');
        let wrongDate = $('#wrongDate');
        var selectDate = new Date(date);
        var today = new Date();
        var newDate = new Date(selectDate.setDate(selectDate.getDate() + 1));
        

        if(name == "" || lastName == "" || time == "" || phone == ""){
            console.log("Campos vacios");
            emptyField.fadeIn(800);
            return false;
        }else if( newDate < today){
            console.log("Fecha inaccessible: ", newDate.getDate(), " < " ,today);
            wrongDate.fadeIn(800);
            return false;
        }else{
            return true;
        }
    }

    
});
