<?php defined('BORDAMEX') || exit;

/**
 *=======================================================
 * BORDAMEX Project
 *-------------------------------------------------------
 * @Description Controlador para editar una reseña existente
 *=======================================================
 */

require_once __DIR__ . '/review.form.php';

$page['name'] = 'Editar Reseña';
$page['code'] = 'editReview';

$error = '';
$success = '';
$review_id = isset($_GET['review_id']) ? (int)$_GET['review_id'] : 0;
$reviewsModel = loadClass('admin/reviews');
$review = $reviewsModel->getReviewById($review_id);

if (!$review)
{
  redirect('admin/view.reviews');
  exit;
}

$isEdit = true;
$pageTitle = 'Editar Reseña';
$submitLabel = 'Actualizar Reseña';

if (isset($_POST['save']))
{
  $result = reviewFormPrepareSave($_POST, $_FILES, $review['image_url']);
  $msg = $result['errors'];

  if (empty($msg))
  {

    if ($reviewsModel->updateReview($review_id, $result['data']))
    {
      setToast([['Reseña actualizada correctamente.']]);
      redirect('admin/view.reviews');
      exit;
    }
    else
    {
      $error = 'Ocurrió un error al actualizar la reseña en la base de datos.';
    }
  }
  else
  {
    setToast([$msg]);
  }
}

$reviewData = reviewFormGetViewValues($review);
$customer_name = $reviewData['customer_name'];
$rating = $reviewData['rating'];
$comment = $reviewData['comment'];
$details = $reviewData['details'];
$image_url = $reviewData['image_url'];
