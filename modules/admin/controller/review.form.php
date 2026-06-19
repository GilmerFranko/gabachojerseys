<?php defined('BORDAMEX') || exit;

function reviewFormGetViewValues(array $review = [])
{
  return [
    'customer_name' => isset($_POST['customer_name']) ? cleanString($_POST['customer_name']) : ($review['customer_name'] ?? ''),
    'rating' => isset($_POST['rating']) ? intval($_POST['rating']) : (isset($review['rating']) ? intval($review['rating']) : 5),
    'comment' => isset($_POST['comment']) ? cleanString($_POST['comment']) : ($review['comment'] ?? ''),
    'details' => isset($_POST['details']) ? cleanString($_POST['details']) : ($review['details'] ?? ''),
    'image_url' => $review['image_url'] ?? ''
  ];
}

function reviewFormValidate(array $post)
{
  $required = [
    'customer_name',
    'rating',
    'comment',
    'details',
  ];

  $errors = [];
  foreach ($required as $field)
  {
    if (!isset($post[$field]) || trim($post[$field]) === '')
    {
      $errors[] = "El campo {$field} es obligatorio y no puede estar vacío.";
    }
  }

  $rating = intval($post['rating'] ?? 0);
  if ($rating < 1 || $rating > 5)
  {
    $errors[] = 'La calificación debe estar entre 1 y 5.';
  }

  return [
    'errors' => $errors,
    'clean' => [
      'customer_name' => cleanString($post['customer_name'] ?? ''),
      'rating' => $rating,
      'comment' => cleanString($post['comment'] ?? ''),
      'details' => cleanString($post['details'] ?? ''),
    ],
  ];
}

function reviewFormUploadImage(array $file)
{
  if (!isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK || $file['size'] <= 0)
  {
    return [
      'success' => false,
      'error' => 'No se pudo procesar la imagen.',
      'image_url' => ''
    ];
  }

  $jerseyClass = loadClass('admin/jersey');
  $upload = $jerseyClass->uploadJerseyImage($file);

  if ($upload[0] === true)
  {
    return [
      'success' => true,
      'image_url' => $upload[1]
    ];
  }

  return [
    'success' => false,
    'error' => 'Error al subir la imagen: ' . $upload[1],
    'image_url' => ''
  ];
}

function reviewFormPrepareSave(array $post, array $files, ?string $existingImageUrl = null)
{
  $validation = reviewFormValidate($post);
  $errors = $validation['errors'];
  $data = $validation['clean'];
  $image_url = $existingImageUrl ?? '';

  if (empty($errors) && isset($files['image']) && $files['image']['size'] > 0)
  {
    $upload = reviewFormUploadImage($files['image']);
    if ($upload['success'])
    {
      // Borrar imagen antigua
      if (!empty($existingImageUrl))
      {
        loadClass('admin/reviews')->deleteImage($existingImageUrl);
      }
      $image_url = $upload['image_url'];
    }
    else
    {
      $errors[] = $upload['error'];
    }
  }

  if (empty($errors))
  {
    $data['image_url'] = $image_url;
  }

  return [
    'errors' => $errors,
    'data' => $data
  ];
}
