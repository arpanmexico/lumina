$(document).ready(function () {
    let route = String(window.location.search);
    let rol = route.split("=", 2)[0];
    let searchBar = $('#search-input');
    let searchContent = $('#search-content');
    let searchMsg = $('#search-msg');
    let pacMsg = $('#search-msg-pac');
    let searchPac = $('#search-input-pac');
    let basic = $('#patientBasic');
    let products = $('#productsPanel');
    let textName = $('#txtName');
    let textLastName = $('#txtLastName');
    let textPhoneNumber = $('#txtPhoneNumber');
    let pregunta = $('#preguntaPaciente');
    page = 1;
    searchMsg.hide();
    pacMsg.hide();
    
    switch(rol){
        case '?listarMarcas':
            searchContent.fadeIn(800);
            searchBar.attr("placeholder", "Escribe para buscar marcas");
            type = "cat";
            ext = 2;
            saveLocalStorage(ext, type, page)
            break;
        case '?listarCategoriasProductos':
            searchContent.fadeIn(800);
            searchBar.attr("placeholder", "Escribe para buscar lentes");
            type = "cat";
            ext = 1;
            saveLocalStorage(ext, type, page)
            break;
        case '?listarEnfermedades':
            searchContent.fadeIn(800);
            searchBar.attr("placeholder", "Escribe para buscar enfermedades");
            type = "cat";
            ext = 3;
            saveLocalStorage(ext, type, page)
            break;         
        case '?listarProveedores':
            searchContent.fadeIn(800);
            searchBar.attr("placeholder", "Escribe para buscar proveedores");
            type = "cat";
            ext = 4;
            saveLocalStorage(ext, type, page)
            break;         
        case '?listarArmazones':
            searchContent.fadeIn(800);
            searchBar.attr("placeholder", "Escribe para buscar armazones");
            type = "arm";
            ext = "";
            saveLocalStorage(ext, type, page)
            break;         
        case '?listarDoctores':
            searchContent.fadeIn(800);
            searchBar.attr("placeholder", "Escribe para buscar doctores");
            type = "doc";
            ext = "";
            saveLocalStorage(ext, type, page)
            break;         
        case '?listarPacientes':
            searchContent.fadeIn(800);
            searchBar.attr("placeholder", "Escribe para buscar pacientes");
            type = "pac";
            ext = "";
            saveLocalStorage(ext, type, page)
            break;         
        case '?listarVentas':
            searchContent.fadeIn(800);
            searchBar.attr("placeholder", "Escribe para buscar ventas");
            type = "ven";
            ext = 1;
            saveLocalStorage(ext, type, page)
            break;         
        case '?sucursal':
            searchContent.fadeOut(800);
            type = "";
            ext = "";
            saveLocalStorage(ext, type, page)
            break;         
        case '?analisis':
            searchContent.fadeOut(800);
            type = "";
            ext = "";
            saveLocalStorage(ext, type, page)
            break;
        case '?crearVentas':
            localStorage.setItem('products', '');
            localStorage.setItem('models', '');
            localStorage.setItem('brands', '');
            localStorage.setItem('prices', '');
            localStorage.setItem('stock', '');
            localStorage.setItem('type', '');
            localStorage.setItem('quantity', '');
            localStorage.setItem('total', '');
            type = "ven";
            ext = 2;
            saveLocalStorage(ext, type, page)
            break;    
        case '?crearSalida':
            localStorage.setItem('products', '');
            localStorage.setItem('models', '');
            localStorage.setItem('brands', '');
            localStorage.setItem('prices', '');
            localStorage.setItem('stock', '');
            localStorage.setItem('type', '');
            localStorage.setItem('quantity', '');
            type = "out";
            ext = "";
            saveLocalStorage(ext, type, page)
            break;    
        case '?crearVentas&name':
            localStorage.setItem('products', '');
            localStorage.setItem('models', '');
            localStorage.setItem('brands', '');
            localStorage.setItem('prices', '');
            localStorage.setItem('stock', '');
            localStorage.setItem('type', '');
            localStorage.setItem('quantity', '');
            localStorage.setItem('total', '');
            type = "ven";
            ext = 2;
            saveLocalStorage(ext, type, page)
            console.log("Venta automática");
            basic.fadeIn(800);
            products.fadeIn(800);
            pregunta.hide()
            textName.attr('readonly', true);
            textLastName.attr('readonly', true);
            textPhoneNumber.attr('readonly', true);
            break;    
        default:
            searchContent.fadeOut(800);

    }
    if(localStorage.getItem('pagType')){
        type = localStorage.getItem('pagType');
        page = localStorage.getItem('pageNum');
        ext = localStorage.getItem('ext');
        loadPagination(type,page, ext);
    }

    searchBar.on("input", function(){
        if (searchBar.val() != ""){
            searchMsg.fadeIn(600);
        }else{
            searchMsg.fadeOut(800);
        }
    });
    searchPac.on("input", function(){
        if (searchPac.val() != ""){
            pacMsg.fadeIn(600);
        }else{
            pacMsg.fadeOut(800);
        }
    });

    searchBar.on("keypress", function(e){
        if(e.which == 13){
            let text = searchBar.val();
            ext = localStorage.getItem("ext");
            type = localStorage.getItem("pagType");
            search(text, type, ext);
        }
    });

    searchPac.on("keypress", function(e){
        if(e.which == 13){
            let text = searchPac.val();
            ext = localStorage.getItem("ext");
            type = localStorage.getItem("pagType");
            search(text, type, ext);
        }
    });

   
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
        url: "../../system/controller/PaginationController.php",
        type: "POST",
        data: data,
        beforeSend: function (){
              result.html('<div class="spinner mx-auto"></div><h3 class="mx-auto text-center">Cargando...</h3><h5 class="mx-auto text-center">Espere un momento por favor</h5>');
              result.fadeIn(800);
        },
        error: function (error) {
            console.log('No se pudo cargar la paginacipon -> ', error);
        },
        success: function (data) {
            result.hide();
            result.html(data);
            result.fadeIn(800);
        },
    });
}

// Funcion para el numero de página
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

function search(text, type, ext){
    let result = $('#search');
    result.hide();
    data = "";
    if(ext != ""){
        data = {
            text : text,
            type : type,
            ext : ext
        }
    }else{
        data = {
            type : type,
            text : text
        }
    }
    $.ajax({
        url: "../../system/controller/SearchController.php",
        type: "POST",
        data: data,
        beforeSend: function (){
              result.html('<div class="spinner mx-auto"></div><h3 class="mx-auto text-center">Cargando...</h3><h5 class="mx-auto text-center">Espere un momento por favor</h5>');
              result.fadeIn(800);
        },
        error: function (error) {
            
        },
        success: function (data) {
            $("#search-title").fadeIn(800).html("Resultados relacionados con <strong>" + text + "</strong>");
            result.hide();
            result.html(data);
            result.fadeIn(800);
        },
    });
}






