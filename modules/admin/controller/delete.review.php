<?php defined('BORDAMEX') || exit;

/**
 *=======================================================
 * BORDAMEX Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador para eliminar una reseña
 *
 */

if (isset($_GET['review_id']) && is_numeric($_GET['review_id']))
{
  $review_id = (int)$_GET['review_id'];
  $reviewsModel = loadClass('admin/reviews');
  
  $review = $reviewsModel->getReviewById($review_id);
  if ($review)
  {
    if ($reviewsModel->deleteReview($review_id))
    {
      setToast([["Reseña eliminada correctamente."]]);
    }
    else
    {
      setToast([["No se pudo eliminar la reseña."]]);
    }
  }
  else
  {
    setToast([["La reseña no existe."]]);
  }
  
  redirect('admin/view.reviews');
}
else
{
  redirect('admin/view.reviews');
}
