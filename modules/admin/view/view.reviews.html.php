<?php defined('BORDAMEX') || exit;

/**
 *=======================================================
 * BORDAMEX Project
 *-------------------------------------------------------
 * @Description Vista modernizada del listado de reseñas para el administrador
 *=======================================================
 */
require Core::view('head', 'core');
$reviewModel = loadClass('admin/reviews');
?>

<style>
  :root {
    --primary-dark: #212121;
    --accent-color: #26a69a;
    --bg-body: #f4f7f6;
  }

  body {
    background-color: var(--bg-body);
  }

  /* Cabecera de página */
  .page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
  }

  .page-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--primary-dark);
    margin: 0;
  }

  /* Tabla Estilizada */
  .product-table-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    border: none;
  }

  table.dataTable {
    border-collapse: collapse;
    width: 100%;
  }

  thead th {
    background-color: #f8f9fa;
    color: #757575;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 1px;
    padding: 15px 20px !important;
    border-bottom: 1px solid #eee;
  }

  tbody td {
    padding: 15px 20px !important;
    vertical-align: middle;
    color: #424242;
    border-bottom: 1px solid #f1f1f1;
  }

  /* Estrellas */
  .stars-display {
    color: #f59e0b;
    font-size: 1.1rem;
    letter-spacing: -1px;
  }

  /* Acciones */
  .action-btns {
    display: flex;
    gap: 8px;
    justify-content: center;
  }

  .btn-action {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    transition: all 0.2s;
    background: #f5f5f5;
    color: #616161;
  }

  .btn-action:hover {
    background: var(--primary-dark);
    color: #fff;
  }

  .btn-delete:hover {
    background: #e53935;
    color: #fff;
  }

  /* Botón Principal */
  .btn-add-new {
    background-color: var(--primary-dark);
    text-transform: none;
    font-weight: 600;
    border-radius: 8px;
    display: flex;
    align-items: center;
  }

  /* Thumbnail */
  .review-thumb {
    width: 50px;
    height: 50px;
    border-radius: 6px;
    object-fit: cover;
    background: #f0f0f0;
  }
</style>

<section class="admin-container" id="sectionReviews">

  <div class="page-header">
    <div>
      <h1 class="page-title">Listado de Reseñas</h1>
      <p class="grey-text" style="margin: 5px 0 0 0;">Gestiona las opiniones de los clientes en la página de inicio.</p>
    </div>
    <a href="<?php echo gLink('admin/new.review') ?>" class="btn btn-add-new waves-effect waves-light">
      <i class="material-icons left">add_circle</i> Agregar Reseña
    </a>
  </div>

  <div class="product-table-card">
    <table class="highlight responsive-table">
      <thead>
        <tr>
          <th width="50">ID</th>
          <th>Cliente</th>
          <th>Calificación</th>
          <th>Detalles del Item</th>
          <th>Comentario</th>
          <th>Imagen</th>
          <th>Registrado</th>
          <th class="center-align">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($reviews)): ?>
          <?php foreach ($reviews as $rev): ?>
            <tr id="review_<?php echo $rev['id']; ?>">
              <td class="grey-text">#<?php echo $rev['id']; ?></td>
              <td><strong><?php echo htmlspecialchars($rev['customer_name']); ?></strong></td>
              <td>
                <span class="stars-display">
                  <?php echo str_repeat('★', $rev['rating']) . str_repeat('☆', 5 - $rev['rating']); ?>
                </span>
              </td>
              <td><span class="grey-text" style="font-size: 0.85rem;"><?php echo htmlspecialchars($rev['details'] ?? 'N/A'); ?></span></td>
              <td><?php echo htmlspecialchars($rev['comment']); ?></td>
              <td>
                <?php if (!empty($rev['image_url'])): ?>
                  <img src="<?= $reviewModel->getImage($rev['image_url']); ?>" alt="Producto" class="review-thumb">
                <?php else: ?>
                  <span class="grey-text" style="font-size: 0.8rem;">Sin Imagen</span>
                <?php endif; ?>
              </td>
              <td class="grey-text" style="font-size: 0.9rem;"><?php echo $rev['created_at']; ?></td>
              <td>
                <div class="action-btns">
                  <a href="<?= gLink('admin/edit.review', ['review_id' => $rev['id']]) ?>" class="btn-action btn-edit tooltipped" data-position="top" data-tooltip="Editar">
                    <i class="material-icons">edit</i>
                  </a>
                  <!-- Botón Eliminar -->
                  <a href="<?= gLink('admin/delete.review', ['review_id' => $rev['id']]) ?>"
                    class="btn-action btn-delete tooltipped" data-position="top" data-tooltip="Eliminar"
                    onclick="return confirm('¿Estás seguro de que deseas eliminar esta reseña? Esta acción no se puede deshacer.');">
                    <i class="material-icons">delete</i>
                  </a>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="8" class="center-align grey-text" style="padding: 50px !important;">
              <i class="material-icons large d-block">rate_review</i>
              <p>No se encontraron reseñas en la base de datos.</p>
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <div class="fixed-action-btn">
    <a class="btn-floating btn-large grey darken-4 waves-effect waves-light" href="<?php echo gLink('admin/new.review') ?>">
      <i class="large material-icons">add</i>
    </a>
  </div>
</section>
<script type="text/javascript" src="<?php echo $config['base_url']; ?>/static/js/admin.js"></script>

<script>
  $(document).ready(function() {
    $('.tooltipped').tooltip();
  });
</script>

<?php require Core::view('footer', 'core'); ?>