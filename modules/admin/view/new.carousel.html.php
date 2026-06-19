<?php defined('BORDAMEX') || exit;

/**
 *=======================================================
 * BORDAMEX Project
 *-------------------------------------------------------
 * @Description Vista para subir imágenes al carrusel (Estilos puros Materialize)
 *=======================================================
 */
require Core::view('head', 'core');
?>

<section>
  <!-- Título de la Sección -->
  <div class="row">
    <div class="col s12">
      <h4 class="header">Agregar Imagen al Carrusel</h4>
    </div>
  </div>

  <div class="row">
    <div class="col s12 m8 l6">
      <div class="card">
        <div class="card-content">

          <!-- Mensaje de Error (Utilizando alertas estándar de Materialize) -->
          <?php if (!empty($error)): ?>
            <div class="card-panel red lighten-4 red-text text-darken-4">
              <span class="valign-wrapper">
                <i class="material-icons left">error</i>
                <?php echo htmlspecialchars($error); ?>
              </span>
            </div>
          <?php endif; ?>

          <!-- Formulario estándar con componentes File de Materialize -->
          <form method="post" enctype="multipart/form-data" id="carouselUploadForm">

            <div class="file-field input-field">
              <div class="btn waves-effect waves-light blue">
                <span>Seleccionar imagen</span>
                <input type="file" name="image" id="imageInput" accept="image/png,image/jpeg,image/gif" required />
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text" placeholder="Sube una imagen para el carrusel" />
              </div>
            </div>

            <!-- Vista Previa de la Imagen (Opcional, usando clases nativas de Materialize) -->
            <div id="previewContainer" class="center-align" style="display: none; margin-top: 20px; margin-bottom: 20px;">
              <img id="imagePreview" class="responsive-img z-depth-1" style="max-height: 220px;" alt="Vista previa" />
            </div>

            <!-- Botones de Acción de Materialize -->
            <div class="input-field" style="margin-top: 30px;">
              <button type="submit" name="save" class="btn waves-effect waves-light green">Guardar</button>
              <a href="<?php echo gLink('admin/view.carousel'); ?>" class="btn waves-effect waves-light grey">Cancelar</a>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</section>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const fileInput = document.getElementById('imageInput');
    const previewContainer = document.getElementById('previewContainer');
    const imagePreview = document.getElementById('imagePreview');

    // Manejador del cambio de archivo para la previsualización nativa
    fileInput.addEventListener('change', function() {
      if (this.files && this.files[0]) {
        const file = this.files[0];

        // Comprobar que sea una imagen válida
        if (!file.type.match('image.*')) {
          alert('Por favor selecciona un archivo de imagen válido (PNG, JPG o GIF).');
          return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
          imagePreview.src = e.target.result;
          previewContainer.style.display = 'block';
        }
        reader.readAsDataURL(file);
      } else {
        previewContainer.style.display = 'none';
        imagePreview.src = '';
      }
    });
  });
</script>

<?php require Core::view('footer', 'core'); ?>