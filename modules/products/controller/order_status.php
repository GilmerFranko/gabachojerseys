<?php defined('BORDAMEX') || exit;

/**
 *=======================================================
 *  BORDAMEX Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador para Aprobar o Rechazar pagos
 *
 */
$page['name'] = 'Rastrear pedido';
$page['code'] = 'orderTraking';

if (!isset($_GET['status']) or empty($_GET['status']))
{
  // redirect('products/order_tracking');
  // exit;
}
if (isset($_SESSION['pending_order_id']) and !empty($_SESSION['pending_order_id']))
{
  $pending_order_id = cleanString($_SESSION['pending_order_id']);
  $paidStatus = ($_GET['status'] == 'aprobado') ? 'approved' : 0;
  $msg = [];
  if ($paidStatus == 'approved' or true)
  {
    if (!$order = loadClass('products/orders')->getOrderById($pending_order_id))
    {
      $msg[] = 'No se ha encontrado el pedido.';
    }
    if (!loadClass('products/orders')->markOrderPaid($pending_order_id, $paidStatus))
    {
      $msg[] = 'Error al actualizar el pedido.';
    }
    if (!empty($msg))
    {
      setTI([$msg]);
      redirect('products/order_tracking');
      exit;
    }
  }
  clearPendingPayment();
}
else
{
  setTI([['ERROR:1NQw']]);
  redirect('products/order_tracking');
  exit;
}
