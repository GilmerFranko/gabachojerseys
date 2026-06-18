<?php defined('BORDAMEX') || exit;

/**
 *=======================================================
 *  BORDAMEX Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Parámetros de conexión para la base de datos
 *
 *
 */

//'p:localhost';  // PERSISTENTE
$db['hostname'] = $_ENV['DB_HOST'];    // Nombre del servidor MySQL
$db['database'] = $_ENV['DB_DATABASE'];    // Nombre de la base de datos
$db['username'] = $_ENV['DB_USERNAME'];      // Nombre del usuario de la base de datos
$db['userpass'] = $_ENV['DB_PASSWORD'];				// Contraseña del usuario de la base de datos
