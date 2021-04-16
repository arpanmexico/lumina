$(document).ready(function(){
    let basic = $('#patientBasic');
    let datePanel = $('#datePanel');
    let moneyPanel = $('#moneyPanel');
    let btnSaveSell = $('#saveSell');
    let textID = $('#txtID');
    let textName = $('#txtName');
    let textDate = $('#txtDate');
    let textLastName = $('#txtLastName');
    let tipoPago = $('#tipoPago');
    let modalidadPago = $('#modalidadPago');
    let mensualidad = $('#mensualidad');
    let txtMensualidad = $('#txtMensualidad');
    let precioMes = $('#precioMes');
    let txtPrecioMes = $('#txtPrecioMes');
    let interes = $('#interes');
    let txtInteres = $('#txtInteres');
    let products = $('#productsPanel');
    let opcionesPaciente = $('#panelPaciente');
    let selectedProductsPanel = $('#selectedProductsPanel');
    let result = $('#sellMsg');
   

    result.hide();
    opcionesPaciente.hide();
    basic.hide();
    textID.attr('readonly', true);
    mensualidad.hide();
    precioMes.hide();
    interes.hide();
    products.hide();
    datePanel.hide();
    moneyPanel.hide();
    btnSaveSell.hide();
    $('#totalIndicator').hide();

    $('#esPaciente').click(function () {
        console.log('Es para un paciente');
        opcionesPaciente.fadeIn(800);
        localStorage.setItem('pagType', 'ven');
        textName.attr('readonly', true);
        textLastName.attr('readonly', true);
        textName.val("");
        textLastName.val("");
        products.fadeOut(800);
        datePanel.fadeOut(800);
        moneyPanel.fadeOut(800);
        btnSaveSell.fadeOut(800);
        $('#totalIndicator').fadeOut(800);
        selectedProductsPanel.fadeOut(800);
        selectedProductsPanel.html('');
        localStorage.setItem('products', '');
        localStorage.setItem('models', '');
        localStorage.setItem('brands', '');
        localStorage.setItem('prices', '');
        localStorage.setItem('stock', '');
        localStorage.setItem('type', '');
    });
    $('#noEsPaciente').click(function () {
        console.log('NO es para un paciente');
        opcionesPaciente.fadeOut(800);
        textName.attr('readonly', false);
        textLastName.attr('readonly', false);
        textName.val("");
        textLastName.val("");
        basic.fadeIn(800);
        products.fadeOut(800);
        datePanel.fadeOut(800);
        moneyPanel.fadeOut(800);
        btnSaveSell.fadeOut(800);
        $('#totalIndicator').fadeOut(800);
        selectedProductsPanel.fadeOut(800);
        selectedProductsPanel.html('');
        localStorage.setItem('pagType', '');
        $('#search').fadeOut(800);
        $("#search-title").fadeOut(800);
        localStorage.setItem('products', '');
        localStorage.setItem('models', '');
        localStorage.setItem('brands', '');
        localStorage.setItem('prices', '');
        localStorage.setItem('stock', '');
        localStorage.setItem('type', '');
    });

    textName.on('input', function(){
        products.fadeIn(800);
    });
    textLastName.on('input', function(){
        products.fadeIn(800);
    });
    
    modalidadPago.change(function(){
        switch (modalidadPago.val()){
            case 'C': //Contado
                mensualidad.fadeOut(800);
                precioMes.fadeOut(800);
                interes.fadeOut(800);
            break;
            case 'MSI': //Meses sin intereses
                mensualidad.fadeIn(800);
                precioMes.fadeIn(800);
                interes.fadeOut(800);
            break;
            case 'MCI': //Meses con intereses
                mensualidad.fadeIn(800);
                precioMes.fadeIn(800);
                interes.fadeIn(800);
            break;
        }
    });

    btnSaveSell.click(function(){
        let result = $('#sellMsg');
        mensualidades = 0;
        precio_mes = 0;
        txt_interes = 0;

        if(txtMensualidad.val() != ""){
            mensualidades =  txtMensualidad.val();
        }
        if(txtPrecioMes.val() != ""){
            precio_mes = txtPrecioMes.val();
        }
        if(txtInteres.val() != ""){
            txt_interes = txtInteres.val();
        }
        data = {
            'id_paciente': textID.val(),
            'productos': localStorage.getItem('products'),
            'nombre': textName.val(),
            'apellidos': textLastName.val(),
            'fecha': textDate.val(),
            'tipo_pago': tipoPago.val(),
            'modalidad_pago': modalidadPago.val(),
            'mensualidades': mensualidades,
            'precio_mes': precio_mes,
            'interes': txt_interes,
            'total': localStorage.getItem('total'),
            'cantidad': localStorage.getItem('quantity'),
            'models': localStorage.getItem('models'),
            'brands': localStorage.getItem('brands'),
            'type': localStorage.getItem('type'),
            'price': localStorage.getItem('prices') 

        };

        if(data['fecha'] == "" || data['nombre'] == "" || data['apellidos'] == "" || data['tipo_pago'] == "" || data['modalidad_pago'] == "" ){
            result.hide();
            result.html('<lottie-player src="https://assets6.lottiefiles.com/packages/lf20_0iHUgw.json"  background="transparent"  speed="1"  style="width: 100%; height: 25vh;"  loop  autoplay></lottie-player><h4 class="text-center font-weight-bolder py-3 text-warning">Oops!. Hay campos marcados con un <span class="text-danger"> * </span> sin llenar.</h4>');
            result.fadeIn(800);
            setTimeout(function () { result.fadeOut(800); }, 3500);
        }else{
            saveSell(data);
            imprimirTicket(data);
        }
        
    });
});


function selectPatient(id_paciente, nombre, apellidos){
    let textID = $('#txtID');
    let textName = $('#txtName');
    let textLastName = $('#txtLastName');
    let basic = $('#patientBasic');
    let products = $('#productsPanel');
    
    basic.fadeIn(800);
    products.fadeIn(800);
    textID.val(id_paciente);
    textName.val(nombre);
    textName.attr('readonly', true);
    textLastName.val(apellidos);
    textLastName.attr('readonly', true);
   
    
}

function saveProducts(){
    let datePanel = $('#datePanel');
    let moneyPanel = $('#moneyPanel');
    let saveSell = $('#saveSell');
    let productsPanel = $('#selectedProductsPanel');
    datePanel.fadeIn(800);
    moneyPanel.fadeIn(800);
    saveSell.fadeIn(800);

    products = localStorage.getItem('products');
    arrProducts = products.split(',');
    models = localStorage.getItem('models');
    arrModels = models.split(',');
    brands = localStorage.getItem('brands');
    arrBrands = brands.split(',');
    prices = localStorage.getItem('prices');
    arrPrices = prices.split(',');
    stock = localStorage.getItem('stock');
    arrStock = stock.split(',');
    types = localStorage.getItem('type');
    arrTypes = types.split(',');

    console.log(arrProducts, arrModels, arrBrands, arrPrices, arrStock, arrTypes);

    productsPanel.html('<h5 class="font-weight-bold text-muted mt-4">Productos seleccionados</h5>')
    productsPanel.append('<div class="row"><label class="text-muted text-wrap font-weight-bold mx-auto my-2">Tipo</label><label class="text-muted font-weight-bold col-md-2 mx-auto my-2">Código</label><label class="text-muted font-weight-bold col-md-2 mx-auto my-2">Modelo</label><label class="text-muted font-weight-bold col-md-3 mx-auto my-2">Marca</label><label class="text-muted font-weight-bold col-md-2 mx-auto my-2">Precio</label><label class="text-muted font-weight-bold col-md-1 mx-auto my-2">Cant.</label></div>')
    arrProducts.forEach((element, index, array) => {
        if(element != ""){
            productsPanel.append(
                '<div class="row"><label class="my-auto small text-muted">'+ arrTypes[index] +'</label><input readonly class="form-control mx-auto my-2 col-md-2" value="' + element +'"><input readonly class="form-control mx-auto my-2 col-md-2" value="' + arrModels[index] +'"><input readonly class="form-control mx-auto my-2 col-md-3" value="' + arrBrands[index] +'"><input readonly id="price'+element+'" class="form-control mx-auto my-2 col-md-2" value="' + arrPrices[index] +'"><input type="number" id="quantity'+ element +'" onchange="changeQuantity('+element+','+index+');" class="form-control input-number mx-auto my-2 col-md-1" min=1 max=' + arrStock[index] +' value="1"></div>'
            );
        }else{
            $('tr').removeClass('row-selected');
        } 
    });
    productsPanel.fadeIn(800);
    calculateTotal(arrPrices);
}

function selectProduct(product, model, brand, price, stock, type, quantity){
    arrProduct = localStorage.getItem('products');
    arrModel = localStorage.getItem('models');
    arrBrand = localStorage.getItem('brands');
    arrPrice = localStorage.getItem('prices');
    arrStock = localStorage.getItem('stock');
    arrType = localStorage.getItem('type');
    arrQuantity = localStorage.getItem('quantity');

    localStorage.setItem('products', arrProduct + product + ',');
    localStorage.setItem('models', arrModel + model + ',');
    localStorage.setItem('brands', arrBrand + brand + ',');
    localStorage.setItem('prices', arrPrice + price + ',');
    localStorage.setItem('stock', arrStock + stock + ',');
    localStorage.setItem('type', arrType + type + ',');
    localStorage.setItem('quantity', arrQuantity + quantity + ',');

    $('#row'+product).addClass('row-selected');
    
}

function cancelProducts(){
    localStorage.setItem('products', '');
    localStorage.setItem('models', '');
    localStorage.setItem('brands', '');
    localStorage.setItem('prices', '');
    localStorage.setItem('stock', '');
    localStorage.setItem('type', '');
}

function changeQuantity(element, index){
    let input = $('#quantity'+element).val();
    let text = $('#price'+element);
    products = localStorage.getItem('products');
    arrProducts = products.split(',');
    
    prices = localStorage.getItem('prices');
    arrPrices = prices.split(',');

    quantity = localStorage.getItem('quantity');
    arrQuantity = quantity.split(',');

    newPrice = arrPrices[index] * input;

    arrPrices[index] = newPrice;
    arrQuantity[index] = input;

    localStorage.setItem('quantity',arrQuantity);
    text.val(newPrice);
    console.log(arrPrices);
    calculateTotal(arrPrices);
}

function calculateTotal(prices){
    sum = 0.0;
    prices.forEach(element =>{
        if(element != ""){
            sum += parseFloat(element);
        }
    });

    console.log('Total: ', sum);
    $('#totalIndicator').html('$  '+ sum + ' MXN');
    $('#txtTotal').val(sum);
    $('#totalIndicator').fadeIn(800);
    localStorage.setItem('total', sum);
}

function saveSell(data){
    let result = $('#sellMsg');
    console.log(data);
    $.ajax({
        url: "../../system/controller/SellController.php",
        type: "POST",
        data: {
            action: 'venta',
            venta: data
        },
        beforeSend: function (){
            result.html('<div class="spinner mx-auto"></div><h3 class="mx-auto text-center">Cargando...</h3><h5 class="mx-auto text-center">Espere un momento por favor</h5>');
            result.fadeIn(800);
        },
        error: function (error) {
            console.log('No se guardó la venta', error);
            result.fadeIn(800);
        },
        success: function (response) {
            result.hide();
            console.log(response);
            if(response == 'true'){
                result.addClass('bg-primary');
                result.html('<lottie-player src="https://assets6.lottiefiles.com/packages/lf20_gaSt56.json" background="#4E73DF"  speed="1"  style="width: 100%; height: 25vh;"  loop  autoplay></lottie-player><h4 class="text-center font-weight-bolder bg-primary py-3 text-white">Venta guardada con éxito!</h4>');
                result.fadeIn(800);
                setTimeout(function () { result.fadeOut(800); }, 2200);
                setTimeout(function () { location.reload(); }, 2900);
            }else{
                result.html('<lottie-player src="https://assets2.lottiefiles.com/packages/lf20_ed9D2z.json"  background="transparent"  speed=".5"  style="width: 100%; height: 25vh;"  loop  autoplay></lottie-player><h4 class="text-center font-weight-bolder py-3 text-danger">Oops ha ocurrido un error! Por favor vuelve a intentarlo</h4>');
                result.fadeIn(800);
                setTimeout(function () { result.fadeOut(800); }, 3500);
            }
        },
    });
}

function sellInfo(id, name, lastname, date, payment_type, modality_pay, monthly, price_month, interest, sell_total, products){
    let modalSell = $('#sellInfo');
    let title = $('#sellInfoTitle');
    let txtName = $('#sellInfoName');
    let txtLastName = $('#sellInfoLastName');
    let txtDate = $('#sellInfoDate');
    let txtPayment = $('#sellInfoPay');
    let txtModality = $('#sellInfoModality');
    let txtMonthly = $('#sellInfoMonthly');
    let txtPrice = $('#sellInfoPrice');
    let txtInterest = $('#sellInfoInterest');
    let txtTotal = $('#sellInfoTotal');
    let result = $('#productsTable');

    var onlyDate = date.split(" ", 2);
    var formatDate = onlyDate[0].split("-", 3);

    let arrMonth = {
        '01': 'enero',
        '02': 'febrero',
        '03': 'marzo',
        '04': 'abril',
        '05': 'mayo',
        '06': 'junio',
        '07': 'julio',
        '08': 'agosto',
        '09': 'septiembre',
        '10': 'octubre',
        '11': 'noviembre',
        '12': 'diciembre',
    };

    title.html("Identificador de la venta: " + id);
    txtName.val(name);
    txtLastName.val(lastname);
    txtPayment.val(payment_type);
    txtModality.val(modality_pay);
    txtMonthly.val(monthly);
    txtPrice.val(price_month);
    txtInterest.val(interest);
    txtTotal.html("$ " + sell_total + " MXN");
    txtDate.html(formatDate[2] + " de " + arrMonth[formatDate[1]] + " del " + formatDate[0]);
    modalSell.modal();

    $.ajax({
        url: "../../system/controller/SellController.php",
        type: "POST",
        data: {
            products: products
        },
        beforeSend: function (){
            result.html('<div class="spinner mx-auto"></div><h3 class="mx-auto text-center">Cargando...</h3><h5 class="mx-auto text-center">Espere un momento por favor</h5>');
            result.fadeIn(800);
        },
        error: function (error) {
            console.log('No se mostraron los productos', error);
            result.html('<div class="alert alert-danger text-center">Ha ocurrido un error inesperado</div>');
            result.fadeIn(800);
        },
        success: function (response) {
            result.hide();
            result.html(response);
            result.fadeIn(800);
        },
    });
}

function imprimirTicket(data) {
    let result = $('#sellMsg');
    console.log(data);
    $.ajax({
        url: "../../system/controller/ImprimirController.php",
        type: "POST",
        data: {
            action: 'venta',
            venta: data
        },
        beforeSend: function (){
            result.html('<div class="spinner mx-auto"></div><h3 class="mx-auto text-center">Cargando...</h3><h5 class="mx-auto text-center">Espere un momento por favor</h5>');
            result.fadeIn(800);
        },
        error: function (error) {
            console.log('No se guardó la venta', error);
            result.fadeIn(800);
        },
        success: function (response) {
            result.hide();
            console.log(response);
            if(response == 'true'){
                result.addClass('bg-primary');
                result.html('<lottie-player src="https://assets6.lottiefiles.com/packages/lf20_gaSt56.json" background="#4E73DF"  speed="1"  style="width: 100%; height: 25vh;"  loop  autoplay></lottie-player><h4 class="text-center font-weight-bolder bg-primary py-3 text-white">Venta guardada con éxito!</h4>');
                result.fadeIn(800);
                setTimeout(function () { result.fadeOut(800); }, 2200);
                setTimeout(function () { location.reload(); }, 2900);
            }else{
                result.html('<lottie-player src="https://assets2.lottiefiles.com/packages/lf20_ed9D2z.json"  background="transparent"  speed=".5"  style="width: 100%; height: 25vh;"  loop  autoplay></lottie-player><h4 class="text-center font-weight-bolder py-3 text-danger">Oops ha ocurrido un error! Por favor vuelve a intentarlo</h4>');
                result.fadeIn(800);
                setTimeout(function () { result.fadeOut(800); }, 3500);
            }
        },
    });
}