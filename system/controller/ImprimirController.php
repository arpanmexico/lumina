<?php
    require __DIR__ . '/ticket/autoload.php'; 
    use Mike42\Escpos\Printer;
    use Mike42\Escpos\EscposImage;
    use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

    /*
	Este ejemplo imprime un hola mundo en una impresora de tickets
	en Windows.
	La impresora debe estar instalada como genérica y debe estar
	compartida
*/
 
    class Ventas {
        
    }

/*
	Conectamos con la impresora
*/
 
 
/*
	Aquí, en lugar de "POS-58" (que es el nombre de mi impresora)
	escribe el nombre de la tuya. Recuerda que debes compartirla
	desde el panel de control
*/
 
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
$printer->text("FOLIO: ");
$printer->text("TIPO DE VENTA: ");
$printer->text("PACIENTE: ");


 
/*
	Imprimimos un mensaje. Podemos usar
	el salto de línea o llamar muchas
	veces a $printer->text()
*/
$printer->text("Hola mundo\nParzibyte.me");
 
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
?>