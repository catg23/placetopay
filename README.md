

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

# Instalación y Configuración

Para la instalacion de este proyecto solo debemos descargar directamente o clonar este repositorio con un cliente Git compatible siguiendo estas instrucciones: [Fundamentos de Git.](https://git-scm.com/book/es/v1/Fundamentos-de-Git-Obteniendo-un-repositorio-Git)
Despues de descargar los archivos ya tenemos una copia local de nuestro proyecto y podemos proceder a instalar las dependencias necesarias, para ello utilizamos el gertor de paquetes y dependencias predefinido de Laravel, [Composer](https://getcomposer.org/) nos facilita la gestion de paquetes y depedencias utilizadas en nuestros proyectos.

 1. Descargando e Instalando Dependencias:
 ejecutamos...
 
     c:\GitHub\placetopay composer update
![enter image description here](https://github.com/catg23/placetopay/blob/master/public/assets/images/readme/composer-update.PNG)