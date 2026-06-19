<?php defined('BORDAMEX') || exit;

/**
 *=======================================================
 * BORDAMEX Project
 *-------------------------------------------------------
 * @Description Controlador para crear una nueva reseña
 *=======================================================
 */

require_once __DIR__ . '/review.form.php';

$page['name'] = 'Nueva Reseña';
$page['code'] = 'newReview';

$error = '';
$success = '';
$review_id = 0;
$isEdit = false;
$pageTitle = 'Agregar Nueva Reseña';
$submitLabel = 'Guardar Reseña';

if (isset($_POST['save']))
{
  $result = reviewFormPrepareSave($_POST, $_FILES);
  $msg = $result['errors'];

  if (empty($msg))
  {
    $reviewsModel = loadClass('admin/reviews');
    if ($reviewsModel->createReview($result['data']))
    {
      setToast([['Reseña agregada correctamente.']]);
      redirect('admin/view.reviews');
      exit;
    }
    else
    {
      $error = 'Ocurrió un error al guardar la reseña en la base de datos.';
    }
  }
  else
  {
    setToast([$msg]);
  }
}

$reviewData = reviewFormGetViewValues();
$customer_name = $reviewData['customer_name'];
$rating = $reviewData['rating'];
$comment = $reviewData['comment'];
$details = $reviewData['details'];
$image_url = $reviewData['image_url'];

Core::view('new.review', 'admin');
