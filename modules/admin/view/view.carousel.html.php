<?php defined('BORDAMEX') || exit;
/**
 * ========================================================
 *  BORDAMEX Project
 *-------------------------------------------------------
 * @autor Gilmer Franco <gil2017.com@gmail.com>
 * ========================================================
 *
 * @Description Vista para ver el carrusel
 *
 *
 */
require Core::view('head', 'core');
?>
<section id="adminViewCarousel">
  <!-- Header -->
  <div class="c">
    <div class="col s12">
      <h4 class="header">Gestión del Carrusel</h4>
      <div class="card">
        <div class="card-content">
          <p>Agrega y elimina imágenes del carrusel. Solo se guarda el nombre del archivo en la base de datos.</p>
          <a href="<?php echo gLink('admin/new.carousel'); ?>" class="btn waves-effect waves-light">Agregar imagen</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col s12">
      <table class="striped responsive-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Creada</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($carouselImages)): ?>
            <?php foreach ($carouselImages as $image): ?>
              <tr>
                <td><?php echo intval($image['id']); ?></td>
                <td>
                  <?php if (!empty($image['image_name'])): ?>
                    <img src="<?php echo htmlspecialchars($config['carousel_url'] . $image['image_name']); ?>" alt="Carrusel" style="max-width:120px; max-height:80px;" />
                  <?php endif; ?>
                </td>
                <td><?php echo htmlspecialchars($image['image_name']); ?></td>
                <td><?php echo date('d/m/Y H:i', intval($image['created_at'])); ?></td>
                <td>
                  <form method="post" style="display:inline-block;" onsubmit="return confirm('¿Eliminar esta imagen del carrusel?');">
                    <input type="hidden" name="action" value="delete" />
                    <input type="hidden" name="image_id" value="<?php echo intval($image['id']); ?>" />
                    <button type="submit" class="btn red darken-1">Eliminar</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="5">No hay imágenes en el carrusel.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</section>
<?php require Core::view('footer', 'core'); ?>