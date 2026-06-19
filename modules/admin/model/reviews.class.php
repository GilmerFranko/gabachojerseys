<?php defined('BORDAMEX') || exit;

/**
 *=======================================================
 *  BORDAMEX Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este modelo se encarga de gestionar las reseñas en el panel de administración
 *
 */

class Reviews extends Model
{
  /**
   * Obtiene la lista de reseñas ordenadas por fecha descendente
   */
  public function getAllReviews($limit = 100)
  {
    $query = $this->db->query(
      'SELECT * FROM `reviews`
       ORDER BY `created_at` DESC
       LIMIT ' . intval($limit)
    );

    $data = [];
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
   * Obtiene una reseña por su ID
   */
  public function getReviewById($id)
  {
    $query = $this->db->query(
      'SELECT * FROM `reviews`
       WHERE `id` = ' . intval($id) . '
       LIMIT 1'
    );

    if ($query && $query->num_rows > 0)
    {
      return $query->fetch_assoc();
    }
    return false;
  }

  /**
   * Elimina una reseña por su ID
   */
  public function deleteReview($id)
  {
    // Optiene imagen
    $review = $this->getReviewById($id);
    if ($review && !empty($review['image_url']))
    {
      $this->deleteImage($review['image_url']);
    }
    return loadClass('core/db')->deleteRow('reviews', $id);
  }

  /**
   * Elimina una imagen vieja del servidor cuando se actualiza un campo
   *
   * @param string $image_url
   */
  public function deleteImage($image_url)
  {
    global $config;

    if (!empty($image_url))
    {
      loadClass('core/extra')->deleteImage($image_url, $config['products_path']);
    }
  }

  /**
   * Crea una nueva reseña
   */
  public function createReview($data)
  {
    return loadClass('core/db')->smartInsert('reviews', $data);
  }

  /**
   * Actualiza una reseña existente por su ID
   */
  public function updateReview($id, $data)
  {
    // die(var_export($data, true));
    return loadClass('core/db')->smartInsert('reviews', $data, ['id', $id]);
  }

  public function getImage($review)
  {
    global $config;

    if (!empty($review))
    {
      return $config['products_url'] . '/' . $review;
    }
    return $config['images_url'] . 'default-thread-photo.png';
  }
}
