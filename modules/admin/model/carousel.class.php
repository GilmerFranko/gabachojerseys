<?php defined('BORDAMEX') || exit;

/**
 *=======================================================
 *  BORDAMEX Project
 *-------------------------------------------------------
 * @Description Modelo para gestionar las imágenes del carrusel
 *=======================================================
 */

class Carousel extends Model
{
  public function getAllImages()
  {
    $query = $this->db->query(
      'SELECT * FROM `carousel_images`
       ORDER BY `position` ASC, `created_at` ASC'
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

  public function getImageById($id)
  {
    $query = $this->db->query(
      'SELECT * FROM `carousel_images`
       WHERE `id` = ' . intval($id) . '
       LIMIT 1'
    );

    if ($query && $query->num_rows > 0)
    {
      return $query->fetch_assoc();
    }
    return false;
  }

  public function createImage($imageName)
  {
    $position = 0;
    $query = $this->db->query('SELECT MAX(`position`) AS max_position FROM `carousel_images`');
    if ($query && $row = $query->fetch_assoc())
    {
      $position = intval($row['max_position']) + 1;
    }

    $data = [
      'image_name' => $imageName,
      'position' => $position,
      'created_at' => time()
    ];

    return loadClass('core/db')->smartInsert('carousel_images', $data);
  }

  public function deleteImage($id)
  {
    $image = $this->getImageById($id);
    if (!$image)
    {
      return false;
    }

    if (!loadClass('core/extra')->deleteImage($image['image_name'], Core::config('carousel_path')))
    {
      return false;
    }

    return loadClass('core/db')->deleteRow('carousel_images', $id);
  }
}
