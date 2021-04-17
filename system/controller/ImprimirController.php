<?php
require $_SERVER['DOCUMENT_ROOT'] . '/ticket/autoload.php'; 
    use Mike42\Escpos\Printer;
    use Mike42\Escpos\EscposImage;
    use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

$nombre_impresora = "POS-58"; 
 
 
$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);

$printer->setJustification(Printer::JUSTIFY_CENTER);

$logo = EscposImage::load("logo.jpg",false);

$printer->bitImage($logo);
$printer->setTextSize(2,2);
//Encabezado
$printer->text("Vidal Solis #10, Centro". "\n" . "Historico; Cd. Hidalgo." . "\n"."C.P: 61100" . "\n");
//Fecha
$printer->text(date("Y-m-d H:i:s") . "\n");
//ventas
$printer->setUnderline(Printer::UNDERLINE_SINGLE);
$printer->text("Ventas");

//Datos del pago
$tipoPago = $_POST['venta']['tipo_pago'];
$nombre = $_POST['venta']['nombre'];
$apellido = $_POST['venta']['apellidos'];
$printer->text("FOLIO: ");
$printer->text("PACIENTE: ");
$printer->text("'$nombre'". "\n");
$printer->text("'$apellido'" . "\n");
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text("Productos");
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("Cantidad");
$printer->setJustification(Printer::JUSTIFY_RIGHT);
$printer->text("Precio");

//Obtenemos el producto
for ($i=0; $i < count($_POST['venta']); $i++) { 
	$modelo = $_POST['venta']['models'][$i];
	$marca = $_POST['venta']['brands'][$i];
	$tipo = $_POST['venta']['type'][$i];
	$precio = $_POST['venta']['price'][$i];
	$cantidad = $_POST['venta']['quantity'][$i];
}

 
/*
	Imprimimos un mensaje. Podemos usar
	el salto de línea o llamar muchas
	veces a $printer->text()
*/
 
/*
	Hacemos que el papel salga. Es como 
	dejar muchos saltos de línea sin escribir nada
*/
$printer->feed();
 
/*
	Cortamos el papel. Si nuestra impresora
	no tiene soporte para ello, no generará
	ningún error
*/
$printer->cut();
 
/*
	Por medio de la impresora mandamos un pulso.
	Esto es útil cuando la tenemos conectada
	por ejemplo a un cajón
*/
$printer->pulse();
 
/*
	Para imprimir realmente, tenemos que "cerrar"
	la conexión con la impresora. Recuerda incluir esto al final de todos los archivos
*/
$printer->close();
