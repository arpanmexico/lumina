$(document).ready(function () {
    let route = String(window.location.search);
    let rol = route.split("=", 2)[0];
    page = 1;

    switch(rol){
        case '?listarMarcas':
            
            type = "cat";
            ext = 2;
            saveLocalStorage(ext, type, page)
            break;
        case '?listarCategoriasProductos':
            
            type = "cat";
            ext = 1;
            saveLocalStorage(ext, type, page)
            break;
        case '?listarEnfermedades':
            
            type = "cat";
            ext = 3;
            saveLocalStorage(ext, type, page)
            break;         
        case '?listarProveedores':
            
            type = "cat";
            ext = 4;
            saveLocalStorage(ext, type, page)
            break;         
        case '?listarArmazones':
            
            type = "arm";
            ext = "";
            saveLocalStorage(ext, type, page)
            break;         
        case '?listarDoctores':
            
            type = "doc";
            ext = "";
            saveLocalStorage(ext, type, page)
            break;         
        case '?listarPacientes':
            
            type = "pac";
            ext = "";
            saveLocalStorage(ext, type, page)
            break;         
        case '?sucursal':
            
            type = "";
            ext = "";
            saveLocalStorage(ext, type, page)
            break;         
        case '?analisis':
            
            type = "";
            ext = "";
            saveLocalStorage(ext, type, page)
            break;         
    }
    if(localStorage.getItem('pagType')){
        type = localStorage.getItem('pagType');
        page = localStorage.getItem('pageNum');
        ext = localStorage.getItem('ext');
        loadPagination(type,page, ext);
    }
});


// Función que llama al controlador de paginación por medio de AJAX
function loadPagination(type,page, ext){
    let result = $('#data');
    result.hide();
    data = "";
    if(ext != ""){
        data = {
            type : type,
            page : page,
            ext : ext
        }
    }else{
        data = {
            type : type,
            page : page
        }
    }
    $.ajax({
        url: "../../system/controller/pagination.php",
        type: "POST",
        data: data,
        beforeSend: function (){
              result.html('<div class="spinner mx-auto"></div><h3 class="mx-auto text-center">Cargando...</h3><h5 class="mx-auto text-center">Espere un momento por favor</h5>');
              result.fadeIn(800);
        },
        error: function (error) {
            
        },
        success: function (data) {
            result.hide();
            result.html(data);
            result.fadeIn(800);
        },
    });
}

function linkClick(page, ext){
    console.log('clicked', page);
    window.localStorage.setItem('pageNum', page);
    type = localStorage.getItem('pagType');
    ext = localStorage.getItem('ext');
    loadPagination(type, page, ext);
}

function saveLocalStorage(ext, type, page){
    window.localStorage.setItem('ext', ext);
    window.localStorage.setItem('pagType', type);
    window.localStorage.setItem('pageNum', page);
}


