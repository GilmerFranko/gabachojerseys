<?php defined('BORDAMEX') || exit;

/**
 *=======================================================
 * BORDAMEX Project
 *-------------------------------------------------------
 * @Description Controlador para editar un Jersey
 *=======================================================
 */

$page['name'] = 'Editar Jersey';
$page['code'] = 'editJersey';

// Obtener el ID del jersey desde la URL
$jersey_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Instanciar la clase y obtener los datos
$jerseyClass = loadClass('admin/jersey');
$jersey = $jerseyClass->getJerseyById($jersey_id);

// Si no existe el jersey, redirigir al listado
if (!$jersey)
{
  Core::model('extra', 'core')->generateUrl('admin', 'view.jerseys', null, null, true);
  exit;
}

$error = '';
$success = '';

// Procesar el formulario
if (isset($_POST['save']))
{
  $msg = []; // Arreglo unificado para todos los errores

  // 1. Validar que los campos no estén vacíos
  if (empty($_POST['description']))    $msg[] = 'La descripción no puede estar vacía.';
  if (empty($_POST['jersey1_sizes']))  $msg[] = 'Las tallas del jersey 1 no pueden estar vacías.';
  if (empty($_POST['jersey2_sizes']))  $msg[] = 'Las tallas del jersey 2 no pueden estar vacías.';
  if (empty($_POST['sale_price']))     $msg[] = 'El precio de venta no puede estar vacío.';
  if (empty($_POST['original_price'])) $msg[] = 'El precio original no puede estar vacío.';

  // 2. Limpieza de variables
  $j_description    = escape($_POST['description'] ?? '');
  $j_jersey1_sizes  = cleanString($_POST['jersey1_sizes'] ?? '');
  $j_jersey2_sizes  = cleanString($_POST['jersey2_sizes'] ?? '');
  $j_sale_price     = cleanString($_POST['sale_price'] ?? '');
  $j_original_price = cleanString($_POST['original_price'] ?? '');

  // 3. Validar formato de tallas: Una sola palabra o varias separadas estrictamente por comas
  // Regex: Permite valores alfanuméricos (S, M, XL, 42) separados por comas. Acepta espacios después de la coma.
  $regexTallas = '/^[a-zA-Z0-9]+(\s*,\s*[a-zA-Z0-9]+)*$/';

  if (!empty($j_jersey1_sizes) && !preg_match($regexTallas, trim($j_jersey1_sizes)))
  {
    $msg[] = 'Las tallas del Jersey 1 deben estar separadas por coma (ej. S,M,L) o ser una sola talla sin espacios.';
  }

  if (!empty($j_jersey2_sizes) && !preg_match($regexTallas, trim($j_jersey2_sizes)))
  {
    $msg[] = 'Las tallas del Jersey 2 deben estar separadas por coma (ej. S,M,L) o ser una sola talla sin espacios.';
  }

  // 4. Procesar solo si NO hay errores de validación de texto
  if (empty($msg))
  {
    $data = [
      'description'    => $j_description,
      'jersey1_sizes'  => $j_jersey1_sizes,
      'jersey2_sizes'  => $j_jersey2_sizes,
      'sale_price'     => $j_sale_price,
      'original_price' => $j_original_price
    ];

    $image_fields = [
      'jersey1_model1',
      'jersey1_model2',
      'jersey1_model3',
      'jersey2_model1',
      'jersey2_model2',
      'jersey2_model3'
    ];

    // Procesar imágenes de forma dinámica
    foreach ($image_fields as $field)
    {
      if (isset($_FILES[$field]) && $_FILES[$field]['size'] > 0)
      {
        $upload = $jerseyClass->uploadJerseyImage($_FILES[$field]);

        if ($upload[0] === true)
        {
          // Si se subió con éxito, eliminar la imagen anterior
          if (!empty($jersey[$field]))
          {
            $jerseyClass->deleteJerseyImage($jersey[$field]);
          }
          $data[$field] = $upload[1];
        }
        else
        {
          $msg[] = "Error al subir la imagen para $field: " . $upload[1];
        }
      }
    }

    // 5. Actualizar BD si tampoco hubo fallos al subir las imágenes
    if (empty($msg))
    {
      if ($jerseyClass->updateJersey($jersey_id, $data))
      {
        $success = "El jersey ha sido actualizado correctamente.";
        $jersey = $jerseyClass->getJerseyById($jersey_id); // Refrescar los datos para la vista
      }
      else
      {
        $msg[] = "Ocurrió un error al intentar actualizar la base de datos.";
      }
    }
  }
  else
  {
    setToast([$msg]);
  }
}
