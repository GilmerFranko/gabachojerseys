<?php defined('BORDAMEX') || exit;

/**
 *=======================================================
 *  BORDAMEX Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador para procesar el pedido
 *
 */
$page['name'] = 'Proceso de pedido';
$page['code'] = 'processPurchase';

// Procesar pedido
if (isset($_GET['action']) && $_GET['action'] === 'process_purchase')
{
  $msg_order = [];
  // Validar datos obligatorios
  if (!isset($_POST['customer_name']) || empty($_POST['customer_name']))
  {
    $msg_order[] = 'Debe ingresar su nombre.';
  }

  // WhatsApp
  if (!isset($_POST['customer_whatsapp']) || empty($_POST['customer_whatsapp']))
  {
    $msg_order[] = 'Debe ingresar su WhatsApp.';
  }

  if (!isset($_POST['shipping_method']) || empty($_POST['shipping_method']))
  {
    $msg_order[] = 'Debe seleccionar un metodo de envío.';
  }

  if (!isset($_POST['shipping_address']) || empty($_POST['shipping_address']))
  {
    $msg_order[] = 'Debe ingresar su dirección de envío.';
  }

  if (!isset($_POST['shipping_state']) || empty($_POST['shipping_state']))
  {
    $msg_order[] = 'Debe ingresar su estado donde resivirá el pedido.';
  }

  if (!isset($_POST['shipping_city']) || empty($_POST['shipping_city']))
  {
    $msg_order[] = 'Debe ingresar su ciudad donde resivirá el pedido.';
  }

  if (!isset($_POST['estimated_delivery']) || empty($_POST['estimated_delivery']))
  {
    $msg_order[] = 'Ocurrio un error';
  }

  if (!isset($_POST['jersey_id']) || empty($_POST['jersey_id']))
  {
    $msg_order[] = 'Ocurrio un error: noj1';
  }

  if (!isset($_POST['jersey1_model']) || empty($_POST['jersey1_model']))
  {
    $msg_order[] = 'No se ha seleccionado el modelo de la jersey 1.';
  }

  if (!isset($_POST['jersey2_model']) || empty($_POST['jersey2_model']))
  {
    $msg_order[] = 'No se ha seleccionado el modelo de la jersey 2.';
  }

  if (!isset($_POST['jersey1_size']) || empty($_POST['jersey1_size']))
  {
    $msg_order[] = 'No se ha seleccionado la talla de la jersey 1.';
  }

  if (!isset($_POST['jersey2_size']) || empty($_POST['jersey2_size']))
  {
    $msg_order[] = 'No se ha seleccionado la talla de la jersey 2.';
  }

  if (empty($msg_order))
  {
    $jersey_id = cleanString($_POST['jersey_id']);
    $jersey1_model = cleanString($_POST['jersey1_model']);
    $jersey1_size = cleanString($_POST['jersey1_size']);
    $jersey2_model = cleanString($_POST['jersey2_model']);
    $jersey2_size = cleanString($_POST['jersey2_size']);
    $customer_name = cleanString($_POST['customer_name']);
    $customer_whatsapp = cleanString($_POST['customer_whatsapp']);
    $estimated_delivery = cleanString($_POST['estimated_delivery']);
    $shipping_method = cleanString($_POST['shipping_method']);
    $shipping_address = cleanString($_POST['shipping_address']);
    $shipping_state = cleanString($_POST['shipping_state']);
    $shipping_city = cleanString($_POST['shipping_city']);

    // Cargar clase
    $jerseyClass = loadClass('jerseys/jerseys');
    $orderModel = loadClass("products/orders");
    $orderItemsModel = loadClass('products/order_items');
    $msg_order2 = [];

    // Obtener datos del producto
    if (!$jersey = $jerseyClass->getJerseyById($jersey_id))
    {
      $msg_order2[] = 'El jersey seleccionado no existe.';
    }

    // Verifica que la talla seleccionada exista
    if (!loadClass('jerseys/jerseys')->verifySize($jersey['jersey1_sizes'], $jersey1_size))
    {
      $msg_order2[] = 'La talla seleccionada para la primera sudadera no es valida.';
    }
    if (!loadClass('jerseys/jerseys')->verifySize($jersey['jersey2_sizes'], $jersey2_size))
    {
      $msg_order2[] = 'La talla seleccionada para la segunda sudadera no es valida.';
    }

    // Verifica de nuevo que los modelos existan
    if (!loadClass('jerseys/jerseys')->verifyModel($jersey1_model))
    {
      $msg_order2[] = 'El modelo de la primera sudadera no es valido.';
    }
    if (!loadClass('jerseys/jerseys')->verifyModel($jersey2_model))
    {
      $msg_order2[] = 'El modelo de la segunda sudadera no es valido.';
    }

    if (empty($msg_order2))
    {
      $data_order = [
        'customer_name' => $customer_name,
        'shipping_method' => $shipping_method,
        'shipping_address' => $shipping_address,
        'shipping_state' => $shipping_state,
        'shipping_city' => $shipping_city,
        'customer_whatsapp' => $customer_whatsapp,
        'estimated_delivery' => $estimated_delivery,
        'total_amount' => (isset($jersey['sale_price']) && $jersey['sale_price'] > 0) ? $jersey['sale_price'] : $jersey['original_price'],
        'order_status' => 'pending'
      ];

      // Crear pedido
      if ($order_id = $orderModel->createOrder($data_order))
      {
        $data_item_order = [
          'order_id' => $order_id,
          'product_id' => $jersey_id,
          'jersey1_model' => $jersey1_model,
          'jersey1_size' => $jersey1_size,
          'jersey2_model' => $jersey2_model,
          'jersey2_size' => $jersey2_size,
          'quantity' => 1,
          'price_at_purchase' => (isset($jersey['sale_price']) && $jersey['sale_price'] > 0) ? $jersey['sale_price'] : $jersey['original_price']
        ];

        // Crear items del pedido
        if ($orderItemsModel->createOrderItem($data_item_order))
        {
          setTI([['Pedido creado exitosamente.']]);
          redirect('pedido/' . $order_id);
          exit;
        }
        else
        {
          error_log(var_export($order_id, 1));
          // Borrar el pedido creado si no se pudieron crear los items
          $orderModel->deleteOrderById($order_id);
          $msg_order2[] = 'No se pudo crear los items del pedido. Intente nuevamente.';
        }
      }
      else
      {
        $msg_order2[] = 'No se pudo crear el pedido. Intente nuevamente.';
      }
      if (!empty($msg_order2))
      {
        setTI([$msg_order2]);
        die(var_export($msg_order2, 1));
        //redirect('core/home-guest', ['variant_id' => $variant_id]);
        //exit;
      }
    }
    else
    {
      setTI([$msg_order2]);
      redirect('/');
      exit;
    }
  }
  else
  {
    setTI([$msg_order]);
    die(var_export($msg_order, 1));
    //redirect('/');
    //exit;
  }
}

unset($msg, $jersey_id, $jersey1_model, $jersey2_model, $jersey1_size, $jersey2_size, $size_available);

//Validaciones0
$msg = [];
if (!isset($_GET['jersey_id']) or empty($_GET['jersey_id']))
{
  $msg[] = 'No ha seleccionado un jersey.';
}
if (!isset($_GET['jersey1_model']) or empty($_GET['jersey1_model']))
{
  $msg[] = 'No ha seleccionado el modelo de la primera sudadera.';
}
if (!in_array($_GET['jersey1_model'], ['1', '2', '3']))
{
  $msg[] = 'El modelo de la primera sudadera no es valido.';
}
if (!isset($_GET['jersey2_model']) or empty($_GET['jersey2_model']))
{
  $msg[] = 'No ha seleccionado el modelo de la segunda sudadera.';
}
if (!in_array($_GET['jersey2_model'], ['1', '2', '3']))
{
  $msg[] = 'El modelo de la segunda sudadera no es valido.';
}
if (!isset($_GET['jersey1_size']) or empty($_GET['jersey1_size']))
{
  $msg[] = 'No ha seleccionado la talla de la primera sudadera.';
}
if (!isset($_GET['jersey2_size']) or empty($_GET['jersey2_size']))
{
  $msg[] = 'No ha seleccionado la talla de la segunda sudadera.';
}

if (empty($msg))
{
  $jersey_id = cleanString($_GET['jersey_id']);
  $jersey1_model = cleanString($_GET['jersey1_model']);
  $jersey1_size = cleanString($_GET['jersey1_size']);
  $jersey2_model = cleanString($_GET['jersey2_model']);
  $jersey2_size = cleanString($_GET['jersey2_size']);
  $msg1 = [];

  // Obtener datos del producto
  if (!$jersey = Core::model('jerseys', 'jerseys')->getJerseyById($jersey_id))
  {
    $msg1[] = 'El jersey seleccionado no existe.';
  }

  // Verifica que la talla seleccionada exista
  if (!loadClass('jerseys/jerseys')->verifySize($jersey['jersey1_sizes'], $jersey1_size))
  {
    $msg1[] = 'La talla seleccionada para la primera sudadera no es valida.';
  }
  if (!loadClass('jerseys/jerseys')->verifySize($jersey['jersey2_sizes'], $jersey2_size))
  {
    $msg1[] = 'La talla seleccionada para la segunda sudadera no es valida.';
  }

  // Verifica de nuevo que los modelos existan
  if (!loadClass('jerseys/jerseys')->verifyModel($jersey1_model))
  {
    $msg1[] = 'El modelo de la primera sudadera no es valido.';
  }
  if (!loadClass('jerseys/jerseys')->verifyModel($jersey2_model))
  {
    $msg1[] = 'El modelo de la segunda sudadera no es valido.';
  }

  if (!empty($msg1))
  {
    setTI([$msg]);
    redirect('core/home-guest');
    exit;
  }
}
// Si hay errores, redirigir con mensajes
else
{
  die(var_export($msg, 1));
  //redirect('core/home-guest', ['variant_id' => $variant_id]);
  //exit;
}
