<?php defined('BORDAMEX') || exit;

/**
 *=======================================================
 * BORDAMEX Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este modelo se encarga de gestionar lo relacionado a los Jerseys
 *
 */

class Jersey extends Model
{
  /**
   * Obtiene todos los jerseys (preparado por si hay más de uno en el futuro)
   */
  public function getAllJerseys($params = [], $limit = 20)
  {
    $where = [];

    // Filtrar por descripción (en lugar de name)
    if (!empty($params['name']))
    {
      $where[] = 'p.`description` LIKE "%' . $params['name'] . '%"';
    }

    $order_by = !empty($params['order_by']) && in_array($params['order_by'], ['asc', 'desc'])
      ? $params['order_by']
      : 'desc';

    $where_clause = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : '';

    $total_query = $this->db->query(
      'SELECT COUNT(*) as p
        FROM `jerseys` AS p
        ' . $where_clause
    );

    $r = $total_query->fetch_assoc();
    $data['total'] = isset($r['p']) ? (int)$r['p'] : 0;
    $data['rows'] = $data['total'];

    $data['pages'] = Core::model('paginator', 'core')->pageIndex(array('admin', 'jerseys', null, $params), $data['total'], $limit);

    $query = $this->db->query(
      'SELECT * FROM `jerseys` AS p
        ' . $where_clause . '
        ORDER BY
            p.`created_at` ' . $order_by . '
        LIMIT ' . $data['pages']['limit']
    );

    $data['data'] = array();
    if ($query)
    {
      while ($row = $query->fetch_assoc())
      {
        $data['data'][] = $row;
      }
    }

    return $data;
  }

  /**
   * Obtiene un jersey por su ID
   *
   * @param int $jersey_id
   * @return array|false
   */
  public function getJerseyById(int $jersey_id)
  {
    $query = $this->db->query(
      'SELECT * FROM `jerseys`
       WHERE `id` = ' . intval($jersey_id) . '
       LIMIT 1'
    );

    if ($query && $query->num_rows > 0)
    {
      return $query->fetch_assoc();
    }

    return false;
  }

  /**
   * Actualiza un registro en la tabla jerseys con los datos proporcionados.
   *
   * @param int $jerseyId El ID del registro a actualizar
   * @param array $data Los datos del nuevo registro (incluyendo URLs de nuevas imágenes).
   * @return bool true si se pudo actualizar, false si no.
   */
  public function updateJersey($jerseyId, $data): bool
  {
    $query = loadClass('core/db')->smartInsert('jerseys', $data, ['id', $jerseyId]);

    return $query ? true : false;
  }

  /**
   * Sube una imagen individual para una columna de jersey
   * (Ej: jersey1_model1)
   *
   * @param array $file Archivo individual desde $_FILES (ej. $_FILES['jersey1_model1'])
   * @return array [true/false, url_de_imagen o mensaje de error]
   */
  public function uploadJerseyImage(array $file): array
  {
    global $config;

    if (isset($file) && $file['size'] > 0)
    {
      $image_url = loadClass('core/extra')->uploadFile(
        [
          'name' => $file['name'],
          'type' => $file['type'],
          'tmp_name' => $file['tmp_name'],
          'error' => $file['error'],
          'size' => $file['size']
        ],
        $config['products_path']
      );

      if ($image_url)
      {
        return [true, $image_url];
      }
    }

    return [false, 'No se ha podido subir la imagen.'];
  }

  /**
   * Elimina una imagen vieja del servidor cuando se actualiza un campo
   *
   * @param string $image_url
   */
  public function deleteJerseyImage($image_url)
  {
    global $config;

    if (!empty($image_url))
    {
      loadClass('core/extra')->deleteImage($image_url, $config['products_path']);
    }
  }
}
