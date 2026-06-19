<?php defined('BORDAMEX') || exit;

/**
 *=======================================================
 * BORDAMEX Project
 *-------------------------------------------------------
 * @Description Controlador para crear una nueva reseña
 *=======================================================
 */

$page['name'] = 'Nueva Reseña';
$page['code'] = 'newReview';

$error = '';
$success = '';

if (isset($_POST['save']))
{

  $verify = [
    'customer_name',
    'rating',
    'comment',
    'details',
  ];

  $msg = [];

  //Validaciones de existencia
  foreach ($verify as $field)
  {
    if (!isset($_POST[$field]) or empty($_POST[$field]))
    {
      $msg[] = "El campo {$field} es obligatorio y no puede estar vacío.";
    }
  }

  if (empty($msg))
  {

    $customer_name = cleanString($_POST['customer_name'] ?? '');
    $rating = intval($_POST['rating'] ?? 5);
    $comment = cleanString($_POST['comment'] ?? '');
    $details = cleanString($_POST['details'] ?? '');
    $image_url = '';

    if ($rating < 1 || $rating > 5) $msg[] = 'La calificación debe estar entre 1 y 5.';

    // Procesar archivo de imagen si se subió uno
    if (empty($msg) && isset($_FILES['image']) && $_FILES['image']['size'] > 0)
    {
      $jerseyClass = loadClass('admin/jersey');
      $upload = $jerseyClass->uploadJerseyImage($_FILES['image']);

      if ($upload[0] === true)
      {
        // Guardar la URL completa de la imagen subida
        $image_url = Core::config('products_url') . '/' . $upload[1];
      }
      else
      {
        $msg[] = 'Error al subir la imagen: ' . $upload[1];
      }
    }

    if (empty($msg))
    {
      $data = [
        'customer_name' => $customer_name,
        'rating' => $rating,
        'comment' => $comment,
        'details' => $details,
        'image_url' => $image_url
      ];

      $reviewsModel = loadClass('admin/reviews');
      if ($reviewsModel->createReview($data))
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
  else
  {
    setToast([$msg]);
  }
}
