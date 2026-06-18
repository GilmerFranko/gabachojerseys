<div class="container px-0 my-4">
  <div class="product-selection-card">
    <form id="purchaseForm" action="<?= gLink('jerseys/process.purchase') ?>" method="GET">
      <input type="hidden" name="jersey_id" value="<?= $jersey['id'] ?>">
      <div class="jersey-section">
        <h2 class="section-title">Jersey 1</h2>
        <div class="gallery">
          <div class="image-option-wrapper" onclick="selectImage('jersey1', 1)">
            <img id="jersey1-img1" src="<?= $config['products_url'] . $jersey['jersey1_model1'] ?>" class="image-option">
          </div>
          <div class="image-option-wrapper" onclick="selectImage('jersey1', 2)">
            <img id="jersey1-img2" src="<?= $config['products_url'] . $jersey['jersey1_model2'] ?>" class="image-option">
          </div>
          <div class="image-option-wrapper" onclick="selectImage('jersey1', 3)">
            <img id="jersey1-img3" src="<?= $config['products_url'] . $jersey['jersey1_model3'] ?>" class="image-option">
          </div>
        </div>

        <label class="size-label">Selecciona tu talla:</label>
        <div class="size-grid">
          <?php foreach ($jersey1_sizes as $size) : ?>
            <button type="button" class="size-btn" onclick="selectSize(this, 'jersey1', '<?= $size ?>')"><?= $size ?></button>
          <?php endforeach; ?>
        </div>
        <input type="hidden" name="jersey1_size" id="jersey1_size" value="">
        <input type="hidden" name="jersey1_model" id="jersey1_model" value="">
      </div>

      <div class="jersey-section">
        <h2 class="section-title">Jersey 2</h2>
        <div class="gallery">
          <div class="image-option-wrapper" onclick="selectImage('jersey2', 1)">
            <img id="jersey2-img1" src="<?= $config['products_url'] . $jersey['jersey2_model1'] ?>" class="image-option">
          </div>
          <div class="image-option-wrapper" onclick="selectImage('jersey2', 2)">
            <img id="jersey2-img2" src="<?= $config['products_url'] . $jersey['jersey2_model2'] ?>" class="image-option">
          </div>
          <div class="image-option-wrapper" onclick="selectImage('jersey2', 3)">
            <img id="jersey2-img3" src="<?= $config['products_url'] . $jersey['jersey2_model3'] ?>" class="image-option">
          </div>
        </div>

        <label class="size-label">Selecciona tu talla:</label>
        <div class="size-grid">
          <?php foreach ($jersey2_sizes as $size) : ?>
            <button type="button" class="size-btn" onclick="selectSize(this, 'jersey2', '<?= $size ?>')"><?= $size ?></button>
          <?php endforeach; ?>
        </div>
        <input type="hidden" name="jersey2_size" id="jersey2_size" value="">
        <input type="hidden" name="jersey2_model" id="jersey2_model" value="">
      </div>

      <hr>

      <button type="submit" class="submit-btn">Finalizar Compra</button>
    </form>
  </div>
</div>

<style>
  .product-selection-card {
    background: #ffffff;
    border-radius: 12px;
    padding: 20px;
    border: 1px solid #e5e7eb;
    max-width: 500px;
    font-family: sans-serif;
  }

  .jersey-section {
    margin-bottom: 24px;
  }

  .section-title {
    font-size: 18px;
    font-weight: 700;
    color: #111;
    margin-bottom: 16px;
  }

  .size-label {
    font-size: 13px;
    font-weight: 600;
    color: #6b7280;
    display: block;
    margin-bottom: 10px;
  }

  .gallery {
    display: flex;
    gap: 8px;
    margin-bottom: 16px;
  }

  .image-option {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid #e5e7eb;
    cursor: pointer;
    transition: 0.2s;
  }

  .image-option.active {
    border-color: #111;
  }

  .size-grid {
    display: flex;
    gap: 6px;
  }

  .size-btn {
    flex: 1;
    padding: 8px;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    background: white;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s;
  }

  .size-btn.active {
    background: #111;
    color: white;
    border-color: #111;
  }

  hr {
    border: 0;
    border-top: 1px solid #f3f4f6;
    margin: 24px 0;
  }

  .submit-btn {
    width: 100%;
    padding: 12px;
    background: #000;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    margin-top: 20px;
  }

  .submit-btn:hover {
    background: #333;
  }
</style>

<script>
  // Validación al enviar el formulario
  document.getElementById('purchaseForm').addEventListener('submit', function(e) {
    const fields = [{
        id: 'jersey1_size',
        name: 'Talla Jersey 1'
      },
      {
        id: 'jersey1_model',
        name: 'Modelo Jersey 1'
      },
      {
        id: 'jersey2_size',
        name: 'Talla Jersey 2'
      },
      {
        id: 'jersey2_model',
        name: 'Modelo Jersey 2'
      }
    ];

    for (let field of fields) {
      if (!document.getElementById(field.id).value) {
        alert('Por favor, selecciona ' + field.name + ' antes de continuar.');
        e.preventDefault(); // Detiene el envío
        return false; // Detiene la ejecución del bucle
      }
    }
  });

  function selectImage(jersey, index) {
    // Busca la sección contenedora usando el pseudoclase :has
    const section = document.querySelector(`.jersey-section:has(#${jersey}_model)`);
    section.querySelectorAll('.image-option').forEach(img => img.classList.remove('active'));
    document.getElementById(`${jersey}-img${index}`).classList.add('active');
    document.getElementById(`${jersey}_model`).value = index;
  }

  function selectSize(btn, jersey, size) {
    const parent = btn.parentElement;
    parent.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById(`${jersey}_size`).value = size;
  }
</script>
