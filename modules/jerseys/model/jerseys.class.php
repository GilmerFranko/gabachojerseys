<?php defined('BORDAMEX') || exit;

/**
 *=======================================================
 *  BORDAMEX Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este modelo se encarga de gestionar lo relacionado a los jerseys
 *
 *
 */

class Jerseys extends Model
{
  public function getLastJersey()
  {
    $query = $this->db->query(
      'SELECT *
       FROM `jerseys`
       ORDER BY `created_at` DESC
       LIMIT 1'
    );

    if ($query && $query->num_rows > 0)
    {
      return $query->fetch_assoc();
    }

    return false;
  }

  public function getJerseyById($jersey_id)
  {
    $query = $this->db->query(
      'SELECT *
       FROM `jerseys`
       WHERE `id` = ' . $jersey_id
    );

    if ($query && $query->num_rows > 0)
    {
      return $query->fetch_assoc();
    }

    return false;
  }

  // Verifica que la talla seleccionada exista
  public function verifySize($sizes, $sizeSelected)
  {
    // 1. Convierte el string de tallas permitidas en un array
    // Ejemplo: 'S,M,L' se convierte en ['S', 'M', 'L']
    $allowedSizes = explode(',', $sizes);

    if (in_array($sizeSelected, $allowedSizes))
    {
      return true;
    }

    return false;
  }
  // Verifica que el modelo seleccionado exista
  public function verifyModel($modelSelected)
  {
    if (!in_array($modelSelected, ['1', '2', '3']))
    {
      return false;
    }
    return true;
  }
}
