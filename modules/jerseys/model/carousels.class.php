<?php defined('BORDAMEX') || exit;

/**
 *=======================================================
 *  BORDAMEX Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este modelo se encarga de gestionar lo relacionado a los carousels
 *
 *
 */

class Carousels extends Model
{
  public function getAllCarousels()
  {
    return getAllRows($this->db, 'carousel_images');
  }
}
