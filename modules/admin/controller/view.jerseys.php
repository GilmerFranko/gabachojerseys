<?php defined('BORDAMEX') || exit;

/**
 *=======================================================
 * BORDAMEX Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador para obtener la lista de Jerseys (área/ajax)
 *
 */

$page['name'] = 'Jerseys';
$page['code'] = 'viewJerseys';

// Variable actualizada a $jerseys por semántica
$jersey = loadClass('jerseys/jerseys')->getLastJersey();

// Lógica para eliminar un jersey
if (isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['id']) && is_numeric($_POST['id']))
{
  $jersey_id = (int)$_POST['id'];

  // reemplazar la siguiente línea
  // por algo como: loadClass('admin/jerseys')->deleteJersey($jersey_id)
  if (loadClass('admin/products')->deleteProduct($jersey_id))
  {
    echo json_encode(['success' => true, 'message' => 'Jersey eliminado correctamente']);
  }
  else
  {
    echo json_encode(['success' => false, 'message' => 'No se pudo eliminar el jersey']);
  }
  exit;
}
