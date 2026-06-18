<?php

/**
 *=======================================================
 *  BORDAMEX Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este archivo incluirá el archivo que hará funcionar al software
 *
 *
 */

/* Definimos la cabecera*/
define('BORDAMEX', TRUE);

/* Carga de Autoload */
require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

/* Carga de Dotenv para las variables de entorno */
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/* Incluimos el archivo de ejecución principal */
require 'includes/common.php';
