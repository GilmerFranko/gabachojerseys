<?php defined('BORDAMEX') || exit;
require Core::view('head', 'core');
?>
<style>
  /* Paleta moderna y consistencia visual */
  :root {
    --primary-color: #212121;
    --star-color: #ffb300;
    --border-radius: 12px;
    --bg-light: #f8f9fa;
  }

  .page-title {
    color: #1a1a1a;
  }

  /* Tarjeta principal mejorada */
  .custom-card {
    border-radius: var(--border-radius);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    border: 1px solid #f0f0f0;
    overflow: hidden;
    background: #ffffff;
  }

  .custom-card .card-content {
    padding: 30px !important;
  }

  .card-title-main {
    font-size: 1.3rem !important;
    font-weight: 700 !important;
    color: var(--primary-color);
    margin-bottom: 25px !important;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  /* Sección interactiva de Estrellas */
  .rating-container {
    margin-bottom: 25px;
  }

  .rating-label {
    font-size: 0.9rem;
    color: #757575;
    margin-bottom: 8px;
    display: block;
  }

  .star-rating {
    display: inline-flex;
    gap: 6px;
    background: var(--bg-light);
    padding: 8px 16px;
    border-radius: 30px;
    border: 1px dashed #e0e0e0;
  }

  .star-rating .material-icons {
    cursor: pointer;
    font-size: 2.2rem;
    color: #bdbdbd;
    transition: transform 0.2s, color 0.2s;
  }

  .star-rating .material-icons:hover {
    transform: scale(1.15);
  }

  .star-rating .material-icons.active {
    color: var(--star-color);
  }

  /* Zona de carga y visualización de imágenes */
  .upload-zone {
    border: 2px dashed #cfd8dc;
    border-radius: var(--border-radius);
    padding: 25px;
    text-align: center;
    background: var(--bg-light);
    transition: all 0.3s ease;
    cursor: pointer;
    position: relative;
  }

  .upload-zone:hover {
    border-color: var(--primary-color);
    background: #f1f3f4;
  }

  .upload-zone .material-icons {
    font-size: 3.5rem;
    color: #78909c;
  }

  .image-preview-wrapper {
    margin-top: 15px;
    position: relative;
    display: inline-block;
    max-width: 100%;
  }

  .image-preview-wrapper img {
    max-width: 100%;
    max-height: 250px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    display: block;
  }

  .remove-preview-btn {
    position: absolute;
    top: -10px;
    right: -10px;
    background: #d32f2f;
    color: #fff;
    border: none;
    border-radius: 50%;
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    transition: background 0.2s;
  }

  .remove-preview-btn:hover {
    background: #b71c1c;
  }

  /* Botón de volver mejorado */
  .btn-back {
    color: #616161 !important;
    font-weight: 500;
    text-transform: none;
    border-radius: 8px;
    padding: 0 15px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }

  .btn-back:hover {
    background-color: rgba(0, 0, 0, 0.05) !important;
  }

  /* Botón de envío */
  .btn-submit {
    background-color: var(--primary-color) !important;
    border-radius: 8px;
    font-weight: 600;
    letter-spacing: 0.5px;
    transition: all 0.3s;
  }

  .btn-submit:hover {
    background-color: #333333 !important;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
  }

  /* Inputs de Materialize con toques modernos */
  .input-field input[type=text]:focus+label,
  .input-field textarea:focus+label {
    color: var(--primary-color) !important;
  }

  .input-field input[type=text]:focus,
  .input-field textarea:focus {
    border-bottom: 2px solid var(--primary-color) !important;
    box-shadow: none !important;
  }

  /* Contenedores flex rápidos */
  .flex-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    margin-bottom: 25px;
    gap: 15px;
  }
</style>

<section id="sectionNewReview">

  <div class="flex-header">
    <div>
      <h1 class="page-title" style="font-size: 1.8rem; font-weight: 700; margin: 0;">
        <?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Agregar Nueva Reseña'; ?>
      </h1>
    </div>
    <a href="<?php echo gLink('admin/view.reviews'); ?>" class="btn-flat btn-back waves-effect">
      <i class="material-icons">arrow_back</i> Volver al listado
    </a>
  </div>

  <?php if (!empty($error)): ?>
    <div class="card-panel red lighten-4 red-text text-darken-4" style="border-radius: var(--border-radius);">
      <i class="material-icons left">error_outline</i> <b>Error:</b> <?php echo $error; ?>
    </div>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data" id="reviewForm">
    <div class="card custom-card">
      <div class="card-content">

        <div class="row">
          <!-- Columna Izquierda: Información de Texto -->
          <div class="col s12 m7">
            <span class="card-title-main">
              <i class="material-icons">rate_review</i> Información de la Reseña
            </span>

            <div class="row">
              <div class="input-field col s12">
                <i class="material-icons prefix">person_outline</i>
                <input id="customer_name" name="customer_name" type="text" required value="<?php echo htmlspecialchars($customer_name ?? ''); ?>">
                <label for="customer_name" class="active">Nombre del Cliente</label>
              </div>

              <!-- Selector de Estrellas Interactivo -->
              <div class="col s12 rating-container">
                <span class="rating-label">Calificación</span>
                <div class="star-rating" id="interactiveStars">
                  <i class="material-icons star-node" data-value="1">star_border</i>
                  <i class="material-icons star-node" data-value="2">star_border</i>
                  <i class="material-icons star-node" data-value="3">star_border</i>
                  <i class="material-icons star-node" data-value="4">star_border</i>
                  <i class="material-icons star-node" data-value="5">star_border</i>
                </div>
                <!-- Input PHP oculto original actualizado por JS -->
                <input type="hidden" name="rating" id="ratingValue" value="<?php echo htmlspecialchars($rating ?? '5'); ?>" required>
              </div>

              <div class="input-field col s12">
                <i class="material-icons prefix">local_offer</i>
                <input id="details" name="details" type="text" placeholder="Ej: XL (Envio Express) / Sin Dorsal / Fan" value="<?php echo htmlspecialchars($details ?? ''); ?>">
                <label for="details" class="active">Detalles del Item (Opcional)</label>
              </div>

              <div class="input-field col s12">
                <i class="material-icons prefix">chat_bubble_outline</i>
                <textarea id="comment" name="comment" class="materialize-textarea" data-length="400" required><?php echo htmlspecialchars($comment ?? ''); ?></textarea>
                <label for="comment" class="active">Comentario</label>
              </div>
            </div>
          </div>

          <!-- Columna Derecha: Imagen del Producto y Previsualización -->
          <div class="col s12 m5">
            <span class="card-title-main">
              <i class="material-icons">image</i> Imagen del Producto
            </span>

            <!-- Zona Interactiva de Arrastre/Carga -->
            <div class="upload-zone" id="uploadZone">
              <i class="material-icons">cloud_upload</i>
              <p style="margin: 10px 0 5px 0; font-weight: 500;">Sube la foto del producto</p>
              <p class="grey-text text-darken-1" style="font-size: 0.85rem; margin: 0;">Haz clic para explorar o arrastra un archivo aquí</p>
            </div>

            <!-- Input de archivo real reubicado fuera de uploadZone para evitar propagación de clics recursivos -->
            <input type="file" id="imageInput" name="image" accept="image/*" style="display: none;">


            <!-- Contenedor dinámico de previsualización para archivos nuevos -->
            <div id="newImagePreview" class="center-align" style="display: none; margin-top: 15px;">
              <span class="grey-text" style="display: block; margin-bottom: 8px; font-size: 0.9rem;">Nueva imagen seleccionada:</span>
              <div class="image-preview-wrapper">
                <img id="previewImg" src="#" alt="Vista previa de imagen">
                <button type="button" class="remove-preview-btn" id="clearImage" title="Quitar imagen">
                  <i class="material-icons" style="font-size: 16px;">close</i>
                </button>
              </div>
            </div>

            <!-- Mostrar imagen actual si existe en la base de datos -->
            <?php if (!empty($image_url)): ?>
              <div id="currentImageContainer" class="center-align" style="margin-top: 25px; padding-top: 20px; border-top: 1px solid #eee;">
                <p class="grey-text" style="margin-bottom: 10px; font-size: 0.9rem;">Imagen actual del servidor</p>
                <div class="image-preview-wrapper">
                  <img src="<?php echo htmlspecialchars($image_url); ?>" alt="Imagen actual" style="border: 1px solid #e0e0e0;">
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>

      </div>
    </div>

    <!-- Botonera inferior de confirmación -->
    <div class="row">
      <div class="col s12 center-align" style="margin-bottom: 40px;">
        <button type="submit" name="save" id="btnSubmit" class="btn-large btn-submit waves-effect waves-light" style="width: 100%; max-width: 320px;">
          <i class="material-icons left" id="submitIcon">save</i>
          <span id="submitText"><?php echo isset($submitLabel) ? htmlspecialchars($submitLabel) : 'Guardar Reseña'; ?></span>
        </button>
      </div>
    </div>

  </form>
</section>

<!-- Librerías requeridas -->
<script type="text/javascript" src="<?php echo $config['base_url']; ?>/static/js/admin.js"></script>
<script>
  $(document).ready(function() {
    // 1. Lógica Interactiva del Rating de Estrellas
    const $stars = $('.star-node');
    const $ratingInput = $('#ratingValue');

    function highlightStars(rating) {
      $stars.each(function() {
        const val = parseInt($(this).data('value'));
        if (val <= rating) {
          $(this).text('star').addClass('active');
        } else {
          $(this).text('star_border').removeClass('active');
        }
      });
    }

    // Inicializar visualización del valor cargado desde PHP
    highlightStars(parseInt($ratingInput.val()));

    // Eventos Hover para experiencia dinámica
    $stars.on('mouseenter', function() {
      const currentHoverVal = parseInt($(this).data('value'));
      $stars.each(function() {
        if (parseInt($(this).data('value')) <= currentHoverVal) {
          $(this).text('star').css('color', 'var(--star-color)');
        } else {
          $(this).text('star_border').css('color', '#bdbdbd');
        }
      });
    });

    // Restaurar calificación seleccionada al salir del área
    $('#interactiveStars').on('mouseleave', function() {
      highlightStars(parseInt($ratingInput.val()));
      $stars.css('color', ''); // Resetear color inline de hover
    });

    // Guardar valor al hacer click
    $stars.on('click', function() {
      const selectedVal = parseInt($(this).data('value'));
      $ratingInput.val(selectedVal);
      highlightStars(selectedVal);
      M.toast({
        html: 'Calificación cambiada a ' + selectedVal + ' estrellas',
        displayLength: 1500
      });
    });


    // 2. Control de Carga de Archivos Integrado
    const $uploadZone = $('#uploadZone');
    const $imageInput = $('#imageInput');
    const $newImagePreview = $('#newImagePreview');
    const $previewImg = $('#previewImg');
    const $currentImageContainer = $('#currentImageContainer');

    $uploadZone.on('click', function() {
      $imageInput.click();
    });

    // Detener propagación de clics en el input para evitar bucles infinitos
    $imageInput.on('click', function(e) {
      e.stopPropagation();
    });


    // Previsualización de imagen en vivo
    $imageInput.on('change', function(e) {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
          $previewImg.attr('src', event.target.result);
          $newImagePreview.fadeIn();
          // Ocultar la imagen anterior temporalmente para no confundir al usuario
          if ($currentImageContainer.length) {
            $currentImageContainer.css('opacity', '0.3');
          }
        };
        reader.readAsDataURL(file);
      }
    });

    // Limpiar imagen seleccionada
    $('#clearImage').on('click', function(e) {
      e.stopPropagation();
      $imageInput.val('');
      $newImagePreview.fadeOut(function() {
        $previewImg.attr('src', '#');
      });
      if ($currentImageContainer.length) {
        $currentImageContainer.css('opacity', '1');
      }
    });

    // Soporte para Arrastrar y Soltar (Drag & Drop)
    $uploadZone.on('dragover', function(e) {
      e.preventDefault();
      e.stopPropagation();
      $(this).css('border-color', 'var(--primary-color)').css('background', '#f1f3f4');
    });

    $uploadZone.on('dragleave', function(e) {
      e.preventDefault();
      e.stopPropagation();
      $(this).css('border-color', '#cfd8dc').css('background', 'var(--bg-light)');
    });

    $uploadZone.on('drop', function(e) {
      e.preventDefault();
      e.stopPropagation();
      $(this).css('border-color', '#cfd8dc').css('background', 'var(--bg-light)');

      const files = e.originalEvent.dataTransfer.files;
      if (files.length > 0 && files[0].type.startsWith('image/')) {
        $imageInput[0].files = files;
        $imageInput.trigger('change');
      }
    });


    // 3. Retroalimentación de carga al guardar
    $('#reviewForm').on('submit', function(e) {

      const $btn = $('#btnSubmit');
      const $icon = $('#submitIcon');
      const $text = $('#submitText');

      // Retraso mínimo de 1ms para que el navegador 
      // procese el envío del formulario antes de alterar el DOM del botón
      setTimeout(function() {
        $btn.addClass('disabled').css('pointer-events', 'none');
        $icon.text('hourglass_empty');
        $text.text('Guardando reseña...');
      }, 1);
    });
  });
</script>

<?php require Core::view('footer', 'core'); ?>