<?php defined('BORDAMEX') || exit;

/**
 *=======================================================
 *  BORDAMEX Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este modelo se encarga de gestionar lo relacionado a los pedidos
 *
 *
 */

class Orders extends Model
{

  /**
   * Optiene un pedido por id
   *
   * @param int $order_id Identificador del pedido
   * @return array|bool Pedido encontrado o false si no se encontr
   */
  public function getOrderById($order_id)
  {
    $query = $this->db->query(
      'SELECT *
        FROM `orders` AS o
        WHERE o.`id` = ' . (int)$order_id
    );

    if ($query)
    {
      $row = $query->fetch_assoc();
      return $row;
    }
    else
    {
      return false;
    }
  }

  /**
   * Optiene los articulos de un pedido
   *
   * @param int $order_id Identificador del pedido
   * @return array|bool Articulos del pedido encontrado o false si no se encontraron
   */
  public function getItemsByOrderId($order_id)
  {
    $query = $this->db->query(
      'SELECT *, oi.`id` AS `item_id`, j.`id` AS `jersey_id`
        FROM `order_items` AS oi
        INNER JOIN `jerseys` AS j
          ON oi.`product_id` = j.`id`
        WHERE oi.`order_id` = ' . (int)$order_id
    );

    $data = array();
    if ($query)
    {
      while ($row = $query->fetch_assoc())
      {
        $data[] = $row;
      }
    }

    return $data;
  }

  /**
   * Crea un nuevo pedido
   *
   * @param int $user_id Identificador del usuario que realizo el pedido
   * @param int $total_cost Costo total del pedido
   * @return int|bool Identificador del pedido creado o false si no se pudo crear
   */
  public function createOrder($data)
  {
    {
      if ($r = loadClass('core/db')->smartInsert('orders', $data))
      {
        return $r;
      }
      return 0;
    }
  }

  // Borra un pedido
  public function deleteOrderById($order_id)
  {
    return loadClass('core/db')->deleteRow('orders', $order_id);
  }

  /**
   * Marca un pedido como pagado
   *
   * @param int $order_id Identificador del pedido
   * @return bool True si se actualizó correctamente, false en caso contrario
   */
  public function markOrderPaid($order_id)
  {
    // Preparamos los datos a actualizar
    $data = [
      'order_status' => 'Paid'
    ];

    // Utilizamos smartInsert pasando el ID como condición para actualizar
    // Ajusta 'orders' si el nombre de tu tabla es diferente
    $result = loadClass('core/db')->smartInsert('orders', $data, ['id', (int)$order_id]);

    return ($result == true);
  }
}
