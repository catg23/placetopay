

![enter image description here](https://dev.placetopay.com/web/wp-content/uploads/2017/10/logof.png)

# Prueba Ingeniero de Desarrollo

El propósito de esta evaluación es verificar las habilidades para entender un
problema a partir de una documentación estándar.

Se requiere desarrollar una conexión en PHP utilizando la documentación de
PlacetoPay (Redirección-Pago básico). Esta integración debe permitir realizar un pago básico desde internet.

Mediante un formulario debe suministrar los datos necesarios para realizar el pago (revisar parámetros de entrada del servicio). Debe mantener un registro de la respuesta generada por el WebService, determinando su estado actual (Aprobado, pendiente, fallido o rechazado). Listar cada intento de pago con el estado en que se encuentre.

### Tener en cuenta

 - Uso de Programación Orientada a Objetos.
 - Uso de cache (Cache Interface).
 - Separación de capas (mínimo MVC)
 - Uso de autoload (PSR 4)
 - Documentación/README
 - Formato de código (PSR 1 y 2)
 - Manejo de variables de entorno para los datos de conexión (con .env o
   config.php o similares)
 - Uso de migraciones
 - Aplicar control de versiones (commits, descripciones, organización,
   continuidad)
 - Aplicar pruebas unitarias
 - Haga un modelo que use un patrón de diseño de software que solucione
   transacciones asíncronas y distribuidas.

# Base del Proyecto
Para dar solucion a esta prueba, se define como base de proyecto el [Framework PHP Laravel 5.4](https://laravel.com/docs/5.4/releases#laravel-5.4), usando persistencia de datos mediante Base de datos Relacional [MariaDB 10.1.30](https://mariadb.com/kb/en/library/mariadb-10130-release-notes/), siguiendo las recomendaciones y especificaciones de la sección de desarrollo de [PlacetoPay Dev](https://dev.placetopay.com/web/).

# Requerimientos

 - MySql Server o MariaDB.
 - PHP 7.0 o Superior
 - Composer.
Para efectos de desarrollo podemos usar [Xammp](https://www.apachefriends.org/es/download.html) o [Wampp](http://www.wampserver.com/en/), que nos proporcionan un servidor con PHP y MySql preinstalado y listo para funcionar.

# Instalación y Configuración

Para la instalacion de este proyecto solo debemos descargar directamente o clonar este repositorio con un cliente Git compatible siguiendo estas instrucciones: [Fundamentos de Git.](https://git-scm.com/book/es/v1/Fundamentos-de-Git-Obteniendo-un-repositorio-Git)

Despues de descargar los archivos ya tenemos una copia local de nuestro proyecto y podemos proceder a instalar las dependencias necesarias, para ello utilizamos el gertor de paquetes y dependencias predefinido de Laravel, [Composer](https://getcomposer.org/) nos facilita la gestion de paquetes y depedencias utilizadas en nuestros proyectos.

### 1. Descargando e Instalando Dependencias

 Ejecutamos...
 
     D:\GitHub\placetopay composer update
     
![Composer Update](https://github.com/catg23/placetopay/blob/master/public/assets/images/readme/composer-update.PNG)

### 2. Configuracion de la Conexión a la Base de Datos

Abrimos el archivo .env ubicado en la raiz del proyecto y colocamos la informacion de nuestro servidor MySql.

![Enviroment Config](https://github.com/catg23/placetopay/blob/master/public/assets/images/readme/env-config.PNG)
### 3. Crear la Base de Datos
 Utilizando nuestro Administrador de Mysql favorito, debemos crear la base de datos en blanco para poder ejecutar las migraciones de las tablas de nuestro proyecto.
 
### 4. Migraciones
 En la raiz del proyecto ejecutamos nuestro comando artisan..
 

    D:\GitHub\placetopay\ php artisan migrate

![Migrations](https://github.com/catg23/placetopay/blob/master/public/assets/images/readme/migrations.PNG)

# Iniciando el Proyecto
 En la raiz del proyecto ejecutamos el comando 
 

    D:\GitHub\placetoplay\ php artisan serve

 
![Artisan Serve](https://github.com/catg23/placetopay/blob/master/public/assets/images/readme/artisan-serve.PNG)

Si todo ha salido bien, ya podemos acceder a `http://127.0.0.1:8000/`, y acceder al proyecto.

![Login](https://github.com/catg23/placetopay/blob/master/public/assets/images/readme/login.PNG)

## Uso de la Aplicacion

### 1.Registro

Al ingresar a la aplicación nos pedira que inciemos sesión, la primera vez debemos realizar el registro.

![Registro](https://github.com/catg23/placetopay/blob/master/public/assets/images/readme/register.PNG)

### 2. Inicio de Sesión

 Al registrarnos de manera exitosa nos direccionara a la pagina principal de la aplicación iniciando sesión de manera automatica.
 
![Home](https://github.com/catg23/placetopay/blob/master/public/assets/images/readme/home.PNG)

### 3. Registro de Clientes
Para poder realizar pagos en la aplicación debemos tener registrados los datos del cliente, esto con el fin de no estar solicitando al cliente sus datos cada vez que vayamos a realizar la peticion de pago, se hace de esta manera solo para fines de desarrollo y agilizar el proceso de pruebas.

![Customers](https://github.com/catg23/placetopay/blob/master/public/assets/images/readme/customers.PNG)

![Customer Register](https://github.com/catg23/placetopay/blob/master/public/assets/images/readme/customer-register.PNG)

![Customer Saved](https://github.com/catg23/placetopay/blob/master/public/assets/images/readme/customer-saved.PNG)

### 4. Registro de Pagos
Ya hemos realizado el registro de los clientes de prueba, ahora vamos a proceder a realizar nuestros pagos.

![Payments](https://github.com/catg23/placetopay/blob/master/public/assets/images/readme/payments.PNG)

Registramos la informacion solicitada para procesar el pago

![Payment Register](https://github.com/catg23/placetopay/blob/master/public/assets/images/readme/payment-register.PNG)

Al presionar el boton "Guardar", el sistema no dirige a la pagina de la pasarela de pago para realizar el proceso de pago. Debemos ingresar con un email registrado en Pse, de lo contrario debemos hacer el registro.

![Pse Home](https://github.com/catg23/placetopay/blob/master/public/assets/images/readme/pse-home.PNG)

Al ingresar a Pse, entraremos en modo de desarollo, seguidamente precionamos el boton "Debug" si queremos simular una respuesta "PENDING" ó presionamos el boton "Pagar" para simular un pago exitos.

![Pse Debug](https://github.com/catg23/placetopay/blob/master/public/assets/images/readme/pse-debug.PNG)

Aqui podemos "Simular" una respuesta "PENDING" presionando el boton "Return PPE"

![Pse States](https://github.com/catg23/placetopay/blob/master/public/assets/images/readme/pse-states.PNG)
![Pse Response Pending](https://github.com/catg23/placetopay/blob/master/public/assets/images/readme/pse-response-pending.PNG)
![Pse Response OK](https://github.com/catg23/placetopay/blob/master/public/assets/images/readme/pse-response-ok.PNG)

Si deseamos ver el detalle de los pagos registrados por la aplicacion, podemos precionar el icono ubicado en la parte dercha de cada registro listado en la pagina de pagos.

![Payments View](https://github.com/catg23/placetopay/blob/master/public/assets/images/readme/payments-view.PNG)![enter image description here](https://github.com/catg23/placetopay/blob/master/public/assets/images/readme/payment-datails.PNG)
## Pruebas Unitarias
Integramos 7 pruebas de tipo "Feature", principalmente para evaluar rutas y respuestas de redirección de la pasarela de pago.
Podemos acceder mediante el comando. 

    D:\GitHub\placetopay\vendor\bin\phpunit

![Phpunit](https://github.com/catg23/placetopay/blob/master/public/assets/images/readme/phpunit.PNG)

Dichas pruebas estan ubicadas en el directorio "test" dentro del proyecto.

## Agradecimientos
Quiero agradecer a la empresa PlacetoPay por permitirme ser parte de su proceso de selección y espero haber llenado las espectativas de la prueba aplicada.
