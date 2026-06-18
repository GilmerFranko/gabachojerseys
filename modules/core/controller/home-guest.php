<?php defined('BORDAMEX') || exit;

/**
 *=======================================================
 *  BORDAMEX Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador de la página principal
 *
 *
 */

$page['name'] = 'Inicio';
$page['code'] = 'homeGuest';

$variant_selected = $_GET['variant_selected'] ?? null;

$jersey = loadClass('jerseys/jerseys')->getLastJersey();

$sectionHero = getColumns('configuration', ['id', 'image_section'], ['id', 1]);

if (!isset($jersey['id']))
{
  die("No hay producto registrado.");
}

$reviews = loadClass('admin/reviews')->getAllReviews(20);

$parser->parse($jersey['description']);

$jersey1_sizes = explode(",", $jersey['jersey1_sizes']);
$jersey2_sizes = explode(",", $jersey['jersey2_sizes']);
