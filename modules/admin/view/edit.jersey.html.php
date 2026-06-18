<?php defined('BORDAMEX') || exit;
require Core::view('head', 'core');
?>

<style>
  .card-title {
    font-weight: 600;
    color: #212121;
  }

  .img-preview {
    width: 100%;
    height: 150px;
    object-fit: contain;
    background: #f5f5f5;
    border-radius: 8px;
    margin-bottom: 10px;
    border: 1px solid #e0e0e0;
  }

  .section-title {
    font-size: 1.2rem;
    font-weight: bold;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #eee;
  }
</style>

<section class="admin-container" id="sectionEditJersey">

  <div class="row">
    <div class="col s12">
      <h1 class="page-title" style="font-size: 1.8rem; font-weight: 700; margin-bottom: 20px;">
        Editar Jersey #<?php echo $jersey['id']; ?>
      </h1>
      <a href="<?php echo gLink('admin/view.jerseys'); ?>" class="btn-flat waves-effect" style="margin-bottom: 20px;">
        <i class="material-icons left">arrow_back</i> Volver al listado
      </a>
    </div>
  </div>

  <?php if (!empty($success)): ?>
    <div class="card-panel green lighten-4 green-text text-darken-4">
      <b>¡Éxito!</b> <?php echo $success; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($error)): ?>
    <div class="card-panel red lighten-4 red-text text-darken-4">
      <b>Error:</b> <?php echo $error; ?>
    </div>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data">
    <div class="card">
      <div class="card-content">
        <span class="card-title">Información General</span>
        <div class="row">
          <div class="input-field col s12">
            <textarea id="description" name="description" class="materialize-textarea" required><?php echo htmlspecialchars($jersey['description']); ?></textarea>
            <label for="description">Descripción del Producto</label>
          </div>
          <div class="input-field col s12 m6">
            <i class="material-icons prefix">attach_money</i>
            <input id="sale_price" name="sale_price" type="number" step="0.01" value="<?php echo htmlspecialchars($jersey['sale_price']); ?>" required>
            <label for="sale_price">Precio de Venta</label>
          </div>
          <div class="input-field col s12 m6">
            <i class="material-icons prefix">money_off</i>
            <input id="original_price" name="original_price" type="number" step="0.01" value="<?php echo htmlspecialchars($jersey['original_price']); ?>">
            <label for="original_price">Precio Original (Opcional - tachado)</label>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col s12 m6">
        <div class="card">
          <div class="card-content">
            <span class="card-title">Detalles Jersey 1</span>

            <div class="input-field">
              <input id="jersey1_sizes" name="jersey1_sizes" type="text" value="<?php echo htmlspecialchars($jersey['jersey1_sizes']); ?>">
              <label for="jersey1_sizes">Tallas Disponibles (Ej. S,M,L,XL)</label>
            </div>

            <?php
            $j1_models = ['jersey1_model1' => 'Modelo 1', 'jersey1_model2' => 'Modelo 2', 'jersey1_model3' => 'Modelo 3'];
            foreach ($j1_models as $field => $label):
            ?>
              <div class="file-field input-field" style="margin-top: 30px;">
                <p class="grey-text text-darken-2" style="margin-bottom: 5px;"><b><?php echo $label; ?></b></p>
                <?php if (!empty($jersey[$field])): ?>
                  <img src="<?= $config['products_url'] . '/' . $jersey[$field]; ?>" alt="Imagen" class="img-preview">
                <?php else: ?>
                  <div class="img-preview center-align grey-text" style="line-height: 150px;">Sin imagen</div>
                <?php endif; ?>

                <div class="btn grey darken-2">
                  <span>Subir</span>
                  <input type="file" name="<?php echo $field; ?>" accept="image/*">
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" placeholder="Actualizar imagen de <?php echo strtolower($label); ?>">
                </div>
              </div>
            <?php endforeach; ?>

          </div>
        </div>
      </div>

      <div class="col s12 m6">
        <div class="card">
          <div class="card-content">
            <span class="card-title">Detalles Jersey 2</span>

            <div class="input-field">
              <input id="jersey2_sizes" name="jersey2_sizes" type="text" value="<?php echo htmlspecialchars($jersey['jersey2_sizes']); ?>">
              <label for="jersey2_sizes">Tallas Disponibles (Ej. S,M,L,XL)</label>
            </div>

            <?php
            $j2_models = ['jersey2_model1' => 'Modelo 1', 'jersey2_model2' => 'Modelo 2', 'jersey2_model3' => 'Modelo 3'];
            foreach ($j2_models as $field => $label):
            ?>
              <div class="file-field input-field" style="margin-top: 30px;">
                <p class="grey-text text-darken-2" style="margin-bottom: 5px;"><b><?php echo $label; ?></b></p>
                <?php if (!empty($jersey[$field])): ?>
                  <img src="<?= $config['products_url'] . '/' . $jersey[$field]; ?>" alt="Imagen" class="img-preview">
                <?php else: ?>
                  <div class="img-preview center-align grey-text" style="line-height: 150px;">Sin imagen</div>
                <?php endif; ?>

                <div class="btn grey darken-2">
                  <span>Subir</span>
                  <input type="file" name="<?php echo $field; ?>" accept="image/*">
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" placeholder="Actualizar imagen de <?php echo strtolower($label); ?>">
                </div>
              </div>
            <?php endforeach; ?>

          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col s12 center-align" style="margin-bottom: 40px;">
        <button type="submit" name="save" class="btn-large waves-effect waves-light" style="background-color: #212121; width: 100%; max-width: 300px; border-radius: 8px;">
          <i class="material-icons left">save</i> Guardar Cambios
        </button>
      </div>
    </div>

  </form>
</section>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script>
  $(document).ready(function() {
    M.updateTextFields(); // Actualiza los labels de materialize para campos con value
    $('.materialize-textarea').characterCounter();
  });
</script>

<?php require Core::view('footer', 'core'); ?>
