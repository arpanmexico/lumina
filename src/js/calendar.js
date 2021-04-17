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
        headerToolbar: {
            right: 'prev,next today',
            center: 'title',
            left: 'dayGridMonth,timeGridWeek,timeGridDay'
          },
        initialView: 'dayGridMonth',
        themeSystem: 'bootstrap',
        locale: 'es',
        //events:'http://localhost:9000/lumina/system/controller/CalendarController.php?action=',
        events:'https://www.luminaoptica.com.mx/system/controller/CalendarController.php?action=',
        select: function(start, end) {
            if(start.isBefore(moment())) {
                calendar.unselect();
                return false;
            }
        },
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
        eventClick:function(info){
            $('#eventTitle').html(info.event.title);
            $('#eventId').val(info.event.id);
            $('#txtName').val(info.event.extendedProps.nombre);
            $('#txtLastName').val(info.event.extendedProps.apellidos);
            $('#colorContent').hide();
            $('#txtDescription').val(info.event.extendedProps.descripcion);
            $('#txtPhone').val(info.event.extendedProps.telefono);
            $('#emptyField').hide();
            $('#wrongDate').hide();

           DateTime = info.event.startStr.split("T");
           console.log(DateTime);
            $('#txtDate').val(DateTime[0]);
            $('#txtTime').val(DateTime[1].split("-")[0]);
            $('#btnAdd').hide();
            $('#btnDelete').show();
            $('#btnUpdate').show();
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

    $('#btnDelete').click(function(){
        getDataFromUI();
        setData('drop', event);
    });
    $('#btnAdd').click(function(){
        getDataFromUI();
        if(validate()){
            setData('add', event);
        }
    });

    $('#btnUpdate').click(function(){
        getDataFromUI();
        if(validate()){
            setData('update', event);
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
            color: $('#txtColor').val()
        };
    }

    function setData(action, objEvent){
        $.ajax({
            type: 'POST',
            //url: 'http://localhost:9000/lumina/system/controller/CalendarController.php?action=' + action,
            url:'https://www.luminaoptica.com.mx/system/controller/CalendarController.php?action=' + action,
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
        $('#txtColor').val("");
        $('#txtTime').val("12:00");
        $('#txtDescription').val("");
        $('#txtPhone').val("");
    }

    function validate(){
        let name= $('#txtName').val();
        let lastName = $('#txtLastName').val();
        let color = $('#txtColor').val();
        let time = $('#txtTime').val();
        let date = $('#txtDate').val();
        let phone = $('#txtPhone').val();
        let emptyField = $('#emptyField');
        let wrongDate = $('#wrongDate');
        var selectDate = new Date(date);
        var today = new Date();
        var newDate = new Date(selectDate.setDate(selectDate.getDate() + 1));
        

        if(name == "" || lastName == "" || color == "" || time == "" || phone == ""){
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