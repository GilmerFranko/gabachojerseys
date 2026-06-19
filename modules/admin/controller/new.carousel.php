<?php defined('BORDAMEX') || exit;

/**
 *=======================================================
 *  BORDAMEX Project
 *-------------------------------------------------------
 * @Description Controlador para subir imágenes al carrusel
 *=======================================================
 */

$page['name'] = 'Agregar imagen al Carrusel';
$page['code'] = 'adminNewCarouselImage';

$error = '';

if (isset($_POST['save']))
{
  global $config;

  if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK || $_FILES['image']['size'] <= 0)
  {
    $error = 'Debes seleccionar una imagen válida.';
  }
  else
  {
    $imageName = loadClass('core/extra')->uploadImage($_FILES['image'], $config['carousel_path']);
    if (!$imageName)
    {
      $error = 'No se pudo subir la imagen. Asegúrate de que sea PNG/JPG/GIF y menor a 2MB.';
    }
    else
    {
      $carouselModel = loadClass('admin/carousel');
      if ($carouselModel->createImage($imageName))
      {
        setToast([['Imagen agregada al carrusel correctamente.']]);
        redirect('admin/view.carousel');
        exit;
      }

      loadClass('core/extra')->deleteImage($imageName, $config['carousel_path']);
      $error = 'No se pudo guardar la imagen en la base de datos.';
    }
  }
}
