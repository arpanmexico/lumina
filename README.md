# Lumina
Sitio web y Panel de Administración de la Óptica Lumina.

## Carpetas y Archivos

./index.php => Contiene la página principal promocional.  
./system/index.php => Contiene el Inicio de Sesión al Punto de Venta.  
./ecommerce/ => Va a tener una tienda en línea (Esta se hará después).  
  
## Conexiones
Host => localhost:9000/system/  
Puerto => 9000  
Usuario => 1806141918  
Contraseña => Lumina0102.  
  
## Tareas Pendientes  
1. Implementar un buscador y un paginador en todas las secciones excepto **sucursal** y **panel principal**  
  
2. La sección Ventas y Consultas ya cuenta con una Interfaz, sin embargo falta complementar con javascript para ocultar y mostrar los campos y opciones, falta crear su controlador y sus procedimientos almecenados para su administración.  
  
3. La sección Agenda de Citas se encuentra vacía, crear una interfaz y un calendario para subir todas sus citas y en la pagina promocional en la sección **agenda tu cita** agregar el calendario para que los clientes puedan elegir una fecha y hora disponible y dejar sus datos.  
  
4. Cada que un usuario haga algo en la plataforma deberá guardarse un registro en una tabla estadísiticas, esta tendrá accion, timestamp, sección.  
  
5. En el panel principal agregar un análisis de estas estadísticas.  