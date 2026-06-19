<?php defined('BORDAMEX') || exit;

/**
 *=======================================================
 *  BORDAMEX Project
 *-------------------------------------------------------
 * @Description Controlador para listar imágenes del carrusel
 *=======================================================
 */

$page['name'] = 'Carrusel';
$page['code'] = 'viewCarousel';

$carouselModel = loadClass('admin/carousel');
$carouselImages = $carouselModel->getAllImages();

if (isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['image_id']) && is_numeric($_POST['image_id']))
{
  $deleted = $carouselModel->deleteImage((int)$_POST['image_id']);
  if ($deleted)
  {
    setToast([['Imagen eliminada correctamente.']]);
  }
  else
  {
    setToast([['No se pudo eliminar la imagen.']]);
  }
  redirect('admin/view.carousel');
  exit;
}
