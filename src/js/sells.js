$(document).ready(function () {
  let basic = $('#patientBasic');
  let datePanel = $('#datePanel');
  let moneyPanel = $('#moneyPanel');
  let btnSaveSell = $('#saveSell');
  let textID = $('#txtID');
  let uniqueid = $('#txtUID');
  let textName = $('#txtName');
  let textDate = $('#txtDate');
  let textLastName = $('#txtLastName');
  let textPhoneNumber = $('#txtPhoneNumber');
  let tipoPago = $('#tipoPago');
  let modalidadPago = $('#modalidadPago');
  let tipoDescuento = $('#tipoDescuento');
  let descuento = $('#descuento');
  let anticipo = $('#anticipo');
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
  moneyPanel.hide();
  btnSaveSell.hide();
  calculateDiscount('NA', 0);
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
    textPhoneNumber.attr('readonly', false);
    textName.val("");
    textLastName.val("");
    textPhoneNumber.val("");
    basic.fadeIn(800);
    products.fadeOut(800);
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

  textName.on('input', function () {
    products.fadeIn(800);
  });
  textLastName.on('input', function () {
    products.fadeIn(800);
  });

  modalidadPago.change(function () {
    switch (modalidadPago.val()) {
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

  tipoDescuento.change(function(){
    switch(tipoDescuento.val()){
      case 'D':
        descuento.val(''); 
        descuento.attr('readonly', false);
        descuento.attr('placeholder', 'Ingresa el monto del descuento');
        break;
      case 'T':
        descuento.val(''); 
        descuento.attr('readonly', true);
        descuento.attr('placeholder', 'Se aplicará descuento total de la venta');
        descuento.val(localStorage.getItem('total'));
        break;
      case 'P':
        descuento.val(''); 
        descuento.attr('readonly', false);    
        descuento.attr('placeholder', 'Ingresa el porcentaje del descuento');
        break;
      default:
        descuento.val(''); 
        descuento.attr('readonly', true);
        descuento.attr('placeholder', 'No se aplicará descuento');
        descuento.val('');      
    }

    calculateDiscount(tipoDescuento.val(), descuento.val());
  });

  descuento.on('input',function(){
    calculateDiscount(tipoDescuento.val(), descuento.val());
  });

  btnSaveSell.click(function () {
    let result = $('#sellMsg');
    mensualidades = 0;
    precio_mes = 0;
    txt_interes = 0;

    if (txtMensualidad.val() != "") {
      mensualidades = txtMensualidad.val();
    }
    if (txtPrecioMes.val() != "") {
      precio_mes = txtPrecioMes.val();
    }
    if (txtInteres.val() != "") {
      txt_interes = txtInteres.val();
    }
    data = {
      'id_venta': uniqueid.val(),
      'id_paciente': textID.val(),
      'productos': localStorage.getItem('products'),
      'nombre': textName.val(),
      'apellidos': textLastName.val(),
      'telefono': textPhoneNumber.val(), 
      'fecha': textDate.val(),
      'tipo_pago': tipoPago.val(),
      'modalidad_pago': modalidadPago.val(),
      'tipo_descuento': tipoDescuento.val(),
      'descuento': localStorage.getItem('discount'),
      'anticipo': anticipo.val() == '' ? 0 : anticipo.val(),
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

    if (data['fecha'] == "" || data['nombre'] == "" || data['apellidos'] == "" || data['tipo_pago'] == "" || data['modalidad_pago'] == "") {
      result.hide();
      result.html('<lottie-player src="https://assets6.lottiefiles.com/packages/lf20_0iHUgw.json"  background="transparent"  speed="1"  style="width: 100%; height: 25vh;"  loop  autoplay></lottie-player><h4 class="text-center font-weight-bolder py-3 text-warning">Oops!. Hay campos marcados con un <span class="text-danger"> * </span> sin llenar.</h4>');
      result.fadeIn(800);
      setTimeout(function () { result.fadeOut(800); }, 3500);
    } else {
      printSell(data);
      saveSell(data);
    }
  });

  $('[name=mensualidad]').keyup(function () {
    //precioMes
    var total = parseFloat($('#totalIndicator').text());
    var meses = parseFloat($('[name=mensualidad]').val());
    $('[name=precioMes]').val(total / meses);
  });
});


function selectPatient(id_paciente, nombre, apellidos, telefono) {
  console.log(id_paciente + " -> " + nombre + " -> " + apellidos + " -> " + telefono);


  let textID = $('#txtID');
  let textName = $('#txtName');
  let textLastName = $('#txtLastName');
  let textPhoneNumber = $('#txtPhoneNumber');
  let basic = $('#patientBasic');
  let products = $('#productsPanel');

  basic.fadeIn(800);
  products.fadeIn(800);
  textID.val(id_paciente);

  textName.val(nombre);
  textName.attr('readonly', true);

  textLastName.val(apellidos);
  textLastName.attr('readonly', true);

  textPhoneNumber.val(telefono);
  textPhoneNumber.attr('readonly', true);
}

function saveProducts() {
  let datePanel = $('#datePanel');
  let moneyPanel = $('#moneyPanel');
  let saveSell = $('#saveSell');
  let productsPanel = $('#selectedProductsPanel');
  let tipoDescuento = $('#tipoDescuento');
  let descuento = $('#descuento');
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

  productsPanel.html('<h5 class="font-weight-bold text-muted mt-4">Productos seleccionados</h5>')
  productsPanel.append('<div class="row"><label class="text-muted text-wrap font-weight-bold mx-auto my-2">Tipo</label><label class="text-muted font-weight-bold col-md-2 mx-auto my-2">Código</label><label class="text-muted font-weight-bold col-md-2 mx-auto my-2">Modelo</label><label class="text-muted font-weight-bold col-md-3 mx-auto my-2">Marca</label><label class="text-muted font-weight-bold col-md-2 mx-auto my-2">Precio</label><label class="text-muted font-weight-bold col-md-1 mx-auto my-2">Cant.</label></div>')
  arrProducts.forEach((element, index, array) => {
    if (element != "") {
      productsPanel.append(
        '<div class="row"><label class="my-auto small text-muted">' + arrTypes[index] + '</label><input readonly class="form-control mx-auto my-2 col-md-2" value="' + element + '"><input readonly class="form-control mx-auto my-2 col-md-2" value="' + arrModels[index] + '"><input readonly class="form-control mx-auto my-2 col-md-3" value="' + arrBrands[index] + '"><input readonly id="price' + element + '" class="form-control mx-auto my-2 col-md-2" value="' + arrPrices[index] + '"><input type="number" id="quantity' + element + '" onchange="changeQuantity(' + element + ',' + index + ');" class="form-control input-number mx-auto my-2 col-md-1" min=1 max=' + arrStock[index] + ' value="1"></div>'
      );
    } else {
      $('tr').removeClass('row-selected');
    }
  });
  productsPanel.fadeIn(800);
  calculateTotal(arrPrices);
  calculateDiscount(tipoDescuento.val(), descuento.val());
  if(tipoDescuento.val() == 'T'){
    descuento.val(localStorage.getItem('total'));
  }
 
}

function selectProduct(product, model, brand, price, stock, type, quantity) {
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

  $('#row' + product).addClass('row-selected');

}

function cancelProducts() {
  localStorage.setItem('products', arrProduct + '');
  localStorage.setItem('models',  arrModel + '');
  localStorage.setItem('brands', arrBrand + '');
  localStorage.setItem('prices', arrPrice + '');
  localStorage.setItem('stock', arrStock + '');
  localStorage.setItem('type', arrType + '');
  localStorage.setItem('quantity', arrQuantity + '');
}

function changeQuantity(element, index) {
  let input = $('#quantity' + element).val();
  let text = $('#price' + element);
  let tipoDescuento = $('#tipoDescuento');
  let descuento = $('#descuento');
  products = localStorage.getItem('products');
  arrProducts = products.split(',');

  prices = localStorage.getItem('prices');
  arrPrices = prices.split(',');

  quantity = localStorage.getItem('quantity');
  arrQuantity = quantity.split(',');

  newPrice = arrPrices[index] * input;

  arrPrices[index] = newPrice;
  arrQuantity[index] = input;

  localStorage.setItem('quantity', arrQuantity);
  text.val(newPrice);
  console.log(arrPrices);
  calculateTotal(arrPrices);
  calculateDiscount(tipoDescuento.val(), descuento.val());
  if(tipoDescuento.val() == 'T'){
    descuento.val(localStorage.getItem('total'));
  }
}

function calculateTotal(prices) {
  sum = 0.0;
  prices.forEach(element => {
    if (element != "") {
      sum += parseFloat(element);
    }
  });
  $('#totalIndicator').html(sum + '.00');
  $('#txtTotal').val(sum);
  $('#totalIndicator').fadeIn(800);
  localStorage.setItem('total', sum);
}

function saveSell(data) {
  let result = $('#sellMsg');
  $.ajax({
    url: "../../system/controller/SellController.php",
    type: "POST",
    data: {
      action: 'venta',
      venta: data
    },
    beforeSend: function () {
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
        result.html('<lottie-player src="https://assets6.lottiefiles.com/packages/lf20_gaSt56.json" background="#4E73DF"  speed="1"  style="width: 100%; height: 25vh;"  loop  autoplay></lottie-player><h4 class="text-center font-weight-bolder bg-primary py-3 text-white">Venta guardada con éxito!</h4>');
        result.fadeIn(800);
        setTimeout(function () { result.fadeOut(800); }, 2200);
        setTimeout(function () { window.location.href = "dashboard.php?listarVentas"; }, 2900);
      } else {
        result.html('<lottie-player src="https://assets2.lottiefiles.com/packages/lf20_ed9D2z.json"  background="transparent"  speed=".5"  style="width: 100%; height: 25vh;"  loop  autoplay></lottie-player><h4 class="text-center font-weight-bolder py-3 text-danger">Oops ha ocurrido un error! Por favor vuelve a intentarlo</h4>');
        result.fadeIn(800);
        setTimeout(function () { result.fadeOut(800); }, 3500);
      }
    },
  });
}

function sellInfo(id, name, lastname, date, payment_type, modality_pay, discount_type, advance, monthly, price_month, interest, sell_total, products, discount) {
  let modalSell = $('#sellInfo');
  let title = $('#sellInfoTitle');
  let txtName = $('#sellInfoName');
  let txtLastName = $('#sellInfoLastName');
  let txtDate = $('#sellInfoDate');
  let txtPayment = $('#sellInfoPay');
  let txtModality = $('#sellInfoModality');

  let txtDiscount = $('#sellDiscount');
  let txtAdvance = $('#sellAdvance');

  let txtMonthly = $('#sellInfoMonthly');
  let txtPrice = $('#sellInfoPrice');
  let txtInterest = $('#sellInfoInterest');
  let txtTotal = $('#sellInfoTotal');
  let txtTotalNet = $('#sellInfoTotalDesc');
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

  title.html("Folio de la venta: " + id);
  txtName.val(name);
  txtLastName.val(lastname);
  txtPayment.val(payment_type);
  txtModality.val(modality_pay);
  txtDiscount.val(discount_type);
  txtAdvance.val("$" + advance + ".00");
  txtMonthly.val(monthly);
  txtPrice.val(price_month);
  txtInterest.val(interest + "%");
  txtTotal.html("$ " + parseFloat(sell_total) + " MXN");
  txtTotalNet.html("$ " + (sell_total - discount) + " MXN");
  txtDate.html(formatDate[2] + " de " + arrMonth[formatDate[1]] + " del " + formatDate[0]);
  modalSell.modal();
  console.log('Descuento -> ', discount);
  $.ajax({
    url: "../../system/controller/SellController.php",
    type: "POST",
    data: {
      products: products
    },
    beforeSend: function () {
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

function printSell(data) {
  $.ajax({
    url: "../../system/view/ventas/ticket.php",
    type: "GET",
    data: {
      datosTicket: data
    },
    beforeSend: function () {
      console.log("Enviando impresión, por favor espera...");
    },
    error: function (error) {
      console.log('No se completó el envío de impresión -> ', error);
      result.fadeIn(800);
    },
    success: function (response) {
      //console.log("Respuesta de impresión -> " + response);
    },
  });

  // Show iframe for printing
  /* 
      if (!$('#iframe').length) {
      $('#iframeHolder').html('<iframe id="printf" name="printf" title="Prevista de Ticket" width="180" height="200" src="ventas/ticket.php?datosTicket=' + data + '"></iframe>');
      }
  */
  var arrStr = encodeURIComponent(JSON.stringify(data));

  window.open("ventas/ticket.php?datosTicket=" + arrStr + "", "_blank");
}

function searchProducts(type, search){
  let result = $('#searchProducts');
  console.log(type);
  $.ajax({
    url: '../../system/controller/SellController.php',
    type: 'POST',
    data: {
      search_products: search,
      id_categoria: type
    },
    beforeSend: function () {
      console.log('Buscando..');
      result.html('<div class="spinner mx-auto"></div><h3 class="mx-auto text-center">Cargando...</h3><h5 class="mx-auto text-center">Espere un momento por favor</h5>');
      result.fadeIn(800);
    },
    error: function (error) {
      console.log('No se pudo realizar la búsqueda -> ', error);
      result.fadeIn(800);
    },
    success: function (response) {
      console.log('Busqueda finalizada: ');
      result.hide();
      result.html(response);
      result.show();
    },
  });
}

function openProductModal(type, name){
  let modal = $('#productsModal');
  $('#modalTitle').html('Agregar ' + name);
  localStorage.setItem('cat', type);
  modal.modal();
  searchProducts(type, '');
}

function calculateDiscount(type, num){
  discount = 0;
  let prev_total = localStorage.getItem('total');
  switch(type){
    case 'NA':
      discount = 0;
      break;
    case 'T':
      discount = prev_total;
      break;
    case 'P':
      discount = (prev_total * num)/100;
      break;
    case 'D':
      discount = num;
      break;    
  }

  localStorage.setItem('discount', discount);
}

$('#search-products').on('input', function (){
  let search = $('#search-products').val();
  let type = localStorage.getItem('cat');
  searchProducts(type, search);
});