# Dashboard de Cervepar

![version](https://img.shields.io/badge/version-1.0.0-blue.svg) 
![license](https://img.shields.io/badge/license-MIT-blue.svg)

## Tabla de Contenido
* Pre requisitos
* Instalación
* Configuración ENV
* Tarea programada

## Pre requisitos

Para correr la aplicación es necesario contar con:

 - PHP corriendo en su version 8 como mínimo
 - PostgreSQL corriendo en cualquier version


## Instalación
1. Clonar el repositorio inicial
2. Generar una base de datos dentro de PostgreSQL
3. Correr en la terminal `composer install`
4. Correr en la terminal `npm install`
5. Copiar `.env.example` a `.env` y actualiza los datos de la configuración, principalmente el de la base de datos
6. Correr en la terminal `php artisan key:generate`
7. Correr en la terminal `php artisan migrate --seed` para crear la base de datos

## Configuración ENV
Adicionalmente es necesario configurar las siguientes variables en el archivo `.env`:

    # Variable que indicar la url donde se tomaran los assets
    APP_URL=http://localhost
    APP_FOLDER=

    # Variables para la base de datos interna
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=laravel
    DB_USERNAME=postgres
    DB_PASSWORD=

    # Variables de los centros a conectarse
    DB_DATA=cerveparDash
    DB_USER_EXTERNAL=postgres
    DB_PASS_EXTERNAL=
    DB_HOST_CDG=127.0.0.01
    DB_HOST_CDO=127.0.0.01
    DB_HOST_CDA=127.0.0.01
    DB_HOST_CDE=127.0.0.01
    DB_HOST_CDEnc=127.0.0.01

## Tarea Programada
Una vez culminada la configuración se debe añadir la tarea programada encargada de ejecutar el procedimiento de poblar el `HOME` cada `5 minutos`.
Para ello añadiremos el siguiente comando dentro del cron job del servidor.

    * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1