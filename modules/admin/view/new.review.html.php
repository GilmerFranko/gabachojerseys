<?php defined('BORDAMEX') || exit;
require Core::view('head', 'core');
?>

<style>
  .card-title {
    font-weight: 600;
    color: #212121;
  }
</style>

<section class="admin-container" id="sectionNewReview">

  <div class="row">
    <div class="col s12">
      <h1 class="page-title" style="font-size: 1.8rem; font-weight: 700; margin-bottom: 20px;">
        Agregar Nueva Reseña
      </h1>
      <a href="<?php echo gLink('admin/view.reviews'); ?>" class="btn-flat waves-effect" style="margin-bottom: 20px;">
        <i class="material-icons left">arrow_back</i> Volver al listado
      </a>
    </div>
  </div>

  <?php if (!empty($error)): ?>
    <div class="card-panel red lighten-4 red-text text-darken-4">
      <b>Error:</b> <?php echo $error; ?>
    </div>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data">
    <div class="card">
      <div class="card-content">
        <span class="card-title">Información de la Reseña</span>
        <div class="row" style="margin-top: 20px;">
          <div class="input-field col s12 m8">
            <input id="customer_name" name="customer_name" type="text" required>
            <label for="customer_name">Nombre del Cliente</label>
          </div>
          <div class="input-field col s12 m4">
            <select id="rating" name="rating" required>
              <option value="5" selected>5 Estrellas</option>
              <option value="4">4 Estrellas</option>
              <option value="3">3 Estrellas</option>
              <option value="2">2 Estrellas</option>
              <option value="1">1 Estrella</option>
            </select>
            <label for="rating">Calificación</label>
          </div>
          <div class="input-field col s12">
            <input id="details" name="details" type="text" placeholder="Ej: XL (Envio Express) / Sin Dorsal / Fan">
            <label for="details">Detalles del Item (Opcional)</label>
          </div>
          <div class="input-field col s12">
            <textarea id="comment" name="comment" class="materialize-textarea" required></textarea>
            <label for="comment">Comentario</label>
          </div>
        </div>

        <span class="card-title" style="margin-top: 20px; display: block;">Imagen del Producto</span>
        <div class="row">
          <div class="file-field input-field col s12 m6" style="margin-top: 20px;">
            <div class="btn grey darken-2">
              <span>Subir Archivo</span>
              <input type="file" name="image" accept="image/*">
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text" placeholder="Seleccionar imagen local">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col s12 center-align" style="margin-bottom: 40px;">
        <button type="submit" name="save" class="btn-large waves-effect waves-light" style="background-color: #212121; width: 100%; max-width: 300px; border-radius: 8px;">
          <i class="material-icons left">save</i> Guardar Reseña
        </button>
      </div>
    </div>

  </form>
</section>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script>
  $(document).ready(function() {
    M.updateTextFields();
    $('select').formSelect();
  });
</script>

<?php require Core::view('footer', 'core'); ?>