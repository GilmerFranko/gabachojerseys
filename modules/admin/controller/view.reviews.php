<?php defined('BORDAMEX') || exit;

/**
 *=======================================================
 * BORDAMEX Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador para obtener la lista de reseñas y eliminarlas
 *
 */

$page['name'] = 'Reseñas';
$page['code'] = 'viewReviews';

$reviewsModel = loadClass('admin/reviews');

// Lógica para eliminar una reseña
if (isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['id']) && is_numeric($_POST['id']))
{
  $review_id = (int)$_POST['id'];

  if ($reviewsModel->deleteReview($review_id))
  {
    echo json_encode(['success' => true, 'message' => 'Reseña eliminada correctamente']);
  }
  else
  {
    echo json_encode(['success' => false, 'message' => 'No se pudo eliminar la reseña']);
  }
  exit;
}

$reviews = $reviewsModel->getAllReviews();
