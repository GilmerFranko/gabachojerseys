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
    return loadClass('core/db')->deleteRow('reviews', $id);
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
    return loadClass('core/db')->smartUpdate('reviews', $id, $data);
  }

  public function getImage($review)
  {
    global $config;

    if (!empty($review['image_url']))
    {
      return $config['products_url'] . '/' . $review['image_url'];
    }
    return Core::config('assets_url') . '/img/default-review.png';
  }
}
